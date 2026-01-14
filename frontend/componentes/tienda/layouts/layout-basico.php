<?php
/**
 * LAYOUT BÁSICO
 * Estructura: Contenido principal (tabs) a la izquierda, sidebar a la derecha
 * NO incluye secciones premium (banners extra, grids adicionales)
 */
?>

<!-- ========================================= -->
<!-- LAYOUT BÁSICO: TABS + SIDEBAR -->
<!-- ========================================= -->
<div class="tienda-main-layout layout-sidebar-right">
  <!-- Columna principal -->
  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-scroll" data-nombre="Productos Destacados">
      <?php include __DIR__ . '/../../tienda-tabs.php'; ?>
    </div>
  </div>
  
  <!-- Sidebar -->
  <div class="tienda-bloque" data-tipo="sidebar" data-nombre="Sidebar">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </div>
</div>
