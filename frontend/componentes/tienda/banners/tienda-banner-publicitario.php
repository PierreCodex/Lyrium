<?php
/**
 * BANNERS PUBLICITARIOS - 3 CARDS
 * Muestra 3 banners en cards con bordes redondeados
 * Diseño responsive: 3 columnas en desktop, 1 en móvil
 */

$maxBanners = ($plan === 'premium') ? 3 : 3;
$bannersPrincipales = [
    ['url' => 'img/BannerVertical/1-BG.webp', 'titulo' => 'Venta de Temporada', 'link' => '#'],
    ['url' => 'img/BannerVertical/2-BG.webp', 'titulo' => 'Mega Sale', 'link' => '#'],
    ['url' => 'img/BannerVertical/3-BG.webp', 'titulo' => 'Envío Gratis', 'link' => '#'],
];
$bannersVisibles = array_slice($bannersPrincipales, 0, $maxBanners);
?>

<!-- Banners Publicitarios - 3 Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  <?php foreach ($bannersVisibles as $index => $banner): ?>
  <a href="<?php echo htmlspecialchars($banner['link']); ?>" 
     class="group block overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
    <div class="relative aspect-[16/9] md:aspect-[4/3] overflow-hidden">
      <img 
        src="<?php echo htmlspecialchars($banner['url']); ?>" 
        alt="<?php echo htmlspecialchars($banner['titulo']); ?>"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
      >
      <!-- Overlay opcional con título -->
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <div class="absolute bottom-0 left-0 right-0 p-4">
          <span class="text-white font-semibold text-sm drop-shadow-lg">
            <?php echo htmlspecialchars($banner['titulo']); ?>
          </span>
        </div>
      </div>
    </div>
  </a>
  <?php endforeach; ?>
</div>

