<?php
/**
 * TIENDA.PHP - Vista pública del perfil de tienda
 * 
 * URL: /tienda.php?slug=nombre-tienda
 * 
 * Muestra el perfil completo de una tienda incluyendo:
 * - Banner con carrusel de imágenes
 * - Scroll de productos destacados
 * - Caja de descripción con estado abierto/cerrado
 * - Pestañas: Información, Sucursales, Fotos, Contacto, Opiniones, Términos
 * - Sidebar: Redes sociales, contacto, horarios, categorías
 */

// ========================================
// DEMO DATA - Reemplazar por consulta a BD
// ========================================
$slug = $_GET['slug'] ?? 'demo-tienda';

// Simular datos de tienda (reemplazar con consulta real)
$tienda = [
  'id' => 1,
  'nombre' => 'Vida Natural',
  'slug' => 'vida-natural',
  'descripcion' => 'Somos una empresa dedicada a la comercialización de productos naturales y orgánicos. Con más de 10 años de experiencia en el mercado, ofrecemos la mejor calidad en suplementos, vitaminas y productos de bienestar.',
  'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Iconic_image_of_a_leaf.svg/256px-Iconic_image_of_a_leaf.svg.png',
  'cover' => 'https://images.unsplash.com/photo-1543362906-acfc16c67564?q=80&w=1400&auto=format&fit=crop',
  'plan' => 'premium', // 'basico' o 'premium'
  'categoria' => 'Salud y Bienestar',
  'telefono' => '+51 912 345 678',
  'correo' => 'contacto@vidanatural.com',
  'direccion' => 'Urb. Los Educadores Mz M Lt 04, Piura, Perú',
  'abierto' => true,
  'actividad' => 'Comercio al por menor de productos naturales y suplementos alimenticios',
  'rubros' => ['Productos Naturales', 'Suplementos', 'Vitaminas', 'Bienestar'],
];

$plan = $tienda['plan'];

// Banners del carrusel
$banners = [
  ['url' => 'https://images.unsplash.com/photo-1543362906-acfc16c67564?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 1'],
  ['url' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 2'],
  ['url' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 3'],
  ['url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 4'],
];

// Productos de la tienda
$productos = [
  ['id' => 1, 'nombre' => 'Vitamina C 1000mg', 'precio' => 45.90, 'precio_anterior' => 59.90, 'imagen' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300', 'sticker' => 'oferta'],
  ['id' => 2, 'nombre' => 'Omega 3 Fish Oil', 'precio' => 89.90, 'imagen' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300', 'sticker' => 'promo'],
  ['id' => 3, 'nombre' => 'Proteína Vegana', 'precio' => 125.00, 'imagen' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=300', 'sticker' => 'nuevo'],
  ['id' => 4, 'nombre' => 'Colágeno Hidrolizado', 'precio' => 78.50, 'imagen' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=300', 'sticker' => ''],
  ['id' => 5, 'nombre' => 'Maca Andina Premium', 'precio' => 35.00, 'imagen' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=300', 'sticker' => 'limitado'],
  ['id' => 6, 'nombre' => 'Multivitamínico', 'precio' => 55.00, 'imagen' => 'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=300', 'sticker' => ''],
];

// Redes sociales
$redes = [
  'instagram' => ['url' => 'https://instagram.com/vidanatural'],
  'facebook' => ['url' => 'https://facebook.com/vidanatural'],
  'whatsapp' => ['url' => 'https://wa.me/51912345678'],
  'tiktok' => ['url' => 'https://tiktok.com/@vidanatural'],
  'youtube' => ['url' => 'https://youtube.com/vidanatural'],
  'web' => ['url' => 'https://vidanatural.com'],
];

// Horarios
$horarios = [
  'lunes' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'martes' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'miercoles' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'jueves' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'viernes' => ['apertura' => '09:00', 'cierre' => '20:00', 'cerrado' => false],
  'sabado' => ['apertura' => '10:00', 'cierre' => '14:00', 'cerrado' => false],
  'domingo' => ['apertura' => '', 'cierre' => '', 'cerrado' => true],
];

// Categorías
$categorias = [
  ['nombre' => 'Vitaminas', 'slug' => 'vitaminas', 'icono' => 'ph-pill'],
  ['nombre' => 'Suplementos', 'slug' => 'suplementos', 'icono' => 'ph-flask'],
  ['nombre' => 'Orgánicos', 'slug' => 'organicos', 'icono' => 'ph-leaf'],
  ['nombre' => 'Bienestar', 'slug' => 'bienestar', 'icono' => 'ph-heart'],
];

// Sucursales
$sucursales = [
  [
    'nombre' => 'Sede Principal - Piura',
    'direccion' => 'Urb. Los Educadores Mz M Lt 04',
    'ciudad' => 'Piura, Perú',
    'telefono' => '+51 912 345 678',
    'horario_apertura' => '09:00',
    'horario_cierre' => '18:00',
    'google_maps_url' => 'https://maps.google.com/?q=-5.194,-80.632',
    'es_principal' => true,
  ],
  [
    'nombre' => 'Sucursal Centro',
    'direccion' => 'Jr. Lima 234, Centro',
    'ciudad' => 'Piura, Perú',
    'telefono' => '+51 912 345 679',
    'horario_apertura' => '10:00',
    'horario_cierre' => '20:00',
    'google_maps_url' => 'https://maps.google.com/?q=-5.196,-80.628',
    'es_principal' => false,
  ],
];

// Fotos de galería
$fotos = [
  ['url' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400', 'titulo' => 'Tienda'],
  ['url' => 'https://images.unsplash.com/photo-1543362906-acfc16c67564?w=400', 'titulo' => 'Productos'],
  ['url' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=400', 'titulo' => 'Interior'],
  ['url' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400', 'titulo' => 'Equipo'],
  ['url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400', 'titulo' => 'Evento'],
  ['url' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400', 'titulo' => 'Local'],
  ['url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400', 'titulo' => 'Vitaminas'],
  ['url' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=400', 'titulo' => 'Omega'],
];

// Opiniones
$opiniones = [
  [
    'id' => 1,
    'autor' => 'María García',
    'fecha' => 'Hace 2 días',
    'rating' => 5,
    'comentario' => 'Excelente tienda, los productos son de muy buena calidad y el servicio al cliente es excepcional. Siempre encuentro lo que busco.',
    'votos_util' => 12,
    'votos_no_util' => 1,
  ],
  [
    'id' => 2,
    'autor' => 'Carlos Pérez',
    'fecha' => 'Hace 1 semana',
    'rating' => 4,
    'comentario' => 'Buenos productos y precios competitivos. La entrega fue rápida. Solo le doy 4 estrellas porque el empaque podría mejorar.',
    'votos_util' => 8,
    'votos_no_util' => 2,
  ],
];

// Términos y políticas
$terminos = [
  'envio' => 'Realizamos envíos a todo el Perú. Los pedidos se procesan en 24-48 horas hábiles. El tiempo de entrega varía según la ubicación: Lima 1-2 días, Provincias 3-5 días.',
  'devolucion' => 'Aceptamos devoluciones dentro de los 7 días posteriores a la compra. El producto debe estar en su empaque original y sin uso.',
  'privacidad' => 'Protegemos tu información personal. No compartimos tus datos con terceros sin tu consentimiento.',
  'archivos' => [
    ['nombre' => 'Términos y Condiciones.pdf', 'url' => '#'],
    ['nombre' => 'Política de Privacidad.pdf', 'url' => '#'],
  ],
];

// Calcular estado abierto/cerrado
function calcularEstado($horarios) {
  $diasSemana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
  $diaActual = $diasSemana[date('w')];
  $horaActual = (int)date('H') * 60 + (int)date('i');
  
  $horarioHoy = $horarios[$diaActual] ?? null;
  
  if (!$horarioHoy || $horarioHoy['cerrado']) {
    return false;
  }
  
  list($horaApertura, $minApertura) = explode(':', $horarioHoy['apertura']);
  list($horaCierre, $minCierre) = explode(':', $horarioHoy['cierre']);
  
  $aperturaMins = (int)$horaApertura * 60 + (int)$minApertura;
  $cierreMins = (int)$horaCierre * 60 + (int)$minCierre;
  
  return $horaActual >= $aperturaMins && $horaActual < $cierreMins;
}

$tienda['abierto'] = calcularEstado($horarios);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($tienda['nombre']); ?> - Lyrium Biomarketplace</title>

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Iconos Phosphor -->
  <script src="https://unpkg.com/phosphor-icons"></script>

  <!-- CSS General -->
  <link href="utils/css/index.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link href="utils/css/ui-components.css?v=<?php echo time(); ?>" rel="stylesheet" />
  
  <!-- CSS Tienda -->
  <link href="utils/css/tienda.css?v=<?php echo time(); ?>" rel="stylesheet" />
  
  <!-- Critical CSS para evitar FOUC (Flash of Unstyled Content) -->
  <style>
    .tienda-tab-content { display: none !important; }
    .tienda-tab-content.active { display: block !important; }
    .tienda-slider-vertical-container { overflow: hidden; }
    .tienda-banner-slides { display: flex; }
    .tienda-banner-slide { min-width: 100%; flex-shrink: 0; }
  </style>
  
  <link rel="icon" type="image/png" href="img/logo.png?v=<?php echo time(); ?>" />

  <!-- Meta OG para compartir -->
  <meta property="og:title" content="<?php echo htmlspecialchars($tienda['nombre']); ?> - Lyrium">
  <meta property="og:description" content="<?php echo htmlspecialchars(substr($tienda['descripcion'], 0, 150)); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($tienda['cover']); ?>">
</head>
<body class="bg-slate-50 min-h-screen">

<?php include 'header.php'; ?>

<main class="tienda-container py-6">
  
  <!-- ========================================= -->
  <!-- BANNER CARRUSEL (R) -->
  <!-- ========================================= -->
  <?php include 'componentes/tienda-banner.php'; ?>

  <!-- ========================================= -->
  <!-- LAYOUT PRINCIPAL: CONTENIDO + SIDEBAR -->
  <!-- ========================================= -->
  <div class="tienda-main-layout">
    
    <!-- COLUMNA PRINCIPAL (8 columnas) -->
    <div class="tienda-main-column">
      
      <!-- SCROLL DE PRODUCTOS DESTACADOS (S) - Solo Premium -->
      <?php if ($plan === 'premium'): 
        $titulo = 'Productos Destacados';
        $icono = 'ph-star-fill';
        include 'componentes/tienda/productos-scroll.php';
      else: ?>
      <!-- Publicidad Horizontal - Plan Básico -->
      <?php include 'componentes/tienda/ad-banner-horizontal.php'; ?>
      <?php endif; ?>

      <!-- CAJA DE DESCRIPCIÓN (C.D) -->
      <?php include 'componentes/tienda/tienda-descripcion.php'; ?>

      <!-- PESTAÑAS (PE) -->
      <?php include 'componentes/tienda-tabs.php'; ?>

      <!-- FILTROS DE PRODUCTOS -->
      <?php include 'componentes/tienda/productos-filtros.php'; ?>

      <!-- GRID DE PRODUCTOS (P) -->
      <?php 
        $titulo = 'Todos los Productos';
        $icono = 'ph-package';
        $clase_extra = 'mt-0';
        include 'componentes/tienda/productos-grid.php'; 
        unset($titulo, $icono, $clase_extra);
      ?>

    </div>

    <!-- SIDEBAR SLIDER VERTICAL (SV) - 4 columnas -->
    <?php include 'componentes/tienda-sidebar.php'; ?>

  </div>

  <!-- ========================================= -->
  <!-- SCROLL ADICIONAL (S) - Solo Premium -->
  <!-- ========================================= -->
  <?php if ($plan === 'premium'): 
    $productos_ofertas = array_slice($productos, 0, 4);
    $productos_temp = $productos;
    $productos = $productos_ofertas;
    $titulo = 'Ofertas de la Semana';
    $icono = 'ph-fire';
    $descuento = 0.8;
    $clase_extra = 'tienda-scroll-full';
    include 'componentes/tienda/productos-scroll.php';
    $productos = $productos_temp;
    unset($productos_ofertas, $productos_temp, $titulo, $icono, $descuento, $clase_extra);
  endif; ?>



  <!-- ========================================= -->
  <!-- BANNER FINAL (R) - Solo Premium -->
  <!-- ========================================= -->
  <?php if ($plan === 'premium'): ?>
  <div class="tienda-banner tienda-banner-final mt-6">
    <!-- Slides -->
    <div class="tienda-banner-slides">
      <?php foreach ($banners as $index => $banner): ?>
      <div class="tienda-banner-slide" data-index="<?php echo $index; ?>">
        <img 
          src="<?php echo htmlspecialchars($banner['url']); ?>" 
          alt="<?php echo htmlspecialchars($banner['titulo'] ?? 'Banner ' . ($index + 1)); ?>"
          loading="lazy"
        >
      </div>
      <?php endforeach; ?>
    </div>
    
    <!-- Navegación -->
    <?php if (count($banners) > 1): ?>
    <button class="tienda-banner-nav prev" aria-label="Anterior">
      <i class="ph-caret-left"></i>
    </button>
    <button class="tienda-banner-nav next" aria-label="Siguiente">
      <i class="ph-caret-right"></i>
    </button>
    
    <!-- Dots indicadores -->
    <div class="tienda-banner-dots">
      <?php foreach ($banners as $index => $banner): ?>
      <button 
        class="tienda-banner-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
        data-index="<?php echo $index; ?>"
        aria-label="Ir a slide <?php echo $index + 1; ?>"
      ></button>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- ========================================= -->
  <!-- PRODUCTOS FINALES (P) - 4 columnas -->
  <!-- ========================================= -->
  <?php 
    $titulo = 'Más Productos de la Tienda';
    $icono = 'ph-storefront';
    $grid_cols = '4';
    $clase_extra = 'tienda-productos-final mt-6';
    include 'componentes/tienda/productos-grid.php';
    unset($titulo, $icono, $grid_cols, $clase_extra);
  ?>
  <?php else: ?>
  <!-- Publicidad Grande Final - Plan Básico -->
  <?php include 'componentes/tienda/ad-banner-grande.php'; ?>
  <?php endif; ?>

</main>

<?php include 'footer.php'; ?>

<!-- JavaScript -->
<script>
  // Pasar datos al JS
  window.tiendaPlanActual = '<?php echo $plan; ?>';
  window.tiendaHorarios = <?php echo json_encode($horarios); ?>;
</script>
<script src="js/tienda.js?v=<?php echo time(); ?>"></script>

</body>
</html>
