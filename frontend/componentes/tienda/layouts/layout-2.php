<?php
/**
 * LAYOUT 2: SIDEBAR IZQUIERDA
 * Estructura: Sidebar a la izquierda, contenido principal (tabs) a la derecha
 */
?>

<!-- ========================================= -->
<!-- LAYOUT: SIDEBAR + TABS (2 columnas) -->
<!-- Sidebar a la izquierda -->
<!-- ========================================= -->
<div class="tienda-main-layout layout-sidebar-left">
  <!-- Sidebar izquierda -->
  <div class="tienda-bloque" data-tipo="sidebar" data-nombre="Sidebar">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </div>
  
  <!-- Columna principal: Tabs con Productos destacados -->
  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-scroll" data-nombre="Productos Destacados">
      <?php include __DIR__ . '/../../tienda-tabs.php'; ?>
    </div>
  </div>
</div>

<?php if ($plan === 'premium'): ?>
<!-- Contenedor para secciones de abajo que se ocultan en otros tabs -->
<div class="tienda-secciones-secundarias">
  <!-- ═══════════════════════════════════════════ -->
  <!-- LÍNEA SEPARADORA -->
  <!-- ═══════════════════════════════════════════ -->
  <hr class="tienda-separador">

  <!-- ========================================= -->
  <!-- SECCIÓN: BANNER PUBLICITARIO "OFERTAS ESPECIALES" -->
  <!-- (Fuera del layout de 2 columnas, ancho completo) -->
  <!-- ========================================= -->
  <div class="tienda-bloque" data-tipo="anuncios" data-nombre="Ofertas Especiales">
    <?php include __DIR__ . '/../banners/tienda-banner-publicitario.php'; ?>
  </div>

  <!-- ═══════════════════════════════════════════ -->
  <!-- LÍNEA SEPARADORA -->
  <!-- ═══════════════════════════════════════════ -->
  <hr class="tienda-separador">

  <!-- ========================================= -->
  <!-- SECCIÓN: GRID DE PRODUCTOS "SELECCIONES DESTACADAS" -->
  <!-- Con sidebar derecho (altura = 3 filas de productos) -->
  <!-- ========================================= -->
  <div class="tienda-bloque" data-tipo="productos-grid" data-nombre="Selecciones Destacadas">
    <div class="tienda-selecciones-layout">
      <!-- Grid de Productos (4 columnas × 3 filas = 12 productos) -->
      <div class="tienda-selecciones-grid">
        <?php 
          // Configuración específica para este layout: 12 productos (4 columnas × 3 filas)
          $maxProductosSelecciones = 12;
          $productosSelecciones = array_slice($productos ?? [], 0, $maxProductosSelecciones);
        ?>
        <!-- Header del grid -->
        <div class="tienda-productos-grid-section">
          <div class="tienda-grid-header">
            <h3 class="tienda-grid-titulo">Selecciones destacadas para ti</h3>
            <div class="tienda-grid-filtros">
              <div class="tienda-filtro-dropdown">
                <button class="tienda-filtro-btn" id="filtroOrden">
                  <span>Ordenar</span>
                  <i class="ph ph-caret-down"></i>
                </button>
              </div>
              <div class="tienda-vista-toggle">
                <button class="tienda-vista-btn active" data-vista="grid" title="Vista cuadrícula">
                  <i class="ph ph-squares-four"></i>
                </button>
                <button class="tienda-vista-btn" data-vista="lista" title="Vista lista">
                  <i class="ph ph-list"></i>
                </button>
              </div>
            </div>
          </div>
          
          <!-- Grid de 12 productos -->
          <div class="tienda-productos-grid" id="productosGridSelecciones">
            <?php if (!empty($productosSelecciones)): ?>
              <?php foreach ($productosSelecciones as $producto): ?>
              <div class="producto-grid-card" data-producto-id="<?php echo $producto['id']; ?>">
                <div class="producto-grid-imagen">
                  <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" loading="lazy">
                  <?php if (!empty($producto['sticker'])): ?>
                  <span class="producto-grid-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
                    <?php 
                      $stickerTextos = ['oferta' => 'Oferta', 'nuevo' => 'Nuevo', 'promo' => 'Promo', 'limitado' => 'Limitado'];
                      echo $stickerTextos[$producto['sticker']] ?? ucfirst($producto['sticker']);
                    ?>
                  </span>
                  <?php endif; ?>
                  <?php if (!empty($producto['precio_anterior']) && $producto['precio_anterior'] > $producto['precio']): ?>
                  <?php $descuento = round((($producto['precio_anterior'] - $producto['precio']) / $producto['precio_anterior']) * 100); ?>
                  <span class="producto-grid-descuento">-<?php echo $descuento; ?>%</span>
                  <?php endif; ?>
                  <div class="producto-grid-acciones">
                    <button class="producto-grid-accion" title="Añadir a favoritos"><i class="ph ph-heart"></i></button>
                  </div>
                  <button class="producto-grid-cart-icon" title="Añadir al carrito"><i class="ph ph-shopping-cart-simple"></i></button>
                </div>
                <div class="producto-grid-info">
                  <h4 class="producto-grid-nombre">
                    <a href="producto.php?id=<?php echo $producto['id']; ?>"><?php echo htmlspecialchars($producto['nombre']); ?></a>
                  </h4>
                  <div class="producto-grid-precios">
                    <span class="producto-grid-precio-actual"><?php echo number_format($producto['precio'], 2); ?></span>
                    <?php if (!empty($producto['precio_anterior'])): ?>
                    <span class="producto-grid-precio-anterior">S/ <?php echo number_format($producto['precio_anterior'], 2); ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="producto-grid-rating">
                    <div class="producto-grid-stars">
                      <?php for ($i = 1; $i <= 5; $i++): ?><i class="ph-fill ph-star"></i><?php endfor; ?>
                    </div>
                    <span class="producto-grid-reviews"><?php echo $producto['ventas'] ?? rand(100, 5000); ?></span>
                  </div>
                  <div class="producto-grid-hover-btns hidden md:flex">
                    <button class="producto-hover-btn" onclick="vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                      <i class="ph ph-eye"></i> Previsualizar
                    </button>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      
      <!-- Sidebar Derecho (Altura igual a 3 filas) -->
      <aside class="tienda-selecciones-sidebar">
        <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
      </aside>
    </div>
  </div>
</div>
<?php endif; ?>
