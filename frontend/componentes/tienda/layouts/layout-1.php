<?php
/**
 * LAYOUT 1: SIDEBAR IZQUIERDA + DERECHA (ALTERNADO)
 * Estructura: 
 *   Bloque 1: Sidebar izquierda + Tabs (productos destacados)
 *   Bloque 2: Productos secundarios + Sidebar derecha
 */
?>

<!-- ========================================= -->
<!-- BLOQUE 1: SIDEBAR IZQUIERDA + TABS -->
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

<!-- ═══════════════════════════════════════════ -->
<!-- LÍNEA SEPARADORA -->
<!-- ═══════════════════════════════════════════ -->
<hr class="tienda-separador">

<!-- ========================================= -->
<!-- BLOQUE 2: PRODUCTOS + SIDEBAR DERECHA -->
<!-- "También te puede interesar" -->
<!-- ========================================= -->
<div class="tienda-main-layout layout-sidebar-right layout-sidebar-compact">
  <!-- Columna principal: Productos secundarios (sin tabs) -->
  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-secundarios" data-nombre="También te puede interesar">
      <?php include __DIR__ . '/../compartidos/productos-secundarios.php'; ?>
    </div>
  </div>
  
  <!-- Sidebar derecha (altura reducida = 2 filas de productos) -->
  <div class="tienda-bloque tienda-sidebar-compact" data-tipo="sidebar" data-nombre="Sidebar Secundario">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </div>
</div>

<?php if ($plan === 'premium'): ?>
<!-- Contenedor para secciones adicionales Premium -->
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

  <!-- ========================================= -->
  <!-- SECCIÓN OCULTA: GRID DE PRODUCTOS "SELECCIONES DESTACADAS" -->
  <!-- No incluida en el bosquejo del Layout 1 -->
  <!-- ========================================= -->
  <?php /* OCULTO - No está en el bosquejo
  <div class="tienda-bloque" data-tipo="productos-grid" data-nombre="Selecciones Destacadas">
    <?php include __DIR__ . '/../compartidos/tienda-productos-grid.php'; ?>
  </div>

  <hr class="tienda-separador">
  */ ?>

  <!-- ========================================= -->
  <!-- BLOQUE 3: SIDEBAR IZQUIERDA + PRODUCTOS TERCIARIOS -->
  <!-- "Más productos para ti" -->
  <!-- ========================================= -->
  <div class="tienda-main-layout layout-sidebar-left layout-sidebar-compact-3">
    <!-- Sidebar izquierda (altura = 3 filas de productos) -->
    <div class="tienda-bloque tienda-sidebar-compact-3" data-tipo="sidebar" data-nombre="Productos Relacionados">
      <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
    </div>
    
    <!-- Columna principal: Productos terciarios -->
    <div class="tienda-main-column">
      <div class="tienda-bloque" data-tipo="productos-terciarios" data-nombre="Más productos para ti">
        <?php include __DIR__ . '/../compartidos/productos-terciarios.php'; ?>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════ -->
  <!-- LÍNEA SEPARADORA -->
  <!-- ═══════════════════════════════════════════ -->
  <hr class="tienda-separador">

  <!-- ========================================= -->
  <!-- BLOQUE 4: PRODUCTOS + SIDEBAR DERECHA -->
  <!-- "Productos más vendidos" -->
  <!-- ========================================= -->
  <div class="tienda-main-layout layout-sidebar-right">
    <!-- Columna principal: Slider de productos más vendidos -->
    <div class="tienda-main-column">
      <div class="tienda-bloque" data-tipo="productos-slider" data-nombre="Productos más vendidos">
        <?php include __DIR__ . '/../compartidos/productos-slider-fullwidth.php'; ?>
      </div>
    </div>
    
    <!-- Sidebar derecha -->
    <div class="tienda-bloque" data-tipo="sidebar" data-nombre="Sidebar Info">
      <?php include __DIR__ . '/../compartidos/sidebar-info.php'; ?>
    </div>
  </div>

</div>
<?php endif; ?>

