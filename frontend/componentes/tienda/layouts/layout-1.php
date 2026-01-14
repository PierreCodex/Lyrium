<?php
/**
 * LAYOUT 1: SIDEBAR DERECHA
 * Estructura: Contenido principal (tabs) a la izquierda, sidebar a la derecha
 */
?>

<!-- ========================================= -->
<!-- LAYOUT: TABS + SIDEBAR (2 columnas) -->
<!-- Sidebar a la derecha -->
<!-- ========================================= -->
<div class="tienda-main-layout layout-sidebar-right">
  <!-- Columna principal: Tabs con Productos destacados -->
  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-scroll" data-nombre="Productos Destacados">
      <?php include __DIR__ . '/../../tienda-tabs.php'; ?>
    </div>
  </div>
  
  <!-- Sidebar derecha -->
  <div class="tienda-bloque" data-tipo="sidebar" data-nombre="Sidebar">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
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
