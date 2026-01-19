<?php
/**
 * COMPONENTE: Sistema de Pestañas de Tienda
 * 
 * Variables esperadas:
 * - $tienda: datos de la tienda
 * - $productos: array de productos
 * - $sucursales: array de sucursales
 * - $fotos: array de fotos de galería
 * - $opiniones: array de opiniones/reseñas
 * - $terminos: array con políticas y términos
 * - $plan: 'basico' o 'premium'
 */

$maxFotos = ($plan === 'premium') ? 30 : 8;
$fotosVisibles = array_slice($fotos ?? [], 0, $maxFotos);
$formularioAvanzado = ($plan === 'premium');
?>

<div class="tienda-tabs">
  
  <!-- ═══════════════════════════════════════════ -->
  <!-- BARRA DE FILTROS DE PRODUCTOS (ARRIBA DE TABS) -->
  <!-- ═══════════════════════════════════════════ -->
  <div class="tienda-filtros-bar-superior">
    <!-- Fila 1: Búsqueda + Filtros rápidos + Ordenar -->
    <div class="filtros-fila-principal">
      <!-- Búsqueda -->
      <div class="filtro-busqueda">
        <i class="ph ph-magnifying-glass"></i>
        <input type="text" id="filtroBuscar" placeholder="Buscar por nombre, SKU, categoría...">
        <button type="button" id="limpiarBusqueda" class="btn-limpiar-busqueda" style="display: none;" title="Limpiar búsqueda">
          <i class="ph ph-x"></i>
        </button>
      </div>
      
      <!-- Tags de filtro rápido -->
      <div class="filtro-tags">
        <button class="filtro-tag" data-filtro="oferta">
          <i class="ph ph-tag"></i>
          Ofertas
        </button>
        <button class="filtro-tag" data-filtro="destacado">
          <i class="ph ph-star"></i>
          Destacados
        </button>
        <button class="filtro-tag" data-filtro="bio">
          <i class="ph ph-leaf"></i>
          Bio
        </button>
      </div>
      
      <!-- Ordenar -->
      <div class="filtro-ordenar">
        <i class="ph ph-funnel"></i>
        <span class="filtro-label">Ordenar</span>
        <select id="filtroOrdenar">
          <option value="recientes">Más recientes</option>
          <option value="precio-asc">Precio: menor a mayor</option>
          <option value="precio-desc">Precio: mayor a menor</option>
          <option value="nombre">Nombre A-Z</option>
          <option value="popular">Más vendidos</option>
        </select>
      </div>
      
      <!-- Botón para mostrar/ocultar filtros avanzados -->
      <button class="filtro-toggle-btn" id="toggleFiltrosAvanzados">
        <i class="ph ph-sliders-horizontal"></i>
        <span>Filtros</span>
        <i class="ph ph-caret-down toggle-icon"></i>
      </button>
    </div>
    
    <!-- Fila 2: Filtros avanzados (desplegable) -->
    <div class="filtros-fila-avanzados" id="filtrosAvanzados" style="display: none;">
      <!-- Contador de productos -->
      <div class="filtro-contador">
        <i class="ph ph-list-bullets"></i>
        <span id="contadorProductos"><?php echo count($productos); ?></span>
        <span>productos</span>
      </div>
      
      <!-- Rango de precio -->
      <div class="filtro-precio">
        <div class="filtro-precio-header">
          <span class="filtro-label"><i class="ph ph-currency-circle-dollar"></i> Precio</span>
          <button class="filtro-reset" id="resetFiltros">
            <i class="ph ph-arrow-counter-clockwise"></i>
            Reset
          </button>
        </div>
        <div class="filtro-precio-inputs">
          <div class="precio-input">
            <span>−</span>
            <span>Min:</span>
            <input type="number" id="precioMin" value="0" min="0">
          </div>
          <div class="precio-input">
            <span>+</span>
            <span>Max:</span>
            <input type="number" id="precioMax" value="500" min="0">
          </div>
        </div>
        <div class="filtro-precio-slider">
          <input type="range" id="precioSlider" min="0" max="500" value="500">
          <small>Arrastra para filtrar (en tiempo real)</small>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Header de Tabs - Estilo Arrow Nav -->
  <div class="tienda-tabs-header arrow-style shadow-sm">
    <div class="tienda-tabs-nav">
      <button class="tienda-tab-btn arrow-nav-btn active" data-tab="productos">
        <span>Productos</span>
      </button>
      <button class="tienda-tab-btn arrow-nav-btn" data-tab="sucursales">
        <span>Sucursales</span>
      </button>

      <button class="tienda-tab-btn arrow-nav-btn" data-tab="contacto">
        <span>Contacto</span>
      </button>
      <button class="tienda-tab-btn arrow-nav-btn" data-tab="opiniones">
        <span>Reseñas (<?php echo count($opiniones ?? []); ?>★)</span>
      </button>
      <button class="tienda-tab-btn arrow-nav-btn" data-tab="terminos">
        <span>Acerca de</span>
      </button>
    </div>
  </div>

  <!-- ===================== -->
  <!-- TAB: PRODUCTOS (NUEVO - PRIMERO) -->
  <!-- ===================== -->
  <div id="tab-productos" class="tienda-tab-content active">
    
    <!-- SCROLL DE PRODUCTOS DESTACADOS (S) - Ahora disponible en ambos para cumplir "1 scroll" -->
    <div class="tienda-productos-grid-section">
      <!-- Header del grid - Solo título, sin ordenar ni iconos -->
      <div class="tienda-grid-header">
        <h3 class="tienda-grid-titulo">
          Productos destacados
        </h3>
      </div>
      <div class="tienda-scroll-wrapper">
        <div class="tienda-scroll-container">
          <?php foreach (array_slice($productos, 0, 8) as $producto): ?>
          <div class="producto-scroll-card-overlay">
            <!-- Imagen del producto con overlay de botones -->
            <div class="producto-scroll-imagen">
              <a href="producto.php?id=<?php echo $producto['id']; ?>" class="producto-scroll-img-link">
                <img 
                  src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                  alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  loading="lazy"
                >
              </a>
              
              <!-- Sticker de estado -->
              <?php if (!empty($producto['sticker'])): ?>
              <span class="producto-scroll-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
                <?php 
                  $stickerTextos = [
                    'oferta' => 'Oferta',
                    'nuevo' => 'Nuevo',
                    'promo' => 'Promo',
                    'limitado' => 'Limitado'
                  ];
                  echo $stickerTextos[$producto['sticker']] ?? ucfirst($producto['sticker']);
                ?>
              </span>
              <?php endif; ?>
              
              <!-- Icono favorito (esquina superior derecha) -->
              <button class="producto-scroll-fav" title="Añadir a favoritos">
                <i class="ph ph-heart"></i>
              </button>
              
              <!-- Icono carrito (esquina inferior derecha) -->
              <button class="producto-scroll-cart" title="Añadir al carrito">
                <i class="ph ph-shopping-cart-simple"></i>
              </button>
              
              <!-- Overlay con botones (aparece al hover) - FUERA del enlace -->
              <div class="producto-scroll-overlay">
                <button type="button" class="producto-overlay-btn" onclick="event.preventDefault(); event.stopPropagation(); vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                  <i class="ph ph-eye"></i>
                  Previsualizar
                </button>
                <button type="button" class="producto-overlay-btn producto-overlay-btn-outline">
                  <i class="ph ph-squares-four"></i>
                  Artículos similares
                </button>
              </div>
            </div>
            
            <!-- Info del producto -->
            <div class="producto-scroll-info">
              <h4 class="producto-scroll-nombre">
                <a href="producto.php?id=<?php echo $producto['id']; ?>">
                  <?php echo htmlspecialchars($producto['nombre']); ?>
                </a>
              </h4>
              
              <div class="producto-scroll-precios">
                <span class="producto-scroll-precio">
                  <?php echo number_format($producto['precio'], 2); ?>
                </span>
                <?php if (!empty($producto['precio_anterior'])): ?>
                <span class="producto-scroll-precio-old">
                  S/ <?php echo number_format($producto['precio_anterior'], 2); ?>
                </span>
                <?php endif; ?>
              </div>
              
              <div class="producto-scroll-meta">
                <div class="producto-scroll-stars">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <i class="ph-fill ph-star"></i>
                  <?php endfor; ?>
                  <span><?php echo $producto['ventas'] ?? rand(100, 5000); ?></span>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="tienda-scroll-nav prev"><i class="ph-caret-left"></i></button>
        <button class="tienda-scroll-nav next"><i class="ph-caret-right"></i></button>
      </div>
    </div>

    <!-- SEGUNDA SECCIÓN: TAMBIÉN TE PUEDE INTERESAR -->
    <div class="tienda-productos-grid-section mt-6">
      <!-- Header del grid -->
      <div class="tienda-grid-header">
        <h3 class="tienda-grid-titulo">
          <i class="ph-fill ph-sparkle text-amber-500"></i>
          También te puede interesar
        </h3>
      </div>
      <div class="tienda-scroll-wrapper">
        <div class="tienda-scroll-container">
          <?php foreach (array_slice($productos, 8, 8) as $producto): ?>
          <div class="producto-scroll-card-overlay">
            <!-- Imagen del producto con overlay de botones -->
            <div class="producto-scroll-imagen">
              <a href="producto.php?id=<?php echo $producto['id']; ?>" class="producto-scroll-img-link">
                <img 
                  src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                  alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  loading="lazy"
                >
              </a>
              
              <!-- Sticker de estado -->
              <?php if (!empty($producto['sticker'])): ?>
              <span class="producto-scroll-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
                <?php 
                  $stickerTextos = [
                    'oferta' => 'Oferta',
                    'nuevo' => 'Nuevo',
                    'promo' => 'Promo',
                    'limitado' => 'Limitado'
                  ];
                  echo $stickerTextos[$producto['sticker']] ?? ucfirst($producto['sticker']);
                ?>
              </span>
              <?php endif; ?>
              
              <!-- Icono favorito (esquina superior derecha) -->
              <button class="producto-scroll-fav" title="Añadir a favoritos">
                <i class="ph ph-heart"></i>
              </button>
              
              <!-- Icono carrito (esquina inferior derecha) -->
              <button class="producto-scroll-cart" title="Añadir al carrito">
                <i class="ph ph-shopping-cart-simple"></i>
              </button>
              
              <!-- Overlay con botones (aparece al hover) - FUERA del enlace -->
              <div class="producto-scroll-overlay">
                <button type="button" class="producto-overlay-btn" onclick="event.preventDefault(); event.stopPropagation(); vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                  <i class="ph ph-eye"></i>
                  Previsualizar
                </button>
                <button type="button" class="producto-overlay-btn producto-overlay-btn-outline">
                  <i class="ph ph-squares-four"></i>
                  Artículos similares
                </button>
              </div>
            </div>
            
            <!-- Info del producto -->
            <div class="producto-scroll-info">
              <h4 class="producto-scroll-nombre">
                <a href="producto.php?id=<?php echo $producto['id']; ?>">
                  <?php echo htmlspecialchars($producto['nombre']); ?>
                </a>
              </h4>
              
              <div class="producto-scroll-precios">
                <span class="producto-scroll-precio">
                  <?php echo number_format($producto['precio'], 2); ?>
                </span>
                <?php if (!empty($producto['precio_anterior'])): ?>
                <span class="producto-scroll-precio-old">
                  S/ <?php echo number_format($producto['precio_anterior'], 2); ?>
                </span>
                <?php endif; ?>
              </div>
              
              <div class="producto-scroll-meta">
                <div class="producto-scroll-stars">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <i class="ph-fill ph-star"></i>
                  <?php endfor; ?>
                  <span><?php echo $producto['ventas'] ?? rand(100, 5000); ?></span>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="tienda-scroll-nav prev"><i class="ph-caret-left"></i></button>
        <button class="tienda-scroll-nav next"><i class="ph-caret-right"></i></button>
      </div>
    </div>

    <!-- Si es plan básico, incluimos el grid completo aquí para que no se vea vacío abajo -->
    <?php if ($plan === 'basico'): ?>
      <div class="mt-8">
        <?php include 'componentes/tienda/tienda-productos-grid.php'; ?>
      </div>
    <?php endif; ?>

  </div>

  <!-- ===================== -->
  <!-- TAB: INFORMACIÓN -->
  <!-- ===================== -->
  <div id="tab-info" class="tienda-tab-content">
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-building-office"></i>
        Sobre Nosotros
      </h4>
      <p class="text-slate-600 leading-relaxed">
        <?php echo nl2br(htmlspecialchars($tienda['descripcion'] ?? 'Sin descripción disponible.')); ?>
      </p>
    </div>
    
    <?php if (!empty($tienda['actividad'])): ?>
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-briefcase"></i>
        Actividad Empresarial
      </h4>
      <p class="text-slate-600">
        <?php echo htmlspecialchars($tienda['actividad']); ?>
      </p>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($tienda['rubros'])): ?>
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-tag"></i>
        Rubros
      </h4>
      <div class="flex flex-wrap gap-2">
        <?php foreach ($tienda['rubros'] as $rubro): ?>
        <span class="inline-flex items-center gap-1 px-3 py-1 bg-sky-50 text-sky-700 rounded-full text-sm font-medium">
          <?php echo htmlspecialchars($rubro); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- ===================== -->
  <!-- TAB: SUCURSALES -->
  <!-- ===================== -->
  <div id="tab-sucursales" class="tienda-tab-content">
    <?php if (!empty($sucursales)): ?>
    
    <!-- Header de sección -->
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
        <svg class="w-5 h-5 text-[#38bdf8]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
          <circle cx="12" cy="10" r="3"/>
        </svg>
        Nuestras Sucursales
        <span class="text-sm font-normal text-slate-400">(<?php echo count($sucursales); ?>)</span>
      </h3>
    </div>
    
    <!-- Grid de Sucursales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($sucursales as $index => $sucursal): ?>
      <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        
        <!-- Preview de Google Maps -->
        <div class="relative h-40 bg-slate-100 overflow-hidden">
          <?php 
          // Extraer coordenadas del URL de Google Maps si existe
          $mapUrl = $sucursal['google_maps_url'] ?? '';
          $direccion = urlencode($sucursal['direccion'] . ', ' . ($sucursal['ciudad'] ?? ''));
          
          // Usar Google Maps Embed
          if (!empty($mapUrl)): 
          ?>
          <iframe 
            src="https://www.google.com/maps?q=<?php echo $direccion; ?>&output=embed&z=15"
            class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-500"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen>
          </iframe>
          <?php else: ?>
          <!-- Placeholder si no hay mapa -->
          <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
            <svg class="w-16 h-16 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
          </div>
          <?php endif; ?>
          
          <!-- Badge Principal (si aplica) -->
          <?php if (!empty($sucursal['es_principal'])): ?>
          <div class="absolute top-3 left-3">
            <span class="px-3 py-1 bg-gradient-to-r from-[#0ea5e9] to-[#38bdf8] text-white text-xs font-bold rounded-full shadow-lg flex items-center gap-1">
              <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
              </svg>
              Principal
            </span>
          </div>
          <?php endif; ?>
        </div>
        
        <!-- Información de la Sucursal -->
        <div class="p-5">
          <!-- Nombre -->
          <h4 class="text-lg font-bold text-slate-800 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-[#38bdf8]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
              <polyline points="9,22 9,12 15,12 15,22"/>
            </svg>
            <?php echo htmlspecialchars($sucursal['nombre']); ?>
          </h4>
          
          <!-- Detalles -->
          <div class="space-y-2 text-sm">
            <?php if (!empty($sucursal['direccion'])): ?>
            <div class="flex items-start gap-2 text-slate-600">
              <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
              <span><?php echo htmlspecialchars($sucursal['direccion']); ?></span>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($sucursal['ciudad'])): ?>
            <div class="flex items-center gap-2 text-slate-600">
              <svg class="w-4 h-4 text-slate-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="4" y="2" width="16" height="20" rx="2"/>
                <path d="M9 22V12h6v10M9 6h.01M15 6h.01M9 10h.01M15 10h.01"/>
              </svg>
              <span><?php echo htmlspecialchars($sucursal['ciudad']); ?></span>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($sucursal['telefono'])): ?>
            <div class="flex items-center gap-2 text-slate-600">
              <svg class="w-4 h-4 text-slate-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
              </svg>
              <a href="tel:<?php echo htmlspecialchars($sucursal['telefono']); ?>" class="hover:text-[#38bdf8] transition-colors">
                <?php echo htmlspecialchars($sucursal['telefono']); ?>
              </a>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($sucursal['horario_apertura']) && !empty($sucursal['horario_cierre'])): ?>
            <div class="flex items-center gap-2 text-slate-600">
              <svg class="w-4 h-4 text-slate-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12,6 12,12 16,14"/>
              </svg>
              <span><?php echo htmlspecialchars($sucursal['horario_apertura']); ?> - <?php echo htmlspecialchars($sucursal['horario_cierre']); ?></span>
            </div>
            <?php endif; ?>
          </div>
          
          <!-- Botones de acción -->
          <div class="flex gap-2 mt-4 pt-4 border-t border-slate-100">
            <?php if (!empty($sucursal['google_maps_url'])): ?>
            <a href="<?php echo htmlspecialchars($sucursal['google_maps_url']); ?>" target="_blank" 
               class="flex-1 py-2 px-3 bg-gradient-to-r from-[#0ea5e9] to-[#38bdf8] text-white text-xs font-semibold rounded-lg text-center hover:shadow-lg hover:shadow-[#38bdf8]/30 transition-all flex items-center justify-center gap-1">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
              Ver en Maps
            </a>
            <?php endif; ?>
            
            <?php if (!empty($sucursal['telefono'])): ?>
            <a href="tel:<?php echo htmlspecialchars($sucursal['telefono']); ?>" 
               class="py-2 px-3 border border-[#7dd3fc] text-[#7dd3fc] text-xs font-semibold rounded-lg text-center hover:bg-[#7dd3fc] hover:text-white transition-all flex items-center justify-center gap-1">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
              </svg>
              Llamar
            </a>
            
        
            <?php endif; ?>
          </div>
          
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    
    <?php else: ?>
    <!-- Estado vacío -->
    <div class="text-center py-12 bg-white rounded-2xl border border-slate-100">
      <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
        <circle cx="12" cy="10" r="3"/>
      </svg>
      <p class="text-slate-500 font-medium">No hay sucursales registradas</p>
      <p class="text-sm text-slate-400 mt-1">Las ubicaciones de la tienda aparecerán aquí</p>
    </div>
    <?php endif; ?>
    
    <p class="text-xs text-slate-400 mt-6 flex items-center gap-1">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <path d="M12 16v-4M12 8h.01"/>
      </svg>
      Máximo 8 sucursales por tienda
    </p>
  </div>

  <!-- ===================== -->
  <!-- TAB: FOTOS -->
  <!-- ===================== -->
  <div id="tab-fotos" class="tienda-tab-content">
    <?php if (!empty($fotosVisibles)): ?>
    <div class="tienda-fotos-grid">
      <?php foreach ($fotosVisibles as $index => $foto): ?>
      <div class="tienda-foto-item" onclick="TiendaModule.openFotoLightbox(<?php echo $index; ?>)">
        <img 
          src="<?php echo htmlspecialchars($foto['url']); ?>" 
          alt="<?php echo htmlspecialchars($foto['titulo'] ?? 'Foto ' . ($index + 1)); ?>"
          loading="lazy"
        >
      </div>
      <?php endforeach; ?>
    </div>
    
    <?php if ($plan === 'basico' && count($fotos ?? []) > $maxFotos): ?>
    <div class="tienda-fotos-limite mt-4">
      <i class="ph-crown mr-1"></i>
      Tu plan permite <?php echo $maxFotos; ?> fotos. 
      <a href="planes.php" class="underline font-bold">Actualiza a Premium</a> para mostrar hasta 30.
    </div>
    <?php endif; ?>
    
    <?php else: ?>
    <div class="text-center py-8 text-slate-400">
      <i class="ph-images text-4xl mb-2"></i>
      <p>No hay fotos en la galería</p>
    </div>
    <?php endif; ?>
    
    <p class="text-xs text-slate-400 mt-4">
      <i class="ph-info mr-1"></i>
      Formatos permitidos: JPG, PNG, WEBP | Máximo 5MB por imagen
    </p>
  </div>

  <div id="tab-contacto" class="tienda-tab-content">
    <?php if ($plan === 'premium'): ?>
    <!-- ========================================= -->
    <!-- CONTACTO PREMIUM: Sidebar Colapsable -->
    <!-- ========================================= -->
    <style>
      .mensaje-layout {
        display: flex;
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #e2e8f0;
        min-height: 500px;
      }
      .mensaje-sidebar {
        width: 280px;
        min-width: 280px;
        border-right: 1px solid #e2e8f0;
        background: #fafbfc;
        transition: all 0.3s ease;
        overflow: hidden;
      }
      .mensaje-sidebar.collapsed {
        width: 0;
        min-width: 0;
        border-right: none;
      }
      .mensaje-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
      }
      @media (max-width: 768px) {
        .mensaje-sidebar {
          position: absolute;
          left: 0;
          top: 0;
          height: 100%;
          z-index: 50;
          box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }
        .mensaje-sidebar.collapsed {
          transform: translateX(-100%);
        }
        .mensaje-layout {
          position: relative;
        }
      }
    </style>
    
    <div class="mensaje-layout" id="contactLayoutPremium">
      <!-- Sidebar de Mensajes (Colapsable) -->
      <aside class="mensaje-sidebar" id="mensajeSidebar">
        <div class="p-4 border-b border-slate-200 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
            <h3 class="font-semibold text-slate-700">Mensajes</h3>
          </div>
          <button onclick="toggleSidebar()" class="p-1.5 hover:bg-slate-200 rounded-lg transition-colors" title="Colapsar">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M15 18L9 12L15 6"/>
            </svg>
          </button>
        </div>
        
        <div class="p-2">
          <!-- Item de conversación activa -->
          <div class="flex items-center gap-3 p-3 bg-white rounded-xl border-l-4 border-[#38bdf8] shadow-sm">
            <img src="<?php echo htmlspecialchars($tienda['logo']); ?>" alt="Logo" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow">
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-0.5">
                <span class="font-semibold text-sm text-slate-800 truncate mensaje-item-nombre"><?php echo htmlspecialchars($tienda['nombre']); ?></span>
                <span class="text-xs text-slate-400"><?php echo date('H:i'); ?></span>
              </div>
              <p class="text-xs text-[#38bdf8] font-medium mensaje-item-preview">[Nuevo Mensaje]</p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Área Principal -->
      <div class="mensaje-main">
        <!-- Header -->
        <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-white">
          <div class="flex items-center gap-3">
            <!-- Botón expandir sidebar (visible cuando está colapsado) -->
            <button onclick="toggleSidebar()" id="btnExpandSidebar" class="hidden p-2 hover:bg-slate-100 rounded-lg transition-colors" title="Mostrar mensajes">
              <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12h18M3 6h18M3 18h18"/>
              </svg>
            </button>
            <img src="<?php echo htmlspecialchars($tienda['logo']); ?>" alt="Logo" class="w-8 h-8 rounded-full object-cover border border-slate-200 lg:hidden">
            <div>
              <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <?php echo htmlspecialchars($tienda['nombre']); ?>
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#38bdf8">
                  <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
              </h3>
              <p class="text-xs text-slate-500">Official Store</p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <!-- Botones de contacto rápido -->
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $tienda['telefono'] ?? ''); ?>" target="_blank" 
               class="p-2 bg-[#25D366] text-white rounded-full hover:bg-[#20bd5a] transition-colors" title="WhatsApp">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/>
              </svg>
            </a>
            <a href="mailto:<?php echo htmlspecialchars($tienda['correo'] ?? ''); ?>" 
               class="p-2 bg-[#7dd3fc] text-white rounded-full hover:bg-[#4a9ec7] transition-colors" title="Email">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="M22 6L12 13L2 6"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Formulario -->
        <div class="flex-1 overflow-y-auto p-6 bg-slate-50/30" id="container-form-premium">
          <form id="formContactoTiendaPremium" class="space-y-4 max-w-2xl mx-auto">
            
            <!-- Row 1: Nombre y Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nombre completo *</label>
                <input type="text" name="nombre" required
                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#38bdf8]/30 focus:border-[#38bdf8] outline-none transition-all"
                       placeholder="Tu nombre">
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Correo electrónico *</label>
                <input type="email" name="correo" required
                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#38bdf8]/30 focus:border-[#38bdf8] outline-none transition-all"
                       placeholder="tucorreo@ejemplo.com">
              </div>
            </div>
            
            <!-- Row 2: Teléfono y Asunto -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Teléfono de contacto</label>
                <div class="flex">
                  <span class="inline-flex items-center px-3 py-2.5 bg-slate-100 border border-r-0 border-slate-200 rounded-l-lg text-sm text-slate-600 font-medium">
                    🇵🇪 +51
                  </span>
                  <input type="tel" name="telefono" id="telefono-peru"
                         class="flex-1 px-4 py-2.5 bg-white border border-slate-200 rounded-r-lg text-sm focus:ring-2 focus:ring-[#38bdf8]/30 focus:border-[#38bdf8] outline-none transition-all"
                         placeholder="999 999 999"
                         maxlength="11"
                         oninput="formatearTelefonoPeru(this)">
                </div>
                <p class="text-[10px] text-slate-400 mt-1">9 dígitos sin el código de país</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Asunto del mensaje *</label>
                <select name="asunto" id="asunto-premium" required
                        class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#38bdf8]/30 focus:border-[#38bdf8] outline-none transition-all cursor-pointer">
                  <option value="">Selecciona un asunto</option>
                  <option value="consulta">📋 Consulta general</option>
                  <option value="cotizacion">💰 Solicitar cotización</option>
                  <option value="pedido">📦 Seguimiento de pedido</option>
                  <option value="reclamo">⚠️ Reclamo</option>
                  <option value="sugerencia">💡 Sugerencia</option>
                  <option value="otro">📝 Otro</option>
                </select>
              </div>
            </div>
            
            <!-- Adjuntar archivo -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagen, vídeo, audio (Max 2MB)</label>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Opción 1: Subir archivo local -->
                <div class="bg-white border-2 border-dashed border-slate-200 rounded-xl p-4 text-center hover:border-[#38bdf8]/50 hover:bg-[#38bdf8]/5 transition-all cursor-pointer"
                     onclick="document.getElementById('contact_file').click()">
                  <input type="file" id="contact_file" name="archivo" class="hidden" accept="image/*,video/*,audio/*,.pdf" onchange="validarArchivo(this)">
                  <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                  </svg>
                  <p id="file-name-display" class="text-xs text-slate-500 font-medium">Subir desde dispositivo</p>
                </div>
                
                <!-- Opción 2: Google Drive -->
                <div class="bg-white border-2 border-dashed border-slate-200 rounded-xl p-4 text-center hover:border-[#4285f4]/50 hover:bg-[#4285f4]/5 transition-all cursor-pointer"
                     onclick="document.getElementById('drive-link-container').classList.toggle('hidden')">
                  <!-- Icono de Google Drive -->
                  <svg class="w-8 h-8 mx-auto mb-2" viewBox="0 0 87.3 78" fill="none">
                    <path d="M6.6 66.85l3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8H0c0 1.55.4 3.1 1.2 4.5l5.4 9.35z" fill="#0066DA"/>
                    <path d="M43.65 25L29.9 0c-1.35.8-2.5 1.9-3.3 3.3L1.2 38.45c-.8 1.4-1.2 2.95-1.2 4.55h27.5L43.65 25z" fill="#00AC47"/>
                    <path d="M73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5H59.85L73.55 76.8z" fill="#EA4335"/>
                    <path d="M43.65 25L57.4 0c-1.35-.8-2.9-1.25-4.45-1.25H34.15c-1.55 0-3.1.45-4.45 1.25L43.65 25z" fill="#00832D"/>
                    <path d="M59.85 53H27.5l-13.75 23.8c1.35.8 2.9 1.2 4.45 1.2h50.9c1.55 0 3.1-.45 4.45-1.25L59.85 53z" fill="#2684FC"/>
                    <path d="M73.4 26.5L57.4 0l-13.75 25 16.2 28H87.3c0-1.55-.4-3.1-1.2-4.5L73.4 26.5z" fill="#FFBA00"/>
                  </svg>
                  <p class="text-xs text-slate-500 font-medium">Enlace de Google Drive</p>
                </div>
              </div>
              
              <!-- Input para enlace de Google Drive (oculto por defecto) -->
              <div id="drive-link-container" class="hidden mt-3">
                <div class="flex gap-2">
                  <input type="url" name="enlace_drive" id="enlace-drive"
                         class="flex-1 px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#4285f4]/30 focus:border-[#4285f4] outline-none transition-all"
                         placeholder="https://drive.google.com/file/d/...">
                  <button type="button" onclick="validarEnlaceDrive()" class="px-4 py-2 bg-[#4285f4] text-white text-sm font-medium rounded-lg hover:bg-[#3367d6] transition-colors">
                    Verificar
                  </button>
                </div>
                <p id="drive-status" class="text-xs text-slate-400 mt-1">Pega el enlace compartido de tu archivo en Drive</p>
              </div>
              
              <p id="file-limit-warning" class="text-xs text-slate-400 mt-2">Formatos: JPG, PNG, MP4, MP3, PDF</p>
            </div>
            
            <!-- Mensaje -->
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">Tu mensaje *</label>
              <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
              <div id="editor-premium" class="bg-white rounded-t-lg min-h-[150px]"></div>
              <input type="hidden" name="mensaje" id="mensaje-hidden">
              
              <!-- Barra de acciones del mensaje -->
              <div class="bg-white border border-t-0 border-slate-200 rounded-b-lg px-3 py-2 flex items-center gap-1">
                <!-- Adjuntar archivo 
                <button type="button" onclick="document.getElementById('contact_file').click()" 
                        class="p-2 hover:bg-slate-100 rounded-lg transition-colors group" title="Adjuntar archivo">
                  <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/>
                  </svg>
                </button>-->
                
                <!-- Google Drive 
                <button type="button" onclick="document.getElementById('drive-link-container').classList.toggle('hidden'); document.getElementById('drive-link-container').scrollIntoView({behavior: 'smooth', block: 'center'})" 
                        class="p-2 hover:bg-slate-100 rounded-lg transition-colors group" title="Insertar desde Google Drive">
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <path d="M4.433 22l-1.6-2.773L9.99 7.36l1.6 2.773L4.433 22z" fill="#4285F4"/>
                    <path d="M22.207 14.227L17.393 22H2.833l4.8-7.773h14.574z" fill="#0F9D58"/>
                    <path d="M14.009 2L23 17.455l-4.8 7.772-8.99-15.454L14.009 2z" fill="#FFBA00"/>
                    <path d="M1 17.455l4.8-7.773L14.8 2H5l-4 7.455v8z" fill="#00832D"/>
                  </svg>
                </button>-->
                
                <!-- Enlace 
                <button type="button" onclick="insertarEnlace()" 
                        class="p-2 hover:bg-slate-100 rounded-lg transition-colors group" title="Insertar enlace">
                  <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                  </svg>
                </button>-->
                
                <!-- Emoji 
                <button type="button" onclick="toggleEmojiPicker()" 
                        class="p-2 hover:bg-slate-100 rounded-lg transition-colors group" title="Insertar emoji">
                  <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                    <line x1="9" y1="9" x2="9.01" y2="9"/>
                    <line x1="15" y1="9" x2="15.01" y2="9"/>
                  </svg>
                </button>
                
                <div class="flex-1"></div>-->
                
                <!-- Indicador de caracteres (opcional) 
                <span class="text-xs text-slate-400">Escribe tu mensaje detallado</span>-->
              </div>
            </div>
            
            <!-- Botón enviar -->
            <button type="submit" id="btn-resolver-premium"
                    class="w-full py-3 px-6 bg-gradient-to-r from-[#0ea5e9] to-[#38bdf8] text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-[#38bdf8]/30 transition-all duration-300 flex items-center justify-center gap-2">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13"/>
              </svg>
              Enviar mensaje
            </button>
            
          </form>
        </div>

        <!-- Vista de confirmación -->
        <div id="container-chat-premium" class="hidden flex-1 overflow-y-auto p-6 bg-slate-50/30">
          <div id="chat-messages-container" class="space-y-4 max-w-2xl mx-auto">
            <!-- Los mensajes se inyectarán aquí -->
          </div>
          <div class="mt-4 p-4 bg-white/80 backdrop-blur rounded-xl text-center max-w-2xl mx-auto border border-slate-100">
            <svg class="w-12 h-12 mx-auto text-[#38bdf8] mb-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <p class="text-slate-700 font-medium">¡Mensaje enviado!</p>
            <p class="text-sm text-slate-500 mt-1">Te responderemos pronto a tu correo.</p>
          </div>
        </div>
        
      </div>
    </div>
    
    <script>
      function toggleSidebar() {
        const sidebar = document.getElementById('mensajeSidebar');
        const btnExpand = document.getElementById('btnExpandSidebar');
        
        sidebar.classList.toggle('collapsed');
        
        if (sidebar.classList.contains('collapsed')) {
          btnExpand.classList.remove('hidden');
        } else {
          btnExpand.classList.add('hidden');
        }
      }
      
      // Formatear teléfono de Perú (999 999 999)
      function formatearTelefonoPeru(input) {
        // Eliminar todo excepto números
        let valor = input.value.replace(/\D/g, '');
        
        // Limitar a 9 dígitos
        if (valor.length > 9) {
          valor = valor.substring(0, 9);
        }
        
        // Formatear con espacios: 999 999 999
        let formateado = '';
        for (let i = 0; i < valor.length; i++) {
          if (i === 3 || i === 6) {
            formateado += ' ';
          }
          formateado += valor[i];
        }
        
        input.value = formateado;
      }
      
      // Validar enlace de Google Drive
      function validarEnlaceDrive() {
        const input = document.getElementById('enlace-drive');
        const status = document.getElementById('drive-status');
        const enlace = input.value.trim();
        
        if (!enlace) {
          status.textContent = '⚠️ Por favor ingresa un enlace';
          status.className = 'text-xs text-amber-500 mt-1';
          return;
        }
        
        // Verificar si es un enlace válido de Google Drive
        const drivePatterns = [
          /drive\.google\.com\/file\/d\//,
          /drive\.google\.com\/open/,
          /docs\.google\.com\/document/,
          /docs\.google\.com\/spreadsheets/,
          /docs\.google\.com\/presentation/
        ];
        
        const esValido = drivePatterns.some(pattern => pattern.test(enlace));
        
        if (esValido) {
          status.innerHTML = '✅ Enlace de Google Drive válido';
          status.className = 'text-xs text-[#38bdf8] mt-1 font-medium';
          input.classList.add('border-[#38bdf8]', 'bg-[#38bdf8]/5');
          input.classList.remove('border-slate-200');
        } else {
          status.innerHTML = '❌ Este no parece ser un enlace válido de Google Drive';
          status.className = 'text-xs text-rose-500 mt-1';
          input.classList.add('border-rose-300');
          input.classList.remove('border-slate-200', 'border-[#38bdf8]', 'bg-[#38bdf8]/5');
        }
      }
      
      // Insertar enlace en el editor
      function insertarEnlace() {
        const url = prompt('Ingresa la URL del enlace:');
        if (url && premiumEditor) {
          premiumEditor.model.change(writer => {
            const insertPosition = premiumEditor.model.document.selection.getFirstPosition();
            writer.insertText(url, insertPosition);
          });
        }
      }
      
      // Toggle selector de emojis
      function toggleEmojiPicker() {
        const emojis = ['😊', '👍', '❤️', '🎉', '✨', '🙏', '👋', '🔥', '💪', '⭐'];
        const emoji = prompt('Selecciona un emoji:\n\n' + emojis.join('  ') + '\n\nO escribe el que quieras:');
        if (emoji && premiumEditor) {
          premiumEditor.model.change(writer => {
            const insertPosition = premiumEditor.model.document.selection.getFirstPosition();
            writer.insertText(emoji, insertPosition);
          });
        }
      }
      
      // En móvil, iniciar con sidebar colapsado
      if (window.innerWidth < 768) {
        document.addEventListener('DOMContentLoaded', () => {
          const sidebar = document.getElementById('mensajeSidebar');
          const btnExpand = document.getElementById('btnExpandSidebar');
          if (sidebar && btnExpand) {
            sidebar.classList.add('collapsed');
            btnExpand.classList.remove('hidden');
          }
        });
      }
    </script>

    <script>
      let premiumEditor;

      function validarArchivo(input) {
        const file = input.files[0];
        const display = document.getElementById('file-name-display');
        const warning = document.getElementById('file-limit-warning');
        
        if (file) {
          display.innerText = '✓ ' + file.name;
          display.classList.add('text-[#38bdf8]', 'font-medium');
          display.classList.remove('text-slate-500');
          
          // Validar 2MB (2 * 1024 * 1024 bytes)
          if (file.size > 2 * 1024 * 1024) {
            warning.classList.remove('text-slate-400');
            warning.classList.add('text-rose-500', 'font-bold');
            warning.innerHTML = '⚠️ Archivo muy grande. Máximo 2MB permitido.';
            display.innerText = 'Arrastra un archivo o haz clic para seleccionar';
            display.classList.remove('text-[#38bdf8]', 'font-medium');
            display.classList.add('text-slate-500');
            input.value = "";
          } else {
            warning.classList.add('text-[#38bdf8]');
            warning.classList.remove('text-rose-500', 'font-bold', 'text-slate-400');
            warning.innerText = '✓ Archivo aceptado';
          }
        }
      }

      document.addEventListener('DOMContentLoaded', () => {
        if (document.querySelector('#editor-premium')) {
          ClassicEditor
            .create(document.querySelector('#editor-premium'), {
              placeholder: 'Escribe aquí los detalles de tu consulta...',
              toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo' ]
            })
            .then(editor => {
              premiumEditor = editor;
              editor.model.document.on('change:data', () => {
                document.querySelector('#mensaje-hidden').value = editor.getData();
              });
            })
            .catch(error => { console.error(error); });
        }

        // Lógica de Envío
        const form = document.querySelector('#formContactoTiendaPremium');
        if (form) {
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.querySelector('#btn-resolver-premium');
            const originalContent = btn.innerHTML;
            
            // 1. Estado de carga
            btn.innerHTML = `
              <svg class="w-5 h-5 animate-spin" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Enviando...
            `;
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            setTimeout(() => {
              // 2. Mostrar confirmación
              document.querySelector('#container-form-premium').classList.add('hidden');
              document.querySelector('#container-chat-premium').classList.remove('hidden');
              
              // 3. Mostrar mensaje enviado
              const mensajeUser = premiumEditor ? premiumEditor.getData() : '';
              const asunto = document.querySelector('#asunto-premium').value;
              const nombre = document.querySelector('input[name="nombre"]').value;
              const chatContainer = document.querySelector('#chat-messages-container');
              const hora = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

              chatContainer.innerHTML = `
                <div class="bg-[#38bdf8]/10 border border-[#38bdf8]/20 rounded-xl p-4">
                  <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#0ea5e9] to-[#38bdf8] rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                      ${nombre.charAt(0).toUpperCase()}
                    </div>
                    <div class="flex-1">
                      <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-slate-800">${nombre}</span>
                        <span class="text-xs text-slate-400">${hora}</span>
                      </div>
                      <p class="text-sm text-slate-600 mb-2">
                        <span class="inline-block bg-[#38bdf8]/20 text-[#38b89a] text-xs font-medium px-2 py-0.5 rounded-full">${asunto}</span>
                      </p>
                      <div class="text-sm text-slate-700">${mensajeUser}</div>
                    </div>
                  </div>
                </div>
              `;

            }, 1500);
          });
        }
      });
    </script>

    <?php else: ?>
    <!-- ========================================= -->
    <!-- CONTACTO BÁSICO: Formulario Estándar -->
    <!-- ========================================= -->
    <form class="tienda-contacto-form" id="formContactoTienda">
      <!-- Campos básicos (todos los planes) -->
      <div class="tienda-form-group">
        <label class="tienda-form-label">Nombre *</label>
        <input type="text" name="nombre" class="tienda-form-input" required placeholder="Tu nombre completo">
      </div>
      
      <div class="tienda-form-group">
        <label class="tienda-form-label">Correo electrónico *</label>
        <input type="email" name="correo" class="tienda-form-input" required placeholder="tucorreo@ejemplo.com">
      </div>
      
      <div class="tienda-form-group">
        <label class="tienda-form-label">Mensaje *</label>
        <textarea name="mensaje" class="tienda-form-textarea" required placeholder="Escribe tu mensaje aquí..."></textarea>
      </div>
      
      <button type="submit" class="tienda-form-btn">
        <i class="ph-paper-plane-tilt"></i>
        Enviar mensaje
      </button>
    </form>
    <?php endif; ?>
  </div>

  <!-- ===================== -->
  <!-- TAB: OPINIONES/RESEÑAS -->
  <!-- ===================== -->
  <div id="tab-opiniones" class="tienda-tab-content">
    <?php 
    // Calcular estadísticas de reseñas
    $totalReviews = count($opiniones ?? []);
    $avgRating = 0;
    $distribution = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
    $comprasVerificadas = 0;
    
    if ($totalReviews > 0) {
      $sumRating = 0;
      foreach ($opiniones as $op) {
        $rating = intval($op['rating']);
        $sumRating += $rating;
        if (isset($distribution[$rating])) {
          $distribution[$rating]++;
        }
        if (!empty($op['compra_verificada'])) {
          $comprasVerificadas++;
        }
      }
      $avgRating = round($sumRating / $totalReviews, 1);
    }
    
    $porcentajeRecomendacion = $totalReviews > 0 ? round((($distribution[5] + $distribution[4]) / $totalReviews) * 100) : 0;
    ?>
    
    <!-- Layout de 2 Columnas -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      
      <!-- ========================================= -->
      <!-- COLUMNA IZQUIERDA: Estadísticas y Resumen -->
      <!-- ========================================= -->
      <div class="lg:col-span-4 space-y-4">
        
        <!-- Resumen de Valoración Principal -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
          <div class="text-center">
            <div class="text-5xl font-bold text-slate-800 mb-2">
              <?php echo number_format($avgRating, 1); ?>
            </div>
            <div class="flex justify-center gap-1 mb-3">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="ph-star<?php echo $i <= round($avgRating) ? '-fill' : ''; ?> text-amber-400 text-2xl"></i>
              <?php endfor; ?>
            </div>
            <p class="text-sm text-slate-600">
              Basado en <strong><?php echo $totalReviews; ?></strong> reseña<?php echo $totalReviews != 1 ? 's' : ''; ?>
            </p>
          </div>
          
          <!-- Distribución de Estrellas -->
          <div class="mt-6 space-y-2">
            <?php foreach ([5, 4, 3, 2, 1] as $stars): ?>
              <?php 
                $count = $distribution[$stars];
                $percentage = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0;
              ?>
              <div class="flex items-center gap-2 text-sm">
                <span class="text-slate-600 w-8"><?php echo $stars; ?>★</span>
                <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                  <div class="h-full bg-amber-400 transition-all" style="width: <?php echo $percentage; ?>%"></div>
                </div>
                <span class="text-slate-500 w-12 text-right"><?php echo $count; ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        
        <!-- Tarjetas de Estadísticas con Iconos Lyrium (nanobanana style) -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
          <h4 class="text-sm font-bold text-slate-700 mb-4 flex items-center gap-2">
            <!-- Icono de gráfico estilo Lyrium -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <rect x="3" y="12" width="4" height="9" rx="1" fill="#38bdf8"/>
              <rect x="10" y="8" width="4" height="13" rx="1" fill="#7dd3fc"/>
              <rect x="17" y="4" width="4" height="17" rx="1" fill="#0ea5e9"/>
            </svg>
            Estadísticas
          </h4>
          
          <div class="space-y-2">
            <!-- Compras Verificadas - Verde Lima Lyrium -->
            <div class="flex items-center gap-2.5 p-2.5 bg-gradient-to-r from-[#0ea5e9]/10 to-[#38bdf8]/10 rounded-lg border border-[#0ea5e9]/20 hover:border-[#0ea5e9]/40 transition-all">
              <div class="w-9 h-9 bg-gradient-to-br from-[#0ea5e9] to-[#0284c7] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md shadow-[#0ea5e9]/25">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
                  <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-[10px] text-[#0284c7] font-semibold uppercase tracking-wide">Compras Verificadas</p>
                <p class="text-base font-bold text-slate-800"><?php echo $comprasVerificadas; ?></p>
              </div>
            </div>
            
            <!-- Recomendación - Turquesa Lyrium -->
            <div class="flex items-center gap-2.5 p-2.5 bg-gradient-to-r from-[#38bdf8]/10 to-[#7dd3fc]/10 rounded-lg border border-[#38bdf8]/20 hover:border-[#38bdf8]/40 transition-all">
              <div class="w-9 h-9 bg-gradient-to-br from-[#38bdf8] to-[#38b89a] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md shadow-[#38bdf8]/25">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M14 9V5C14 3.9 13.1 3 12 3C10.9 3 10 3.9 10 5V9" stroke="white" stroke-width="2" stroke-linecap="round"/>
                  <path d="M18 9H6C4.9 9 4 9.9 4 11V12C4 15.3 6.7 18 10 18H14C17.3 18 20 15.3 20 12V11C20 9.9 19.1 9 18 9Z" stroke="white" stroke-width="2"/>
                  <path d="M12 18V21" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-[10px] text-[#38b89a] font-semibold uppercase tracking-wide">Recomendación</p>
                <p class="text-base font-bold text-slate-800"><?php echo $porcentajeRecomendacion; ?>%</p>
              </div>
            </div>
            
            <!-- Tiempo de Respuesta - Azul Cielo Lyrium -->
            <div class="flex items-center gap-2.5 p-2.5 bg-gradient-to-r from-[#7dd3fc]/10 to-[#4a9ec7]/10 rounded-lg border border-[#7dd3fc]/20 hover:border-[#7dd3fc]/40 transition-all">
              <div class="w-9 h-9 bg-gradient-to-br from-[#7dd3fc] to-[#4a9ec7] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md shadow-[#7dd3fc]/25">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
                  <path d="M12 7V12L15 15" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-[10px] text-[#4a9ec7] font-semibold uppercase tracking-wide">Respuesta Promedio</p>
                <p class="text-base font-bold text-slate-800">&lt; 24h</p>
              </div>
            </div>
            
            <!-- Total de Ventas - Gradiente Lyrium Completo -->
            <div class="flex items-center gap-2.5 p-2.5 bg-gradient-to-r from-[#0ea5e9]/10 via-[#38bdf8]/10 to-[#7dd3fc]/10 rounded-lg border border-[#38bdf8]/20 hover:border-[#38bdf8]/40 transition-all">
              <div class="w-9 h-9 bg-gradient-to-br from-[#0ea5e9] via-[#38bdf8] to-[#7dd3fc] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md shadow-[#38bdf8]/25">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M6 6H8L10 18H18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M10 14H17.5L19 8H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <circle cx="11" cy="20" r="1.5" fill="white"/>
                  <circle cx="17" cy="20" r="1.5" fill="white"/>
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-[10px] text-[#4a9ec7] font-semibold uppercase tracking-wide">Ventas Totales</p>
                <p class="text-base font-bold text-slate-800"><?php echo rand(100, 9999); ?>+</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Insignias de Confianza (Lyrium nanobanana style) -->
        <div class="bg-white rounded-xl border border-slate-200 p-4">
          <h4 class="text-sm font-bold text-slate-700 mb-3 flex items-center gap-2">
            <!-- Icono de verificación Lyrium -->
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M12 2L14.5 6.5L19.5 7L15.5 11L16.5 16L12 13.5L7.5 16L8.5 11L4.5 7L9.5 6.5L12 2Z" fill="url(#trust-badge-gradient)"/>
              <defs>
                <linearGradient id="trust-badge-gradient" x1="4" y1="2" x2="20" y2="18">
                  <stop offset="0%" stop-color="#0ea5e9"/>
                  <stop offset="50%" stop-color="#38bdf8"/>
                  <stop offset="100%" stop-color="#7dd3fc"/>
                </linearGradient>
              </defs>
            </svg>
            Insignias de Confianza
          </h4>
          
          <div class="grid grid-cols-2 gap-2">
            
            <!-- 1. Reseñas Reales -->
            <div class="group flex flex-col items-center gap-2 p-2.5 bg-gradient-to-br from-[#0ea5e9]/5 to-[#38bdf8]/10 rounded-xl border border-[#0ea5e9]/15 hover:border-[#0ea5e9]/40 hover:shadow-lg transition-all duration-300 cursor-pointer">
              <div class="w-10 h-10 bg-gradient-to-br from-[#0ea5e9] to-[#0284c7] rounded-xl flex items-center justify-center shadow-md shadow-[#0ea5e9]/20 group-hover:scale-110 transition-transform duration-300">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                  <path d="M21 11.5C21 16.75 16.75 21 11.5 21C10 21 8.5 20.7 7.2 20L3 21L4 17C3.4 15.6 3 14.1 3 12.5C3 7.25 7.25 3 12.5 3H13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19 2L20 5L23 6L20 7L19 10L18 7L15 6L18 5L19 2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="white"/>
                </svg>
              </div>
              <span class="text-[10px] font-bold text-[#0284c7] text-center uppercase tracking-wide leading-tight">Reseñas<br/>Reales</span>
            </div>
            
            <!-- 2. Respuestas Rápidas -->
            <div class="group flex flex-col items-center gap-2 p-2.5 bg-gradient-to-br from-[#38bdf8]/5 to-[#7dd3fc]/10 rounded-xl border border-[#38bdf8]/15 hover:border-[#38bdf8]/40 hover:shadow-lg transition-all duration-300 cursor-pointer">
              <div class="w-10 h-10 bg-gradient-to-br from-[#38bdf8] to-[#38b89a] rounded-xl flex items-center justify-center shadow-md shadow-[#38bdf8]/20 group-hover:scale-110 transition-transform duration-300">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                  <path d="M20 4H4C2.9 4 2 4.9 2 6V15C2 16.1 2.9 17 4 17H7L12 22L12 17H20C21.1 17 22 16.1 22 15V6C22 4.9 21.1 4 20 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13 7L11 11H14L12 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <span class="text-[10px] font-bold text-[#38b89a] text-center uppercase tracking-wide leading-tight">Respuestas<br/>Rápidas</span>
            </div>
            
            <!-- 3. Vendedor Confiable -->
            <div class="group flex flex-col items-center gap-2 p-2.5 bg-gradient-to-br from-[#7dd3fc]/5 to-[#4a9ec7]/10 rounded-xl border border-[#7dd3fc]/15 hover:border-[#7dd3fc]/40 hover:shadow-lg transition-all duration-300 cursor-pointer">
              <div class="w-10 h-10 bg-gradient-to-br from-[#7dd3fc] to-[#4a9ec7] rounded-xl flex items-center justify-center shadow-md shadow-[#7dd3fc]/20 group-hover:scale-110 transition-transform duration-300">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                  <circle cx="10" cy="7" r="4" stroke="white" stroke-width="2"/>
                  <path d="M4 21V18C4 15.8 5.8 14 8 14H12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                  <circle cx="17" cy="17" r="4" stroke="white" stroke-width="2"/>
                  <path d="M15.5 17L16.5 18L19 15.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <span class="text-[10px] font-bold text-[#4a9ec7] text-center uppercase tracking-wide leading-tight">Vendedor<br/>Confiable</span>
            </div>
            
            <!-- 4. Transacciones Seguras -->
            <div class="group flex flex-col items-center gap-2 p-2.5 bg-gradient-to-br from-[#0ea5e9]/5 via-[#38bdf8]/5 to-[#7dd3fc]/10 rounded-xl border border-[#38bdf8]/15 hover:border-[#38bdf8]/40 hover:shadow-lg transition-all duration-300 cursor-pointer">
              <div class="w-10 h-10 bg-gradient-to-br from-[#0ea5e9] via-[#38bdf8] to-[#7dd3fc] rounded-xl flex items-center justify-center shadow-md shadow-[#38bdf8]/20 group-hover:scale-110 transition-transform duration-300">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                  <path d="M12 2L4 6V12C4 17 7.5 21.5 12 23C16.5 21.5 20 17 20 12V6L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <rect x="9" y="10" width="6" height="5" rx="1" stroke="white" stroke-width="1.5"/>
                  <path d="M10 10V8C10 6.9 10.9 6 12 6C13.1 6 14 6.9 14 8V10" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
              </div>
              <span class="text-[10px] font-bold text-[#38bdf8] text-center uppercase tracking-wide leading-tight">Transacciones<br/>Seguras</span>
            </div>
            
          </div>
        </div>
        
      </div>
      
      <!-- ========================================= -->
      <!-- COLUMNA DERECHA: Filtros y Lista de Reseñas -->
      <!-- ========================================= -->
      <div class="lg:col-span-8">
        
        <!-- Filtros y Ordenamiento -->
        <div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
          <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-semibold text-slate-700">Filtrar por:</span>
            
            <select class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500" id="filtro-estrellas">
              <option value="all">Todas las estrellas</option>
              <option value="5">5 estrellas</option>
              <option value="4">4 estrellas</option>
              <option value="3">3 estrellas</option>
              <option value="2">2 estrellas</option>
              <option value="1">1 estrella</option>
            </select>
            
            <select class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500" id="ordenar-por">
              <option value="recientes">Más recientes</option>
              <option value="antiguos">Más antiguos</option>
              <option value="mejor-valoradas">Mejor valoradas</option>
              <option value="peor-valoradas">Peor valoradas</option>
            </select>
            
            <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
              <input type="checkbox" id="solo-verificadas" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
              <span>Solo compras verificadas</span>
            </label>
          </div>
        </div>
        
        <!-- Lista de Reseñas -->
        <?php if (!empty($opiniones)): ?>
        <div class="space-y-4" id="lista-opiniones">
          <?php foreach ($opiniones as $opinion): ?>
          <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-md transition-shadow" data-rating="<?php echo $opinion['rating']; ?>" data-verificada="<?php echo !empty($opinion['compra_verificada']) ? '1' : '0'; ?>">
            
            <!-- Header de la Reseña -->
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-start gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-sky-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                  <?php echo strtoupper(substr($opinion['autor'], 0, 1)); ?>
                </div>
                <div>
                  <div class="flex items-center gap-2 mb-1">
                    <span class="font-bold text-slate-800"><?php echo htmlspecialchars($opinion['autor']); ?></span>
                    <?php if (!empty($opinion['compra_verificada'])): ?>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">
                      <i class="ph-seal-check"></i>
                      Compra verificada
                    </span>
                    <?php endif; ?>
                  </div>
                  <div class="flex items-center gap-2">
                    <div class="flex gap-0.5">
                      <?php for ($i = 1; $i <= 5; $i++): ?>
                      <i class="ph-star<?php echo $i <= $opinion['rating'] ? '-fill' : ''; ?> text-amber-400"></i>
                      <?php endfor; ?>
                    </div>
                    <span class="text-sm text-slate-500"><?php echo htmlspecialchars($opinion['fecha']); ?></span>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Contenido de la Reseña -->
            <p class="text-slate-700 leading-relaxed mb-4">
              <?php echo nl2br(htmlspecialchars($opinion['comentario'])); ?>
            </p>
            
            <!-- Fotos de la Reseña (si existen) -->
            <?php if (!empty($opinion['fotos'])): ?>
            <div class="flex gap-2 mb-4">
              <?php foreach (array_slice($opinion['fotos'], 0, 4) as $foto): ?>
              <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto de reseña" class="w-20 h-20 object-cover rounded-lg border border-slate-200 cursor-pointer hover:opacity-80 transition-opacity">
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Respuesta del Vendedor (si existe) -->
            <?php if (!empty($opinion['respuesta_vendedor'])): ?>
            <div class="mt-4 p-4 bg-sky-50 border-l-4 border-sky-500 rounded-r-lg">
              <div class="flex items-center gap-2 mb-2">
                <i class="ph-storefront text-sky-600"></i>
                <span class="text-sm font-bold text-sky-900">Respuesta del vendedor:</span>
              </div>
              <p class="text-sm text-slate-700 leading-relaxed">
                <?php echo nl2br(htmlspecialchars($opinion['respuesta_vendedor'])); ?>
              </p>
            </div>
            <?php endif; ?>
            
            <!-- Acciones de la Reseña -->
            <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
              <button 
                class="flex items-center gap-2 text-sm text-slate-600 hover:text-sky-600 transition-colors"
                onclick="TiendaModule.votarOpinion(<?php echo $opinion['id']; ?>, 'util')"
              >
                <i class="ph-thumbs-up"></i>
                <span>Útil (<?php echo $opinion['votos_util'] ?? 0; ?>)</span>
              </button>
              <button 
                class="flex items-center gap-2 text-sm text-slate-600 hover:text-slate-800 transition-colors"
                onclick="TiendaModule.votarOpinion(<?php echo $opinion['id']; ?>, 'no_util')"
              >
                <i class="ph-thumbs-down"></i>
                <span>(<?php echo $opinion['votos_no_util'] ?? 0; ?>)</span>
              </button>
              <button class="flex items-center gap-2 text-sm text-slate-600 hover:text-slate-800 transition-colors ml-auto">
                <i class="ph-flag"></i>
                <span>Reportar</span>
              </button>
            </div>
            
          </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
          <i class="ph-chat-circle-text text-6xl text-slate-300 mb-4"></i>
          <h3 class="text-xl font-bold text-slate-700 mb-2">Aún no hay reseñas</h3>
          <p class="text-slate-500">¡Sé el primero en compartir tu experiencia!</p>
        </div>
        <?php endif; ?>
        
        <!-- Botón Load More Reviews -->
        <?php if (!empty($opiniones) && count($opiniones) > 5): ?>
        <div class="mt-6 text-center" id="load-more-container">
          <button 
            id="btn-load-more" 
            class="group inline-flex items-center gap-3 px-8 py-4 bg-white border-2 border-slate-200 hover:border-sky-500 rounded-xl font-semibold text-slate-700 hover:text-sky-600 transition-all hover:shadow-lg"
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" class="transition-transform group-hover:rotate-180">
              <path d="M12 4v16m0 0l-6-6m6 6l6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Cargar más reseñas</span>
            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full text-sm font-bold" id="reviews-counter">
              +<?php echo count($opiniones) - 5; ?>
            </span>
          </button>
          
          <!-- Loading State (oculto por defecto) -->
          <div id="loading-reviews" class="hidden">
            <div class="inline-flex items-center gap-3 px-8 py-4 bg-slate-50 rounded-xl">
              <svg class="animate-spin h-5 w-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span class="text-slate-600 font-medium">Cargando reseñas...</span>
            </div>
          </div>
          
          <!-- Mensaje cuando se cargaron todas -->
          <div id="all-loaded-message" class="hidden">
            <div class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-50 text-emerald-700 rounded-xl">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
              </svg>
              <span class="font-medium">Has visto todas las reseñas</span>
            </div>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Formulario para Nueva Reseña -->
        <div class="mt-6 bg-white rounded-xl border border-slate-200 p-6">
          <h4 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
            <i class="ph-pencil-simple-line text-sky-600"></i>
            Escribe tu reseña
          </h4>
          
          <form id="formNuevaOpinion" class="space-y-4">
            <div class="flex items-center gap-3">
              <span class="text-sm font-medium text-slate-700">Tu calificación:</span>
              <div class="flex gap-1 rating-stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <button type="button" class="text-3xl text-slate-300 hover:text-amber-400 transition-colors" data-rating="<?php echo $i; ?>">
                  <i class="ph-star"></i>
                </button>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="rating" value="0">
            </div>
            
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Tu experiencia</label>
              <textarea 
                name="comentario" 
                class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none" 
                rows="4"
                placeholder="Comparte los detalles de tu experiencia con esta tienda..." 
                required
              ></textarea>
            </div>
            
            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-lg transition-colors flex items-center justify-center gap-2">
              <i class="ph-paper-plane-tilt"></i>
              Publicar reseña
            </button>
          </form>
        </div>
        
      </div>
      
    </div>
  </div>

  <!-- ===================== -->
  <!-- TAB: ACERCA DE -->
  <!-- ===================== -->
  <div id="tab-terminos" class="tienda-tab-content">
    
    <!-- Descripción de la Empresa -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
      <div class="flex items-start gap-4">
        <div class="w-14 h-14 bg-sky-50 rounded-xl flex items-center justify-center flex-shrink-0">
          <i class="ph-buildings text-sky-600 text-2xl"></i>
        </div>
        <div class="flex-1">
          <h3 class="text-xl font-bold text-slate-800 mb-3">
            <?php echo htmlspecialchars($tienda['nombre']); ?>
          </h3>
          <p class="text-slate-600 leading-relaxed mb-4">
            <?php echo htmlspecialchars($tienda['descripcion']); ?>
          </p>
          
          <!-- Categoría y Actividad en línea -->
          <div class="flex flex-wrap gap-3 text-sm">
            <div class="flex items-center gap-2 text-slate-600">
              <i class="ph-tag text-purple-500"></i>
              <span class="font-medium">Categoría:</span>
              <span class="font-bold text-slate-700"><?php echo htmlspecialchars($tienda['categoria'] ?? 'General'); ?></span>
            </div>
            <div class="flex items-center gap-2 text-slate-600">
              <i class="ph-briefcase text-emerald-500"></i>
              <span class="font-medium">Actividad:</span>
              <span class="font-bold text-slate-700"><?php echo htmlspecialchars($tienda['actividad'] ?? 'Comercio'); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Información de Contacto -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
      <h4 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
        <i class="ph-address-book text-sky-600"></i>
        Información de Contacto
      </h4>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Teléfono -->
        <?php if (!empty($tienda['telefono'])): ?>
        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg">
          <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
            <i class="ph-phone text-blue-600"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Teléfono</p>
            <a href="tel:<?php echo htmlspecialchars($tienda['telefono']); ?>" class="text-sm font-bold text-slate-700 hover:text-sky-600">
              <?php echo htmlspecialchars($tienda['telefono']); ?>
            </a>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Email -->
        <?php if (!empty($tienda['correo'])): ?>
        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg">
          <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center">
            <i class="ph-envelope text-rose-600"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-xs text-slate-500 font-medium">Correo Electrónico</p>
            <a href="mailto:<?php echo htmlspecialchars($tienda['correo']); ?>" class="text-sm font-bold text-slate-700 hover:text-sky-600 truncate block">
              <?php echo htmlspecialchars($tienda['correo']); ?>
            </a>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Dirección -->
        <?php if (!empty($tienda['direccion'])): ?>
        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg md:col-span-2">
          <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="ph-map-pin text-amber-600"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Dirección</p>
            <p class="text-sm font-bold text-slate-700">
              <?php echo htmlspecialchars($tienda['direccion']); ?>
            </p>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Redes Sociales -->
    <?php if (!empty($redes)): ?>
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
      <h4 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
        <i class="ph-share-network text-purple-600"></i>
        Redes Sociales
      </h4>
      
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        <?php 
        $redesIconos = [
          'instagram' => ['icono' => 'ph-instagram-logo', 'color' => 'bg-gradient-to-br from-pink-500 to-purple-600', 'nombre' => 'Instagram'],
          'facebook' => ['icono' => 'ph-facebook-logo', 'color' => 'bg-blue-600', 'nombre' => 'Facebook'],
          'tiktok' => ['icono' => 'ph-tiktok-logo', 'color' => 'bg-slate-900', 'nombre' => 'TikTok'],
          'whatsapp' => ['icono' => 'ph-whatsapp-logo', 'color' => 'bg-green-500', 'nombre' => 'WhatsApp'],
          'youtube' => ['icono' => 'ph-youtube-logo', 'color' => 'bg-red-600', 'nombre' => 'YouTube'],
          'twitter' => ['icono' => 'ph-twitter-logo', 'color' => 'bg-sky-500', 'nombre' => 'Twitter'],
          'linkedin' => ['icono' => 'ph-linkedin-logo', 'color' => 'bg-blue-700', 'nombre' => 'LinkedIn'],
          'pinterest' => ['icono' => 'ph-pinterest-logo', 'color' => 'bg-red-600', 'nombre' => 'Pinterest'],
          'telegram' => ['icono' => 'ph-telegram-logo', 'color' => 'bg-sky-400', 'nombre' => 'Telegram'],
          'web' => ['icono' => 'ph-globe', 'color' => 'bg-slate-600', 'nombre' => 'Sitio Web'],
        ];
        
        foreach ($redes as $plataforma => $red): 
          if (!empty($red['url'])):
            $info = $redesIconos[$plataforma] ?? ['icono' => 'ph-link', 'color' => 'bg-slate-500', 'nombre' => ucfirst($plataforma)];
        ?>
        <a href="<?php echo htmlspecialchars($red['url']); ?>" target="_blank" 
           class="flex items-center gap-2 p-3 rounded-lg border border-slate-200 hover:border-slate-300 hover:shadow-sm transition-all group">
          <div class="w-8 h-8 <?php echo $info['color']; ?> rounded-lg flex items-center justify-center">
            <i class="<?php echo $info['icono']; ?> text-white"></i>
          </div>
          <span class="text-xs font-semibold text-slate-700 group-hover:text-sky-600"><?php echo $info['nombre']; ?></span>
        </a>
        <?php 
          endif;
        endforeach; 
        ?>
      </div>
    </div>
    <?php endif; ?>

    <!-- Rubros -->
    <?php if (!empty($tienda['rubros'])): ?>
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
      <h4 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
        <i class="ph-stack text-indigo-600"></i>
        Rubros
      </h4>
      
      <div class="flex flex-wrap gap-2">
        <?php foreach ($tienda['rubros'] as $rubro): ?>
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-sm font-medium text-slate-700">
          <i class="ph-check-circle text-sky-500 text-xs"></i>
          <?php echo htmlspecialchars($rubro); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <!-- Políticas y Términos -->
    <?php if (!empty($terminos['envio']) || !empty($terminos['devolucion']) || !empty($terminos['privacidad'])): ?>
    <div class="bg-white rounded-xl border border-slate-200 p-6">
      <h4 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
        <i class="ph-file-text text-slate-600"></i>
        Políticas y Términos
      </h4>
      
      <div class="space-y-3">
        <?php if (!empty($terminos['envio'])): ?>
        <details class="border border-slate-200 rounded-lg overflow-hidden">
          <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2">
              <i class="ph-truck text-sky-600"></i>
              <span class="font-semibold text-slate-700">Política de Envío</span>
            </div>
            <i class="ph-caret-down text-slate-400"></i>
          </summary>
          <div class="p-4 pt-0 text-sm text-slate-600 leading-relaxed">
            <?php echo nl2br(htmlspecialchars($terminos['envio'])); ?>
          </div>
        </details>
        <?php endif; ?>
        
        <?php if (!empty($terminos['devolucion'])): ?>
        <details class="border border-slate-200 rounded-lg overflow-hidden">
          <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2">
              <i class="ph-arrow-counter-clockwise text-amber-600"></i>
              <span class="font-semibold text-slate-700">Política de Devolución</span>
            </div>
            <i class="ph-caret-down text-slate-400"></i>
          </summary>
          <div class="p-4 pt-0 text-sm text-slate-600 leading-relaxed">
            <?php echo nl2br(htmlspecialchars($terminos['devolucion'])); ?>
          </div>
        </details>
        <?php endif; ?>
        
        <?php if (!empty($terminos['privacidad'])): ?>
        <details class="border border-slate-200 rounded-lg overflow-hidden">
          <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2">
              <i class="ph-shield-check text-emerald-600"></i>
              <span class="font-semibold text-slate-700">Política de Privacidad</span>
            </div>
            <i class="ph-caret-down text-slate-400"></i>
          </summary>
          <div class="p-4 pt-0 text-sm text-slate-600 leading-relaxed">
            <?php echo nl2br(htmlspecialchars($terminos['privacidad'])); ?>
          </div>
        </details>
        <?php endif; ?>
      </div>
      
      <!-- Documentos Descargables -->
      <?php if (!empty($terminos['archivos'])): ?>
      <div class="mt-4 pt-4 border-t border-slate-200">
        <p class="text-sm font-semibold text-slate-700 mb-3">
          <i class="ph-download-simple mr-1"></i>
          Documentos Descargables
        </p>
        <div class="flex flex-wrap gap-2">
          <?php foreach ($terminos['archivos'] as $archivo): ?>
          <a href="<?php echo htmlspecialchars($archivo['url']); ?>" target="_blank" 
             class="inline-flex items-center gap-2 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-sky-50 hover:border-sky-300 hover:text-sky-600 transition-all">
            <i class="ph-file-pdf text-red-500"></i>
            <?php echo htmlspecialchars($archivo['nombre']); ?>
            <i class="ph-download-simple text-xs"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    
  </div>



</div>

<script>
// Inicializar sistema de estrellas para nueva opinión
document.querySelectorAll('.rating-stars button').forEach(btn => {
  btn.addEventListener('click', function() {
    const rating = parseInt(this.dataset.rating);
    document.querySelector('input[name="rating"]').value = rating;
    
    document.querySelectorAll('.rating-stars button').forEach((star, index) => {
      const icon = star.querySelector('i');
      if (index < rating) {
        icon.className = 'ph-star-fill';
        star.classList.add('text-amber-400');
        star.classList.remove('text-slate-300');
      } else {
        icon.className = 'ph-star';
        star.classList.remove('text-amber-400');
        star.classList.add('text-slate-300');
      }
    });
  });
});

// Sistema de Filtros y Ordenamiento de Reseñas
document.addEventListener('DOMContentLoaded', function() {
  const filtroEstrellas = document.getElementById('filtro-estrellas');
  const ordenarPor = document.getElementById('ordenar-por');
  const soloVerificadas = document.getElementById('solo-verificadas');
  const listaOpiniones = document.getElementById('lista-opiniones');
  
  if (!listaOpiniones) return; // Si no hay reseñas, salir
  
  function aplicarFiltros() {
    const opiniones = Array.from(listaOpiniones.children);
    
    // Filtrar
    opiniones.forEach(opinion => {
      let mostrar = true;
      
      // Filtro por estrellas
      if (filtroEstrellas && filtroEstrellas.value !== 'all') {
        const rating = opinion.dataset.rating;
        if (rating !== filtroEstrellas.value) {
          mostrar = false;
        }
      }
      
      // Filtro por compras verificadas
      if (soloVerificadas && soloVerificadas.checked) {
        const verificada = opinion.dataset.verificada;
        if (verificada !== '1') {
          mostrar = false;
        }
      }
      
      opinion.style.display = mostrar ? 'block' : 'none';
    });
    
    // Ordenar
    if (ordenarPor) {
      const opinionesVisibles = opiniones.filter(op => op.style.display !== 'none');
      
      opinionesVisibles.sort((a, b) => {
        const ratingA = parseInt(a.dataset.rating);
        const ratingB = parseInt(b.dataset.rating);
        
        switch(ordenarPor.value) {
          case 'mejor-valoradas':
            return ratingB - ratingA;
          case 'peor-valoradas':
            return ratingA - ratingB;
          case 'recientes':
          case 'antiguos':
          default:
            return 0; // Mantener orden original
        }
      });
      
      // Reordenar en el DOM
      opinionesVisibles.forEach(opinion => {
        listaOpiniones.appendChild(opinion);
      });
    }
  }
  
  // Event listeners
  if (filtroEstrellas) {
    filtroEstrellas.addEventListener('change', aplicarFiltros);
  }
  
  if (ordenarPor) {
    ordenarPor.addEventListener('change', aplicarFiltros);
  }
  
  if (soloVerificadas) {
    soloVerificadas.addEventListener('change', aplicarFiltros);
  }
  
  // ============================================
  // Sistema de "Load More Reviews"
  // ============================================
  const btnLoadMore = document.getElementById('btn-load-more');
  const loadingState = document.getElementById('loading-reviews');
  const allLoadedMessage = document.getElementById('all-loaded-message');
  const reviewsCounter = document.getElementById('reviews-counter');
  
  if (btnLoadMore && listaOpiniones) {
    const allReviews = Array.from(listaOpiniones.children);
    const reviewsPerPage = 5;
    let currentlyShown = reviewsPerPage;
    
    // Ocultar reseñas inicialmente (mostrar solo las primeras 5)
    allReviews.forEach((review, index) => {
      if (index >= reviewsPerPage) {
        review.style.display = 'none';
        review.classList.add('hidden-review');
      }
    });
    
    // Función para cargar más reseñas
    btnLoadMore.addEventListener('click', function() {
      // Mostrar loading
      btnLoadMore.style.display = 'none';
      loadingState.classList.remove('hidden');
      
      // Simular carga (puedes ajustar el tiempo)
      setTimeout(() => {
        const hiddenReviews = allReviews.filter(r => r.classList.contains('hidden-review'));
        const reviewsToShow = hiddenReviews.slice(0, reviewsPerPage);
        
        // Mostrar siguiente batch de reseñas con animación
        reviewsToShow.forEach((review, index) => {
          setTimeout(() => {
            review.style.display = 'block';
            review.classList.remove('hidden-review');
            review.style.opacity = '0';
            review.style.transform = 'translateY(20px)';
            
            // Animación de entrada
            setTimeout(() => {
              review.style.transition = 'all 0.4s ease';
              review.style.opacity = '1';
              review.style.transform = 'translateY(0)';
            }, 50);
          }, index * 100); // Stagger effect
        });
        
        currentlyShown += reviewsToShow.length;
        const remaining = allReviews.length - currentlyShown;
        
        // Ocultar loading
        loadingState.classList.add('hidden');
        
        // Actualizar contador o mostrar mensaje final
        if (remaining > 0) {
          btnLoadMore.style.display = 'inline-flex';
          reviewsCounter.textContent = `+${remaining}`;
        } else {
          // Todas las reseñas cargadas
          allLoadedMessage.classList.remove('hidden');
        }
        
        // Smooth scroll hacia las nuevas reseñas
        setTimeout(() => {
          if (reviewsToShow.length > 0) {
            reviewsToShow[0].scrollIntoView({ 
              behavior: 'smooth', 
              block: 'center' 
            });
          }
        }, 400);
        
      }, 800); // Tiempo de "carga"
    });
  }
});
</script>

<!-- Script para toggle de filtros avanzados -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const toggleBtn = document.getElementById('toggleFiltrosAvanzados');
  const filtrosAvanzados = document.getElementById('filtrosAvanzados');
  
  if (toggleBtn && filtrosAvanzados) {
    toggleBtn.addEventListener('click', function() {
      const isVisible = filtrosAvanzados.style.display !== 'none';
      
      if (isVisible) {
        // Cerrar con animación
        filtrosAvanzados.style.animation = 'slideUp 0.3s ease-out forwards';
        setTimeout(() => {
          filtrosAvanzados.style.display = 'none';
          filtrosAvanzados.style.animation = '';
        }, 280);
        toggleBtn.classList.remove('active');
      } else {
        // Abrir con animación
        filtrosAvanzados.style.display = 'flex';
        filtrosAvanzados.style.animation = 'slideDown 0.3s ease-out';
        toggleBtn.classList.add('active');
      }
    });
  }
});
</script>

<style>
@keyframes slideUp {
  from {
    opacity: 1;
    transform: translateY(0);
  }
  to {
    opacity: 0;
    transform: translateY(-10px);
  }
}

/* Botón limpiar búsqueda */
.btn-limpiar-busqueda {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  padding: 0;
  background: #ef4444;
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.btn-limpiar-busqueda:hover {
  background: #dc2626;
  transform: scale(1.1);
}

.btn-limpiar-busqueda i {
  font-size: 0.75rem;
}

/* Modo búsqueda activa */
.tienda-tabs.busqueda-activa .tienda-tabs-header {
  display: none !important;
}

.tienda-tabs.busqueda-activa .tienda-tab-content:not(#tab-productos) {
  display: none !important;
}

.tienda-tabs.busqueda-activa #tab-productos {
  display: block !important;
}

/* Indicador de búsqueda activa */
.busqueda-indicador {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  background: linear-gradient(135deg, #fef3c7 0%, #fef9c3 100%);
  border: 1px solid #fcd34d;
  border-radius: 12px;
  margin-bottom: 1rem;
  color: #92400e;
  font-size: 0.875rem;
}

.busqueda-indicador i {
  font-size: 1.25rem;
  color: #f59e0b;
}

.busqueda-indicador .busqueda-texto {
  flex: 1;
}

.busqueda-indicador .busqueda-texto strong {
  color: #78350f;
}

.busqueda-indicador .btn-volver-tabs {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.5rem 1rem;
  background: #fff;
  color: #92400e;
  border: 1px solid #fcd34d;
  border-radius: 8px;
  font-size: 0.8125rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.busqueda-indicador .btn-volver-tabs:hover {
  background: #fef3c7;
  border-color: #f59e0b;
}
</style>

<!-- Script para búsqueda que oculta tabs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const tiendaTabs = document.querySelector('.tienda-tabs');
  const inputBuscar = document.getElementById('filtroBuscar');
  const btnLimpiar = document.getElementById('limpiarBusqueda');
  const tabProductos = document.getElementById('tab-productos');
  
  if (!inputBuscar || !tiendaTabs) return;
  
  let indicadorBusqueda = null;
  
  // Función para activar modo búsqueda
  function activarModoBusqueda(texto) {
    tiendaTabs.classList.add('busqueda-activa');
    btnLimpiar.style.display = 'flex';
    
    // Crear indicador si no existe
    if (!indicadorBusqueda && tabProductos) {
      indicadorBusqueda = document.createElement('div');
      indicadorBusqueda.className = 'busqueda-indicador';
      indicadorBusqueda.innerHTML = `
        <i class="ph ph-magnifying-glass"></i>
        <span class="busqueda-texto">Resultados para: <strong>"${texto}"</strong></span>
        <button class="btn-volver-tabs" id="btnVolverTabs">
          <i class="ph ph-arrow-left"></i>
          Volver a tabs
        </button>
      `;
      tabProductos.insertBefore(indicadorBusqueda, tabProductos.firstChild);
      
      // Event listener para botón volver
      document.getElementById('btnVolverTabs').addEventListener('click', limpiarBusqueda);
    } else if (indicadorBusqueda) {
      // Actualizar texto de búsqueda
      indicadorBusqueda.querySelector('.busqueda-texto').innerHTML = `Resultados para: <strong>"${texto}"</strong>`;
    }
  }
  
  // Función para limpiar búsqueda
  function limpiarBusqueda() {
    tiendaTabs.classList.remove('busqueda-activa');
    inputBuscar.value = '';
    btnLimpiar.style.display = 'none';
    
    // Remover indicador
    if (indicadorBusqueda) {
      indicadorBusqueda.remove();
      indicadorBusqueda = null;
    }
    
    // Disparar evento input para resetear filtros
    inputBuscar.dispatchEvent(new Event('input', { bubbles: true }));
  }
  
  // Event listeners
  inputBuscar.addEventListener('input', function() {
    const texto = this.value.trim();
    
    if (texto.length > 0) {
      activarModoBusqueda(texto);
    } else {
      limpiarBusqueda();
    }
  });
  
  btnLimpiar.addEventListener('click', limpiarBusqueda);
});
</script>
