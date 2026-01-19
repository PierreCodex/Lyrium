<?php
/**
 * COMPONENTE: Sidebar Info Compacto
 * Diseño blanco consistente con el resto del sitio
 */
?>

<!-- ========================================= -->
<!-- SIDEBAR: INFO COMPACTO -->
<!-- ========================================= -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">
  
  <!-- Header -->
  <div class="flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-sky-500 to-cyan-500 text-white">
    <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
      <i class="ph ph-storefront text-lg"></i>
    </div>
    <span class="font-semibold text-sm">Información de la tienda</span>
  </div>
  
  <!-- Contenido -->
  <div class="p-3">
    
    <!-- Beneficios compactos -->
    <div class="space-y-2 mb-4">
      <div class="flex items-center gap-3 p-2.5 rounded-xl bg-emerald-50/50 border border-emerald-100">
        <div class="w-9 h-9 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
          <i class="ph ph-truck text-white"></i>
        </div>
        <div class="flex-1">
          <span class="block text-xs font-semibold text-slate-700">Envío Gratis</span>
          <span class="text-[10px] text-slate-500">Compras +S/100</span>
        </div>
      </div>
      
      <div class="flex items-center gap-3 p-2.5 rounded-xl bg-blue-50/50 border border-blue-100">
        <div class="w-9 h-9 rounded-lg bg-blue-500 flex items-center justify-center flex-shrink-0">
          <i class="ph ph-shield-check text-white"></i>
        </div>
        <div class="flex-1">
          <span class="block text-xs font-semibold text-slate-700">100% Original</span>
          <span class="text-[10px] text-slate-500">Garantía de calidad</span>
        </div>
      </div>
      
      <div class="flex items-center gap-3 p-2.5 rounded-xl bg-amber-50/50 border border-amber-100">
        <div class="w-9 h-9 rounded-lg bg-amber-500 flex items-center justify-center flex-shrink-0">
          <i class="ph ph-arrow-counter-clockwise text-white"></i>
        </div>
        <div class="flex-1">
          <span class="block text-xs font-semibold text-slate-700">7 días devolución</span>
          <span class="text-[10px] text-slate-500">Sin preguntas</span>
        </div>
      </div>
      
      <div class="flex items-center gap-3 p-2.5 rounded-xl bg-violet-50/50 border border-violet-100">
        <div class="w-9 h-9 rounded-lg bg-violet-500 flex items-center justify-center flex-shrink-0">
          <i class="ph ph-headset text-white"></i>
        </div>
        <div class="flex-1">
          <span class="block text-xs font-semibold text-slate-700">Soporte 24/7</span>
          <span class="text-[10px] text-slate-500">Siempre disponible</span>
        </div>
      </div>
    </div>
    
    <!-- Separador -->
    <div class="flex items-center gap-2 my-3">
      <div class="flex-1 h-px bg-slate-200"></div>
      <span class="text-[10px] font-medium text-slate-400 uppercase">Pagos</span>
      <div class="flex-1 h-px bg-slate-200"></div>
    </div>
    
    <!-- Métodos de pago compactos -->
    <div class="space-y-3">
      <div class="flex items-center justify-center gap-3 p-2.5 bg-slate-50 rounded-xl">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/60px-Visa_Inc._logo.svg.png" alt="Visa" class="h-4 opacity-70 hover:opacity-100 transition-opacity">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/60px-Mastercard-logo.svg.png" alt="Mastercard" class="h-5 opacity-70 hover:opacity-100 transition-opacity">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/60px-PayPal.svg.png" alt="PayPal" class="h-4 opacity-70 hover:opacity-100 transition-opacity">
      </div>
      
      <div class="grid grid-cols-2 gap-1.5">
        <span class="inline-flex items-center justify-center gap-1.5 px-2 py-2 text-[10px] font-medium text-slate-600 bg-slate-100 rounded-lg">
          <i class="ph ph-money text-green-500 text-sm"></i>
          Contra entrega
        </span>
        <span class="inline-flex items-center justify-center gap-1.5 px-2 py-2 text-[10px] font-medium text-slate-600 bg-slate-100 rounded-lg">
          <i class="ph ph-qr-code text-violet-500 text-sm"></i>
          Yape / Plin
        </span>
      </div>
    </div>
    
    <!-- Separador -->
    <div class="flex items-center gap-2 my-3">
      <div class="flex-1 h-px bg-slate-200"></div>
      <span class="text-[10px] font-medium text-slate-400 uppercase">Horario</span>
      <div class="flex-1 h-px bg-slate-200"></div>
    </div>
    
    <!-- Horario compacto -->
    <div class="space-y-1.5 text-xs">
      <div class="flex justify-between">
        <span class="text-slate-500">Lun - Vie</span>
        <span class="font-medium text-slate-700">9:00 - 18:00</span>
      </div>
      <div class="flex justify-between">
        <span class="text-slate-500">Sábado</span>
        <span class="font-medium text-slate-700">10:00 - 14:00</span>
      </div>
      <div class="flex justify-between">
        <span class="text-slate-500">Domingo</span>
        <span class="font-medium text-red-500">Cerrado</span>
      </div>
    </div>
    
    <!-- Estado -->
    <div class="mt-3 flex items-center justify-center gap-2 py-2 px-3 rounded-lg bg-emerald-50 border border-emerald-200">
      <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
      <span class="text-xs font-medium text-emerald-700">Abierto ahora</span>
    </div>
    
  </div>
</div>
