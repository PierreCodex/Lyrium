<?php
/**
 * Layout 3: Full Width con secciones alternadas
 */
?>

<div class="tienda-bloque mb-8" data-tipo="anuncios" data-nombre="Publicidad destacada">
  <?php include __DIR__ . '/../banners/tienda-banner-horizontal.php'; ?>
</div>

<div class="tienda-main-layout layout-three-columns">
  <div class="tienda-bloque tienda-sidebar-left" data-tipo="sidebar" data-nombre="Artículos de tendencia">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </div>

  <div class="tienda-main-column">
    <div class="tienda-bloque" data-tipo="productos-tabs" data-nombre="Tabs de Productos">
      <?php include __DIR__ . '/../../tienda-tabs.php'; ?>
    </div>
  </div>

  <aside class="tienda-bloque tienda-sidebar-right" data-tipo="sidebar" data-nombre="Más productos">
    <?php include __DIR__ . '/../../tienda-sidebar.php'; ?>
  </aside>
</div>

<?php if ($plan === 'premium'): ?>
<div class="tienda-secciones-secundarias-zigzag">

  <hr class="tienda-separador">

  <div class="tienda-bloque" data-tipo="productos-secundarios" data-nombre="Descubre más productos">
    <?php include __DIR__ . '/../compartidos/productos-secundarios.php'; ?>
  </div>

  <hr class="tienda-separador">

  <div class="tienda-bloque" data-tipo="anuncios" data-nombre="Oferta del día">
    <?php include __DIR__ . '/../banners/tienda-banner-publicitario.php'; ?>
  </div>

  <hr class="tienda-separador">

  <div class="tienda-bloque" data-tipo="productos-terciarios" data-nombre="Más productos para ti">
    <?php include __DIR__ . '/../compartidos/productos-terciarios.php'; ?>
  </div>

  <hr class="tienda-separador">

</div>
<?php endif; ?>
