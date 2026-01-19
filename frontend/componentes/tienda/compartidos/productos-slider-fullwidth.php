<?php
/**
 * Componente: Productos Más Vendidos - Destacado + Grid
 */

// Obtener productos más vendidos
$productosVendidos = $productos ?? [];
usort($productosVendidos, function($a, $b) {
  return ($b['ventas'] ?? $b['reviews'] ?? 0) - ($a['ventas'] ?? $a['reviews'] ?? 0);
});
$productosVendidos = array_slice($productosVendidos, 0, 7);

// Si no hay suficientes, reciclar
if (count($productosVendidos) < 7 && !empty($productos)) {
  $productosVendidos = $productos;
  shuffle($productosVendidos);
  $productosVendidos = array_slice($productosVendidos, 0, 7);
}

// Separar el #1 del resto
$productoDestacado = $productosVendidos[0] ?? null;
$productosSecundarios = array_slice($productosVendidos, 1, 6);

?>

<!-- ========================================= -->
<!-- SECCIÓN: PRODUCTOS MÁS VENDIDOS -->
<!-- Diseño: Destacado + Grid -->
<!-- ========================================= -->
<div class="tienda-tabs">
  <div class="tienda-tab-content active">
    <div class="tienda-productos-grid-section">
      
      <!-- Header -->
      <div class="tienda-grid-header">
        <h3 class="tienda-grid-titulo">
          <i class="ph ph-fire text-orange-500"></i>
          Productos más vendidos
        </h3>
        <span class="px-3 py-1 text-xs font-bold bg-gradient-to-r from-sky-500 to-cyan-500 text-white rounded-full">
          🔥 Hot
        </span>
      </div>
      
      <!-- Layout: Destacado + Grid -->
      <div class="productos-vendidos-layout">
        
        <!-- Producto #1 Destacado (Izquierda) -->
        <?php if ($productoDestacado): ?>
        <div class="producto-destacado-wrapper">
          <div class="producto-grid-card producto-destacado" data-producto-id="<?php echo $productoDestacado['id']; ?>">
            
            <!-- Badge #1 Best Seller -->
            <div class="bestseller-badge">
              <span class="bestseller-numero">#1</span>
              <span class="bestseller-texto">Best Seller</span>
            </div>
            
            <!-- Imagen del producto -->
            <div class="producto-grid-imagen producto-destacado-imagen">
              <img 
                src="<?php echo htmlspecialchars($productoDestacado['imagen']); ?>" 
                alt="<?php echo htmlspecialchars($productoDestacado['nombre']); ?>"
                loading="lazy"
              >
              
              <!-- Sticker -->
              <?php if (!empty($productoDestacado['sticker'])): ?>
              <span class="producto-grid-sticker <?php echo htmlspecialchars($productoDestacado['sticker']); ?>">
                <?php 
                  $stickerTextos = ['oferta' => 'Oferta', 'nuevo' => 'Nuevo', 'promo' => 'Promo', 'limitado' => 'Limitado'];
                  echo $stickerTextos[$productoDestacado['sticker']] ?? ucfirst($productoDestacado['sticker']);
                ?>
              </span>
              <?php endif; ?>
              
              <!-- Descuento -->
              <?php if (!empty($productoDestacado['precio_anterior']) && $productoDestacado['precio_anterior'] > $productoDestacado['precio']): ?>
              <?php $descuento = round((($productoDestacado['precio_anterior'] - $productoDestacado['precio']) / $productoDestacado['precio_anterior']) * 100); ?>
              <span class="producto-grid-descuento">-<?php echo $descuento; ?>%</span>
              <?php endif; ?>
              
              <!-- Acciones hover -->
              <div class="producto-grid-acciones">
                <button class="producto-grid-accion" title="Añadir a favoritos">
                  <i class="ph ph-heart"></i>
                </button>
              </div>
            </div>
            
            <!-- Info del producto destacado -->
            <div class="producto-grid-info producto-destacado-info">
              <h4 class="producto-grid-nombre text-lg">
                <a href="producto.php?id=<?php echo $productoDestacado['id']; ?>">
                  <?php echo htmlspecialchars($productoDestacado['nombre']); ?>
                </a>
              </h4>
              
              <!-- Descripción corta -->
              <p class="producto-destacado-desc">
                <?php echo htmlspecialchars(substr($productoDestacado['descripcion'] ?? '', 0, 100)); ?>...
              </p>
              
              <div class="producto-grid-precios text-xl">
                <span class="producto-grid-precio-actual">
                  S/ <?php echo number_format($productoDestacado['precio'], 2); ?>
                </span>
                <?php if (!empty($productoDestacado['precio_anterior'])): ?>
                <span class="producto-grid-precio-anterior">
                  S/ <?php echo number_format($productoDestacado['precio_anterior'], 2); ?>
                </span>
                <?php endif; ?>
              </div>
              
              <div class="producto-grid-rating">
                <div class="producto-grid-stars">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <i class="ph-fill ph-star"></i>
                  <?php endfor; ?>
                </div>
                <span class="producto-grid-reviews"><?php echo $productoDestacado['reviews'] ?? rand(500, 5000); ?> vendidos</span>
              </div>
              
              <!-- Botones de acción -->
              <div class="producto-destacado-acciones">
                <button class="btn-primary-action" onclick="vistaRapidaProducto(<?php echo $productoDestacado['id']; ?>)">
                  <i class="ph ph-eye"></i>
                  Vista rápida
                </button>
                <button class="btn-secondary-action">
                  <i class="ph ph-shopping-cart-simple"></i>
                  Añadir al carrito
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Grid de productos secundarios (Derecha) -->
        <div class="productos-secundarios-grid-vendidos">
          <?php foreach ($productosSecundarios as $index => $producto): ?>
          <div class="producto-grid-card producto-secundario-vendido" data-producto-id="<?php echo $producto['id']; ?>">
            
            <!-- Badge de ranking -->
            <div class="ranking-badge ranking-<?php echo $index + 2; ?>">
              #<?php echo $index + 2; ?>
            </div>
            
            <!-- Imagen -->
            <div class="producto-grid-imagen">
              <img 
                src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                loading="lazy"
              >
              
              <?php if (!empty($producto['sticker'])): ?>
              <span class="producto-grid-sticker <?php echo htmlspecialchars($producto['sticker']); ?>">
                <?php 
                  $stickerTextos = ['oferta' => 'Oferta', 'nuevo' => 'Nuevo', 'promo' => 'Promo', 'limitado' => 'Limitado'];
                  echo $stickerTextos[$producto['sticker']] ?? ucfirst($producto['sticker']);
                ?>
              </span>
              <?php endif; ?>
              
              <!-- Acciones hover -->
              <div class="producto-grid-acciones">
                <button class="producto-grid-accion" title="Añadir a favoritos">
                  <i class="ph ph-heart"></i>
                </button>
              </div>
              
              <!-- Carrito flotante -->
              <button class="producto-grid-cart-icon" title="Añadir al carrito">
                <i class="ph ph-shopping-cart-simple"></i>
              </button>
            </div>
            
            <!-- Info -->
            <div class="producto-grid-info">
              <h4 class="producto-grid-nombre">
                <a href="producto.php?id=<?php echo $producto['id']; ?>">
                  <?php echo htmlspecialchars($producto['nombre']); ?>
                </a>
              </h4>
              
              <div class="producto-grid-precios">
                <span class="producto-grid-precio-actual">
                  S/ <?php echo number_format($producto['precio'], 2); ?>
                </span>
                <?php if (!empty($producto['precio_anterior'])): ?>
                <span class="producto-grid-precio-anterior">
                  S/ <?php echo number_format($producto['precio_anterior'], 2); ?>
                </span>
                <?php endif; ?>
              </div>
              
              <div class="producto-grid-rating">
                <div class="producto-grid-stars">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <i class="ph-fill ph-star"></i>
                  <?php endfor; ?>
                </div>
                <span class="producto-grid-reviews"><?php echo $producto['reviews'] ?? rand(100, 2000); ?></span>
              </div>
              
              <!-- Hover buttons -->
              <div class="producto-grid-hover-btns hidden md:flex">
                <button class="producto-hover-btn" onclick="vistaRapidaProducto(<?php echo $producto['id']; ?>)">
                  <i class="ph ph-eye"></i>
                  Ver
                </button>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        
      </div>
    </div>
  </div>
</div>

<style>
/* ═══════════════════════════════════════════════════════════════
   LAYOUT: DESTACADO + GRID
   ═══════════════════════════════════════════════════════════════ */

.productos-vendidos-layout {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 1.5rem;
  align-items: start;
}

/* Producto Destacado (#1) */
.producto-destacado-wrapper {
  position: sticky;
  top: 1rem;
}

.producto-destacado {
  position: relative;
  padding: 1rem;
}

.bestseller-badge {
  position: absolute;
  top: 1rem;
  left: 1rem;
  z-index: 10;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0.5rem 0.75rem;
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

.bestseller-numero {
  font-size: 1.25rem;
  font-weight: 800;
  color: #fff;
  line-height: 1;
}

.bestseller-texto {
  font-size: 0.625rem;
  font-weight: 600;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.producto-destacado-imagen {
  aspect-ratio: 1 / 1;
  border-radius: 12px;
  overflow: hidden;
}

.producto-destacado-imagen img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.producto-destacado-info {
  padding: 1rem 0.5rem;
}

.producto-destacado-desc {
  font-size: 0.8125rem;
  color: #64748b;
  margin: 0.5rem 0;
  line-height: 1.5;
}

.producto-destacado-acciones {
  display: flex;
  gap: 0.75rem;
  margin-top: 1rem;
}

.btn-primary-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.375rem;
  padding: 0.5rem 1rem;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #fff;
  background: linear-gradient(135deg, #0ea5e9, #06b6d4);
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-primary-action:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(14, 165, 233, 0.35);
}

.btn-secondary-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.375rem;
  padding: 0.5rem 1rem;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #0ea5e9;
  background: #fff;
  border: 2px solid #0ea5e9;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-secondary-action:hover {
  background: #0ea5e9;
  color: #fff;
}

/* Grid de productos secundarios */
.productos-secundarios-grid-vendidos {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

.producto-secundario-vendido {
  position: relative;
}

/* Ranking badges */
.ranking-badge {
  position: absolute;
  top: 0.75rem;
  left: 0.75rem;
  z-index: 10;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 700;
  color: #fff;
  border-radius: 50%;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.ranking-2 { background: linear-gradient(135deg, #94a3b8, #64748b); }
.ranking-3 { background: linear-gradient(135deg, #d97706, #b45309); }
.ranking-4, .ranking-5, .ranking-6, .ranking-7 { 
  background: linear-gradient(135deg, #0ea5e9, #0284c7); 
}

/* Responsive */
@media (max-width: 1024px) {
  .productos-vendidos-layout {
    grid-template-columns: 1fr;
  }
  
  .producto-destacado-wrapper {
    position: static;
  }
  
  .productos-secundarios-grid-vendidos {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .productos-secundarios-grid-vendidos {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .producto-destacado-acciones {
    flex-direction: column;
  }
}

@media (max-width: 480px) {
  .productos-secundarios-grid-vendidos {
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
  }
}
</style>
