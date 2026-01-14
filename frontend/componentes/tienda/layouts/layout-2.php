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
  <!-- (Fuera del layout de 2 columnas, ancho completo) -->
  <!-- ========================================= -->
  <div class="tienda-bloque" data-tipo="productos-grid" data-nombre="Selecciones Destacadas">
    <?php include __DIR__ . '/../compartidos/tienda-productos-grid.php'; ?>
  </div>
</div>
<?php endif; ?>
