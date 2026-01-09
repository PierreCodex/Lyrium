<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Términos y Condiciones - Lyrium Biomarketplace</title>
  <link rel="stylesheet" href="utils/css/politicasdeprivacidad.css">

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

    /* =============================================================================
       ESTILOS DEL FORMULARIO - ESTILO PREMIUM
    ============================================================================= */
    .lr-page {
      background: radial-gradient(1200px 240px at 50% 0%, #e0f2fe 0%, rgba(224, 242, 254, 0) 60%), #f7fbff;
      padding: 42px 16px 60px;
      min-height: 100vh;
      font-family: 'Outfit', sans-serif;
    }

    .lr-wrap {
      max-width: 1000px;
      margin: 0 auto;
    }

    /* Header animado con estilo de políticas */
    .ly-pagehead-row {
      display: flex;
      justify-content: center;
      margin: 10px 0 30px;
    }

    .ly-pagehead {
      display: inline-flex;
      align-items: center;
      gap: 16px;
      padding: 16px 32px;
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      border-radius: 999px;
      box-shadow: 0 20px 40px rgba(14, 165, 233, 0.2);
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      text-decoration: none;
    }

    .ly-pagehead:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 30px 60px rgba(14, 165, 233, 0.3);
    }

    .ly-pagehead__icon {
      width: 44px;
      height: 44px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(4px);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8px;
      transition: all 0.4s ease;
    }

    .ly-pagehead:hover .ly-pagehead__icon {
      transform: rotate(10deg) scale(1.1);
      background: rgba(255, 255, 255, 0.3);
    }

    .ly-pagehead__icon img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .ly-pagehead__title {
      color: #ffffff;
      font-size: clamp(20px, 4vw, 32px);
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    .lr-pill {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      padding: 16px 28px;
      border-radius: 999px;
      background: linear-gradient(135deg, #0ea5e9, #38bdf8);
      color: #fff;
      box-shadow: 0 18px 35px rgba(14, 165, 233, .18);
      font-weight: 900;
      letter-spacing: -0.02em;
      font-size: clamp(20px, 2.6vw, 34px);
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    /* Efecto de partículas decorativas */
    .lr-pill::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
      background-size: 30px 30px;
      animation: particleMove 15s linear infinite;
      pointer-events: none;
    }

    /* Línea de brillo superior animada */
    .lr-pill::after {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 70%;
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
      background-size: 200% 100%;
      animation: shimmerLine 3s ease-in-out infinite;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
    }

    .lr-pill:hover {
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 30px 60px rgba(14, 165, 233, .4);
    }

    .lr-pill i {
      font-size: 26px;
      background: rgba(255, 255, 255, .18);
      border-radius: 999px;
      padding: 10px;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      position: relative;
      z-index: 1;
    }

    .lr-pill:hover i {
      transform: rotate(360deg) scale(1.2);
      background: rgba(255, 255, 255, .3);
    }

    .lr-intro {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 20px 24px;
      margin-bottom: 24px;
      color: #475569;
      line-height: 1.8;
      font-size: 15.5px;
      border: 1px solid rgba(14, 165, 233, 0.1);
      box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
      transition: all 0.3s ease;
    }

    .lr-intro:hover {
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 12px 32px rgba(15, 23, 42, .12);
      transform: translateY(-2px);
    }

    .lr-intro b {
      color: #0ea5e9;
      font-weight: 700;
    }

    .lr-card {
      background: rgba(255, 255, 255, .92);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(226, 232, 240, .9);
      border-radius: 26px;
      box-shadow: 0 22px 60px rgba(15, 23, 42, .08);
      overflow: hidden;
      padding: 32px;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      position: relative;
    }

    .lr-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #0ea5e9, #38bdf8, #0ea5e9);
      background-size: 200% 100%;
      animation: shimmer 3s linear infinite;
    }

    .lr-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 35px 80px rgba(15, 23, 42, .15);
      border-color: rgba(14, 165, 233, .2);
    }

    .lr-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    @media (min-width: 768px) {
      .lr-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .lr-field {
      grid-column: span 1;
      transition: all 0.3s ease;
    }

    .lr-field:hover {
      transform: translateY(-2px);
    }

    .lr-col-2 {
      grid-column: span 1;
    }

    .lr-col-3 {
      grid-column: span 1;
    }

    @media (min-width: 768px) {
      .lr-col-2 {
        grid-column: span 2;
      }

      .lr-col-3 {
        grid-column: span 3;
      }
    }

    .lr-label {
      display: block;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .lr-field:hover .lr-label {
      color: #0ea5e9;
      transform: translateX(2px);
    }

    .lr-control {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      background: #ffffff;
      border-radius: 12px;
      font-size: 15.5px;
      color: #1e293b;
      transition: all 0.25s ease;
      font-family: inherit;
    }

    .lr-control::placeholder {
      color: #94a3b8;
    }

    .lr-control:hover {
      border-color: #38bdf8;
      background: #f8fafc;
      box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
    }

    .lr-control:focus {
      outline: none;
      border-color: #0ea5e9;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(14, 165, 233, .15);
      transform: translateY(-2px);
    }

    textarea.lr-control {
      min-height: 120px;
      resize: vertical;
    }

    .lr-section-title {
      grid-column: span 1;
      font-size: 20px;
      font-weight: 900;
      background: linear-gradient(135deg, #0ea5e9, #38bdf8);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin: 12px 0 -8px;
      letter-spacing: -0.02em;
      transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
      .lr-section-title {
        grid-column: span 3;
      }
    }

    .lr-section-title:hover {
      transform: scale(1.02);
      filter: drop-shadow(0 4px 8px rgba(14, 165, 233, 0.3));
    }

    .lr-help {
      grid-column: span 1;
      padding: 16px 20px;
      background: linear-gradient(135deg, rgba(240, 249, 255, 0.8), rgba(224, 242, 254, 0.5));
      border-left: 4px solid #0ea5e9;
      border-radius: 12px;
      color: #475569;
      font-size: 14px;
      line-height: 1.7;
      transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
      .lr-help {
        grid-column: span 3;
      }
    }

    .lr-help:hover {
      background: linear-gradient(135deg, rgba(240, 249, 255, 1), rgba(224, 242, 254, 0.8));
      box-shadow: 0 4px 16px rgba(14, 165, 233, .15);
      transform: translateX(4px);
    }

    .lr-help b {
      color: #0ea5e9;
      font-weight: 700;
    }

    .lr-file input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 2px dashed #cbd5e1;
      border-radius: 12px;
      background: #f8fafc;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .lr-file input[type="file"]:hover {
      border-color: #0ea5e9;
      background: rgba(14, 165, 233, .05);
      transform: scale(1.01);
    }

    .lr-checks {
      grid-column: span 1;
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-top: 8px;
    }

    @media (min-width: 768px) {
      .lr-checks {
        grid-column: span 3;
      }
    }

    .lr-check {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding: 14px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }

    .lr-check:hover {
      background: rgba(14, 165, 233, .05);
      border-color: rgba(14, 165, 233, .2);
      transform: translateX(4px);
    }

    .lr-check input[type="checkbox"] {
      margin-top: 4px;
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #0ea5e9;
    }

    .lr-check span {
      flex: 1;
      color: #475569;
      font-size: 14px;
      line-height: 1.6;
    }

    .lr-check a {
      color: #0ea5e9;
      text-decoration: none;
      font-weight: 700;
      transition: all 0.2s ease;
    }

    .lr-check a:hover {
      color: #38bdf8;
      text-decoration: underline;
    }

    .lr-actions {
      grid-column: span 1;
      display: flex;
      justify-content: center;
      margin-top: 12px;
    }

    @media (min-width: 768px) {
      .lr-actions {
        grid-column: span 3;
      }
    }

    .lr-submit {
      padding: 16px 48px;
      font-size: 16px;
      font-weight: 900;
      color: #fff;
      background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #0ea5e9 100%);
      background-size: 200% 100%;
      border: 2px solid transparent;
      border-radius: 999px;
      cursor: pointer;
      box-shadow: 0 18px 40px rgba(14, 165, 233, .25), inset 0 1px 2px rgba(255, 255, 255, .3);
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      position: relative;
      overflow: hidden;
    }

    .lr-submit::before {
      content: '';
      position: absolute;
      inset: -2px;
      background: linear-gradient(135deg, #38bdf8, #7dd3fc, #38bdf8, #0ea5e9);
      background-size: 300% 100%;
      border-radius: 999px;
      opacity: 0;
      z-index: -1;
      animation: shimmer 3s linear infinite;
      transition: opacity 0.4s ease;
    }

    .lr-submit:hover::before {
      opacity: 1;
    }

    .lr-submit:hover {
      transform: translateY(-6px) scale(1.05);
      box-shadow: 0 28px 60px rgba(14, 165, 233, .4), 0 0 40px rgba(56, 189, 248, .3);
      background-position: -100% 0;
    }

    .lr-submit:active {
      transform: translateY(-4px) scale(1.03);
    }
  </style>

  <?php include 'header.php'; ?>

  <main class="max-w-7xl mx-auto px-4 py-10 flex-1 space-y-10">

    <?php
    $PDF_CLIENTE = 'frontend/pdf/cliente.pdf';
    $PDF_VENDEDOR = 'frontend/pdf/vendedor.pdf';

    $TERMINOS = [
      'cliente' => [
        [
          'id' => 'primero-privacidad',
          'title' => '1. Privacidad',
          'html' => '
            <p class="pp-text">El uso del Marketplace lyriumbiomarketplace.com estará sujeto a la aceptación de los Términos y Condiciones detallados a continuación:</p>
            <div class="pp-title">1.1 Información que recopilamos</div>
            <p class="pp-text">Los datos personales requeridos por el Marketplace, tales como nombres, apellidos, RUC (opcional), tipo de documento de identidad, número de documento de identidad, domicilio, departamento, provincia, número de contacto y correo electrónico serán de uso exclusivo del sitio para concretar las operaciones de compra y venta que el usuario desee realizar.</p>
            <p class="pp-text">La información que indirectamente nos proporcione, tales como cookies (preferencias del usuario cuando visite nuestra página web o redes sociales), direcciones IP, conexiones y sistemas de información; podrán ser usadas con el único fin de brindar una mejor experiencia al usuario y gestionar mejoras de productos/servicios.</p>
            <div class="pp-title">1.2 Guardamos su información de manera segura</div>
            <p class="pp-text">El sitio guarda toda su información personal de forma segura y confidencial. Sólo personal autorizado podrá acceder a su información personal en cumplimiento de los términos y condiciones.</p>
            <div class="pp-title">1.3 Finalidades del tratamiento</div>
            <p class="pp-text">Los datos personales que usted libremente proporciona serán tratados para: atender consultas, quejas, reclamos y hacer seguimiento; enviar información o publicidad sobre productos/servicios; invitar a participar en concursos/actividades; encuestas de satisfacción; administración interna; estudios de mercado; comercio electrónico; entrega de pedidos, entre otros.</p>
            <div class="pp-title">1.4 Acceso y Transferencia</div>
            <p class="pp-text">El sitio podrá compartir con terceros sus datos personales bajo circunstancias limitadas (socios, proveedores de internet, administradores web, managers de redes sociales, call centers, mensajería, transportes, etc.) para cumplir finalidades antes descritas. También podrá facilitar información a organismos públicos o autoridades competentes si es requerido por ley.</p>
          '
        ],
        [
          'id' => 'segundo-modificacion',
          'title' => '2. Modificación de los T&C',
          'html' => '
            <p class="pp-text">El sitio se reserva el derecho de actualizar y/o modificar los Términos y Condiciones del uso del Marketplace, poniéndolos a disposición de los usuarios para su conocimiento con el objetivo final de mejorar el servicio de nuestra comunidad.</p>
          '
        ],
        [
          'id' => 'tercero-creacion-cuenta',
          'title' => '3. Creación de Cuenta',
          'html' => '
            <p class="pp-text">Para comprar productos y/o servicios en el sitio no es necesario estar registrado; sin embargo, aquel usuario que esté registrado o cree una cuenta podrá recibir beneficios adicionales.</p>
            <p class="pp-text">Un usuario podrá crear una cuenta completando el formulario que aparece en el sitio web. Al registrarse acepta que:</p>
            <ul class="pp-list">
              <li>Proveerá información básica y real sobre su persona/empresa.</li>
              <li>Actualizará esta información si cambia.</li>
              <li>Será responsable por la veracidad de la información y por mantener la confidencialidad de sus credenciales.</li>
            </ul>
          '
        ],
        [
          'id' => 'quinto-metodo-pago',
          'title' => '5. Método de Pago',
          'html' => '
            <p class="pp-text">Los productos y servicios ofrecidos sólo podrán ser pagados bajo la modalidad de pago en línea. Los pagos en línea son procesados por una pasarela de pagos; el uso de tarjetas se sujetará a lo establecido por su banco emisor y al marco contractual correspondiente.</p>
            <p class="pp-text">Los reembolsos por devoluciones se realizarán a través del mismo medio de pago utilizado, sujeto a las políticas del banco emisor.</p>
          '
        ],
        [
          'id' => 'sexto-consentimiento',
          'title' => '6. Formación del Consentimiento',
          'html' => '
            <p class="pp-text">Las empresas vendedoras realizan ofertas de bienes y servicios que pueden concretarse mediante la aceptación del usuario (en línea) y usando los mecanismos del sitio. Toda aceptación quedará sujeta a la condición suspensiva de validación de la transacción por parte del sitio.</p>
          '
        ],
        [
          'id' => 'septimo-envios',
          'title' => '7. Envíos',
          'html' => '
            <p class="pp-text">El sitio permite despachos a nivel nacional de productos. Estos estarán sujetos a las políticas de despacho de cada empresa vendedora. La accesibilidad de destinos será identificada por el usuario al momento de comprar.</p>
          '
        ],
        [
          'id' => 'octavo-devoluciones',
          'title' => '8. Devoluciones',
          'html' => '
            <p class="pp-text">Los procedimientos de devoluciones de cada artículo o producto están sujetos a las decisiones de cada empresa vendedora del Marketplace LYRIUM.</p>
          '
        ],
        [
          'id' => 'noveno-reembolsos',
          'title' => '9. Reembolsos',
          'html' => '
            <p class="pp-text">Los procedimientos de reembolso de cada producto y/o servicio están sujetos a las decisiones de cada empresa vendedora del Marketplace LYRIUM.</p>
          '
        ],
        [
          'id' => 'decimo-exoneracion',
          'title' => '10. Exoneración de Responsabilidad',
          'html' => '
            <p class="pp-text">LYRIUM se constituye como un Marketplace que reúne a vendedores y compradores; por tanto, no será responsable de las características del producto adquirido, su envío y/o despacho, los cuales corresponden a la empresa vendedora.</p>
          '
        ],
      ],
      'vendedor' => [
        [
          'id' => 'vend-primero',
          'title' => '1. Obligaciones del Vendedor',
          'html' => '
            <p class="pp-text">El vendedor se compromete a publicar información veraz y completa sobre sus productos/servicios, incluyendo precios, stock, condiciones, imágenes y restricciones aplicables.</p>
            <ul class="pp-list">
              <li>Cumplir con los plazos de despacho y la atención posventa ofrecida.</li>
              <li>Gestionar garantías, devoluciones y reclamos según su política y la normativa aplicable.</li>
              <li>Responder por la calidad, idoneidad y legalidad de los bienes/servicios ofrecidos.</li>
            </ul>
          '
        ],
      ],
    ];
    ?>

    <div class="pp-wrap"
      data-terms='<?php echo htmlspecialchars(json_encode($TERMINOS, JSON_UNESCAPED_UNICODE), ENT_QUOTES, "UTF-8"); ?>'
      data-config='<?php echo htmlspecialchars(json_encode([
        "cliente" => [
          "subtitle" => "TÉRMINOS Y CONDICIONES GENERALES APLICABLES A LOS CLIENTES",
          "pdfLabel" => "Descargar PDF Cliente",
          "pdfHref" => $PDF_CLIENTE,
          "pdfName" => "cliente.pdf"
        ],
        "vendedor" => [
          "subtitle" => "TÉRMINOS Y CONDICIONES GENERALES APLICABLES A LOS VENDEDORES",
          "pdfLabel" => "Descargar PDF Vendedor",
          "pdfHref" => $PDF_VENDEDOR,
          "pdfName" => "vendedor.pdf"
        ]
      ]), ENT_QUOTES, "UTF-8"); ?>'>

      <!-- HEADER "PILL" -->

      <div class="text-center mb-10">
        <div class="ly-pagehead">
          <span class="ly-pagehead__icon">
            <img src="https://img.icons8.com/ios-filled/96/ffffff/terms-and-conditions.png" alt="Términos">
          </span>
          <span class="ly-pagehead__title">Términos y condiciones</span>
        </div>
      </div>


      <p class="pp-sub">
        Revisa los términos aplicables al uso de <strong>LYRIUM BIO MARKETPLACE</strong>.
        Usa las pestañas para cambiar entre Cliente y Vendedor.
      </p>

      <!-- Toolbar con tabs (Estilo unificado) -->
      <div class="flex justify-center gap-4 mt-6 mb-2 flex-wrap">
        <button class="pp-badge tc-tab-btn active" data-mode="cliente" type="button">
          <i class="ph-user"></i><span>Del Cliente</span>
        </button>
        <button class="pp-badge tc-tab-btn" data-mode="vendedor" type="button">
          <i class="ph-storefront"></i><span>Del Vendedor</span>
        </button>
        <a id="tcPdfBtn" class="pp-badge pp-btn-premium" href="<?php echo htmlspecialchars($PDF_CLIENTE); ?>"
          download="cliente.pdf">
          <i class="ph-file-arrow-down"></i><span id="tcPdfLabel">Descargar PDF Cliente</span>
        </a>
      </div>

      <div class="pp-grid mt-6">

        <!-- NAV / ÍNDICE (Dinámico) -->
        <aside class="pp-nav hidden lg:block animate-in animate-delay-1">
          <h4>Contenido</h4>
          <div id="tcTOC"></div>
        </aside>

        <!-- CARD PRINCIPAL -->
        <section class="pp-card animate-in animate-delay-2">
          <div class="pp-card-inner">
            <div id="tcSubtitle" class="text-center text-xl font-black text-gray-800 mb-2 uppercase">
              TÉRMINOS Y CONDICIONES GENERALES APLICABLES A LOS CLIENTES
            </div>
            <div class="text-center text-sm text-gray-500 mb-8">-LYRIUM BIOMARKETPLACE-</div>

            <div id="tcContent"></div>

            <div class="pp-foot">
              Última actualización: <strong>2025</strong>. Al usar LYRIUM BIO MARKETPLACE, aceptas los términos y
              condiciones.
            </div>
          </div>
        </section>

      </div>
    </div>

    <script src="utils/js/terminoscondiciones.js"></script>

    <script>
      (function () {
        const tipo = document.getElementById('tipo_reclamo');
        if (!tipo) return; // sólo ejecutar si existe el formulario
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
    </script>


  </main>

  <?php include 'footer.php'; ?>