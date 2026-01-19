<?php
/**
 * Componente: Productos Terciarios - Grid de 5 columnas (1 fila)
 */

$productosTerciarios = $productos ?? [];
shuffle($productosTerciarios);
$productosTerciarios = array_slice($productosTerciarios, 0, 5);

if (count($productosTerciarios) < 5 && !empty($productos)) {
  $productosExtra = $productos;
  shuffle($productosExtra);
  $productosTerciarios = array_merge($productosTerciarios, $productosExtra);
  $productosTerciarios = array_slice($productosTerciarios, 0, 5);
}
?>

<div class="tienda-tabs">
  <div class="tienda-tab-content active">
    <div class="tienda-productos-grid-section">
      <!-- Header del grid -->
      <div class="tienda-grid-header">
        <h3 class="tienda-grid-titulo">
          <i class="ph ph-sparkle text-amber-500"></i>
          Más productos para ti
        </h3>
      </div>
      
      <!-- GRID de productos -->
      <div class="tienda-productos-grid productos-terciarios-grid">
        <?php if (!empty($productosTerciarios)): ?>
          <?php foreach ($productosTerciarios as $producto): ?>
          <div class="producto-grid-card" data-producto-id="<?php echo $producto['id']; ?>">
            <!-- Imagen del producto -->
            <div class="producto-grid-imagen">
              <img 
                src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                loading="lazy"
              >
              
              <!-- Sticker de estado -->
              <?php if (!empty($producto['sticker'])): ?>
              <span class="producto-grid-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
                <?php 
                  $stickerTextos = [
                    'oferta' => 'Oferta',
                    'nuevo' => 'Nuevo',
                    'promo' => 'Promo',
                    'limitado' => 'Limitado'
                  ];
                  echo $stickerTextos[$producto['sticker']] ?? ucfirst($producto['sticker']);
                ?>
              </span>
              <?php endif; ?>
              
              <!-- Descuento badge -->
              <?php if (!empty($producto['precio_anterior']) && $producto['precio_anterior'] > $producto['precio']): ?>
              <?php 
                $descuento = round((($producto['precio_anterior'] - $producto['precio']) / $producto['precio_anterior']) * 100);
              ?>
              <span class="producto-grid-descuento">-<?php echo $descuento; ?>%</span>
              <?php endif; ?>
              
              <!-- Acciones hover -->
              <div class="producto-grid-acciones">
                <button class="producto-grid-accion" title="Añadir a favoritos">
                  <i class="ph ph-heart"></i>
                </button>
              </div>
              
              <!-- Icono carrito flotante -->
              <button class="producto-grid-cart-icon" title="Añadir al carrito">
                <i class="ph ph-shopping-cart-simple"></i>
              </button>
            </div>
            
            <!-- Info del producto -->
            <div class="producto-grid-info">
              <h4 class="producto-grid-nombre">
                <a href="producto.php?id=<?php echo $producto['id']; ?>">
                  <?php echo htmlspecialchars($producto['nombre']); ?>
                </a>
              </h4>
              
              <div class="producto-grid-precios">
                <span class="producto-grid-precio-actual">
                  <?php echo number_format($producto['precio'], 2); ?>
                </span>
                <?php if (!empty($producto['precio_anterior'])): ?>
                <span class="producto-grid-precio-anterior">
                  S/ <?php echo number_format($producto['precio_anterior'], 2); ?>
                </span>
                <?php endif; ?>
              </div>
              
              <div class="producto-grid-rating">
                <div class="producto-grid-stars">
                  <?php 
                    $rating = $producto['rating'] ?? 5;
                    for ($i = 1; $i <= 5; $i++): 
                  ?>
                  <i class="ph-fill ph-star"></i>
                  <?php endfor; ?>
                </div>
                <span class="producto-grid-reviews"><?php echo $producto['ventas'] ?? rand(100, 5000); ?></span>
              </div>
              
              <!-- Botones de hover -->
              <div class="producto-grid-hover-btns hidden md:flex">
                <button class="producto-hover-btn" onclick="vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                  <i class="ph ph-eye"></i>
                  Previsualizar
                </button>
                <button class="producto-hover-btn producto-hover-btn-outline">
                  <i class="ph ph-squares-four"></i>
                  Artículos similares
                </button>
              </div>
              
              <!-- Móvil -->
              <div class="producto-grid-mobile-actions flex md:hidden">
                <button class="producto-mobile-action" onclick="vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                  <i class="ph ph-eye"></i>
                </button>
                <button class="producto-mobile-action">
                  <i class="ph ph-shopping-cart-simple"></i>
                </button>
                <button class="producto-mobile-action">
                  <i class="ph ph-heart"></i>
                </button>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
        <div class="tienda-grid-empty">
          <i class="ph ph-package"></i>
          <p>No hay más productos disponibles</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<style>
/* Grid terciario - 5 columnas (1 fila) */
.productos-terciarios-grid {
  display: grid !important;
  grid-template-columns: repeat(5, 1fr) !important;
  gap: 1rem !important;
}

@media (max-width: 1200px) {
  .productos-terciarios-grid {
    grid-template-columns: repeat(4, 1fr) !important;
  }
}

@media (max-width: 900px) {
  .productos-terciarios-grid {
    grid-template-columns: repeat(3, 1fr) !important;
  }
}

@media (max-width: 640px) {
  .productos-terciarios-grid {
    grid-template-columns: repeat(2, 1fr) !important;
  }
}

@media (max-width: 400px) {
  .productos-terciarios-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>
