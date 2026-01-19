/**
 * ═══════════════════════════════════════════════════════════════════════════
 * FILTROS DE PRODUCTOS - JavaScript Funcional
 * Filtrado en tiempo real sin backend (usa datos del cliente)
 * ═══════════════════════════════════════════════════════════════════════════
 */

(function () {
  'use strict';

  // Esperar a que el DOM esté listo
  document.addEventListener('DOMContentLoaded', function () {
    initFiltros();
  });

  function initFiltros() {
    // Verificar que existe la barra de filtros
    const filtrosBar = document.querySelector('.tienda-filtros-bar');
    if (!filtrosBar) return;

    // Obtener productos del array global (definido en tienda.php)
    const productosData = window.tiendaProductos || [];

    // Elementos del DOM
    const inputBuscar = document.getElementById('filtroBuscar');
    const selectOrdenar = document.getElementById('filtroOrdenar');
    const inputPrecioMin = document.getElementById('precioMin');
    const inputPrecioMax = document.getElementById('precioMax');
    const sliderPrecio = document.getElementById('precioSlider');
    const btnReset = document.getElementById('resetFiltros');
    const contadorProductos = document.getElementById('contadorProductos');
    const tagButtons = document.querySelectorAll('.filtro-tag');

    // Estado de filtros
    let filtrosActivos = {
      busqueda: '',
      tags: [],
      ordenar: 'recientes',
      precioMin: 0,
      precioMax: 500
    };

    // ═══════════════════════════════════════════════════════════════════
    // EVENTOS
    // ═══════════════════════════════════════════════════════════════════

    // Búsqueda en tiempo real
    if (inputBuscar) {
      inputBuscar.addEventListener('input', debounce(function (e) {
        filtrosActivos.busqueda = e.target.value.toLowerCase().trim();
        aplicarFiltros();
      }, 300));
    }

    // Tags de filtro (Ofertas, Destacados, Bio)
    tagButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const filtro = this.dataset.filtro;

        // Toggle clase activo
        this.classList.toggle('active');

        // Actualizar array de tags activos
        if (this.classList.contains('active')) {
          if (!filtrosActivos.tags.includes(filtro)) {
            filtrosActivos.tags.push(filtro);
          }
        } else {
          filtrosActivos.tags = filtrosActivos.tags.filter(t => t !== filtro);
        }

        aplicarFiltros();
      });
    });

    // Ordenar
    if (selectOrdenar) {
      selectOrdenar.addEventListener('change', function (e) {
        filtrosActivos.ordenar = e.target.value;
        aplicarFiltros();
      });
    }

    // Precio mínimo
    if (inputPrecioMin) {
      inputPrecioMin.addEventListener('input', debounce(function (e) {
        filtrosActivos.precioMin = parseFloat(e.target.value) || 0;
        aplicarFiltros();
      }, 300));
    }

    // Precio máximo
    if (inputPrecioMax) {
      inputPrecioMax.addEventListener('input', debounce(function (e) {
        filtrosActivos.precioMax = parseFloat(e.target.value) || 500;
        if (sliderPrecio) sliderPrecio.value = filtrosActivos.precioMax;
        aplicarFiltros();
      }, 300));
    }

    // Slider de precio
    if (sliderPrecio) {
      sliderPrecio.addEventListener('input', function (e) {
        const valor = parseFloat(e.target.value);
        filtrosActivos.precioMax = valor;
        if (inputPrecioMax) inputPrecioMax.value = valor;

        // Actualizar background del slider
        const porcentaje = (valor / 500) * 100;
        this.style.background = `linear-gradient(to right, #0ea5e9 0%, #0ea5e9 ${porcentaje}%, #e5e7eb ${porcentaje}%, #e5e7eb 100%)`;

        aplicarFiltros();
      });
    }

    // Reset filtros
    if (btnReset) {
      btnReset.addEventListener('click', function () {
        resetFiltros();
      });
    }

    // ═══════════════════════════════════════════════════════════════════
    // FUNCIONES DE FILTRADO
    // ═══════════════════════════════════════════════════════════════════

    function aplicarFiltros() {
      // IMPORTANTE: Solo filtrar productos dentro del tab de Productos
      // Las secciones de abajo (Selecciones destacadas, También te puede interesar) NO se filtran
      const tabProductos = document.getElementById('tab-productos');
      if (!tabProductos) return;

      const productCards = tabProductos.querySelectorAll('.producto-grid-card, .producto-scroll-card-overlay');
      let productosVisibles = 0;

      productCards.forEach(card => {
        const productoId = card.dataset.productoId;
        const producto = productosData.find(p => p.id == productoId);

        if (!producto) {
          // Si no encontramos el producto en data, intentar extraer info del DOM
          const nombre = card.querySelector('.producto-grid-nombre a, .producto-scroll-nombre a')?.textContent?.toLowerCase() || '';
          const precioText = card.querySelector('.producto-grid-precio-actual, .producto-scroll-precio-actual')?.textContent || '0';
          const precio = parseFloat(precioText.replace(/[^\d.]/g, '')) || 0;
          const sticker = card.querySelector('.producto-grid-sticker, .producto-scroll-sticker')?.classList.contains('oferta') ? 'oferta' :
            card.querySelector('.producto-grid-sticker, .producto-scroll-sticker')?.classList.contains('nuevo') ? 'nuevo' : '';

          const visible = evaluarVisibilidad({ nombre, precio, sticker });
          card.style.display = visible ? '' : 'none';
          if (visible) productosVisibles++;
        } else {
          const visible = evaluarVisibilidad(producto);
          card.style.display = visible ? '' : 'none';
          if (visible) productosVisibles++;
        }
      });

      // Actualizar contador
      if (contadorProductos) {
        contadorProductos.textContent = productosVisibles;

        // Animación del contador
        contadorProductos.classList.add('contador-actualizado');
        setTimeout(() => contadorProductos.classList.remove('contador-actualizado'), 300);
      }

      // Mostrar mensaje si no hay resultados
      mostrarMensajeVacio(productosVisibles === 0);
    }

    function evaluarVisibilidad(producto) {
      // 1. Filtro de búsqueda
      if (filtrosActivos.busqueda) {
        const nombre = (producto.nombre || '').toLowerCase();
        const categoria = (producto.categoria || '').toLowerCase();
        const descripcion = (producto.descripcion || '').toLowerCase();

        const coincide = nombre.includes(filtrosActivos.busqueda) ||
          categoria.includes(filtrosActivos.busqueda) ||
          descripcion.includes(filtrosActivos.busqueda);

        if (!coincide) return false;
      }

      // 2. Filtro de tags
      if (filtrosActivos.tags.length > 0) {
        const sticker = (producto.sticker || '').toLowerCase();
        const categoria = (producto.categoria || '').toLowerCase();

        let coincideTag = false;

        for (const tag of filtrosActivos.tags) {
          if (tag === 'oferta' && sticker === 'oferta') coincideTag = true;
          if (tag === 'destacado' && (sticker === 'nuevo' || sticker === 'promo' || producto.rating >= 5)) coincideTag = true;
          if (tag === 'bio' && (categoria.includes('orgánico') || categoria.includes('natural') || categoria.includes('bio'))) coincideTag = true;
        }

        if (!coincideTag) return false;
      }

      // 3. Filtro de precio
      const precio = parseFloat(producto.precio) || 0;
      if (precio < filtrosActivos.precioMin || precio > filtrosActivos.precioMax) {
        return false;
      }

      return true;
    }

    function ordenarProductos() {
      const grid = document.querySelector('.tienda-productos-grid, #productosGrid');
      if (!grid) return;

      const cards = Array.from(grid.querySelectorAll('.producto-grid-card'));

      cards.sort((a, b) => {
        const productoA = getProductoFromCard(a);
        const productoB = getProductoFromCard(b);

        switch (filtrosActivos.ordenar) {
          case 'precio-asc':
            return productoA.precio - productoB.precio;
          case 'precio-desc':
            return productoB.precio - productoA.precio;
          case 'nombre':
            return productoA.nombre.localeCompare(productoB.nombre);
          case 'popular':
            return productoB.ventas - productoA.ventas;
          case 'recientes':
          default:
            return productoB.id - productoA.id;
        }
      });

      // Re-ordenar en el DOM
      cards.forEach(card => grid.appendChild(card));
    }

    function getProductoFromCard(card) {
      const id = parseInt(card.dataset.productoId) || 0;
      const producto = productosData.find(p => p.id == id);

      if (producto) return producto;

      // Fallback: extraer del DOM
      const nombre = card.querySelector('.producto-grid-nombre a')?.textContent || '';
      const precioText = card.querySelector('.producto-grid-precio-actual')?.textContent || '0';
      const precio = parseFloat(precioText.replace(/[^\d.]/g, '')) || 0;

      return { id, nombre, precio, ventas: 0 };
    }

    function resetFiltros() {
      // Reset estado
      filtrosActivos = {
        busqueda: '',
        tags: [],
        ordenar: 'recientes',
        precioMin: 0,
        precioMax: 500
      };

      // Reset inputs
      if (inputBuscar) inputBuscar.value = '';
      if (selectOrdenar) selectOrdenar.value = 'recientes';
      if (inputPrecioMin) inputPrecioMin.value = '0';
      if (inputPrecioMax) inputPrecioMax.value = '500';
      if (sliderPrecio) {
        sliderPrecio.value = 500;
        sliderPrecio.style.background = 'linear-gradient(to right, #0ea5e9 0%, #0ea5e9 100%, #e5e7eb 100%, #e5e7eb 100%)';
      }

      // Reset tags
      tagButtons.forEach(btn => btn.classList.remove('active'));

      // Aplicar (mostrar todos)
      aplicarFiltros();

      // Feedback visual
      showToast('Filtros restablecidos');
    }

    function mostrarMensajeVacio(mostrar) {
      let mensajeVacio = document.getElementById('filtros-sin-resultados');

      if (mostrar) {
        if (!mensajeVacio) {
          mensajeVacio = document.createElement('div');
          mensajeVacio.id = 'filtros-sin-resultados';
          mensajeVacio.className = 'filtros-sin-resultados';
          mensajeVacio.innerHTML = `
            <i class="ph ph-magnifying-glass"></i>
            <h4>No se encontraron productos</h4>
            <p>Intenta ajustar los filtros de búsqueda</p>
            <button onclick="document.getElementById('resetFiltros').click()">
              <i class="ph ph-arrow-counter-clockwise"></i>
              Limpiar filtros
            </button>
          `;

          // Insertar dentro del tab-productos
          const tabProductos = document.getElementById('tab-productos');
          const grid = tabProductos?.querySelector('.tienda-productos-grid-section');
          if (grid) grid.appendChild(mensajeVacio);
        }
        mensajeVacio.style.display = 'flex';
      } else {
        if (mensajeVacio) mensajeVacio.style.display = 'none';
      }
    }

    // ═══════════════════════════════════════════════════════════════════
    // UTILIDADES
    // ═══════════════════════════════════════════════════════════════════

    function debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    }

    function showToast(mensaje) {
      // Crear toast si no existe
      let toast = document.getElementById('filtros-toast');
      if (!toast) {
        toast = document.createElement('div');
        toast.id = 'filtros-toast';
        toast.className = 'filtros-toast';
        document.body.appendChild(toast);
      }

      toast.textContent = mensaje;
      toast.classList.add('visible');

      setTimeout(() => {
        toast.classList.remove('visible');
      }, 2000);
    }

    // Inicializar slider con estilo
    if (sliderPrecio) {
      sliderPrecio.style.background = 'linear-gradient(to right, #0ea5e9 0%, #0ea5e9 100%, #e5e7eb 100%, #e5e7eb 100%)';
    }

    console.log('✅ Filtros de productos inicializados');
  }
})();
