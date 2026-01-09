document.addEventListener('DOMContentLoaded', function () {
    // Ahora leemos los datos desde el atributo data- del contenedor principal
    const elWrap = document.querySelector('.pp-wrap');
    if (!elWrap) return;

    const DATA = JSON.parse(elWrap.getAttribute('data-terms') || '{}');
    const MODE_CONF = JSON.parse(elWrap.getAttribute('data-config') || '{}');

    const elTabs = Array.from(document.querySelectorAll('[data-mode]'));
    const elSubtitle = document.getElementById('tcSubtitle');
    const elPdfBtn = document.getElementById('tcPdfBtn');
    const elPdfLabel = document.getElementById('tcPdfLabel');
    const elContent = document.getElementById('tcContent');
    const elTOC = document.getElementById('tcTOC');
    const cardInner = document.querySelector('.pp-card-inner');

    let currentSelected = null;

    function setupNavLinks() {
        const navLinks = document.querySelectorAll('.pp-nav a');
        const sections = document.querySelectorAll('.pp-section');

        // CLICK BEHAVIOR: Smooth Scroll + Highlight
        navLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetEl = document.getElementById(targetId);

                if (targetEl) {
                    // Remove highlight from previous
                    document.querySelectorAll('.highlight-target').forEach(el => el.classList.remove('highlight-target'));

                    // Add highlight
                    targetEl.classList.add('highlight-target');

                    // Scroll
                    const offset = 160;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = targetEl.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Remove highlight class after animation finish (optional, CSS handles it with forwards)
                    setTimeout(() => {
                        targetEl.classList.remove('highlight-target');
                    }, 2500);
                }
            });
        });

        // SCROLL BEHAVIOR: Intersection Observer for TOC highlight
        const observerOptions = {
            root: null,
            rootMargin: '-150px 0px -70% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    const activeLink = document.querySelector(`.pp-nav a[href="#${id}"]`);

                    if (activeLink) {
                        navLinks.forEach(l => l.classList.remove('selected'));
                        activeLink.classList.add('selected');
                    }
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));
    }

    function render(mode) {
        if (!MODE_CONF[mode]) return;

        elTabs.forEach(b => b.classList.toggle('active', b.dataset.mode === mode));
        elSubtitle.textContent = MODE_CONF[mode].subtitle;
        elPdfLabel.textContent = MODE_CONF[mode].pdfLabel;

        if (elPdfBtn) {
            elPdfBtn.setAttribute('href', MODE_CONF[mode].pdfHref);
            elPdfBtn.setAttribute('download', MODE_CONF[mode].pdfName);
        }

        const sections = DATA[mode] || [];

        elContent.innerHTML = sections.map(s => `
      <div class="pp-section" id="${s.id}">
        <div class="pp-h"><span>${s.title}</span></div>
        ${s.html}
      </div>
    `).join('');

        elTOC.innerHTML = sections.map(s => `
      <a href="#${s.id}" class="pp-nav-link" data-id="${s.id}">
        <span class="flex-1">${s.title}</span>
        <i class="ph-caret-right text-xs opacity-0 -translate-x-2 transition-all"></i>
      </a>
    `).join('');

        setupNavLinks();
    }

    elTabs.forEach(btn => btn.addEventListener('click', () => {
        render(btn.dataset.mode);
        // Volver arriba al cambiar de pestaña
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }));

    // Renderizado inicial
    if (elTabs.length > 0) {
        render('cliente');
    }
});
