<?php
/**
 * COMPONENTE: Sidebar de Tienda - Slider Vertical de Productos
 * 
 * Variables esperadas:
 * - $tienda: datos de la tienda
 * - $productos: array de productos para el slider vertical
 * - $plan: 'basico' o 'premium'
 */

// Productos para el slider vertical (máximo 8)
$productosSlider = array_slice($productos ?? [], 0, 8);
?>

<aside class="tienda-slider-vertical-container">
  
  <?php if ($plan === 'premium'): ?>
  <!-- Slider Vertical de Productos (SV) - Solo Premium -->
  <?php if (!empty($productosSlider)): ?>
  <div class="tienda-slider-vertical-card tienda-slider-vertical-fullheight">
    
    <div class="tienda-slider-vertical-wrapper">
      <!-- Botón Arriba -->
      <button class="tienda-slider-vertical-nav up" aria-label="Anterior">
        <i class="ph-caret-up"></i>
      </button>
      
      <!-- Container del Slider -->
      <div class="tienda-slider-vertical-container">
        <div class="tienda-slider-vertical-track">
          <?php foreach ($productosSlider as $index => $producto): ?>
          <div class="tienda-slider-vertical-item" data-index="<?php echo $index; ?>">
            <a href="producto.php?id=<?php echo $producto['id']; ?>" class="tienda-slider-vertical-link">
              <div class="tienda-slider-vertical-img">
                <img 
                  src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                  alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                  loading="lazy"
                >
                <?php if (!empty($producto['sticker'])): ?>
                <span class="tienda-slider-vertical-sticker <?php echo $producto['sticker']; ?>">
                  <?php echo ucfirst($producto['sticker']); ?>
                </span>
                <?php endif; ?>
              </div>
              <div class="tienda-slider-vertical-info">
                <h4 class="tienda-slider-vertical-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                <span class="tienda-slider-vertical-precio">S/ <?php echo number_format($producto['precio'], 2); ?></span>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      
      <!-- Botón Abajo -->
      <button class="tienda-slider-vertical-nav down" aria-label="Siguiente">
        <i class="ph-caret-down"></i>
      </button>
    </div>
    
    <!-- Indicadores -->
    <div class="tienda-slider-vertical-dots">
      <?php foreach ($productosSlider as $index => $producto): ?>
      <button 
        class="tienda-slider-vertical-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
        data-index="<?php echo $index; ?>"
        aria-label="Ir a producto <?php echo $index + 1; ?>"
      ></button>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
  
  <?php else: ?>
  <!-- Publicidad del Marketplace - Plan Básico -->
  <div class="tienda-sidebar-ad">
    <div class="tienda-sidebar-ad-content">
      <span class="tienda-sidebar-ad-label">Publicidad</span>
      
      <div class="tienda-sidebar-ad-logo">
        <img src="img/logo_lyrium_blanco_01-scaled.webp" alt="Lyrium" onerror="this.style.display='none'">
      </div>
      
      <h4>¡Únete a la familia!</h4>
      <p class="tienda-sidebar-ad-subtitle">+500 emprendedores ya venden aquí</p>
      
      <div class="tienda-sidebar-ad-features">
        <span><i class="ph-check-circle-fill"></i> Tu tienda lista en minutos</span>
        <span><i class="ph-check-circle-fill"></i> Miles de clientes esperando</span>
        <span><i class="ph-check-circle-fill"></i> Sin costos de inicio</span>
        <span><i class="ph-check-circle-fill"></i> Soporte personalizado</span>
      </div>
      
      <a href="registro.php?tipo=vendedor" class="tienda-sidebar-ad-btn">
        <i class="ph-rocket-launch"></i>
        <span>¡Empezar ahora!</span>
      </a>
      
      <div class="tienda-sidebar-ad-promo">
        <i class="ph-gift-fill"></i>
        <span>Primer mes 100% GRATIS</span>
      </div>
    </div>
  </div>
  <?php endif; ?>

</aside>
