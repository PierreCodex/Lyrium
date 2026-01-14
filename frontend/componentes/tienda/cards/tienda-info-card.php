<?php
/**
 * TIENDA-INFO-CARD.PHP - Barra de Servicios Compacta
 * 
 * Diseño minimalista en una sola barra horizontal:
 * - Entregas nacionales
 * - Atención 24/7
 * - Horarios
 * 
 * Variables esperadas:
 * @var array $tienda - Datos de la tienda
 * @var array $horarios - Horarios de atención
 */

// Validar datos requeridos
if (!isset($tienda) || !is_array($tienda)) {
    return;
}

// Día actual
$dias_semana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
$dias_nombres = ['domingo' => 'Dom', 'lunes' => 'Lun', 'martes' => 'Mar', 'miercoles' => 'Mié', 'jueves' => 'Jue', 'viernes' => 'Vie', 'sabado' => 'Sáb'];
$dia_actual = $dias_semana[date('w')];
$horario_hoy = $horarios[$dia_actual] ?? null;
?>

<!-- Estilos de animación para iconos -->
<style>
/* Animación de camión - efecto de velocidad/movimiento */
@keyframes truck-drive {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(3px); }
  75% { transform: translateX(-2px); }
}

@keyframes truck-shake {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  25% { transform: translateY(-1px) rotate(-1deg); }
  50% { transform: translateY(0) rotate(0deg); }
  75% { transform: translateY(-1px) rotate(1deg); }
}

.icon-truck-animated {
  animation: truck-drive 0.8s ease-in-out infinite, truck-shake 0.4s ease-in-out infinite;
}

/* Animación de teléfono - vibración */
@keyframes phone-vibrate {
  0%, 100% { transform: rotate(0deg); }
  10% { transform: rotate(-8deg); }
  20% { transform: rotate(8deg); }
  30% { transform: rotate(-8deg); }
  40% { transform: rotate(8deg); }
  50% { transform: rotate(0deg); }
}

.icon-phone-animated {
  animation: phone-vibrate 2s ease-in-out infinite;
}

/* Animación de reloj - manecilla que gira */
@keyframes clock-tick {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.icon-clock-animated {
  animation: clock-tick 8s linear infinite;
}

/* Efecto de hover: acelerar animaciones */
.service-card:hover .icon-truck-animated {
  animation-duration: 0.3s, 0.2s;
}

.service-card:hover .icon-phone-animated {
  animation-duration: 0.5s;
}

.service-card:hover .icon-clock-animated {
  animation-duration: 2s;
}
</style>

<!-- BARRA DE SERVICIOS - Diseño Compacto Minimalista con Animaciones -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm mt-4 overflow-hidden">
  <div class="flex flex-col md:flex-row md:items-center md:divide-x divide-slate-100">
    
    <!-- Sección 1: Entregas Nacionales -->
    <div class="service-card flex items-center gap-3 px-5 py-4 flex-1 hover:bg-slate-50/50 transition-colors cursor-pointer">
      <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center overflow-hidden">
        <i class="ph-fill ph-truck text-emerald-600 text-xl icon-truck-animated"></i>
      </div>
      <div class="min-w-0">
        <p class="font-semibold text-slate-800 text-sm">Entregas nacionales</p>
        <p class="text-slate-500 text-xs">Shalom · Olva · Cruz del Sur</p>
      </div>
    </div>
    
    <!-- Separador móvil -->
    <div class="h-px bg-slate-100 md:hidden"></div>
    
    <!-- Sección 2: Atención 24/7 -->
    <div class="service-card flex items-center gap-3 px-5 py-4 flex-1 hover:bg-slate-50/50 transition-colors cursor-pointer">
      <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-sky-50 flex items-center justify-center">
        <i class="ph-fill ph-headset text-sky-600 text-xl icon-phone-animated"></i>
      </div>
      <div class="min-w-0">
        <p class="font-semibold text-slate-800 text-sm">Atención 24/7</p>
        <p class="text-slate-500 text-xs">Chat o llamada</p>
      </div>
    </div>
    
    <!-- Separador móvil -->
    <div class="h-px bg-slate-100 md:hidden"></div>
    
    <!-- Sección 3: Horarios -->
    <div class="service-card flex items-center gap-3 px-5 py-4 flex-1 hover:bg-slate-50/50 transition-colors cursor-pointer">
      <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
        <i class="ph-fill ph-clock text-amber-600 text-xl icon-clock-animated"></i>
      </div>
      <div class="min-w-0 flex-1">
        <div class="flex items-center gap-2">
          <p class="font-semibold text-slate-800 text-sm">Horarios</p>
          <?php if ($tienda['abierto']): ?>
          <span class="inline-flex items-center px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-semibold rounded-full">
            Abierto
          </span>
          <?php else: ?>
          <span class="inline-flex items-center px-2 py-0.5 bg-red-100 text-red-700 text-[10px] font-semibold rounded-full">
            Cerrado
          </span>
          <?php endif; ?>
        </div>
        <p class="text-slate-500 text-xs">
          <?php if ($horario_hoy && !$horario_hoy['cerrado']): ?>
          <?php echo $horario_hoy['apertura']; ?> - <?php echo $horario_hoy['cierre']; ?>
          <?php else: ?>
          Cerrado hoy
          <?php endif; ?>
        </p>
      </div>
    </div>
    
  </div>
</div>
