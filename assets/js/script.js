/**
 * PhiloMap - Core Interactivity and Animations 3.6
 */

const PhiloMap = {
    initPage() {
        console.log('Initializing Page Components...');
        
        // --- SCROLL & REVEAL ---
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // --- TEXT SCRAMBLE ---
        const mainHeader = document.querySelector('h1');
        if (mainHeader) {
            const fx = new this.TextScramble(mainHeader);
            fx.setText(mainHeader.innerText);
        }

        // --- BUSCA FILOSÓFICA (Re-vincular se necessário ou garantir que funciona globalmente) ---
        this.setupSearch();

        // --- CITAÇÃO DO DIA ---
        this.setupQuotes();
        
        // --- OUTROS COMPONENTES ---
        // (Adicione aqui outras inicializações necessárias após a troca de conteúdo)
    },

    // Movemos TextScramble para dentro do objeto
    TextScramble: class {
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
    },

    setupSearch() {
        const searchInput = document.getElementById('searchConcepts');
        if (!searchInput || searchInput.dataset.initialized) return;

        // Marcar como inicializado para não duplicar eventos no sidebar persistente
        searchInput.dataset.initialized = 'true';
        
        const conceptsList = document.getElementById('conceptsList');
        let searchOverlay = document.querySelector('.search-overlay');
        
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

        const resultsGrid = document.getElementById('searchResultsGrid');
        const closeOverlay = searchOverlay.querySelector('.close-overlay');
        
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
                
                // Melhoria na resolução do path para o roteador SPA
                const isRoot = !window.location.pathname.includes('/pages/');
                const absoluteHref = (isRoot ? 'pages/' : '') + hrefFile.replace('../', '');

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
            } else {
                searchOverlay.classList.remove('active');
                searchCount.classList.remove('visible');
            }
        };

        searchInput.addEventListener('input', filterConcepts);
        clearBtn.addEventListener('click', () => { searchInput.value = ''; filterConcepts(); searchInput.focus(); });
        closeOverlay.addEventListener('click', () => searchOverlay.classList.remove('active'));
    },

    setupQuotes() {
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
    }
};

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

    // --- GLOBAL SETUP (ONLY ONCE) ---
    const setupGlobal = () => {
        // Mouse Glow Interaction
        const glow = document.createElement('div');
        glow.className = 'mouse-glow';
        document.body.appendChild(glow);

        document.addEventListener('mousemove', (e) => {
            glow.style.left = e.clientX + 'px';
            glow.style.top = e.clientY + 'px';
        });

        // Partículas de Pensamento (Background)
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

        // Search Overlay (Garantir que existe)
        if (!document.querySelector('.search-overlay')) {
            const searchOverlay = document.createElement('div');
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
    };

    setupGlobal();
    PhiloMap.initPage();

    // --- ACESSIBILIDADE AVANÇADA ---
    window.toggleZenMode = () => {
        const active = document.body.classList.toggle('zen-mode');
        localStorage.setItem('zenMode', active);
    };

    window.changeFontSize = (size) => {
        const scales = { 'small': 0.85, 'medium': 1, 'large': 1.25 };
        const scale = scales[size] || 1;
        document.documentElement.style.setProperty('--font-scale', scale);
        localStorage.setItem('fontScale', scale);
    };

    window.toggleDyslexiaFont = () => {
        const active = document.body.classList.toggle('dyslexia-font');
        localStorage.setItem('dyslexiaFont', active);
    };

    // Restaurar Configurações
    const savedScale = localStorage.getItem('fontScale');
    if (savedScale) document.documentElement.style.setProperty('--font-scale', savedScale);
    if (localStorage.getItem('dyslexiaFont') === 'true') document.body.classList.add('dyslexia-font');
    if (localStorage.getItem('zenMode') === 'true') document.body.classList.add('zen-mode');
});

window.PhiloMap = PhiloMap;

