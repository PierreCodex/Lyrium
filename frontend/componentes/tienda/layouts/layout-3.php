<?php
/**
 * LAYOUT 3: ANCHO COMPLETO (FULL WIDTH)
 * Estructura: Sin sidebar, contenido principal ocupa todo el ancho
 * Incluye secciones adicionales como banners horizontales y ofertas del día
 */
?>

<!-- ========================================= -->
<!-- LAYOUT: FULL WIDTH (Con sidebar vertical de productos) -->
<!-- ========================================= -->
<div class="tienda-main-layout layout-full-width">
  <!-- Columna principal: Tabs con Productos destacados -->
  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-scroll" data-nombre="Productos Destacados">
      <?php include __DIR__ . '/../../tienda-tabs.php'; ?>
    </div>
  </div>
  
  <!-- Sidebar vertical con productos (siempre visible en layout 3) -->
  <div class="tienda-bloque" data-tipo="sidebar" data-nombre="Sidebar">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </div>
</div>

<?php if ($plan === 'premium'): ?>
  <!-- Contenedor para secciones del modelo 3 que se ocultan en otros tabs -->
  <div class="tienda-secciones-secundarias-full">
    <!-- Banner Horizontal Adicional para Modelo 3 (Full Width) -->
    <div class="tienda-bloque" data-tipo="anuncios" data-nombre="Banner Publicitario">
      <div class="tienda-full-banner-horizontal mb-8">
        <?php include __DIR__ . '/../banners/tienda-banner-publicitario.php'; ?>
      </div>
    </div>

    <!-- Sección de Productos Extra para el Modelo 3 (Según Bosquejo) -->
    <div class="tienda-bloque" data-tipo="productos-grid" data-nombre="Ofertas del Día">
      <div class="mb-10">
      <div class="tienda-grid-header">
        <h3 class="tienda-grid-titulo">Ofertas del día</h3>
      </div>
      
      <!-- Grid simple de productos (sin filtros) -->
      <div class="tienda-productos-grid vista-grid" id="productosGridOfertas" style="display: grid !important;">
        <?php 
          $productosOfertas = array_slice($productos, 0, 6);
          foreach ($productosOfertas as $producto): 
        ?>
        <div class="producto-grid-card" data-producto-id="<?php echo $producto['id']; ?>">
          <!-- Imagen del producto -->
          <div class="producto-grid-imagen">
            <img 
              src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
              alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
              loading="lazy"
            >
            
            <!-- Sticker de estado -->
            <?php if (!empty($producto['sticker'])): ?>
            <span class="producto-grid-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
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
            
            <!-- Descuento badge -->
            <?php if (!empty($producto['precio_anterior']) && $producto['precio_anterior'] > $producto['precio']): ?>
            <?php 
              $descuento = round((($producto['precio_anterior'] - $producto['precio']) / $producto['precio_anterior']) * 100);
            ?>
            <span class="producto-grid-descuento">-<?php echo $descuento; ?>%</span>
            <?php endif; ?>
            
            <!-- Icono carrito flotante -->
            <button class="producto-grid-cart-icon" title="Añadir al carrito">
              <i class="ph ph-shopping-cart-simple"></i>
            </button>
          </div>
          
          <!-- Info del producto -->
          <div class="producto-grid-info">
            <!-- Nombre -->
            <h4 class="producto-grid-nombre">
              <a href="producto.php?id=<?php echo $producto['id']; ?>">
                <?php echo htmlspecialchars($producto['nombre']); ?>
              </a>
            </h4>
            
            <!-- Precios -->
            <div class="producto-grid-precios">
              <span class="producto-grid-precio-actual">
                <?php echo number_format($producto['precio'], 2); ?>
              </span>
              <?php if (!empty($producto['precio_anterior'])): ?>
              <span class="producto-grid-precio-anterior">
                S/ <?php echo number_format($producto['precio_anterior'], 2); ?>
              </span>
              <?php endif; ?>
            </div>
            
            <!-- Rating -->
            <div class="producto-grid-rating">
              <div class="producto-grid-stars">
                <?php 
                  $rating = $producto['rating'] ?? 5;
                  for ($i = 1; $i <= 5; $i++): 
                ?>
                <i class="ph-fill ph-star"></i>
                <?php endfor; ?>
              </div>
              <span class="producto-grid-reviews"><?php echo $producto['ventas'] ?? rand(100, 5000); ?></span>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

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
  <!-- (Fuera del layout de 2 columnas, ancho completo) -->
  <!-- ========================================= -->
  <div class="tienda-bloque" data-tipo="productos-grid" data-nombre="Selecciones Destacadas">
    <?php include __DIR__ . '/../compartidos/tienda-productos-grid.php'; ?>
  </div>
</div>
<?php endif; ?>
