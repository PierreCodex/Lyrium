<?php
/**
 * COMPONENTE: Sidebar Vertical de Productos - Cards Apiladas
 * Diseño con imagen panorámica arriba y info abajo
 */

// Mostrar 4 productos visibles para alineación con el grid (3 filas)
$itemsVisibles = 4;
$productosSidebar = $productos ?? [];

// Mapeo de stickers para consistencia global
$stickerTextos = [
    'oferta' => 'Oferta',
    'nuevo' => 'Nuevo',
    'promo' => 'Promo',
    'limitado' => 'Limitado'
];

// Colores para badges de categoría (usando sky como base)
$categoriasColores = [
    'Vitaminas' => 'bg-sky-100 text-sky-700',
    'Suplementos' => 'bg-sky-100 text-sky-700',
    'Proteínas' => 'bg-sky-100 text-sky-700',
    'Belleza' => 'bg-sky-100 text-sky-700',
    'Energía' => 'bg-sky-100 text-sky-700',
    'Superfoods' => 'bg-sky-100 text-sky-700',
    'Orgánicos' => 'bg-sky-100 text-sky-700',
    'Granos' => 'bg-sky-100 text-sky-700',
    'Especias' => 'bg-sky-100 text-sky-700',
    'Digestivo' => 'bg-sky-100 text-sky-700',
];
?>

<div class="tienda-sidebar-cards">
    
    <!-- Header con título y navegación -->
    <div class="sidebar-cards-header flex items-center justify-between">
        <h3 class="flex items-center gap-2 text-base font-bold text-slate-800">
            <i class="ph-fill ph-chart-line-up text-sky-500"></i>
            Artículos de tendencia
        </h3>
        <div class="flex gap-1">
            <button class="sidebar-cards-nav-btn prev w-7 h-7 flex items-center justify-center bg-slate-100 hover:bg-sky-500 hover:text-white rounded-md text-slate-500 transition-all" type="button">
                <i class="ph ph-caret-left text-sm"></i>
            </button>
            <button class="sidebar-cards-nav-btn next w-7 h-7 flex items-center justify-center bg-slate-100 hover:bg-sky-500 hover:text-white rounded-md text-slate-500 transition-all" type="button">
                <i class="ph ph-caret-right text-sm"></i>
            </button>
        </div>
    </div>

    <!-- Cards de productos apiladas -->
    <div class="sidebar-cards-container flex flex-col gap-4" data-carousel="sidebar-cards">
        <?php foreach (array_slice($productosSidebar, 0, $itemsVisibles) as $producto): ?>
        <div class="sidebar-product-card bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-sky-300 transition-all group">
            
            <!-- Imagen panorámica -->
            <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                <img 
                    src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                    alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                
                <!-- Sticker -->
                <?php if (!empty($producto['sticker'])): ?>
                <span class="absolute top-2 left-2 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full
                    <?php 
                    $stickerClases = [
                        'oferta' => 'bg-red-500 text-white',
                        'nuevo' => 'bg-sky-500 text-white',
                        'promo' => 'bg-amber-500 text-white',
                        'limitado' => 'bg-purple-500 text-white'
                    ];
                    echo $stickerClases[$producto['sticker']] ?? 'bg-slate-500 text-white';
                    ?>">
                    <?php echo $stickerTextos[$producto['sticker']] ?? $producto['sticker']; ?>
                </span>
                <?php endif; ?>
                
                <!-- Botón favorito -->
                <button class="absolute top-2 right-2 w-7 h-7 flex items-center justify-center bg-white/80 backdrop-blur-sm rounded-full text-slate-400 hover:text-red-500 hover:bg-white transition-all opacity-0 group-hover:opacity-100">
                    <i class="ph ph-heart text-sm"></i>
                </button>
            </div>
            
            <!-- Info del producto -->
            <div class="p-3">
                <!-- Nombre -->
                <h4 class="font-semibold text-slate-800 text-sm mb-1.5 line-clamp-1 group-hover:text-sky-600 transition-colors">
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                </h4>
                
                <!-- Categoría badge + Precio -->
                <div class="flex items-center justify-between gap-2">
                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full <?php 
                        $cat = $producto['categoria'] ?? 'Productos';
                        echo $categoriasColores[$cat] ?? 'bg-slate-100 text-slate-600';
                    ?>">
                        <?php echo htmlspecialchars($producto['categoria'] ?? 'Productos'); ?>
                    </span>
                    
                    <div class="flex items-center gap-1.5">
                        <?php if (!empty($producto['precio_anterior'])): ?>
                        <span class="text-xs text-slate-400 line-through">
                            S/<?php echo number_format($producto['precio_anterior'], 2); ?>
                        </span>
                        <?php endif; ?>
                        <span class="text-sm font-bold text-sky-600">
                            S/<?php echo number_format($producto['precio'], 2); ?>
                        </span>
                    </div>
                </div>
                
                <!-- Botón añadir al carrito -->
                <button class="w-full mt-3 flex items-center justify-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-sky-500 text-slate-600 hover:text-white text-xs font-medium rounded-lg transition-all">
                    <i class="ph ph-shopping-cart text-sm"></i>
                    Añadir al carrito
                </button>
            </div>
            
        </div>
        <?php endforeach; ?>
    </div>

</div>


<script>
/**
 * CARRUSEL AUTOMÁTICO - Sidebar Trending Products
 * Rotación automática con efecto de deslizamiento
 */
(function() {
    'use strict';
    
    const carousel = document.querySelector('[data-carousel="sidebar-trending"]');
    if (!carousel) return;
    
    const items = Array.from(carousel.querySelectorAll('.tienda-sidebar-trending-item'));
    const prevBtn = carousel.closest('.tienda-sidebar-trending').querySelector('.tienda-sidebar-nav-btn.prev');
    const nextBtn = carousel.closest('.tienda-sidebar-trending').querySelector('.tienda-sidebar-nav-btn.next');
    
    if (items.length <= 1) return; // No hay suficientes items para rotar
    
    // Configuración
    const config = {
        autoPlayInterval: 5000, // 5 segundos
        itemsToShow: <?php echo $itemsVisibles; ?>, // Productos visibles simultáneamente
        animationDuration: 600 // ms
    };
    
    let currentIndex = 0;
    let autoPlayTimer = null;
    let isAnimating = false;
    
    // Inicializar visibilidad de items
    function initCarousel() {
        items.forEach((item, index) => {
            if (index < config.itemsToShow) {
                item.style.display = 'flex';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            } else {
                item.style.display = 'none';
                item.style.opacity = '0';
            }
        });
    }
    
    // Función de animación de deslizamiento
    function slideItems(direction) {
        if (isAnimating) return;
        isAnimating = true;
        
        const oldIndex = currentIndex;
        
        // Calcular nuevo índice
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % items.length;
        } else {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
        }
        
        // Obtener items visibles actuales y nuevos
        const currentVisibleIndices = [];
        const newVisibleIndices = [];
        
        for (let i = 0; i < config.itemsToShow; i++) {
            currentVisibleIndices.push((oldIndex + i) % items.length);
            newVisibleIndices.push((currentIndex + i) % items.length);
        }
        
        // Items que salen
        const exitingIndices = currentVisibleIndices.filter(i => !newVisibleIndices.includes(i));
        // Items que entran
        const enteringIndices = newVisibleIndices.filter(i => !currentVisibleIndices.includes(i));
        
        // Animación de salida (deslizamiento más pronunciado)
        exitingIndices.forEach(index => {
            const item = items[index];
            item.style.transition = `all ${config.animationDuration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
            item.style.opacity = '0';
            item.style.transform = direction === 'next' ? 'translateX(-100%)' : 'translateX(100%)';
        });
        
        // Preparar items entrantes (fuera de vista con mayor desplazamiento)
        enteringIndices.forEach(index => {
            const item = items[index];
            item.style.display = 'flex';
            item.style.opacity = '0';
            item.style.transform = direction === 'next' ? 'translateX(100%)' : 'translateX(-100%)';
            item.style.transition = 'none';
        });
        
        // Forzar reflow
        carousel.offsetHeight;
        
        // Animación de entrada
        setTimeout(() => {
            enteringIndices.forEach(index => {
                const item = items[index];
                item.style.transition = `all ${config.animationDuration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            });
        }, 50);
        
        // Limpiar después de la animación
        setTimeout(() => {
            exitingIndices.forEach(index => {
                items[index].style.display = 'none';
            });
            
            items.forEach(item => {
                item.style.transition = '';
            });
            
            isAnimating = false;
        }, config.animationDuration + 100);
    }
    
    // Navegación
    function goNext() {
        slideItems('next');
        resetAutoPlay();
    }
    
    function goPrev() {
        slideItems('prev');
        resetAutoPlay();
    }
    
    // Auto-play
    function startAutoPlay() {
        stopAutoPlay();
        autoPlayTimer = setInterval(() => {
            slideItems('next');
        }, config.autoPlayInterval);
    }
    
    function stopAutoPlay() {
        if (autoPlayTimer) {
            clearInterval(autoPlayTimer);
            autoPlayTimer = null;
        }
    }
    
    function resetAutoPlay() {
        stopAutoPlay();
        startAutoPlay();
    }
    
    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', goNext);
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', goPrev);
    }
    
    // Pausar al hacer hover
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    
    // Inicializar
    initCarousel();
    startAutoPlay();
    
    // Limpiar al salir
    window.addEventListener('beforeunload', stopAutoPlay);
})();
</script>

<style>
/* ========================================
   ANIMACIONES DEL SIDEBAR
   Efectos dinámicos estilo Temu/AliExpress
   ======================================== */

/* Animación de entrada con fade y slide up */
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.5s ease-out forwards;
    opacity: 0;
}

/* Efecto shimmer para carga de imágenes */
@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.animate-shimmer {
    animation: shimmer 2s infinite linear;
}

/* Pulso sutil para stickers */
@keyframes pulse-subtle {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.animate-pulse-subtle {
    animation: pulse-subtle 2s ease-in-out infinite;
}

/* Bounce sutil para iconos */
@keyframes bounce-subtle {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-2px);
    }
}

.animate-bounce-subtle {
    animation: bounce-subtle 0.5s ease-in-out;
}

/* ========================================
   SIDEBAR CARDS APILADAS
   Diseño con imagen panorámica y info abajo
   ======================================== */

.tienda-sidebar-cards {
    background: #fff;
    border: 1px solid var(--tienda-border, #e2e8f0);
    border-radius: 14px;
    padding: 0; /* Eliminar padding para alinear con tabs */
    box-shadow: 0 8px 30px var(--tienda-shadow, rgba(0,0,0,0.05));
    display: flex;
    flex-direction: column;
    height: 100%;
    flex: 1;
}

/* Header del sidebar - alineado exactamente con las pestañas */
.sidebar-cards-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0;
    margin: 0;
    background: #fff;
    border-radius: 14px 14px 0 0;
    border-top: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
}

/* Título del sidebar - mismo estilo que los tabs */
.sidebar-cards-header h3 {
    padding: 0.625rem 1rem;
    margin: 0;
}

/* Botones de navegación del sidebar */
.sidebar-cards-header .flex.gap-1 {
    padding-right: 0.5rem;
}

.tienda-sidebar-cards .sidebar-cards-container {
    flex: 1;
    overflow-y: auto;
    padding: 1rem 1.25rem;
}

/* Scrollbar personalizado para el sidebar */
.tienda-sidebar-cards .sidebar-cards-container::-webkit-scrollbar {
    width: 4px;
}

.tienda-sidebar-cards .sidebar-cards-container::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.tienda-sidebar-cards .sidebar-cards-container::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.tienda-sidebar-cards .sidebar-cards-container::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Compatibilidad con clase anterior */
.tienda-sidebar-trending {
    background: #fff;
    border: 1px solid var(--tienda-border);
    border-radius: 14px;
    padding: 1.25rem;
    box-shadow: 0 8px 30px var(--tienda-shadow);
}

/* === HEADER === */
.tienda-sidebar-trending-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--tienda-border);
}

.tienda-sidebar-trending-title {
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.tienda-sidebar-trending-title i {
    color: var(--tienda-primary);
    font-size: 1.1rem;
}

/* Botones de navegación */
.tienda-sidebar-trending-nav {
    display: flex;
    gap: 0.375rem;
}

.tienda-sidebar-nav-btn {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid var(--tienda-border);
    border-radius: 6px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}

.tienda-sidebar-nav-btn:hover {
    background: var(--tienda-primary);
    border-color: var(--tienda-primary);
    color: #fff;
    transform: scale(1.05);
}

.tienda-sidebar-nav-btn i {
    font-size: 0.875rem;
}

/* === LISTA DE PRODUCTOS === */
.tienda-sidebar-trending-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    overflow: hidden; /* Ocultar productos que se deslizan fuera */
    position: relative;
}

/* === ITEM INDIVIDUAL === */
.tienda-sidebar-trending-item {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 0.75rem;
    background: #fff;
    border: 1px solid var(--tienda-border);
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
}

.tienda-sidebar-trending-item:hover {
    border-color: var(--tienda-primary);
    box-shadow: 0 4px 16px rgba(14, 165, 233, 0.12);
    transform: translateX(4px);
}

/* === IMAGEN === */
.tienda-sidebar-trending-img {
    position: relative;
    width: 100px;
    height: 100px;
    flex-shrink: 0;
    background: #f8fafc;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

.tienda-sidebar-trending-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.tienda-sidebar-trending-item:hover .tienda-sidebar-trending-img img {
    transform: scale(1.1);
}

/* === INFORMACIÓN === */
.tienda-sidebar-trending-info {
    flex: 1;
    min-width: 0;
}

.tienda-sidebar-trending-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s ease;
}

.tienda-sidebar-trending-item:hover .tienda-sidebar-trending-name {
    color: var(--tienda-primary);
}

.tienda-sidebar-trending-category {
    font-size: 0.75rem;
    color: #64748b;
    margin: 0 0 0.375rem 0;
}

/* === PRECIOS === */
.tienda-sidebar-trending-prices {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tienda-sidebar-trending-price {
    font-size: 1rem;
    font-weight: 800;
    color: var(--tienda-primary);
}

.tienda-sidebar-trending-price-old {
    font-size: 0.75rem;
    color: #94a3b8;
    text-decoration: line-through;
}

/* === BOTÓN CARRITO === */
.tienda-sidebar-trending-cart-btn {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid var(--tienda-border);
    border-radius: 8px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateX(-8px);
}

.tienda-sidebar-trending-item:hover .tienda-sidebar-trending-cart-btn {
    opacity: 1;
    transform: translateX(0);
}

.tienda-sidebar-trending-cart-btn:hover {
    background: var(--tienda-primary);
    border-color: var(--tienda-primary);
    color: #fff;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
}

.tienda-sidebar-trending-cart-btn:active {
    transform: scale(0.95);
}

.tienda-sidebar-trending-cart-btn i {
    font-size: 1rem;
}

/* === RESPONSIVE === */
@media (max-width: 1024px) {
    .tienda-sidebar-trending {
        margin-top: 1.5rem;
    }
}

/* === MOBILE: Carrusel Horizontal === */
@media (max-width: 768px) {
    /* Sidebar Cards - Convertir a carrusel horizontal */
    .tienda-sidebar-cards {
        width: 100%;
        background: transparent;
        padding: 0;
    }
    
    .sidebar-cards-container {
        flex-direction: row !important;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        gap: 1rem;
        padding-bottom: 0.5rem;
        scrollbar-width: none;
    }
    
    .sidebar-cards-container::-webkit-scrollbar {
        display: none;
    }
    
    .sidebar-product-card {
        flex: 0 0 70%;
        min-width: 200px;
        max-width: 280px;
        scroll-snap-align: start;
    }
    
    /* Sidebar Trending - Convertir a carrusel horizontal */
    .tienda-sidebar-trending {
        padding: 1rem;
        width: 100%;
    }
    
    .tienda-sidebar-trending-header {
        margin-bottom: 1rem;
    }
    
    .tienda-sidebar-trending-title {
        font-size: 0.875rem;
    }
    
    .tienda-sidebar-trending-list {
        flex-direction: row !important;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        gap: 1rem;
        padding-bottom: 0.5rem;
        scrollbar-width: none;
    }
    
    .tienda-sidebar-trending-list::-webkit-scrollbar {
        display: none;
    }
    
    .tienda-sidebar-trending-item {
        flex: 0 0 auto;
        min-width: 160px;
        max-width: 200px;
        scroll-snap-align: start;
        flex-direction: column !important;
        padding: 0.75rem;
    }
    
    .tienda-sidebar-trending-img {
        width: 100% !important;
        height: 100px !important;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    
    .tienda-sidebar-trending-info {
        width: 100%;
    }
    
    .tienda-sidebar-trending-name {
        font-size: 0.8125rem;
    }
    
    .tienda-sidebar-trending-price {
        font-size: 0.9375rem;
    }
    
    .tienda-sidebar-trending-cart-btn {
        opacity: 1;
        transform: translateX(0);
        position: relative;
        margin-top: 0.5rem;
        width: 100%;
        justify-content: center;
    }
    
    /* Ocultar botones de navegación en mobile (usar scroll táctil) */
    .sidebar-cards-nav-btn,
    .tienda-sidebar-nav-btn {
        display: none;
    }
}
</style>
