<?php

$slug = $_GET['slug'] ?? 'vida-natural';

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// CARGAR DATOS DE LA TIENDA DESDE LA BASE DE DATOS
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

// ⚠️ TEMPORALMENTE DESACTIVADO - Usando datos estáticos para demostración
/*
require_once __DIR__ . '/../backend/config/Conexion.php';

try {
    $stmt = $conn->prepare("
        SELECT 
            id, nombre_tienda, slug, descripcion, logo_url, banner_url,
            plan, telefono, whatsapp, direccion, ciudad,
            redes_sociales, tema, layout_modelo, estado
        FROM tiendas
        WHERE slug = :slug AND estado = 'activo'
    ");
    $stmt->execute([':slug' => $slug]);
    $tiendaDB = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$tiendaDB) {
        die('Tienda no encontrada');
    }
    
    // Convertir datos de BD a formato esperado
    $tienda = [
        'id' => $tiendaDB['id'],
        'nombre' => $tiendaDB['nombre_tienda'],
        'slug' => $tiendaDB['slug'],
        'descripcion' => $tiendaDB['descripcion'] ?? 'Tienda en línea',
        'logo' => $tiendaDB['logo_url'] ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Iconic_image_of_a_leaf.svg/256px-Iconic_image_of_a_leaf.svg.png',
        'cover' => $tiendaDB['banner_url'] ?? 'https://images.unsplash.com/photo-1543362906-acfc16c67564?q=80&w=1400&auto=format&fit=crop',
        'plan' => $tiendaDB['plan'],
        'categoria' => 'Salud y Bienestar',
        'telefono' => $tiendaDB['telefono'] ?? '',
        'correo' => 'contacto@' . $tiendaDB['slug'] . '.com',
        'direccion' => $tiendaDB['direccion'] ?? '',
        'actividad' => 'Comercio en línea',
        'rubros' => ['Productos'],
        'layout_modelo' => (int)($tiendaDB['layout_modelo'] ?? 3),
        'tema' => $tiendaDB['tema'] ?? ''
    ];
    
} catch (PDOException $e) {
    die('Error al cargar tienda: ' . $e->getMessage());
}

$plan = $tienda['plan'];
*/

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// DATOS ESTÁTICOS PARA DEMOSTRACIÓN (SIN BASE DE DATOS)
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$tienda = [
    'id' => 1,
    'nombre' => 'Vida Natural',
    'slug' => 'vida-natural',
    'descripcion' => 'Tu tienda de productos naturales y suplementos de calidad',
    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Iconic_image_of_a_leaf.svg/256px-Iconic_image_of_a_leaf.svg.png',
    'cover' => 'https://images.unsplash.com/photo-1543362906-acfc16c67564?q=80&w=1400&auto=format&fit=crop',
    'plan' => 'premium', // Cambiar a 'basico' para ver diseño básico
    'categoria' => 'Salud y Bienestar',
    'telefono' => '+51 912 345 678',
    'correo' => 'contacto@vidanatural.com',
    'direccion' => 'Urb. Los Educadores Mz M Lt 04, Piura',
    'actividad' => 'Comercio en línea',
    'rubros' => ['Productos Naturales', 'Suplementos', 'Vitaminas'],
    'layout_modelo' => 1, // 🎨 CAMBIAR AQUÍ: 1=sidebar derecha, 2=sidebar izquierda, 3=full width
    'tema' => '' // 🎨 CAMBIAR AQUÍ: '', 'tema-ocean', 'tema-dark', 'tema-minimal'
];

$plan = $tienda['plan'];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// CONFIGURACIÓN DE LAYOUT Y TEMA (SOLO PREMIUM)
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

$tema_actual = ($plan === 'premium') ? $tienda['tema'] : ''; 
$modelo_layout = ($plan === 'premium') ? $tienda['layout_modelo'] : 3;

// Convertir número de modelo a clase CSS
$layout_class = '';
if ($modelo_layout == 1) $layout_class = 'layout-sidebar-right';
if ($modelo_layout == 2) $layout_class = 'layout-sidebar-left';
if ($modelo_layout == 3) $layout_class = 'layout-full-width';

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// CALIFICACIONES DE LA TIENDA (Para modal hover)
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// 🔗 Backend: Calcular desde tabla tienda_opiniones
$calificaciones = [
  'descripcion' => ['valor' => 4.9, 'nivel' => 'TOP'],
  'comunicacion' => ['valor' => 4.8, 'nivel' => 'TOP'],
  'envio' => ['valor' => 4.8, 'nivel' => 'TOP'],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// ESTADÍSTICAS DE LA TIENDA
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// 🔗 Backend: SELECT * FROM tienda_estadisticas WHERE IdTienda = ?
$stats_tienda = [
  'valoracion_positiva' => 98.4,
  'seguidores' => '2.4K',
  'vendidos_180_dias' => '5,000+',
  'compradores_habituales' => '100+',
  'fecha_apertura' => 'Mar 12, 2025',
  'id_tienda' => $tienda['id'],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// BANNERS DEL CARRUSEL PRINCIPAL
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$banners = [
  ['url' => 'https://images.unsplash.com/photo-1543362906-acfc16c67564?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 1'],
  ['url' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 2'],
  ['url' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 3'],
  ['url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1400&auto=format&fit=crop', 'titulo' => 'Banner 4'],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// PRODUCTOS DE LA TIENDA
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$productos = [
  ['id' => 1, 'nombre' => 'Vitamina C 1000mg', 'precio' => 45.90, 'precio_anterior' => 59.90, 'imagen' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300', 'sticker' => 'oferta', 'rating' => 5, 'reviews' => 24, 'stock' => 50, 'categoria' => 'Vitaminas', 'descripcion' => 'Vitamina C de alta potencia para fortalecer el sistema inmunológico. Ideal para prevenir resfriados y mejorar la salud general.'],
  ['id' => 2, 'nombre' => 'Omega 3 Fish Oil', 'precio' => 89.90, 'imagen' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=300', 'sticker' => 'promo', 'rating' => 4, 'reviews' => 18, 'stock' => 30, 'categoria' => 'Suplementos', 'descripcion' => 'Aceite de pescado rico en Omega 3 para la salud cardiovascular y cerebral. Ayuda a reducir el colesterol y mejora la función cognitiva.'],
  ['id' => 3, 'nombre' => 'Proteína Vegana', 'precio' => 125.00, 'imagen' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=300', 'sticker' => 'nuevo', 'rating' => 5, 'reviews' => 32, 'stock' => 25, 'categoria' => 'Proteínas', 'descripcion' => 'Proteína 100% vegetal de alta calidad. Perfecta para deportistas y personas que buscan una alternativa plant-based.'],
  ['id' => 4, 'nombre' => 'Colágeno Hidrolizado', 'precio' => 78.50, 'imagen' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=300', 'sticker' => '', 'rating' => 4, 'reviews' => 15, 'stock' => 40, 'categoria' => 'Belleza', 'descripcion' => 'Colágeno hidrolizado para mejorar la salud de la piel, cabello y uñas. Ayuda a reducir arrugas y fortalecer articulaciones.'],
  ['id' => 5, 'nombre' => 'Maca Andina Premium', 'precio' => 35.00, 'imagen' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=300', 'sticker' => 'limitado', 'rating' => 5, 'reviews' => 45, 'stock' => 15, 'categoria' => 'Energía', 'descripcion' => 'Maca peruana de alta calidad para aumentar energía y vitalidad. Mejora el rendimiento físico y mental de forma natural.'],
  ['id' => 6, 'nombre' => 'Multivitamínico', 'precio' => 55.00, 'imagen' => 'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=300', 'sticker' => '', 'rating' => 4, 'reviews' => 28, 'stock' => 60, 'categoria' => 'Vitaminas', 'descripcion' => 'Complejo multivitamínico completo con vitaminas y minerales esenciales para el bienestar diario.'],
  ['id' => 7, 'nombre' => 'Zinc + Vitamina D', 'precio' => 38.50, 'imagen' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?w=300', 'sticker' => 'nuevo', 'rating' => 5, 'reviews' => 19, 'stock' => 45, 'categoria' => 'Vitaminas', 'descripcion' => 'Combinación de Zinc y Vitamina D para fortalecer el sistema inmune y la salud ósea.'],
  ['id' => 8, 'nombre' => 'Probióticos Premium', 'precio' => 92.00, 'imagen' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=300', 'sticker' => 'promo', 'rating' => 5, 'reviews' => 56, 'stock' => 35, 'categoria' => 'Digestivo', 'descripcion' => 'Probióticos de alta potencia para mejorar la salud digestiva y el equilibrio intestinal.'],
  // Productos con imágenes locales generadas
  ['id' => 9, 'nombre' => 'Té Matcha Premium', 'precio' => 68.00, 'precio_anterior' => 85.00, 'imagen' => 'img/productos/producto_te_verde.png', 'sticker' => 'oferta', 'rating' => 5, 'reviews' => 42, 'stock' => 28, 'categoria' => 'Superfoods', 'descripcion' => 'Matcha japonés de grado ceremonial. Rico en antioxidantes y L-teanina para energía y concentración.'],
  ['id' => 10, 'nombre' => 'Miel Orgánica Pura', 'precio' => 42.00, 'imagen' => 'img/productos/producto_miel_organica.png', 'sticker' => '', 'rating' => 5, 'reviews' => 67, 'stock' => 50, 'categoria' => 'Orgánicos', 'descripcion' => 'Miel cruda 100% pura y sin procesar. Propiedades antibacterianas y nutritivas naturales.'],
  ['id' => 11, 'nombre' => 'Aceite de Coco Virgen', 'precio' => 38.50, 'imagen' => 'img/productos/producto_aceite_coco.png', 'sticker' => 'nuevo', 'rating' => 4, 'reviews' => 38, 'stock' => 40, 'categoria' => 'Orgánicos', 'descripcion' => 'Aceite de coco virgen prensado en frío. Ideal para cocinar, skincare y cuidado del cabello.'],
  ['id' => 12, 'nombre' => 'Spirulina Orgánica', 'precio' => 55.00, 'precio_anterior' => 72.00, 'imagen' => 'img/productos/producto_spirulina.png', 'sticker' => 'oferta', 'rating' => 5, 'reviews' => 29, 'stock' => 22, 'categoria' => 'Superfoods', 'descripcion' => 'Spirulina orgánica en polvo. Superalimento rico en proteínas, vitaminas y minerales.'],
  ['id' => 13, 'nombre' => 'Quinoa Blanca Premium', 'precio' => 28.00, 'imagen' => 'img/productos/producto_quinoa.png', 'sticker' => '', 'rating' => 4, 'reviews' => 45, 'stock' => 60, 'categoria' => 'Granos', 'descripcion' => 'Quinoa peruana de alta calidad. Fuente completa de proteínas y fibra. Libre de gluten.'],
  ['id' => 14, 'nombre' => 'Semillas de Chía', 'precio' => 22.00, 'imagen' => 'img/productos/producto_chia.png', 'sticker' => 'promo', 'rating' => 5, 'reviews' => 82, 'stock' => 75, 'categoria' => 'Superfoods', 'descripcion' => 'Semillas de chía orgánicas ricas en omega-3, fibra y antioxidantes.'],
  ['id' => 15, 'nombre' => 'Cúrcuma en Polvo', 'precio' => 32.00, 'imagen' => 'img/productos/producto_curcuma.png', 'sticker' => 'limitado', 'rating' => 5, 'reviews' => 36, 'stock' => 30, 'categoria' => 'Especias', 'descripcion' => 'Cúrcuma orgánica con alto contenido de curcumina. Potente antiinflamatorio natural.'],
  ['id' => 16, 'nombre' => 'Jengibre en Polvo', 'precio' => 26.00, 'imagen' => 'img/productos/producto_jengibre.png', 'sticker' => '', 'rating' => 4, 'reviews' => 24, 'stock' => 45, 'categoria' => 'Especias', 'descripcion' => 'Jengibre orgánico deshidratado. Mejora la digestión y tiene propiedades antiinflamatorias.'],
];


// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// REDES SOCIALES
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$redes = [
  'instagram' => ['url' => 'https://instagram.com/vidanatural'],
  'facebook' => ['url' => 'https://facebook.com/vidanatural'],
  'whatsapp' => ['url' => 'https://wa.me/51912345678'],
  'tiktok' => ['url' => 'https://tiktok.com/@vidanatural'],
  'youtube' => ['url' => 'https://youtube.com/vidanatural'],
  'web' => ['url' => 'https://vidanatural.com'],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// HORARIOS DE ATENCIÓN
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$horarios = [
  'lunes' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'martes' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'miercoles' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'jueves' => ['apertura' => '09:00', 'cierre' => '18:00', 'cerrado' => false],
  'viernes' => ['apertura' => '09:00', 'cierre' => '20:00', 'cerrado' => false],
  'sabado' => ['apertura' => '10:00', 'cierre' => '14:00', 'cerrado' => false],
  'domingo' => ['apertura' => '', 'cierre' => '', 'cerrado' => true],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// CATEGORÍAS DE PRODUCTOS
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$categorias = [
  ['nombre' => 'Vitaminas', 'slug' => 'vitaminas', 'icono' => 'ph-pill'],
  ['nombre' => 'Suplementos', 'slug' => 'suplementos', 'icono' => 'ph-flask'],
  ['nombre' => 'Orgánicos', 'slug' => 'organicos', 'icono' => 'ph-leaf'],
  ['nombre' => 'Bienestar', 'slug' => 'bienestar', 'icono' => 'ph-heart'],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// SUCURSALES
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
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

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// FOTOS DE GALERÍA
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
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

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// OPINIONES/RESEÑAS
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
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

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// TÉRMINOS Y POLÍTICAS
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
$terminos = [
  'envio' => 'Realizamos envíos a todo el Perú. Los pedidos se procesan en 24-48 horas hábiles. El tiempo de entrega varía según la ubicación: Lima 1-2 días, Provincias 3-5 días.',
  'devolucion' => 'Aceptamos devoluciones dentro de los 7 días posteriores a la compra. El producto debe estar en su empaque original y sin uso.',
  'privacidad' => 'Protegemos tu información personal. No compartimos tus datos con terceros sin tu consentimiento.',
  'archivos' => [
    ['nombre' => 'Términos y Condiciones.pdf', 'url' => '#'],
    ['nombre' => 'Política de Privacidad.pdf', 'url' => '#'],
  ],
];

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// FUNCIÓN: Calcular estado abierto/cerrado
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
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

// ═══════════════════════════════════════════════════════════════════════════
// FIN DE DATOS MOCK - ELIMINAR HASTA AQUÍ AL CONECTAR CON BACKEND
// ═══════════════════════════════════════════════════════════════════════════
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
  <link href="utils/css/tienda-grid-features.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <!-- <link href="utils/css/tienda-bloques-animaciones.css?v=<?php echo time(); ?>" rel="stylesheet" /> -->
  <link href="utils/css/tienda-refactor.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link href="utils/css/tienda-slider-descuentos.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link href="utils/css/tienda-sidebar-refactor.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link href="utils/css/tienda-sliders-fullwidth.css?v=<?php echo time(); ?>" rel="stylesheet" />
  
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
<body class="bg-white min-h-screen">

<?php include 'header.php'; ?>

<!-- Secciones de tienda con tema localizado -->
<?php $scope_tema = $tema_actual; ?>
  <!-- ========================================= -->
  <!-- HEADER DE TIENDA - Estilo AliExpress -->
  <!-- ========================================= -->
  <div class="<?php echo $scope_tema; ?>">
    <?php include 'componentes/tienda/header/tienda-header.php'; ?>
  </div>

<main class="tienda-container py-6 <?php echo $scope_tema; ?> bg-[var(--tienda-bg-body)]">
  
  <!-- Contenedor para secciones que se ocultan en otros tabs -->
  <div class="tienda-secciones-principales">
    <!-- ========================================= -->
    <!-- BANNER CARRUSEL (R) -->
    <!-- ========================================= -->
    <div class="tienda-bloque" data-tipo="banner" data-nombre="Banner Principal">
      <?php include 'componentes/tienda-banner.php'; ?>
    </div>

    <!-- ========================================= -->
    <!-- NUEVO: SLIDER HORIZONTAL DE PUBLICIDAD -->
    <!-- Debajo del hero, altura menor para jerarquía -->
    <!-- ========================================= -->
    <div class="tienda-bloque" data-tipo="anuncios" data-nombre="Publicidad Horizontal">
      <?php include 'componentes/tienda/banners/slider-publicidad-horizontal.php'; ?>
    </div>

    <!-- Ocultamos la card horizontal en básico porque ya la movimos al sidebar -->
    <?php if ($plan === 'premium'): ?>
    <!-- ========================================= -->
    <!-- INFO DE TIENDA (Card fija con 3 columnas) -->
    <!-- ========================================= -->
    <div class="tienda-bloque" data-tipo="info-card" data-nombre="Info Tienda">
      <?php include 'componentes/tienda/cards/tienda-info-card.php'; ?>
    </div>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════ -->
    <!-- LÍNEA SEPARADORA -->
    <!-- ═══════════════════════════════════════════ -->
    <hr class="tienda-separador">
  </div>

  <!-- ========================================= -->
  <!-- LAYOUT DINÁMICO: Carga el archivo correspondiente -->
  <!-- según el modelo_layout configurado (1, 2, o 3) -->
  <!-- ========================================= -->
  <?php 
    if ($plan !== 'premium') {
      // Forzar layout básico para planes no premium
      include 'componentes/tienda/layouts/layout-basico.php';
    } else {
      // Layout dinámico solo para premium
      $layout_file = "componentes/tienda/layouts/layout-{$modelo_layout}.php";
      if (file_exists($layout_file)) {
        include $layout_file;
      } else {
        include 'componentes/tienda/layouts/layout-3.php';
      }
    }
  ?>


</main>

<!-- Modal Vista Rápida de Producto -->
<?php include 'componentes/tienda/modales/modal-producto-rapido.php'; ?>

<?php include 'footer.php'; ?>

<!-- JavaScript -->
<script>
  // Pasar datos al JS
  window.tiendaPlanActual = '<?php echo $plan; ?>';
  window.tiendaHorarios = <?php echo json_encode($horarios); ?>;
  // Variables globales para el modal de producto
  window.tiendaInfo = <?php echo json_encode($tienda); ?>;
  
  // Array de productos (combinar todos los productos disponibles)
  window.tiendaProductos = <?php echo json_encode($productos); ?>;
</script>
<script src="js/tienda.js?v=<?php echo time(); ?>"></script>
<!-- <script src="js/bloques-animaciones.js?v=<?php echo time(); ?>"></script> -->
<script src="js/tienda-sliders.js?v=<?php echo time(); ?>"></script>

</body>
</html>
