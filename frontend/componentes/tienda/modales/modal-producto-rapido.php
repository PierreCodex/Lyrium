<?php
/**
 * Modal: Vista Rápida de Producto
 */
?>

<div class="fixed inset-0 bg-black/60 z-[9999] flex items-center justify-center p-4 opacity-0 invisible transition-all duration-300 backdrop-blur-sm" id="modalProductoOverlay">
  <div class="relative bg-white rounded-3xl max-w-[950px] w-full max-h-[90vh] overflow-y-auto overflow-x-hidden custom-scrollbar shadow-[0_20px_50px_rgba(0,0,0,0.3)] transform scale-95 transition-all duration-300" id="modalProducto">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-sky-50 bg-sky-50/30">
      <div class="flex items-center gap-2 text-sky-600 font-medium">
        <i class="ph ph-image text-xl"></i>
        <span>Detalle del producto</span>
      </div>
      <button class="w-9 h-9 flex items-center justify-center rounded-full bg-white border border-gray-100 text-gray-400 hover:text-rose-500 hover:shadow-md transition-all" id="modalProductoClose">
        <i class="ph ph-x text-lg"></i>
      </button>
    </div>
    
    <!-- CUERPO DEL MODAL (Relación de aspecto y espacio fiel a la referencia) -->
    <div class="grid grid-cols-1 md:grid-cols-[1.1fr_450px]">
      
      <!-- COLUMNA IZQUIERDA: GALERÍA -->
      <div class="p-6 md:border-r border-gray-100 flex flex-col gap-4">
        
        <!-- Imagen con Zoom -->
        <div class="relative group bg-gray-50 rounded-xl border border-gray-100 overflow-hidden aspect-square flex items-center justify-center cursor-zoom-in" id="modalZoomContainer">
          
          <!-- Tip Flotante -->
          <div class="absolute top-4 left-4 z-20 px-3 py-1.5 bg-white/90 backdrop-blur-sm border border-sky-100 rounded-full text-[10px] text-gray-500 shadow-sm transition-opacity group-hover:opacity-100 flex items-center gap-2">
            <i class="ph ph-mouse"></i>
            <span>Rueda = zoom - Arrastra = mover</span>
          </div>

          <!-- Imagen con Zoom -->
          <div class="w-full h-full relative" id="modalZoomWrapper">
            <img id="modalImagenPrincipal" class="w-full h-full object-contain" src="" alt="Producto">
          </div>
          
          <!-- Controles de Zoom Abajo -->
          <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
            <button class="w-9 h-9 bg-white shadow-sm border border-gray-100 rounded-lg text-gray-400 hover:text-sky-500 transition-colors flex items-center justify-center" onclick="ModalProducto.zoom(-0.2)">
              <i class="ph ph-minus"></i>
            </button>
            <button class="w-9 h-9 bg-white shadow-sm border border-gray-100 rounded-lg text-gray-400 hover:text-sky-500 transition-colors flex items-center justify-center" onclick="ModalProducto.zoom(0.2)">
              <i class="ph ph-plus"></i>
            </button>
            <button class="w-9 h-9 bg-white shadow-sm border border-gray-100 rounded-lg text-gray-400 hover:text-sky-500 transition-colors flex items-center justify-center" onclick="ModalProducto.resetZoom()">
              <i class="ph ph-arrows-out"></i>
            </button>
          </div>
        </div>
        
        <!-- Miniaturas -->
        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-none justify-center" id="modalThumbs">
          <!-- Dinámico -->
        </div>
      </div>
      
      <!-- COLUMNA DERECHA: INFO (Calco exacto de la referencia) -->
      <div class="p-8 flex flex-col gap-6">
        
        <!-- Fila 1: Nombre y Estrellas -->
        <div class="flex justify-between items-center">
          <h2 class="text-2xl font-normal text-slate-700" id="modalNombre">Producto</h2>
          <div class="flex items-center gap-2 bg-slate-50 px-3 py-1 rounded-full border border-slate-100">
            <div class="flex items-center gap-0.5 text-slate-200 text-sm" id="modalStars">
              <i class="ph ph-star"></i><i class="ph ph-star"></i><i class="ph ph-star"></i><i class="ph ph-star"></i><i class="ph ph-star"></i>
            </div>
            <span class="text-[12px] text-slate-400" id="modalRatingText">0.0 (0)</span>
          </div>
        </div>

        <!-- Fila 2: Categoría, SKU y Stock -->
        <div class="flex justify-between items-center">
          <div class="flex gap-2">
            <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-full text-[12px] text-slate-400" id="modalCategoria">Categoría</span>
            <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-full text-[12px] text-slate-400" id="modalCodigo">SKU: ---</span>
          </div>
          <div class="flex items-center gap-1.5 text-sky-400 text-[12px]">
            <i class="ph ph-cube"></i>
            <span id="modalStock">Stock: 0</span>
          </div>
        </div>

        <!-- Fila 3: Precio y Botones (Calco de Referencia 2) -->
        <div class="flex justify-between items-center mt-2">
          <!-- Bloque Precio -->
          <div class="flex items-center gap-3">
            <span class="text-sky-400 text-2xl font-light">$</span>
            <div class="flex flex-col">
              <div class="flex items-baseline gap-2">
                <span class="text-xl font-medium text-emerald-800/80" id="modalPrecio">S/ 19.90</span>
                <span class="text-xs text-slate-300 line-through opacity-0" id="modalPrecioAnterior">S/ 00.00</span>
              </div>
            </div>
          </div>
          
          <!-- Bloque Botones -->
          <div class="flex gap-3">
            <button class="h-10 px-6 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium flex items-center gap-2 transition-all" id="modalBtnCarrito">
              <i class="ph ph-shopping-cart text-lg"></i>
              Añadir
            </button>
            <button class="h-10 px-6 rounded-full border border-sky-100 text-slate-600 text-sm font-medium flex items-center gap-2 hover:bg-sky-50 transition-all">
              <i class="ph ph-shopping-bag text-lg text-sky-400"></i>
              Ver carrito
            </button>
          </div>
        </div>
        
        <!-- Tagline -->
        <p class="text-[15px] text-slate-500 mt-2" id="modalTagline">Resumen corto del producto</p>

        <!-- Secciones Detalle -->
        <div class="space-y-6 mt-4">
          <div>
            <div class="flex items-center gap-2 text-sky-400 text-[14px] mb-2">
              <i class="ph ph-list-bullets"></i> Atributos
            </div>
            <p class="text-[14px] text-slate-400" id="modalAtributos">Sin atributos registrados.</p>
          </div>
          <div>
            <div class="flex items-center gap-2 text-sky-400 text-[14px] mb-2">
              <i class="ph ph-text-aa"></i> Detalle
            </div>
            <p class="text-[14px] text-slate-400 leading-relaxed" id="modalDescripcion">Cargando descripción...</p>
          </div>
        </div>
      </div>

    </div>
    
    <!-- Footer Tip -->
    <div class="px-6 py-3 border-t border-sky-50 bg-sky-50/20">
      <div class="flex items-center gap-2 text-[10px] text-gray-400">
        <i class="ph ph-info"></i>
        <span>Tip: miniatura cambia imagen; rueda zoom; doble click reset.</span>
      </div>
    </div>

  </div>
</div>

<style>
/* CLASES DE ESTADO */
#modalProductoOverlay.active {
  opacity: 1;
  visibility: visible;
}
#modalProductoOverlay.active #modalProducto {
  transform: scale(1);
}

/* MINIATURAS */
.modal-thumb {
  flex-shrink: 0;
  width: 70px;
  height: 70px;
  border-radius: 12px;
  border: 2px solid #f1f5f9;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.2s ease;
  background: white;
}
.modal-thumb:hover {
  border-color: #cbd5e1;
}
.modal-thumb.active {
  border-color: #0ea5e9;
  box-shadow: 0 4px 10px rgba(14, 165, 233, 0.1);
}
.modal-thumb img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 4px;
}

/* SCROLLBAR CUSTOM PRO */
.custom-scrollbar {
  scrollbar-width: thin;
  scrollbar-color: #94a3b8 #f1f5f9;
}
.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #94a3b8;
  border-radius: 10px;
  border: 2px solid #f1f5f9;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #64748b;
}

/* ZOOM CONTAINER */
#modalZoomWrapper {
  transition: transform 0.1s ease-out;
  transform-origin: center center;
}

/* ================================================ */
/* RESPONSIVE: MODAL MÓVIL                          */
/* ================================================ */
@media (max-width: 768px) {
  /* Overlay con menos padding */
  #modalProductoOverlay {
    padding: 0 !important;
    align-items: flex-end !important;
  }

  /* Modal fullscreen en móvil */
  #modalProducto {
    max-width: 100% !important;
    width: 100% !important;
    max-height: 95vh !important;
    border-radius: 20px 20px 0 0 !important;
    margin: 0 !important;
  }

  /* Grid a 1 columna */
  #modalProducto > div:nth-child(2) {
    display: flex !important;
    flex-direction: column !important;
  }

  /* Galería más compacta */
  #modalProducto .p-6.md\\:border-r {
    padding: 1rem !important;
    border-right: none !important;
  }

  /* Imagen más pequeña en móvil */
  #modalZoomContainer {
    aspect-ratio: 4/3 !important;
    min-height: 200px !important;
    max-height: 280px !important;
  }

  /* Miniaturas más pequeñas */
  .modal-thumb {
    width: 55px !important;
    height: 55px !important;
    border-radius: 8px !important;
  }

  /* Info del producto */
  #modalProducto .p-8 {
    padding: 1rem 1.25rem !important;
  }

  /* Nombre más pequeño */
  #modalNombre {
    font-size: 1.25rem !important;
  }

  /* Fila con nombre y estrellas - stack */
  #modalProducto .flex.justify-between.items-center:first-child {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 0.5rem !important;
  }

  /* Precio y botones - stack en móvil */
  #modalProducto .flex.justify-between.items-center.mt-2 {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 1rem !important;
  }

  /* Botones a ancho completo */
  #modalProducto .flex.gap-3:has(#modalBtnCarrito) {
    display: flex !important;
    flex-direction: column !important;
    width: 100% !important;
    gap: 0.5rem !important;
  }

  #modalBtnCarrito,
  #modalProducto .flex.gap-3 button {
    width: 100% !important;
    justify-content: center !important;
  }

  /* Controles de zoom más pequeños */
  #modalZoomContainer .absolute.bottom-4 button {
    width: 32px !important;
    height: 32px !important;
  }

  /* Tip de zoom oculto en móvil */
  #modalZoomContainer > div:first-child {
    display: none !important;
  }

  /* Header más compacto */
  #modalProducto .px-6.py-4 {
    padding: 0.75rem 1rem !important;
  }

  /* Footer más compacto */
  #modalProducto .px-6.py-3 {
    padding: 0.5rem 1rem !important;
  }

  /* Tags más pequeños */
  #modalCategoria,
  #modalCodigo {
    font-size: 10px !important;
    padding: 0.25rem 0.5rem !important;
  }

  /* Secciones de detalle más compactas */
  #modalProducto .space-y-6 {
    gap: 0.75rem !important;
  }
  
  #modalProducto .space-y-6 > div {
    margin-bottom: 0.5rem !important;
  }
}

/* Extra pequeño (iPhone SE, etc) */
@media (max-width: 380px) {
  #modalZoomContainer {
    max-height: 220px !important;
  }

  .modal-thumb {
    width: 45px !important;
    height: 45px !important;
  }

  #modalNombre {
    font-size: 1.1rem !important;
  }
}
</style>

<script>
const ModalProducto = {
  overlay: null,
  modal: null,
  zoomWrapper: null,
  scale: 1,
  posX: 0,
  posY: 0,
  isDragging: false,
  startX: 0,
  startY: 0,
  productoActual: null,

  init() {
    this.overlay = document.getElementById('modalProductoOverlay');
    this.modal = document.getElementById('modalProducto');
    this.zoomWrapper = document.getElementById('modalZoomWrapper');
    
    if (!this.overlay) return;

    // Eventos Básicos
    document.getElementById('modalProductoClose').addEventListener('click', () => this.cerrar());
    this.overlay.addEventListener('click', (e) => {
      if (e.target === this.overlay) this.cerrar();
    });

    // Lógica de Zoom con Rueda
    const zoomContainer = document.getElementById('modalZoomContainer');
    if (zoomContainer) {
      zoomContainer.addEventListener('wheel', (e) => {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.2 : 0.2;
        this.zoom(delta);
      });

      // Lógica de Arrastre (Pan)
      zoomContainer.addEventListener('mousedown', (e) => this.startDragging(e));
      window.addEventListener('mousemove', (e) => this.drag(e));
      window.addEventListener('mouseup', () => this.stopDragging());
      
      // Reset en doble click
      zoomContainer.addEventListener('dblclick', () => this.resetZoom());
    }
  },

  abrir(productoId) {
    const producto = this.obtenerDatosProducto(productoId);
    if (!producto) return;

    this.productoActual = producto;
    this.llenarDatos(producto);
    this.resetZoom();
    
    this.overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  },

  cerrar() {
    this.overlay.classList.remove('active');
    document.body.style.overflow = '';
  },

  obtenerDatosProducto(id) {
    const productos = window.tiendaProductos || [];
    const p = productos.find(item => item.id == id);
    if (!p) return null;

    return {
      id: p.id,
      nombre: p.nombre,
      precio: p.precio,
      precioAnterior: p.precio_anterior || null,
      categoria: p.categoria || 'Sin categoría',
      sku: `LYR-${p.categoria?.substring(0,3).toUpperCase() || 'GEN'}-${String(p.id).padStart(3, '0')}`,
      stock: p.stock || 0,
      rating: p.rating || 0.0,
      comentarios: p.ventas || 0,
      tagline: p.descripcion_corta || 'Calidad garantizada',
      descripcion: p.descripcion || 'Sin descripción detallada.',
      imagenes: [p.imagen]
    };
  },

  llenarDatos(p) {
    document.getElementById('modalNombre').textContent = p.nombre;
    document.getElementById('modalCategoria').textContent = p.categoria;
    document.getElementById('modalCodigo').textContent = `SKU: ${p.sku}`;
    document.getElementById('modalStock').textContent = `Stock: ${p.stock}`;
    document.getElementById('modalPrecio').textContent = `S/ ${p.precio.toFixed(2)}`;
    
    const pAnterior = document.getElementById('modalPrecioAnterior');
    if (p.precioAnterior) {
      pAnterior.textContent = `S/ ${p.precioAnterior.toFixed(2)}`;
      pAnterior.classList.remove('opacity-0');
    } else {
      pAnterior.classList.add('opacity-0');
    }

    const starsContainer = document.getElementById('modalStars');
    const ratingText = document.getElementById('modalRatingText');
    const starsHtml = [];
    const ratingValue = p.rating || 5.0;
    
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.floor(ratingValue)) {
            starsHtml.push('<i class="ph-fill ph-star"></i>');
        } else if (i - ratingValue < 1) {
            starsHtml.push('<i class="ph-fill ph-star-half"></i>');
        } else {
            starsHtml.push('<i class="ph ph-star text-slate-200"></i>');
        }
    }
    starsContainer.innerHTML = starsHtml.join('');
    if (ratingText) {
        ratingText.textContent = `${ratingValue.toFixed(1)} (${p.comentarios})`;
    }

    document.getElementById('modalTagline').textContent = p.tagline;
    document.getElementById('modalDescripcion').textContent = p.descripcion;
    document.getElementById('modalImagenPrincipal').src = p.imagenes[0];

    const thumbs = document.getElementById('modalThumbs');
    thumbs.innerHTML = p.imagenes.map((img, i) => `
      <div class="modal-thumb ${i === 0 ? 'active' : ''}" onclick="ModalProducto.cambiarImagen(this, '${img}')">
        <img src="${img}" alt="Thumb">
      </div>
    `).join('');
  },

  cambiarImagen(thumb, src) {
    document.getElementById('modalImagenPrincipal').src = src;
    document.querySelectorAll('.modal-thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
    this.resetZoom();
  },

  zoom(delta) {
    this.scale = Math.min(Math.max(1, this.scale + delta), 4);
    this.aplicarTransform();
  },

  resetZoom() {
    this.scale = 1;
    this.posX = 0;
    this.posY = 0;
    this.aplicarTransform();
  },

  aplicarTransform() {
    if (this.zoomWrapper) {
      this.zoomWrapper.style.transform = `scale(${this.scale}) translate(${this.posX}px, ${this.posY}px)`;
    }
  },

  startDragging(e) {
    if (this.scale <= 1) return;
    this.isDragging = true;
    this.startX = e.clientX - this.posX;
    this.startY = e.clientY - this.posY;
    document.getElementById('modalZoomContainer').classList.add('cursor-grabbing');
  },

  drag(e) {
    if (!this.isDragging) return;
    this.posX = e.clientX - this.startX;
    this.posY = e.clientY - this.startY;
    this.aplicarTransform();
  },

  stopDragging() {
    this.isDragging = false;
    document.getElementById('modalZoomContainer')?.classList.remove('cursor-grabbing');
  }
};

document.addEventListener('DOMContentLoaded', () => ModalProducto.init());

function vistaRapidaProducto(id) {
  ModalProducto.abrir(id);
}
</script>
