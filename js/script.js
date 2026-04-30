/**
 * PhiloMap - Core Interactivity and Animations 3.5
 */

document.addEventListener('DOMContentLoaded', () => {
    // --- HIDE LOADER ---
    const hideLoader = () => {
        const loader = document.getElementById('loader');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 500);
        }
    };
    
    if (document.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }
    setTimeout(hideLoader, 2000);

    // --- ACESSIBILIDADE AVANÇADA 3.5 ---
    
    // 1. Zen Mode (Foco Total)
    window.toggleZenMode = () => {
        const active = document.body.classList.toggle('zen-mode');
        localStorage.setItem('zenMode', active);
        announceToScreenReader(active ? 'Modo Zen Ativado. Foco na leitura.' : 'Modo Zen Desativado.');
        if (typeof exibirFeedback === 'function') {
            exibirFeedback(active ? 'Modo Zen: Foco na Razão' : 'Modo Normal Ativado', 'info');
        }
    };

    // 2. Announcer para Leitores de Tela
    const announceToScreenReader = (msg) => {
        let announcer = document.getElementById('aria-announcer');
        if (!announcer) {
            announcer = document.createElement('div');
            announcer.id = 'aria-announcer';
            announcer.setAttribute('aria-live', 'polite');
            announcer.style.cssText = 'position: absolute; left: -9999px;';
            document.body.appendChild(announcer);
        }
        announcer.innerText = msg;
    };

    // 3. Mouse Glow Interaction
    const glow = document.createElement('div');
    glow.className = 'mouse-glow';
    document.body.appendChild(glow);

    document.addEventListener('mousemove', (e) => {
        glow.style.left = e.clientX + 'px';
        glow.style.top = e.clientY + 'px';
    });

    // 4. Partículas de Pensamento (Background)
    const bgContainer = document.createElement('div');
    bgContainer.className = 'philosophy-bg';
    document.body.appendChild(bgContainer);

    for (let i = 0; i < 5; i++) {
        const shape = document.createElement('div');
        shape.className = 'shape';
        const size = Math.random() * 300 + 100;
        shape.style.width = size + 'px';
        shape.style.height = size + 'px';
        shape.style.left = Math.random() * 100 + '%';
        shape.style.top = Math.random() * 100 + '%';
        shape.style.animationDelay = (Math.random() * 10) + 's';
        bgContainer.appendChild(shape);
    }

    // --- ACESSIBILIDADE EXISTENTE ---
    window.changeFontSize = (size) => {
        const scales = { 'small': 0.85, 'medium': 1, 'large': 1.25 };
        const scale = scales[size] || 1;
        document.documentElement.style.setProperty('--font-scale', scale);
        localStorage.setItem('fontScale', scale);
        document.querySelectorAll('.font-controls button').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.querySelector(`.font-controls button[onclick*="${size}"]`);
        if (activeBtn) activeBtn.classList.add('active');
        announceToScreenReader(`Tamanho da fonte ajustado para ${size}`);
    };

    window.toggleDyslexiaFont = () => {
        const active = document.body.classList.toggle('dyslexia-font');
        localStorage.setItem('dyslexiaFont', active);
        announceToScreenReader(active ? 'Fonte para dislexia ativada' : 'Fonte padrão ativada');
        if (typeof exibirFeedback === 'function') {
            exibirFeedback(active ? 'Fonte para Dislexia Ativada' : 'Fonte Padrão Ativada', 'info');
        }
    };

    let ruler = document.querySelector('.reading-ruler');
    if (!ruler) {
        ruler = document.createElement('div');
        ruler.className = 'reading-ruler';
        document.body.appendChild(ruler);
    }

    window.toggleReadingRuler = () => {
        const isVisible = ruler.style.display === 'block';
        ruler.style.display = isVisible ? 'none' : 'block';
        localStorage.setItem('readingRuler', !isVisible);
        if (!isVisible) {
            document.addEventListener('mousemove', moveRuler);
        } else {
            document.removeEventListener('mousemove', moveRuler);
        }
        announceToScreenReader(isVisible ? 'Régua de leitura desativada' : 'Régua de leitura ativada');
    };

    const moveRuler = (e) => {
        ruler.style.top = (e.clientY - 15) + 'px';
    };

    // Restaurar Configurações
    const savedScale = localStorage.getItem('fontScale');
    if (savedScale) document.documentElement.style.setProperty('--font-scale', savedScale);
    if (localStorage.getItem('dyslexiaFont') === 'true') document.body.classList.add('dyslexia-font');
    if (localStorage.getItem('readingRuler') === 'true') toggleReadingRuler();
    if (localStorage.getItem('zenMode') === 'true') toggleZenMode();

    // --- TEXT SCRAMBLE ---
    class TextScramble {
        constructor(el) {
            this.el = el;
            this.chars = '!<>-_\\/[]{}—=+*^?#________';
            this.update = this.update.bind(this);
        }
        setText(newText) {
            const oldText = this.el.innerText;
            const length = Math.max(oldText.length, newText.length);
            const promise = new Promise((resolve) => this.resolve = resolve);
            this.queue = [];
            for (let i = 0; i < length; i++) {
                const from = oldText[i] || '';
                const to = newText[i] || '';
                const start = Math.floor(Math.random() * 40);
                const end = start + Math.floor(Math.random() * 40);
                this.queue.push({ from, to, start, end });
            }
            cancelAnimationFrame(this.frameRequest);
            this.frame = 0;
            this.update();
            return promise;
        }
        update() {
            let output = '';
            let complete = 0;
            for (let i = 0, n = this.queue.length; i < n; i++) {
                let { from, to, start, end, char } = this.queue[i];
                if (this.frame >= end) {
                    complete++;
                    output += to;
                } else if (this.frame >= start) {
                    if (!char || Math.random() < 0.28) {
                        char = this.randomChar();
                        this.queue[i].char = char;
                    }
                    output += `<span class="dud">${char}</span>`;
                } else {
                    output += from;
                }
            }
            this.el.innerHTML = output;
            if (complete === this.queue.length) {
                this.resolve();
            } else {
                this.frameRequest = requestAnimationFrame(this.update);
                this.frame++;
            }
        }
        randomChar() {
            return this.chars[Math.floor(Math.random() * this.chars.length)];
        }
    }

    const mainHeader = document.querySelector('h1');
    if (mainHeader) {
        const fx = new TextScramble(mainHeader);
        fx.setText(mainHeader.innerText);
    }

    // --- BUSCA FILOSÓFICA ---
    const searchInput = document.getElementById('searchConcepts');
    const conceptsList = document.getElementById('conceptsList');
    
    let searchOverlay = document.querySelector('.search-overlay');
    if (!searchOverlay) {
        searchOverlay = document.createElement('div');
        searchOverlay.className = 'search-overlay';
        searchOverlay.innerHTML = `
            <div class="search-overlay-content">
                <div class="search-overlay-header">
                    <h3>Resultados da Busca</h3>
                    <span class="close-overlay" aria-label="Fechar busca">&times;</span>
                </div>
                <div class="search-results-grid" id="searchResultsGrid" role="region" aria-live="polite"></div>
            </div>
        `;
        document.body.appendChild(searchOverlay);
    }

    const resultsGrid = document.getElementById('searchResultsGrid');
    const closeOverlay = searchOverlay.querySelector('.close-overlay');
    
    const keywordsMap = {
        "etica.html": { title: "Ética", desc: "O estudo da conduta humana e dos valores morais.", keywords: "dever moral virtude aristoteles kant certo errado agir" },
        "logica.html": { title: "Lógica", desc: "As leis do pensamento racional e da argumentação.", keywords: "razao pensamento silogismo verdade falacia calculo" },
        "moralismo.html": { title: "Moralismo", desc: "A aplicação rigorosa de normas morais na sociedade.", keywords: "costumes tradicao values sociedade conduta" },
        "existencialismo.html": { title: "Existencialismo", desc: "A liberdade individual, a escolha e a busca de sentido.", keywords: "liberdade angustia sartre camus escolha ser" },
        "estetica.html": { title: "Estética", desc: "A natureza do belo, da arte e da sensibilidade.", keywords: "belo arte sensivel juizo feio aparencia" },
        "metafisica.html": { title: "Metafísica", desc: "Os princípios fundamentais da realidade e do ser.", keywords: "ser realidade ontologia deus alma essencia" },
        "epistemologia.html": { title: "Epistemologia", desc: "A teoria do conhecimento e seus limites.", keywords: "conhecimento ciencia crença verdade razao" },
        "politica.html": { title: "Política", desc: "A organização da sociedade, o poder e a justiça.", keywords: "estado poder democracia justiça cidadania" },
        "linguagem.html": { title: "Linguagem", desc: "A relação entre pensamento, palavra e mundo.", keywords: "signo significado fala comunicacao wittgenstein" },
        "estoicismo.html": { title: "Estoicismo", desc: "A busca pela paz interior através da razão e virtude.", keywords: "senecca marco aurelio controle indiferença virtude" },
        "fenomenologia.html": { title: "Fenomenologia", desc: "O estudo das estruturas da consciência e experiência.", keywords: "husserl merleau-ponty consciencia percepcao fenomeno" },
        "cinismo.html": { title: "Cinismo", desc: "A vida em conformidade com a natureza e desprezo por convenções.", keywords: "diogenes natureza simplicidade honestidade" },
        "literatura.html": { title: "Literatura Filosófica", desc: "Obras essenciais, manuais e guias de estudo.", keywords: "livros leitura canone republica aristoteles manuais bibliografia" }
    };

    if (searchInput && conceptsList) {
        const clearBtn = document.createElement('span');
        clearBtn.className = 'search-clear';
        clearBtn.innerHTML = '&times;';
        clearBtn.setAttribute('aria-label', 'Limpar busca');
        
        const searchCount = document.createElement('span');
        searchCount.className = 'search-count';
        
        searchInput.parentNode.appendChild(clearBtn);
        searchInput.parentNode.appendChild(searchCount);

        const conceptItems = Array.from(conceptsList.getElementsByClassName('nav-item'));
        
        conceptItems.forEach(item => {
            const link = item.querySelector('a');
            item.dataset.originalText = link.innerText;
            const href = link.getAttribute('href').split('/').pop();
            const data = keywordsMap[href];
            item.dataset.keywords = data ? data.keywords : "";
            item.dataset.desc = data ? data.desc : "";
        });

        const filterConcepts = () => {
            const searchTerm = searchInput.value.toLowerCase().trim();
            clearBtn.style.display = searchTerm ? 'block' : 'none';

            let visibleCount = 0;
            resultsGrid.innerHTML = '';

            conceptItems.forEach(item => {
                const originalText = item.dataset.originalText;
                const keywords = item.dataset.keywords;
                const desc = item.dataset.desc;
                const link = item.querySelector('a');
                const hrefFile = link.getAttribute('href').split('/').pop();
                const absoluteHref = (window.location.pathname.includes('/pages/') ? '' : 'pages/') + hrefFile;

                if (originalText.toLowerCase().includes(searchTerm) || keywords.toLowerCase().includes(searchTerm)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                    if (searchTerm) {
                        const resultCard = document.createElement('div');
                        resultCard.className = 'search-result-card';
                        resultCard.innerHTML = `<h4>${originalText}</h4><p>${desc}</p><a href="${absoluteHref}">Explorar →</a>`;
                        resultsGrid.appendChild(resultCard);
                    }
                } else {
                    item.classList.add('hidden');
                }
            });

            if (searchTerm && visibleCount > 0) {
                searchOverlay.classList.add('active');
                searchCount.innerText = visibleCount;
                searchCount.classList.add('visible');
                announceToScreenReader(`${visibleCount} resultados encontrados para ${searchTerm}`);
            } else {
                searchOverlay.classList.remove('active');
                searchCount.classList.remove('visible');
            }
        };

        searchInput.addEventListener('input', filterConcepts);
        clearBtn.addEventListener('click', () => { searchInput.value = ''; filterConcepts(); searchInput.focus(); });
        closeOverlay.addEventListener('click', () => searchOverlay.classList.remove('active'));
    }

    // --- SCROLL & REVEAL ---
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // --- OUTROS ---
    const quotes = [
        { text: "A vida não examinada não vale a pena ser vivida.", author: "Sócrates" },
        { text: "Penso, logo existo.", author: "Descartes" },
        { text: "Não se pode banhar duas vezes no mesmo rio.", author: "Heráclito" },
        { text: "A felicidade é o único fim em si mesma.", author: "Aristóteles" }
    ];

    const quoteText = document.getElementById('dailyQuoteText');
    const quoteAuthor = document.getElementById('dailyQuoteAuthor');
    if (quoteText && quoteAuthor) {
        const quote = quotes[Math.floor(Math.random() * quotes.length)];
        quoteText.innerText = `"${quote.text}"`;
        quoteAuthor.innerText = `— ${quote.author}`;
    }

    // Inicializar Configurações Salvas
    if (localStorage.getItem('highContrast') === 'true') document.body.classList.add('high-contrast');
});
