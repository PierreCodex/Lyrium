/**
 * TIENDA.JS - Lógica del perfil de tienda
 * Maneja: carruseles, tabs, estado abierto/cerrado, planes
 */

// ========================================
// CONFIGURACIÓN DE PLANES
// ========================================
const PLANES_CONFIG = {
  basico: {
    nombre: 'Básico',
    banners: 2,
    fotos: 8,
    redes: 3,
    scrolls: 1,
    formularioAvanzado: false,
    medallas: false,
    stickers: ['oferta', 'promo', 'descuento']
  },
  premium: {
    nombre: 'Premium',
    banners: 4,
    fotos: 30,
    redes: 10,
    scrolls: 3,
    formularioAvanzado: true,
    medallas: true,
    stickers: ['oferta', 'promo', 'descuento', 'limitado', 'nuevo', 'recomendado']
  }
};

// ========================================
// VARIABLES GLOBALES
// ========================================
let currentSlide = 0;
let bannerInterval = null;
let tiendaPlan = 'basico'; // Se carga dinámicamente

// ========================================
// INICIALIZACIÓN
// ========================================
document.addEventListener('DOMContentLoaded', () => {
  initBannerCarousel();
  initProductScrolls();
  initSliderVertical();
  initTabs();
  initEstadoTienda();
  initPlanFeatures();
});

// ========================================
// BANNER CARRUSEL (R) - Soporta múltiples banners
// ========================================
function initBannerCarousel() {
  const banners = document.querySelectorAll('.tienda-banner');
  
  banners.forEach((banner, bannerIndex) => {
    const slides = banner.querySelectorAll('.tienda-banner-slide');
    const dots = banner.querySelectorAll('.tienda-banner-dot');
    const prevBtn = banner.querySelector('.tienda-banner-nav.prev');
    const nextBtn = banner.querySelector('.tienda-banner-nav.next');
    const slidesContainer = banner.querySelector('.tienda-banner-slides');
    
    if (slides.length === 0) return;
    
    // Estado local para cada banner
    let currentSlideIndex = 0;
    let autoplayInterval = null;
    
    // Limitar slides según plan (solo para banner principal, no para banner-final)
    const isFinalBanner = banner.classList.contains('tienda-banner-final');
    const maxSlides = isFinalBanner ? slides.length : PLANES_CONFIG[tiendaPlan].banners;
    
    slides.forEach((slide, index) => {
      if (index >= maxSlides) {
        slide.style.display = 'none';
      }
    });
    
    dots.forEach((dot, index) => {
      if (index >= maxSlides) {
        dot.style.display = 'none';
      }
    });
    
    // Función de actualización local
    function updateThisBanner() {
      if (slidesContainer) {
        slidesContainer.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
      }
      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlideIndex);
      });
    }
    
    // Navegación
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        currentSlideIndex = (currentSlideIndex - 1 + Math.min(slides.length, maxSlides)) % Math.min(slides.length, maxSlides);
        updateThisBanner();
      });
    }
    
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        currentSlideIndex = (currentSlideIndex + 1) % Math.min(slides.length, maxSlides);
        updateThisBanner();
      });
    }
    
    // Dots click
    dots.forEach((dot, index) => {
      if (index >= maxSlides) return;
      dot.addEventListener('click', () => {
        currentSlideIndex = index;
        updateThisBanner();
      });
    });
    
    // Auto-play
    function startAutoplay() {
      stopAutoplay();
      autoplayInterval = setInterval(() => {
        currentSlideIndex = (currentSlideIndex + 1) % Math.min(slides.length, maxSlides);
        updateThisBanner();
      }, 5000);
    }
    
    function stopAutoplay() {
      if (autoplayInterval) {
        clearInterval(autoplayInterval);
        autoplayInterval = null;
      }
    }
    
    // Pausar en hover
    banner.addEventListener('mouseenter', stopAutoplay);
    banner.addEventListener('mouseleave', startAutoplay);
    
    // Iniciar autoplay
    startAutoplay();
  });
}

// Mantener funciones legacy para compatibilidad (ya no se usan directamente)
function updateBanner() {
  // Legacy - las actualizaciones ahora son locales por banner
}

function startBannerAutoplay() {
  // Legacy
}

function stopBannerAutoplay() {
  // Legacy
}

function startBannerAutoplay() {
  stopBannerAutoplay();
  bannerInterval = setInterval(() => {
    const maxSlides = Math.min(
      document.querySelectorAll('.tienda-banner-slide').length,
      PLANES_CONFIG[tiendaPlan].banners
    );
    currentSlide = (currentSlide + 1) % maxSlides;
    updateBanner();
  }, 5000);
}

function stopBannerAutoplay() {
  if (bannerInterval) {
    clearInterval(bannerInterval);
    bannerInterval = null;
  }
}

// ========================================
// SLIDER VERTICAL DE PRODUCTOS (SV)
// ========================================
let currentVerticalSlide = 0;
let verticalSliderInterval = null;

function initSliderVertical() {
  const track = document.querySelector('.tienda-slider-vertical-track');
  const items = document.querySelectorAll('.tienda-slider-vertical-item');
  const dots = document.querySelectorAll('.tienda-slider-vertical-dot');
  const upBtn = document.querySelector('.tienda-slider-vertical-nav.up');
  const downBtn = document.querySelector('.tienda-slider-vertical-nav.down');
  
  if (!track || items.length === 0) return;
  
  const totalSlides = items.length;
  
  // Navegación arriba
  if (upBtn) {
    upBtn.addEventListener('click', () => {
      currentVerticalSlide = (currentVerticalSlide - 1 + totalSlides) % totalSlides;
      updateVerticalSlider();
    });
  }
  
  // Navegación abajo
  if (downBtn) {
    downBtn.addEventListener('click', () => {
      currentVerticalSlide = (currentVerticalSlide + 1) % totalSlides;
      updateVerticalSlider();
    });
  }
  
  // Dots
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      currentVerticalSlide = index;
      updateVerticalSlider();
    });
  });
  
  // Auto-play
  startVerticalAutoplay();
  
  // Pausar en hover
  const wrapper = document.querySelector('.tienda-slider-vertical-wrapper');
  if (wrapper) {
    wrapper.addEventListener('mouseenter', stopVerticalAutoplay);
    wrapper.addEventListener('mouseleave', startVerticalAutoplay);
  }
  
  // Actualizar estado inicial de botones
  updateVerticalNavButtons();
}

function updateVerticalSlider() {
  const track = document.querySelector('.tienda-slider-vertical-track');
  const container = document.querySelector('.tienda-slider-vertical-container');
  const items = document.querySelectorAll('.tienda-slider-vertical-item');
  const dots = document.querySelectorAll('.tienda-slider-vertical-dot');
  
  if (!track || !container || items.length === 0) return;
  
  // Usar la altura del container para el desplazamiento
  const containerHeight = container.offsetHeight;
  track.style.transform = `translateY(-${currentVerticalSlide * containerHeight}px)`;
  
  // Actualizar dots
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentVerticalSlide);
  });
  
  updateVerticalNavButtons();
}

function updateVerticalNavButtons() {
  const items = document.querySelectorAll('.tienda-slider-vertical-item');
  const upBtn = document.querySelector('.tienda-slider-vertical-nav.up');
  const downBtn = document.querySelector('.tienda-slider-vertical-nav.down');
  
  // Opcional: deshabilitar botones en los extremos (modo no-loop)
  // Por ahora dejamos el loop activado, así que no deshabilitamos
}

function startVerticalAutoplay() {
  stopVerticalAutoplay();
  const items = document.querySelectorAll('.tienda-slider-vertical-item');
  if (items.length <= 1) return;
  
  verticalSliderInterval = setInterval(() => {
    currentVerticalSlide = (currentVerticalSlide + 1) % items.length;
    updateVerticalSlider();
  }, 4000);
}

function stopVerticalAutoplay() {
  if (verticalSliderInterval) {
    clearInterval(verticalSliderInterval);
    verticalSliderInterval = null;
  }
}

// ========================================
// SCROLL DE PRODUCTOS (S)
// ========================================
function initProductScrolls() {
  const scrollContainers = document.querySelectorAll('.tienda-scroll-container');
  
  // Limitar scrolls según plan
  const maxScrolls = PLANES_CONFIG[tiendaPlan].scrolls;
  const scrollSections = document.querySelectorAll('.tienda-scroll-section');
  
  scrollSections.forEach((section, index) => {
    if (index >= maxScrolls) {
      section.style.display = 'none';
    }
  });
  
  // Navegación de cada scroll
  document.querySelectorAll('.tienda-scroll-wrapper').forEach(wrapper => {
    const container = wrapper.querySelector('.tienda-scroll-container');
    const prevBtn = wrapper.querySelector('.tienda-scroll-nav.prev');
    const nextBtn = wrapper.querySelector('.tienda-scroll-nav.next');
    
    if (!container) return;
    
    const scrollAmount = 320;
    
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      });
    }
    
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      });
    }
  });
}

// ========================================
// PESTAÑAS (PE)
// ========================================
function initTabs() {
  const tabBtns = document.querySelectorAll('.tienda-tab-btn');
  const tabContents = document.querySelectorAll('.tienda-tab-content');
  
  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const tabId = btn.dataset.tab;
      
      // Desactivar todos
      tabBtns.forEach(b => b.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));
      
      // Activar seleccionado
      btn.classList.add('active');
      const content = document.getElementById(`tab-${tabId}`);
      if (content) {
        content.classList.add('active');
      }
    });
  });
}

// ========================================
// ESTADO ABIERTO/CERRADO
// ========================================
function initEstadoTienda() {
  const horarios = window.tiendaHorarios || null;
  if (!horarios) return;
  
  const estadoEl = document.querySelector('.tienda-estado');
  if (!estadoEl) return;
  
  const estado = calcularEstadoTienda(horarios);
  
  estadoEl.classList.remove('abierto', 'cerrado');
  estadoEl.classList.add(estado.abierto ? 'abierto' : 'cerrado');
  
  const dotEl = estadoEl.querySelector('.tienda-estado-dot');
  const textoEl = estadoEl.querySelector('.tienda-estado-texto');
  
  if (textoEl) {
    textoEl.textContent = estado.abierto ? 'Abierto' : 'Cerrado';
  }
  
  // Destacar día actual en la lista de horarios
  highlightCurrentDay();
}

function calcularEstadoTienda(horarios) {
  const ahora = new Date();
  const diasSemana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
  const diaActual = diasSemana[ahora.getDay()];
  const horaActual = ahora.getHours() * 60 + ahora.getMinutes();
  
  const horarioHoy = horarios[diaActual];
  
  if (!horarioHoy || horarioHoy.cerrado) {
    return { abierto: false, mensaje: 'Cerrado hoy' };
  }
  
  const [horaApertura, minApertura] = horarioHoy.apertura.split(':').map(Number);
  const [horaCierre, minCierre] = horarioHoy.cierre.split(':').map(Number);
  
  const aperturaMins = horaApertura * 60 + minApertura;
  const cierreMins = horaCierre * 60 + minCierre;
  
  const abierto = horaActual >= aperturaMins && horaActual < cierreMins;
  
  return {
    abierto,
    mensaje: abierto 
      ? `Cierra a las ${horarioHoy.cierre}` 
      : `Abre a las ${horarioHoy.apertura}`
  };
}

function highlightCurrentDay() {
  const diasSemana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
  const diaActual = diasSemana[new Date().getDay()];
  
  document.querySelectorAll('.tienda-horario-item').forEach(item => {
    const dia = item.dataset.dia;
    if (dia === diaActual) {
      item.classList.add('hoy');
    }
  });
}

// ========================================
// GESTIÓN DE PLANES
// ========================================
function initPlanFeatures() {
  // Obtener plan de la tienda (se pasa desde PHP)
  tiendaPlan = window.tiendaPlanActual || 'basico';
  
  const config = PLANES_CONFIG[tiendaPlan];
  
  // Limitar redes sociales
  limitarRedesSociales(config.redes);
  
  // Limitar fotos
  limitarFotos(config.fotos);
  
  // Mostrar/ocultar formulario avanzado
  toggleFormularioAvanzado(config.formularioAvanzado);
  
  // Mostrar/ocultar medallas
  toggleMedallas(config.medallas);
}

function limitarRedesSociales(maxRedes) {
  const redesBtns = document.querySelectorAll('.tienda-red-btn');
  redesBtns.forEach((btn, index) => {
    if (index >= maxRedes && !btn.classList.contains('disabled')) {
      btn.classList.add('disabled');
      btn.removeAttribute('href');
      btn.style.pointerEvents = 'none';
    }
  });
}

function limitarFotos(maxFotos) {
  const fotos = document.querySelectorAll('.tienda-foto-item');
  const container = document.querySelector('.tienda-fotos-grid');
  
  if (fotos.length > maxFotos && container) {
    // Mostrar mensaje de límite
    const limiteMsg = document.createElement('div');
    limiteMsg.className = 'tienda-fotos-limite';
    limiteMsg.innerHTML = `
      <i class="ph-crown"></i>
      Tu plan actual permite ${maxFotos} fotos. 
      <a href="planes.php" class="underline font-bold">Actualiza a Premium</a> para subir hasta 30 fotos.
    `;
    
    fotos.forEach((foto, index) => {
      if (index >= maxFotos) {
        foto.style.display = 'none';
      }
    });
    
    container.appendChild(limiteMsg);
  }
}

function toggleFormularioAvanzado(habilitado) {
  const camposAvanzados = document.querySelectorAll('.tienda-form-premium-only');
  camposAvanzados.forEach(campo => {
    if (habilitado) {
      campo.classList.remove('tienda-form-premium-only');
    }
  });
}

function toggleMedallas(habilitado) {
  const medallas = document.querySelectorAll('.tienda-badge.premium');
  medallas.forEach(medalla => {
    if (!habilitado) {
      medalla.style.display = 'none';
    }
  });
}

// ========================================
// FUNCIONES DE UTILIDAD
// ========================================
function formatearHora(hora) {
  const [h, m] = hora.split(':');
  const hora12 = h % 12 || 12;
  const ampm = h < 12 ? 'AM' : 'PM';
  return `${hora12}:${m} ${ampm}`;
}

// Lightbox para galería de fotos
function openFotoLightbox(index) {
  const fotos = document.querySelectorAll('.tienda-foto-item img');
  if (!fotos[index]) return;
  
  // Crear lightbox
  const lightbox = document.createElement('div');
  lightbox.className = 'fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4';
  lightbox.innerHTML = `
    <button class="absolute top-4 right-4 text-white text-3xl" onclick="this.parentElement.remove()">
      <i class="ph-x"></i>
    </button>
    <img src="${fotos[index].src}" class="max-w-full max-h-full rounded-lg shadow-2xl">
  `;
  
  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) lightbox.remove();
  });
  
  document.body.appendChild(lightbox);
}

// Votar opinión
function votarOpinion(opinionId, tipo) {
  // TODO: Implementar llamada a API
  console.log(`Votando ${tipo} para opinión ${opinionId}`);
  
  const btn = document.querySelector(`[data-opinion="${opinionId}"][data-voto="${tipo}"]`);
  if (btn) {
    const countEl = btn.querySelector('span');
    if (countEl) {
      countEl.textContent = parseInt(countEl.textContent) + 1;
    }
  }
}

// ========================================
// EXPORTAR PARA USO GLOBAL
// ========================================
window.TiendaModule = {
  PLANES_CONFIG,
  calcularEstadoTienda,
  openFotoLightbox,
  votarOpinion
};
