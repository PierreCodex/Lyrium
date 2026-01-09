<?php
/**
 * COMPONENTE: Sistema de Pestañas de Tienda
 * 
 * Variables esperadas:
 * - $tienda: datos de la tienda
 * - $sucursales: array de sucursales
 * - $fotos: array de fotos de galería
 * - $opiniones: array de opiniones/reseñas
 * - $terminos: array con políticas y términos
 * - $plan: 'basico' o 'premium'
 */

$maxFotos = ($plan === 'premium') ? 30 : 8;
$fotosVisibles = array_slice($fotos ?? [], 0, $maxFotos);
$formularioAvanzado = ($plan === 'premium');
?>

<div class="tienda-tabs">
  <!-- Header de Tabs -->
  <div class="tienda-tabs-header">
    <button class="tienda-tab-btn active" data-tab="info">
      <i class="ph-info mr-1"></i> Información
    </button>
    <button class="tienda-tab-btn" data-tab="sucursales">
      <i class="ph-map-pin mr-1"></i> Sucursales
    </button>
    <button class="tienda-tab-btn" data-tab="fotos">
      <i class="ph-images mr-1"></i> Fotos
    </button>
    <button class="tienda-tab-btn" data-tab="contacto">
      <i class="ph-envelope mr-1"></i> Contacto
    </button>
    <button class="tienda-tab-btn" data-tab="opiniones">
      <i class="ph-star mr-1"></i> Opiniones
    </button>
    <button class="tienda-tab-btn" data-tab="terminos">
      <i class="ph-file-text mr-1"></i> Términos
    </button>
  </div>

  <!-- ===================== -->
  <!-- TAB: INFORMACIÓN -->
  <!-- ===================== -->
  <div id="tab-info" class="tienda-tab-content active">
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-building-office"></i>
        Sobre Nosotros
      </h4>
      <p class="text-slate-600 leading-relaxed">
        <?php echo nl2br(htmlspecialchars($tienda['descripcion'] ?? 'Sin descripción disponible.')); ?>
      </p>
    </div>
    
    <?php if (!empty($tienda['actividad'])): ?>
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-briefcase"></i>
        Actividad Empresarial
      </h4>
      <p class="text-slate-600">
        <?php echo htmlspecialchars($tienda['actividad']); ?>
      </p>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($tienda['rubros'])): ?>
    <div class="tienda-info-section">
      <h4 class="tienda-info-title">
        <i class="ph-tag"></i>
        Rubros
      </h4>
      <div class="flex flex-wrap gap-2">
        <?php foreach ($tienda['rubros'] as $rubro): ?>
        <span class="inline-flex items-center gap-1 px-3 py-1 bg-sky-50 text-sky-700 rounded-full text-sm font-medium">
          <?php echo htmlspecialchars($rubro); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- ===================== -->
  <!-- TAB: SUCURSALES -->
  <!-- ===================== -->
  <div id="tab-sucursales" class="tienda-tab-content">
    <?php if (!empty($sucursales)): ?>
    <div class="tienda-sucursales-grid">
      <?php foreach ($sucursales as $index => $sucursal): ?>
      <div class="tienda-sucursal-card">
        <h4 class="tienda-sucursal-nombre">
          <i class="ph-storefront"></i>
          <?php echo htmlspecialchars($sucursal['nombre']); ?>
          <?php if (!empty($sucursal['es_principal'])): ?>
          <span class="tienda-sucursal-principal">Principal</span>
          <?php endif; ?>
        </h4>
        
        <div class="tienda-sucursal-info">
          <?php if (!empty($sucursal['direccion'])): ?>
          <div class="tienda-sucursal-info-item">
            <i class="ph-map-pin"></i>
            <span><?php echo htmlspecialchars($sucursal['direccion']); ?></span>
          </div>
          <?php endif; ?>
          
          <?php if (!empty($sucursal['ciudad'])): ?>
          <div class="tienda-sucursal-info-item">
            <i class="ph-buildings"></i>
            <span><?php echo htmlspecialchars($sucursal['ciudad']); ?></span>
          </div>
          <?php endif; ?>
          
          <?php if (!empty($sucursal['telefono'])): ?>
          <div class="tienda-sucursal-info-item">
            <i class="ph-phone"></i>
            <a href="tel:<?php echo htmlspecialchars($sucursal['telefono']); ?>" class="hover:text-sky-500">
              <?php echo htmlspecialchars($sucursal['telefono']); ?>
            </a>
          </div>
          <?php endif; ?>
          
          <?php if (!empty($sucursal['horario_apertura']) && !empty($sucursal['horario_cierre'])): ?>
          <div class="tienda-sucursal-info-item">
            <i class="ph-clock"></i>
            <span><?php echo htmlspecialchars($sucursal['horario_apertura']); ?> - <?php echo htmlspecialchars($sucursal['horario_cierre']); ?></span>
          </div>
          <?php endif; ?>
        </div>
        
        <?php if (!empty($sucursal['google_maps_url'])): ?>
        <a href="<?php echo htmlspecialchars($sucursal['google_maps_url']); ?>" target="_blank" class="tienda-sucursal-mapa">
          <i class="ph-map-trifold"></i>
          Ver en Google Maps
        </a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-8 text-slate-400">
      <i class="ph-storefront text-4xl mb-2"></i>
      <p>No hay sucursales registradas</p>
    </div>
    <?php endif; ?>
    
    <p class="text-xs text-slate-400 mt-4">
      <i class="ph-info mr-1"></i>
      Máximo 8 sucursales por tienda
    </p>
  </div>

  <!-- ===================== -->
  <!-- TAB: FOTOS -->
  <!-- ===================== -->
  <div id="tab-fotos" class="tienda-tab-content">
    <?php if (!empty($fotosVisibles)): ?>
    <div class="tienda-fotos-grid">
      <?php foreach ($fotosVisibles as $index => $foto): ?>
      <div class="tienda-foto-item" onclick="TiendaModule.openFotoLightbox(<?php echo $index; ?>)">
        <img 
          src="<?php echo htmlspecialchars($foto['url']); ?>" 
          alt="<?php echo htmlspecialchars($foto['titulo'] ?? 'Foto ' . ($index + 1)); ?>"
          loading="lazy"
        >
      </div>
      <?php endforeach; ?>
    </div>
    
    <?php if ($plan === 'basico' && count($fotos ?? []) > $maxFotos): ?>
    <div class="tienda-fotos-limite mt-4">
      <i class="ph-crown mr-1"></i>
      Tu plan permite <?php echo $maxFotos; ?> fotos. 
      <a href="planes.php" class="underline font-bold">Actualiza a Premium</a> para mostrar hasta 30.
    </div>
    <?php endif; ?>
    
    <?php else: ?>
    <div class="text-center py-8 text-slate-400">
      <i class="ph-images text-4xl mb-2"></i>
      <p>No hay fotos en la galería</p>
    </div>
    <?php endif; ?>
    
    <p class="text-xs text-slate-400 mt-4">
      <i class="ph-info mr-1"></i>
      Formatos permitidos: JPG, PNG, WEBP | Máximo 5MB por imagen
    </p>
  </div>

  <!-- ===================== -->
  <!-- TAB: CONTACTO -->
  <!-- ===================== -->
  <div id="tab-contacto" class="tienda-tab-content">
    <form class="tienda-contacto-form" id="formContactoTienda">
      
      <!-- Campos básicos (todos los planes) -->
      <div class="tienda-form-group">
        <label class="tienda-form-label">Nombre *</label>
        <input type="text" name="nombre" class="tienda-form-input" required placeholder="Tu nombre completo">
      </div>
      
      <div class="tienda-form-group">
        <label class="tienda-form-label">Correo electrónico *</label>
        <input type="email" name="correo" class="tienda-form-input" required placeholder="tucorreo@ejemplo.com">
      </div>
      
      <?php if ($formularioAvanzado): ?>
      <!-- Campos avanzados (solo Premium) -->
      <div class="tienda-form-group">
        <label class="tienda-form-label">Teléfono</label>
        <input type="tel" name="telefono" class="tienda-form-input" placeholder="+51 999 999 999">
      </div>
      
      <div class="tienda-form-group">
        <label class="tienda-form-label">Asunto *</label>
        <select name="asunto" class="tienda-form-input" required>
          <option value="">Selecciona un asunto</option>
          <option value="consulta">Consulta general</option>
          <option value="cotizacion">Solicitar cotización</option>
          <option value="reclamo">Reclamo</option>
          <option value="sugerencia">Sugerencia</option>
          <option value="otro">Otro</option>
        </select>
      </div>
      <?php endif; ?>
      
      <div class="tienda-form-group">
        <label class="tienda-form-label">Mensaje *</label>
        <textarea name="mensaje" class="tienda-form-textarea" required placeholder="Escribe tu mensaje aquí..."></textarea>
      </div>
      
      <?php if ($formularioAvanzado): ?>
      <!-- Adjuntar archivo (solo Premium) -->
      <div class="tienda-form-group">
        <label class="tienda-form-label">Adjuntar archivo (máx. 2MB)</label>
        <input type="file" name="archivo" class="tienda-form-input" accept=".pdf,.doc,.docx,.jpg,.png">
        <span class="text-xs text-slate-400 mt-1">PDF, DOC, DOCX, JPG, PNG</span>
      </div>
      <?php else: ?>
      <!-- Mensaje de upgrade para campos avanzados -->
      <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center">
        <i class="ph-crown text-amber-500 text-2xl mb-2"></i>
        <p class="text-sm text-amber-700">
          <strong>Plan Premium</strong> incluye: selección de asunto, adjuntar archivos y más opciones de contacto.
          <a href="planes.php" class="underline font-bold">Actualizar plan</a>
        </p>
      </div>
      <?php endif; ?>
      
      <button type="submit" class="tienda-form-btn">
        <i class="ph-paper-plane-tilt"></i>
        Enviar mensaje
      </button>
    </form>
  </div>

  <!-- ===================== -->
  <!-- TAB: OPINIONES -->
  <!-- ===================== -->
  <div id="tab-opiniones" class="tienda-tab-content">
    <?php if (!empty($opiniones)): ?>
    <div class="tienda-opiniones-list">
      <?php foreach ($opiniones as $opinion): ?>
      <div class="tienda-opinion-card">
        <div class="tienda-opinion-header">
          <div class="tienda-opinion-avatar">
            <?php echo strtoupper(substr($opinion['autor'], 0, 1)); ?>
          </div>
          <div class="tienda-opinion-autor">
            <span class="tienda-opinion-nombre"><?php echo htmlspecialchars($opinion['autor']); ?></span>
            <span class="tienda-opinion-fecha"><?php echo htmlspecialchars($opinion['fecha']); ?></span>
          </div>
          <div class="tienda-opinion-rating">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <i class="ph-star<?php echo $i <= $opinion['rating'] ? '-fill' : ''; ?>"></i>
            <?php endfor; ?>
          </div>
        </div>
        
        <p class="tienda-opinion-texto">
          <?php echo htmlspecialchars($opinion['comentario']); ?>
        </p>
        
        <div class="tienda-opinion-votos">
          <button 
            class="tienda-opinion-voto-btn" 
            data-opinion="<?php echo $opinion['id']; ?>" 
            data-voto="util"
            onclick="TiendaModule.votarOpinion(<?php echo $opinion['id']; ?>, 'util')"
          >
            <i class="ph-thumbs-up"></i>
            <span><?php echo $opinion['votos_util'] ?? 0; ?></span> Útil
          </button>
          <button 
            class="tienda-opinion-voto-btn"
            data-opinion="<?php echo $opinion['id']; ?>" 
            data-voto="no_util"
            onclick="TiendaModule.votarOpinion(<?php echo $opinion['id']; ?>, 'no_util')"
          >
            <i class="ph-thumbs-down"></i>
            <span><?php echo $opinion['votos_no_util'] ?? 0; ?></span>
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-8 text-slate-400">
      <i class="ph-chat-circle-text text-4xl mb-2"></i>
      <p>Aún no hay opiniones</p>
      <p class="text-sm mt-1">¡Sé el primero en dejar una reseña!</p>
    </div>
    <?php endif; ?>
    
    <!-- Formulario para nueva opinión -->
    <div class="mt-6 pt-6 border-t border-slate-200">
      <h4 class="font-bold text-slate-700 mb-4">
        <i class="ph-pencil-simple-line mr-1 text-sky-500"></i>
        Deja tu opinión
      </h4>
      <form id="formNuevaOpinion" class="space-y-4">
        <div class="flex items-center gap-2">
          <span class="text-sm text-slate-600">Tu calificación:</span>
          <div class="flex gap-1 rating-stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <button type="button" class="text-2xl text-slate-300 hover:text-amber-400 transition-colors" data-rating="<?php echo $i; ?>">
              <i class="ph-star"></i>
            </button>
            <?php endfor; ?>
          </div>
          <input type="hidden" name="rating" value="0">
        </div>
        <textarea name="comentario" class="tienda-form-textarea" placeholder="Comparte tu experiencia con esta tienda..." required></textarea>
        <button type="submit" class="tienda-form-btn">
          <i class="ph-paper-plane-tilt"></i>
          Publicar opinión
        </button>
      </form>
    </div>
  </div>

  <!-- ===================== -->
  <!-- TAB: TÉRMINOS -->
  <!-- ===================== -->
  <div id="tab-terminos" class="tienda-tab-content">
    
    <?php if (!empty($terminos['envio'])): ?>
    <div class="tienda-terminos-section">
      <h4 class="tienda-terminos-titulo">
        <i class="ph-truck"></i>
        Política de Envío
      </h4>
      <div class="tienda-terminos-contenido">
        <?php echo nl2br(htmlspecialchars($terminos['envio'])); ?>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($terminos['devolucion'])): ?>
    <div class="tienda-terminos-section">
      <h4 class="tienda-terminos-titulo">
        <i class="ph-arrow-counter-clockwise"></i>
        Política de Devolución
      </h4>
      <div class="tienda-terminos-contenido">
        <?php echo nl2br(htmlspecialchars($terminos['devolucion'])); ?>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($terminos['privacidad'])): ?>
    <div class="tienda-terminos-section">
      <h4 class="tienda-terminos-titulo">
        <i class="ph-shield-check"></i>
        Política de Privacidad
      </h4>
      <div class="tienda-terminos-contenido">
        <?php echo nl2br(htmlspecialchars($terminos['privacidad'])); ?>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($terminos['archivos'])): ?>
    <div class="tienda-terminos-section">
      <h4 class="tienda-terminos-titulo">
        <i class="ph-files"></i>
        Documentos Descargables
      </h4>
      <div class="flex flex-wrap gap-3">
        <?php foreach ($terminos['archivos'] as $archivo): ?>
        <a href="<?php echo htmlspecialchars($archivo['url']); ?>" target="_blank" class="tienda-terminos-archivo">
          <i class="ph-file-pdf"></i>
          <?php echo htmlspecialchars($archivo['nombre']); ?>
          <i class="ph-download-simple ml-auto"></i>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if (empty($terminos['envio']) && empty($terminos['devolucion']) && empty($terminos['privacidad'])): ?>
    <div class="text-center py-8 text-slate-400">
      <i class="ph-file-text text-4xl mb-2"></i>
      <p>No hay términos y condiciones publicados</p>
    </div>
    <?php endif; ?>
    
  </div>

</div>

<script>
// Inicializar sistema de estrellas para nueva opinión
document.querySelectorAll('.rating-stars button').forEach(btn => {
  btn.addEventListener('click', function() {
    const rating = parseInt(this.dataset.rating);
    document.querySelector('input[name="rating"]').value = rating;
    
    document.querySelectorAll('.rating-stars button').forEach((star, index) => {
      const icon = star.querySelector('i');
      if (index < rating) {
        icon.className = 'ph-star-fill';
        star.classList.add('text-amber-400');
        star.classList.remove('text-slate-300');
      } else {
        icon.className = 'ph-star';
        star.classList.remove('text-amber-400');
        star.classList.add('text-slate-300');
      }
    });
  });
});
</script>
