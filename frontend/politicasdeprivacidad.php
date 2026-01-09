<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lyrium Biomarketplace</title>
  <link rel="stylesheet" href="utils/css/politicasdeprivacidad.css">

  <style>
    /* Reutilizado desde libroreclamaciones.php - estilos principales */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes shimmer {
      0% {
        background-position: -1000px 0;
      }

      100% {
        background-position: 1000px 0;
      }
    }

    .animate-in {
      animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-delay-1 {
      animation-delay: 0.1s;
      opacity: 0;
    }

    .ly-pagehead {
      display: inline-flex;
      align-items: center;
      gap: 16px;
      padding: 16px 32px;
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      border-radius: 999px;
      color: #fff;
    }

    .ly-pagehead__icon {
      width: 44px;
      height: 44px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8px;
    }

    .ly-pagehead__title {
      font-weight: 800;
      font-size: clamp(20px, 4vw, 32px);
    }

    .lr-intro {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 20px 24px;
      margin-bottom: 24px;
      color: #475569;
    }

    .lr-help {
      padding: 16px 20px;
      background: linear-gradient(135deg, rgba(240, 249, 255, 0.8), rgba(224, 242, 254, 0.5));
      border-left: 4px solid #0ea5e9;
      border-radius: 12px;
      color: #475569;
    }
  </style>

  <?php include 'header.php'; ?>


  <!-- CONTENIDO: LANDING -->

  <main class="max-w-7xl mx-auto px-4 py-10 flex-1 space-y-10">

    <div class="pp-wrap">

      <!-- HEADER "PILL" -->

      <div class="text-center mb-10">
        <div class="ly-pagehead">
          <span class="ly-pagehead__icon">
            <img src="https://img.icons8.com/ios-filled/96/ffffff/privacy-policy.png" alt="Privacidad">
          </span>
          <span class="ly-pagehead__title">Políticas de privacidad</span>
        </div>
      </div>

      <p class="pp-sub">
        Esta Política de Privacidad explica cómo recopilamos, usamos y protegemos tu información cuando utilizas
        <strong>LYRIUM BIO MARKETPLACE</strong>.
      </p>

      <div class="pp-grid mt-6">

        <!-- NAV / ÍNDICE -->
        <aside class="pp-nav hidden lg:block animate-in animate-delay-1">
          <h4>Contenido</h4>
          <a href="#pp-1" class="pp-nav-link"><span class="flex-1">1. Quiénes somos</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-2" class="pp-nav-link"><span class="flex-1">2. Información que recopilamos</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-3" class="pp-nav-link"><span class="flex-1">3. Uso de la información</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-4" class="pp-nav-link"><span class="flex-1">4. Compartir su información</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-5" class="pp-nav-link"><span class="flex-1">5. Seguridad</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-6" class="pp-nav-link"><span class="flex-1">6. Cookies</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-7" class="pp-nav-link"><span class="flex-1">7. Contenido incrustado</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-8" class="pp-nav-link"><span class="flex-1">8. Con quién compartimos</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-9" class="pp-nav-link"><span class="flex-1">9. Retención de datos</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-10" class="pp-nav-link"><span class="flex-1">10. Derechos del usuario</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-11" class="pp-nav-link"><span class="flex-1">11. Transferencias</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-12" class="pp-nav-link"><span class="flex-1">12. Cambios</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
          <a href="#pp-13" class="pp-nav-link"><span class="flex-1">13. Contacto</span><i
              class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i></a>
        </aside>

        <!-- CARD PRINCIPAL -->
        <section class="pp-card animate-in animate-delay-2">
          <div class="pp-card-inner">
            <div class="text-center text-xl font-black text-gray-800 mb-2 uppercase">
              Política de Privacidad y Protección de Datos
            </div>
            <div class="text-center text-sm text-gray-500 mb-8">-LYRIUM BIOMARKETPLACE-</div>

            <!-- 1 -->
            <div class="pp-section" id="pp-1">
              <div class="pp-h"><span>1. Quiénes somos</span></div>
              <p class="pp-text">
                Bienvenido(a) a <strong>LYRIUM BIO MARKETPLACE</strong>. Somos un marketplace donde conviven tiendas,
                productos y
                servicios saludables, conectando compradores y vendedores en un entorno seguro.
              </p>
              <span class="pp-badge"><i class="ph-map-pin"></i> Dirección: Piura – Perú</span>
            </div>

            <!-- 2 -->
            <div class="pp-section" id="pp-2">
              <div class="pp-h"><span>2. Información que recopilamos</span></div>

              <div class="pp-title">Información de Registro</div>
              <p class="pp-text">
                Cuando creas una cuenta, podemos solicitar datos como nombre, correo electrónico, teléfono, dirección y
                otra
                información necesaria para operar el servicio.
              </p>

              <div class="pp-title">Información de Transacción</div>
              <p class="pp-text">
                Recopilamos información relacionada a compras/ventas dentro del marketplace (por ejemplo,
                productos/servicios
                adquiridos, confirmaciones, envío y soporte).
              </p>

              <div class="pp-title">Información Técnica</div>
              <p class="pp-text">
                Podemos registrar información del dispositivo y navegación (IP, navegador, páginas visitadas, tiempos de
                carga) para
                mejorar seguridad y experiencia.
              </p>

              <div class="pp-title">Cookies y Tecnologías Similares</div>
              <p class="pp-text">
                Usamos cookies para recordar preferencias, medir el rendimiento y habilitar funciones esenciales del
                sitio.
              </p>
            </div>

            <!-- 3 -->
            <div class="pp-section" id="pp-3">
              <div class="pp-h"><span>3. Uso de la información</span></div>
              <p class="pp-text">Usamos la información recopilada para:</p>
              <ul class="pp-list">
                <li>Proporcionar y mejorar nuestros servicios.</li>
                <li>Procesar transacciones y enviar confirmaciones.</li>
                <li>Responder consultas y brindar soporte al cliente.</li>
                <li>Personalizar tu experiencia y mostrar contenido relevante.</li>
                <li>Enviar comunicaciones (promos/actualizaciones) cuando corresponda.</li>
                <li>Cumplir obligaciones legales y de seguridad.</li>
                <script src="https://unpkg.com/phosphor-icons"></script>

                <style>
                  /* =============================================================================
                   ANIMACIONES PREMIUM
                ============================================================================= */
                  @keyframes fadeInUp {
                    from {
                      opacity: 0;
                      transform: translateY(30px);
                    }

                    to {
                      opacity: 1;
                      transform: translateY(0);
                    }
                  }

                  @keyframes shimmer {
                    0% {
                      background-position: -1000px 0;
                    }

                    100% {
                      background-position: 1000px 0;
                    }
                  }

                  @keyframes particleMove {
                    0% {
                      transform: translate(0, 0);
                    }

                    100% {
                      transform: translate(50px, 50px);
                    }
                  }

                  @keyframes shimmerLine {

                    0%,
                    100% {
                      background-position: 200% 0;
                      opacity: 0.3;
                    }

                    50% {
                      background-position: -200% 0;
                      opacity: 1;
                    }
                  }

                  .animate-in {
                    animation: fadeInUp 0.6s ease-out forwards;
                  }

                  .animate-delay-1 {
                    animation-delay: 0.1s;
                    opacity: 0;
                  }

                  .animate-delay-2 {
                    animation-delay: 0.2s;
                    opacity: 0;
                  }

                  .animate-delay-3 {
                    animation-delay: 0.3s;
                    opacity: 0;
                  }

                  .animate-delay-4 {
                    animation-delay: 0.4s;
                    opacity: 0;
                  }

                  html {
                    scroll-behavior: smooth;
                  }

                  .lr-page {
                    background: radial-gradient(1200px 240px at 50% 0%, #e0f2fe 0%, rgba(224, 242, 254, 0) 60%), #f7fbff;
                    padding: 42px 16px 60px;
                    min-height: 100vh;
                  }

                  .lr-wrap {
                    max-width: 1000px;
                    margin: 0 auto;
                  }

                  .ly-pagehead {
                    display: inline-flex;
                    align-items: center;
                    gap: 16px;
                    padding: 16px 32px;
                    background: linear-gradient(135deg, #0ea5e9, #0284c7);
                    border-radius: 999px;
                    color: #fff;
                  }

                  .ly-pagehead__icon {
                    width: 44px;
                    height: 44px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 8px;
                  }

                  .ly-pagehead__title {
                    font-weight: 800;
                    font-size: clamp(20px, 4vw, 32px);
                  }

                  .lr-intro {
                    background: rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(10px);
                    border-radius: 20px;
                    padding: 20px 24px;
                    margin-bottom: 24px;
                    color: #475569;
                  }

                  .lr-help {
                    padding: 16px 20px;
                    background: linear-gradient(135deg, rgba(240, 249, 255, 0.8), rgba(224, 242, 254, 0.5));
                    border-left: 4px solid #0ea5e9;
                    border-radius: 12px;
                    color: #475569;
                  }
                </style>

                <?php include 'header.php'; ?>
                Terceros que nos apoyan (pagos, analítica, envíos, hosting) pueden acceder a información mínima
                necesaria para brindar
                su servicio.
                </p>

                <div class="pp-title">Cumplimiento Legal</div>
                <p class="pp-text">
                  Podremos divulgar información si es requerida por autoridades competentes o para proteger derechos,
                  seguridad y
                  prevenir fraudes.
                </p>

                <div class="pp-title">Transferencias Comerciales</div>
                <p class="pp-text">
                  En caso de fusión, adquisición o venta de activos, la información podría transferirse bajo medidas de
                  protección.
                </p>
            </div>

            <!-- 5 -->
            <div class="pp-section" id="pp-5">
              <div class="pp-h"><span>5. Seguridad</span></div>
              <p class="pp-text">
                Aplicamos medidas razonables para proteger tu información contra acceso no autorizado, alteración,
                divulgación o
                destrucción. Sin embargo, ningún método de transmisión o almacenamiento es 100% infalible.
              </p>
            </div>

            <!-- 6 -->
            <div class="pp-section" id="pp-6">
              <div class="pp-h"><span>6. Cookies</span></div>
              <p class="pp-text">
                Las cookies son pequeños archivos que se almacenan en tu dispositivo. Nos ayudan a mejorar la
                experiencia.
              </p>

              <div class="pp-title">Tipos de cookies que utilizamos</div>
              <ul class="pp-list">
                <li><strong>Cookies de sesión:</strong> temporales y se eliminan al cerrar el navegador.</li>
                <li><strong>Cookies persistentes:</strong> permanecen hasta que las elimines o caduquen.</li>
                <li><strong>Cookies de terceros:</strong> servicios externos que ayudan a mejorar el sitio.</li>
              </ul>

              <div class="pp-title">Cómo controlar las cookies</div>
              <p class="pp-text">
                Puedes configurar tu navegador para bloquear o eliminar cookies. Ten en cuenta que algunas funciones
                podrían dejar de
                funcionar correctamente.
              </p>
            </div>

            <!-- 7 -->
            <div class="pp-section" id="pp-7">
              <div class="pp-h"><span>7. Contenido incrustado de otros sitios web</span></div>
              <p class="pp-text">
                Algunas páginas pueden incluir contenido incrustado (videos, imágenes, widgets). Este contenido se
                comporta como si
                visitaras el sitio de origen y podría recopilar datos según sus propias políticas.
              </p>
            </div>

            <!-- 8 -->
            <div class="pp-section" id="pp-8">
              <div class="pp-h"><span>8. Con quién compartimos sus datos</span></div>
              <p class="pp-text">
                Compartimos datos únicamente con proveedores esenciales para operar el marketplace (por ejemplo, pagos,
                hosting y
                soporte técnico), y solo en la medida necesaria.
              </p>
            </div>

            <!-- 9 -->
            <div class="pp-section" id="pp-9">
              <div class="pp-h"><span>9. Cuánto tiempo conservamos sus datos</span></div>
              <p class="pp-text">
                Conservamos la información durante el tiempo necesario para cumplir con los fines del servicio,
                obligaciones legales,
                auditorías o resolución de disputas.
              </p>
            </div>

            <!-- 10 -->
            <div class="pp-section" id="pp-10">
              <div class="pp-h"><span>10. Qué derechos tiene sobre sus datos</span></div>
              <p class="pp-text">
                Dependiendo de tu ubicación, puedes tener derechos como acceso, corrección, eliminación o limitación del
                uso de tus
                datos. Para ejercerlos, contáctanos.
              </p>
            </div>

            <!-- 11 -->
            <div class="pp-section" id="pp-11">
              <div class="pp-h"><span>11. Dónde se envía su información</span></div>
              <p class="pp-text">
                Tus datos podrían procesarse en servicios de infraestructura ubicados fuera de tu país. En esos casos,
                aplicamos
                medidas razonables para mantener la protección.
              </p>
            </div>

            <!-- 12 -->
            <div class="pp-section" id="pp-12">
              <div class="pp-h"><span>12. Cambios a esta política</span></div>
              <p class="pp-text">
                Podemos actualizar esta Política de Privacidad cuando sea necesario. Publicaremos cambios en esta página
                y, cuando
                aplique, ajustaremos la fecha de actualización.
              </p>
            </div>

            <!-- 13 -->
            <div class="pp-section" id="pp-13">
              <div class="pp-h"><span>13. Contacto</span></div>
              <p class="pp-text">Si tienes preguntas sobre esta Política de Privacidad, contáctanos:</p>
              <ul class="pp-list">
                <li><strong>Correo:</strong> info@lyriumbiomarketplace.com</li>
                <li><strong>Dirección:</strong> Piura – Perú</li>
                <li><strong>Teléfono:</strong> 969 343 913</li>
              </ul>

              <div class="pp-foot">
                Última actualización: <strong>2025</strong>. Al usar LYRIUM BIO MARKETPLACE, aceptas los términos
                descritos en esta política.
              </div>
            </div>

          </div>
        </section>

      </div>
    </div>

    <!-- Script de navegación con selección y filtrado -->
    <script src="utils/js/politicasdeprivacidad.js"></script>

    <script>
      (function () {
        const tipo = document.getElementById('tipo_reclamo');
        if (!tipo) return; // no ejecutar si no existe el formulario de reclamo
        const help = document.getElementById('lrHelp');
        const detalle = document.getElementById('detalle_reclamo');
        function renderHelp() {
          const v = (tipo.value || '').toLowerCase();
          if (v === 'queja') {
            if (help) help.innerHTML = '<b>Queja:</b> Disconformidad frente a una mala atención del proveedor (sin relación directa con el producto/servicio).';
            if (detalle) detalle.placeholder = 'Describe la atención recibida, fecha, canal, persona que te atendió y lo ocurrido.';
          } else {
            if (help) help.innerHTML = '<b>Reclamo:</b> Disconformidad relacionada a un producto/servicio adquirido (calidad, entrega, garantía, etc.).';
            if (detalle) detalle.placeholder = 'Describe el problema con el producto/servicio, cuándo ocurrió y qué solución solicitas.';
          }
        }
        tipo.addEventListener('change', renderHelp);
        renderHelp();
      })();
    </main >

        <?php include 'footer.php'; ?>

      <?php include 'footer.php'; ?>