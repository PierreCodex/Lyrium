<?php
/**
 * TIENDA-HEADER.PHP - Header de tienda estilo barra
 * 
 * Barra superior con:
 * - Logo, nombre y badge de verificación
 * - Información del negocio (ubicación, categoría, estado, contacto)
 * - Botones de acción (seguir, contactar)
 * - Buscador dentro de la tienda
 * 
 * Variables esperadas:
 * @var array $tienda - Datos de la tienda
 * @var string $plan - Plan de la tienda ('basico' o 'premium')
 * @var array $productos - Productos de la tienda (para contar)
 */

// Validar datos requeridos
if (!isset($tienda) || !is_array($tienda)) {
    return;
}

$plan = $plan ?? 'basico';

// Contar productos
$total_productos = isset($productos) ? count($productos) : 0;

// Calcular calificación promedio de opiniones
$calificacion_promedio = 0;
if (!empty($opiniones)) {
    $suma = array_sum(array_column($opiniones, 'rating'));
    $calificacion_promedio = round($suma / count($opiniones), 1);
}

// Badge según plan
$badge_texto = $plan === 'premium' ? 'Premium' : 'Verificado';
?>
<!-- HEADER DE TIENDA - Nuevo diseño Glassmorphism -->
<div id="tiendaHeaderSticky" class="tienda-header-sticky">
  <div class="tienda-container">
    <!-- Contenedor principal con efecto glassmorphism -->
    <div class="tienda-header-glass rounded-2xl shadow-xl overflow-hidden">
      
      <!-- FILA 1: Logo + Nombre + Badges + Buscador -->
      <div class="tienda-header-row-main px-4 lg:px-6 py-4">
        <div class="flex items-center justify-between gap-4 flex-wrap">
          
          <!-- Logo + Nombre + Badges (juntos) -->
          <div class="flex items-center gap-3">
            <!-- Logo -->
            <?php 
            $logo_src = !empty($tienda['logo']) ? htmlspecialchars($tienda['logo']) : '/lyrium/frontend/img/tienda/tienda-94.png';
            ?>
            <div class="w-12 h-12 rounded-xl overflow-hidden bg-white flex-shrink-0 shadow-lg ring-2 ring-white/50 flex items-center justify-center">
              <img 
                src="<?php echo $logo_src; ?>" 
                alt="<?php echo htmlspecialchars($tienda['nombre']); ?>"
                class="w-full h-full object-cover"
                onerror="this.src='/lyrium/frontend/img/tienda/tienda-94.png'"
              >
            </div>
            
            <!-- Nombre + Badges minimalistas -->
            <div class="flex items-center gap-2">
              <h1 class="text-xl font-bold text-slate-800">
                <?php echo htmlspecialchars($tienda['nombre']); ?>
              </h1>
              
              <!-- Badge Plan (minimalista) -->
              <?php if ($plan === 'premium'): ?>
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 text-amber-700 rounded text-xs font-medium">
                <i class="ph-fill ph-crown text-[10px]"></i>
                Premium
              </span>
              <?php else: ?>
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded text-xs font-medium">
                <i class="ph-fill ph-check-circle text-[10px]"></i>
                Verificado
              </span>
              <?php endif; ?>
              
              <!-- Badge Estado (minimalista) -->
              <?php if ($tienda['abierto']): ?>
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-sky-100 text-sky-700 rounded text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-sky-500 rounded-full animate-pulse"></span>
                Abierto
              </span>
              <?php else: ?>
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-100 text-red-600 rounded text-xs font-medium">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                Cerrado
              </span>
              <?php endif; ?>
            </div>
          </div>
          
          <!-- Buscador mejorado -->
          <div class="flex-1 max-w-sm">
            <div class="relative group">
              <!-- Ícono de lupa -->
              <div class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg bg-sky-500 flex items-center justify-center shadow-sm">
                <i class="ph-bold ph-magnifying-glass text-white text-sm"></i>
              </div>
              
              <!-- Input -->
              <input 
                type="text" 
                placeholder="Buscar productos en esta tienda..."
                id="tiendaSearchHeader"
                class="w-full pl-14 pr-4 py-3 rounded-xl bg-white border-2 border-slate-200 
                       text-sm text-slate-700 placeholder-slate-400 
                       focus:outline-none focus:border-sky-400 focus:shadow-lg focus:shadow-sky-100
                       hover:border-slate-300
                       transition-all duration-200 shadow-md"
              >
              
              <!-- Texto de tecla (opcional) -->
              <div class="absolute right-3 top-1/2 -translate-y-1/2 hidden sm:flex items-center gap-1">
                <kbd class="px-2 py-0.5 text-[10px] font-medium text-slate-400 bg-slate-100 rounded border border-slate-200">
                  Enter
                </kbd>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      
      <!-- FILA 2: Cards de información -->
      <div class="tienda-header-row-cards px-4 lg:px-6 py-3 bg-white/40 backdrop-blur-sm border-t border-white/50">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
          
          <!-- Card: Ubicación -->
          <div class="tienda-info-card bg-white rounded-xl p-4 shadow-lg border-l-4 border-l-sky-500 hover:shadow-xl hover:-translate-y-0.5 transition-all">
            <div class="flex items-start justify-between">
              <div class="flex-1 min-w-0">
                <p class="text-slate-500 text-xs font-medium mb-1">Ubicación</p>
                <p class="text-lg font-bold text-slate-800 truncate"><?php echo htmlspecialchars(explode(',', $tienda['direccion'] ?? 'Sin ubicación')[0]); ?></p>
                <p class="text-xs text-sky-600 font-medium mt-1 flex items-center gap-0.5">
                  <i class="ph-fill ph-map-pin text-[10px]"></i>
                  Ver en mapa
                </p>
              </div>
              <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center flex-shrink-0">
                <i class="ph-fill ph-map-pin text-sky-600 text-xl"></i>
              </div>
            </div>
          </div>
          
          <!-- Card: Categoría -->
          <div class="tienda-info-card bg-white rounded-xl p-4 shadow-lg border-l-4 border-l-purple-500 hover:shadow-xl hover:-translate-y-0.5 transition-all">
            <div class="flex items-start justify-between">
              <div class="flex-1 min-w-0">
                <p class="text-slate-500 text-xs font-medium mb-1">Categoría</p>
                <p class="text-lg font-bold text-slate-800 truncate"><?php echo htmlspecialchars($tienda['categoria'] ?? 'General'); ?></p>
                <p class="text-xs text-purple-600 font-medium mt-1 flex items-center gap-0.5">
                  <i class="ph-fill ph-tag text-[10px]"></i>
                  Productos naturales
                </p>
              </div>
              <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                <i class="ph-fill ph-tag text-purple-600 text-xl"></i>
              </div>
            </div>
          </div>
          
          <!-- Card: Valoración -->
          <div class="tienda-info-card bg-white rounded-xl p-4 shadow-lg border-l-4 border-l-amber-500 hover:shadow-xl hover:-translate-y-0.5 transition-all">
            <div class="flex items-start justify-between">
              <div class="flex-1 min-w-0">
                <p class="text-slate-500 text-xs font-medium mb-1">Valoración</p>
                <p class="text-lg font-bold text-slate-800"><?php echo $calificacion_promedio > 0 ? $calificacion_promedio . ' ★' : 'Sin reseñas'; ?></p>
                <p class="text-xs text-amber-600 font-medium mt-1 flex items-center gap-0.5">
                  <i class="ph-fill ph-users text-[10px]"></i>
                  <?php echo count($opiniones ?? []); ?> reseñas
                </p>
              </div>
              <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                <i class="ph-fill ph-star text-amber-500 text-xl"></i>
              </div>
            </div>
          </div>
          
          <!-- Card: Productos -->
          <div class="tienda-info-card bg-white rounded-xl p-4 shadow-lg border-l-4 border-l-emerald-500 hover:shadow-xl hover:-translate-y-0.5 transition-all">
            <div class="flex items-start justify-between">
              <div class="flex-1 min-w-0">
                <p class="text-slate-500 text-xs font-medium mb-1">Productos Activos</p>
                <p class="text-lg font-bold text-slate-800"><?php echo $total_productos; ?></p>
                <p class="text-xs text-emerald-600 font-medium mt-1 flex items-center gap-0.5">
                  <i class="ph-fill ph-check-circle text-[10px]"></i>
                  Disponibles
                </p>
              </div>
              <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <i class="ph-fill ph-package text-emerald-600 text-xl"></i>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Estilos del nuevo header glassmorphism -->
<style>
.tienda-header-glass {
  background: url('/lyrium/frontend/img/tienda/stats-background.png') center center / cover no-repeat;
  border: 1px solid rgba(14, 165, 233, 0.2);
}

.tienda-header-row-main {
  background: rgba(255, 255, 255, 0.1);
}

.tienda-info-card {
  transition: all 0.2s ease;
}

.tienda-info-card:hover {
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
  .tienda-header-row-main > div {
    flex-direction: column;
    align-items: stretch;
    gap: 1rem;
  }
  
  .tienda-header-row-main .flex-1 {
    max-width: none;
  }
}
</style>

<?php if ($plan === 'premium'): ?>
<?php endif; ?>