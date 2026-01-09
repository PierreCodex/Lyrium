<?php
/**
 * COMPONENTE: Banner Carrusel de Tienda
 * 
 * Variables esperadas:
 * - $banners: array de URLs de imágenes
 * - $plan: 'basico' o 'premium'
 * - $redes: array de redes sociales (opcional, se pasa desde tienda.php)
 */

$maxBanners = ($plan === 'premium') ? 4 : 2;
$maxRedes = ($plan === 'premium') ? 10 : 3;
$bannersVisibles = array_slice($banners, 0, $maxBanners);

$redesDisponibles = [
  'instagram' => ['icon' => 'ph-instagram-logo', 'label' => 'Instagram'],
  'facebook' => ['icon' => 'ph-facebook-logo', 'label' => 'Facebook'],
  'tiktok' => ['icon' => 'ph-tiktok-logo', 'label' => 'TikTok'],
  'whatsapp' => ['icon' => 'ph-whatsapp-logo', 'label' => 'WhatsApp'],
  'youtube' => ['icon' => 'ph-youtube-logo', 'label' => 'YouTube'],
  'twitter' => ['icon' => 'ph-twitter-logo', 'label' => 'Twitter'],
  'linkedin' => ['icon' => 'ph-linkedin-logo', 'label' => 'LinkedIn'],
  'pinterest' => ['icon' => 'ph-pinterest-logo', 'label' => 'Pinterest'],
  'telegram' => ['icon' => 'ph-telegram-logo', 'label' => 'Telegram'],
  'web' => ['icon' => 'ph-globe', 'label' => 'Sitio Web'],
];
?>

<div class="tienda-banner">
  <!-- Slides -->
  <div class="tienda-banner-slides">
    <?php foreach ($bannersVisibles as $index => $banner): ?>
    <div class="tienda-banner-slide" data-index="<?php echo $index; ?>">
      <img 
        src="<?php echo htmlspecialchars($banner['url']); ?>" 
        alt="<?php echo htmlspecialchars($banner['titulo'] ?? 'Banner ' . ($index + 1)); ?>"
        loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
      >
    </div>
    <?php endforeach; ?>
  </div>
  
  <!-- Barra de Redes Sociales (R) - Dentro del banner -->
  <?php if (!empty($redes)): ?>
  <div class="tienda-banner-redes">
    <?php 
    $contador = 0;
    foreach ($redesDisponibles as $key => $config): 
      $redData = $redes[$key] ?? null;
      if (!$redData || empty($redData['url'])) continue;
      if ($contador >= $maxRedes) break;
      $contador++;
    ?>
    <a 
      href="<?php echo htmlspecialchars($redData['url']); ?>" 
      target="_blank" 
      class="tienda-banner-red-btn <?php echo $key; ?>"
      title="<?php echo $config['label']; ?>"
    >
      <i class="<?php echo $config['icon']; ?>"></i>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  
  <!-- Navegación -->
  <?php if (count($bannersVisibles) > 1): ?>
  <button class="tienda-banner-nav prev" aria-label="Anterior">
    <i class="ph-caret-left"></i>
  </button>
  <button class="tienda-banner-nav next" aria-label="Siguiente">
    <i class="ph-caret-right"></i>
  </button>
  
  <!-- Dots indicadores -->
  <div class="tienda-banner-dots">
    <?php foreach ($bannersVisibles as $index => $banner): ?>
    <button 
      class="tienda-banner-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
      data-index="<?php echo $index; ?>"
      aria-label="Ir a slide <?php echo $index + 1; ?>"
    ></button>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<?php if ($plan === 'basico' && count($banners) > 2): ?>
<!-- Mensaje de upgrade para más banners -->

<?php endif; ?>
