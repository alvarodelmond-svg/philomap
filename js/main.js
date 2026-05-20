
/**
 * PhiloMap - JavaScript Principal Consolidado
 * Unifica o DB local, o controller, o core da página, sidebar e roteador.
 */

const DB_NAME = 'PhiloMapDB';
const DB_VERSION = 1;
const STORE_NAME = 'inscricoes';

function iniciarBanco() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NAME, DB_VERSION);

        request.onupgradeneeded = (event) => {
            const db = event.target.result;
            if (!db.objectStoreNames.contains(STORE_NAME)) {
                db.createObjectStore(STORE_NAME, { keyPath: 'id', autoIncrement: true });
            }
        };

        request.onsuccess = (event) => resolve(event.target.result);
        request.onerror = (event) => reject('Erro ao abrir banco: ' + event.target.error);
    });
}

async function adicionarItem(dado) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readwrite');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.add(dado);

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao adicionar item: ' + request.error);
    });
}

async function buscarItens() {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readonly');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.getAll();

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao buscar itens: ' + request.error);
    });
}

async function deletarItem(id) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readwrite');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.delete(Number(id));

        request.onsuccess = () => resolve();
        request.onerror = () => reject('Erro ao deletar item: ' + request.error);
    });
}

const PhiloController = {
    init() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else if (savedTheme === 'high-contrast') {
            document.body.classList.add('high-contrast');
        }

        if (localStorage.getItem('readingRuler') === 'true') {
            this.toggleReadingRuler(true);
        }

        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            `;
            document.body.appendChild(container);
        }

        this.initDynamicComponents();
    },

    initDynamicComponents() {
        console.log('Initializing Controller Dynamic Components...');
        const form = document.getElementById('formCadastro');
        if (form && !form.dataset.listenerAttached) {
            form.addEventListener('submit', lidarComSubmissao);
            form.dataset.listenerAttached = 'true';
        }

        if (document.getElementById('listaDados')) {
            atualizarListaUI();
        }
    },

    toggleReadingRuler(force = null) {
        let ruler = document.querySelector('.reading-ruler');
        if (!ruler) {
            ruler = document.createElement('div');
            ruler.className = 'reading-ruler';
            document.body.appendChild(ruler);
        }

        const isActive = force !== null ? force : (ruler.style.display !== 'block');
        ruler.style.display = isActive ? 'block' : 'none';
        localStorage.setItem('readingRuler', isActive);

        if (isActive) {
            const moveRuler = (e) => {
                ruler.style.top = (e.clientY - 15) + 'px';
            };
            document.addEventListener('mousemove', moveRuler);
            ruler._moveRuler = moveRuler;
        } else if (ruler._moveRuler) {
            document.removeEventListener('mousemove', ruler._moveRuler);
        }
    }
};

document.addEventListener('DOMContentLoaded', () => PhiloController.init());

function toggleTheme() {
    document.body.classList.remove('high-contrast');
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    exibirFeedback(isDark ? 'Modo Escuro Ativado' : 'Modo Claro Ativado', 'info');
}

function toggleHighContrast() {
    document.body.classList.remove('dark-mode');
    const isHC = document.body.classList.toggle('high-contrast');
    localStorage.setItem('theme', isHC ? 'high-contrast' : 'light');
    exibirFeedback(isHC ? 'Alto Contraste Ativado' : 'Modo Padrão Ativado', 'info');
}

function toggleReadingRuler() {
    PhiloController.toggleReadingRuler();
}

function exibirFeedback(mensagem, tipo = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    const cores = { success: 'var(--gold)', error: '#ff4444', info: 'var(--accent)' };
    toast.style.cssText = `background: var(--surface); color: var(--text-main); padding: 15px 25px; border-radius: 12px; border-left: 5px solid ${cores[tipo] || cores.info}; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 0.9rem; font-weight: 600; transform: translateX(120%); transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1); display: flex; align-items: center; gap: 10px; min-width: 250px;`;
    const icon = { success: '✓', error: '✕', info: 'ℹ' };
    toast.innerHTML = `<span>${icon[tipo] || '•'}</span> ${mensagem}`;
    container.appendChild(toast);
    setTimeout(() => { toast.style.transform = 'translateX(0)'; }, 100);
    setTimeout(() => { toast.style.transform = 'translateX(120%)'; setTimeout(() => toast.remove(), 500); }, 4000);
}

async function lidarComSubmissao(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const interesses = Array.from(form.querySelectorAll('input[name="interesse"]:checked')).map(cb => cb.value);
    const novoDado = { nome: formData.get('nome'), email: formData.get('email'), nascimento: formData.get('nascimento'), interesse: interesses, dataCriacao: new Date().toLocaleString('pt-BR') };
    try { if (typeof adicionarItem === 'function') { await adicionarItem(novoDado); form.reset(); exibirFeedback('Inscrição realizada com sucesso!', 'success'); if (document.getElementById('listaDados')) await atualizarListaUI(); } } catch (error) { exibirFeedback('Erro ao processar inscrição.', 'error'); }
}

async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container || typeof buscarItens !== 'function') return;
    try {
        const itens = await buscarItens();
        if (itens.length === 0) { container.innerHTML = '<p style="text-align:center; color: var(--text-dim); padding: 40px;">Ainda não há exploradores registrados.</p>'; return; }
        container.innerHTML = `<div style="display: grid; gap: 20px; margin-top: 30px; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">${itens.map(item => `<div class="reveal active" style="background: var(--surface); padding: 25px; border-radius: 20px; border: 1px solid var(--border); transition: 0.3s; position: relative; overflow: hidden;"><div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--gold);"></div><h3 style="font-size: 1.1rem; margin-bottom: 5px;">${item.nome}</h3><p style="font-size: 0.8rem; color: var(--text-dim); margin-bottom: 15px;">${item.email}</p><div style="display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 20px;">${item.interesse.map(int => `<span style="font-size: 0.6rem; background: var(--bg); padding: 4px 8px; border-radius: 5px; border: 1px solid var(--border); color: var(--gold); font-weight: bold;">${int.toUpperCase()}</span>`).join('')}</div><button onclick="removerRegistro(${item.id})" style="background: transparent; border: 1px solid #ff4444; color: #ff4444; padding: 5px 12px; border-radius: 8px; font-size: 0.7rem; cursor: pointer; transition: 0.3s;">REMOVER</button></div>`).join('')}</div>`;
    } catch (error) { container.innerHTML = '<p>Erro ao carregar o mapa de membros.</p>'; }
}

async function removerRegistro(id) {
    if (confirm('Deseja realmente remover este registro da história do PhiloMap?')) {
        try { await deletarItem(id); exibirFeedback('Registro removido.', 'success'); atualizarListaUI(); } catch (error) { exibirFeedback('Erro ao remover registro.', 'error'); }
    }
}

const PhiloMap = {
    initPage() {
        console.log('Initializing Page Components...');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        const mainHeader = document.querySelector('h1');
        if (mainHeader) {
            const fx = new this.TextScramble(mainHeader);
            fx.setText(mainHeader.innerText);
        }

        this.setupSearch();
        this.setupQuotes();
    },

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
                const isRoot = !window.location.pathname.includes('/pages/');
                const absoluteHref = (isRoot ? 'pages/' : '') + hrefFile;

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

    const setupGlobal = () => {
        const glow = document.createElement('div');
        glow.className = 'mouse-glow';
        document.body.appendChild(glow);

        document.addEventListener('mousemove', (e) => {
            glow.style.left = e.clientX + 'px';
            glow.style.top = e.clientY + 'px';
        });

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
    PhiloMap.initPage(); // Inicia as animações e componentes na primeira carga
    
    // Fallback para garantir que reveal funcione se houver delay
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('active'));
    }, 2000);

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

    const savedScale = localStorage.getItem('fontScale');
    if (savedScale) document.documentElement.style.setProperty('--font-scale', savedScale);
    if (localStorage.getItem('dyslexiaFont') === 'true') document.body.classList.add('dyslexia-font');
    if (localStorage.getItem('zenMode') === 'true') document.body.classList.add('zen-mode');
});

window.PhiloMap = PhiloMap;
window.PhiloController = PhiloController;

const Router = {
    init() {
        this.normalizeSidebarLinks();

        document.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (this.isInternalLink(link)) {
                e.preventDefault();
                this.navigate(link.href);
            }
        });

        window.addEventListener('popstate', () => {
            this.navigate(window.location.href, false);
        });

        console.log('Router initialized');
    },

    normalizeSidebarLinks() {
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        sidebarLinks.forEach(link => {
            const absoluteUrl = link.href;
            link.setAttribute('href', absoluteUrl);
        });
    },

    isInternalLink(link) {
        return link &&
               link.href &&
               link.href.startsWith(window.location.origin) &&
               !link.hash &&
               link.target !== '_blank' &&
               (link.href.endsWith('.php') || link.href.endsWith('.html') || link.href.endsWith('/'));
    },

    async navigate(url, addToHistory = true) {
        const mainContent = document.getElementById('main-content');
        if (!mainContent) return;

        mainContent.style.opacity = '0';
        mainContent.style.transform = 'translateY(20px)';

        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Falha ao carregar página');

            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newMain = doc.querySelector('#main-content');
            const newSidebar = doc.querySelector('.sidebar');
            const newTitle = doc.title;

            if (!newMain) throw new Error('Conteúdo principal não encontrado na página de destino');

            setTimeout(() => {
                mainContent.innerHTML = newMain.innerHTML;
                if (newSidebar) {
                    const currentSidebar = document.querySelector('.sidebar');
                    if (currentSidebar) currentSidebar.innerHTML = newSidebar.innerHTML;
                }
                document.title = newTitle;

                if (addToHistory) {
                    history.pushState({ url }, newTitle, url);
                }

                window.scrollTo({ top: 0, behavior: 'smooth' });

                if (window.PhiloMap && typeof window.PhiloMap.initPage === 'function') {
                    window.PhiloMap.initPage();
                }
                if (window.PhiloController && typeof window.PhiloController.initDynamicComponents === 'function') {
                    window.PhiloController.initDynamicComponents();
                }

                mainContent.style.opacity = '1';
                mainContent.style.transform = 'translateY(0)';
                this.updateActiveLinks(url);
            }, 300);

        } catch (error) {
            console.error('Erro na navegação:', error);
            if (addToHistory) window.location.href = url;
        }
    },

    updateActiveLinks(url) {
        const links = document.querySelectorAll('.sidebar .nav-item a');
        const currentPath = new URL(url).pathname;

        links.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            if (currentPath === linkPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
};

window.PhiloRouter = Router;

document.addEventListener('DOMContentLoaded', () => Router.init());
