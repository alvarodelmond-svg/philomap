/**
 * PhiloMap - Animations and Interactivity
 */

document.addEventListener('DOMContentLoaded', () => {
    const oracleQuotes = [
        "PhiloMap: A jornada é o destino.",
        "A dúvida é o princípio da sabedoria.",
        "Conhece-te a ti mesmo.",
        "Viver sem filosofar é o que se chama ter os olhos fechados sem nunca tentar abri-los."
    ];
    console.log(`%c${oracleQuotes[Math.floor(Math.random() * oracleQuotes.length)]}`, "color: #c5a059; font-size: 1.2rem; font-weight: bold;");

    // --- BUSCA FILOSÓFICA PRO (A Busca pela Verdade) ---
    const searchInput = document.getElementById('searchConcepts');
    const conceptsList = document.getElementById('conceptsList');
    
    if (searchInput && conceptsList) {
        // Inserir elementos dinâmicos
        const clearBtn = document.createElement('span');
        clearBtn.className = 'search-clear';
        clearBtn.innerHTML = '&times;';
        
        const searchCount = document.createElement('span');
        searchCount.className = 'search-count';
        
        searchInput.parentNode.appendChild(clearBtn);
        searchInput.parentNode.appendChild(searchCount);

        // Placeholders dinâmicos (Ciclo da Sabedoria)
        const placeholders = ["Buscar verdade...", "Buscar sabedoria...", "Buscar caminhos...", "Buscar a essência..."];
        let pIndex = 0;
        setInterval(() => {
            if (document.activeElement !== searchInput && !searchInput.value) {
                pIndex = (pIndex + 1) % placeholders.length;
                searchInput.placeholder = placeholders[pIndex];
            }
        }, 4000);

        // Mapeamento de palavras-chave para busca inteligente
        const keywordsMap = {
            "etica.html": "dever moral virtude aristoteles kant certo errado agir",
            "logica.html": "razao pensamento silogismo verdade falacia calculo",
            "moralismo.html": "costumes tradicao valores sociedade conduta",
            "existencialismo.html": "liberdade angustia sartre camus escolha ser",
            "estetica.html": "belo arte sensivel juizo feio aparencia",
            "metafisica.html": "ser realidade ontologia deus alma essencia",
            "epistemologia.html": "conhecimento ciencia crença verdade razao",
            "politica.html": "estado poder democracia justiça cidadania",
            "linguagem.html": "signo significado fala comunicacao wittgenstein"
        };

        const conceptItems = Array.from(conceptsList.getElementsByClassName('nav-item'));
        
        // Guardar o texto original para restaurar após o highlight
        conceptItems.forEach(item => {
            const link = item.querySelector('a');
            item.dataset.originalText = link.innerText;
            const href = link.getAttribute('href').split('/').pop();
            item.dataset.keywords = keywordsMap[href] || "";
        });

        const filterConcepts = () => {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            // Mostrar/Esconder botão de limpar
            clearBtn.style.display = searchTerm ? 'block' : 'none';

            let visibleCount = 0;
            conceptItems.forEach(item => {
                const originalText = item.dataset.originalText;
                const keywords = item.dataset.keywords;
                const link = item.querySelector('a');

                const matchesText = originalText.toLowerCase().includes(searchTerm);
                const matchesKeywords = keywords.toLowerCase().includes(searchTerm);

                if (matchesText || matchesKeywords) {
                    item.classList.remove('hidden');
                    visibleCount++;
                    
                    // Highlight apenas se houver termo de busca e se o texto em si der match
                    if (searchTerm && matchesText) {
                        const regex = new RegExp(`(${searchTerm})`, 'gi');
                        link.innerHTML = originalText.replace(regex, '<span class="search-match">$1</span>');
                    } else {
                        link.innerText = originalText;
                    }
                } else {
                    item.classList.add('hidden');
                }
            });

            // Atualizar Contador de Resultados
            if (searchTerm && visibleCount > 0) {
                searchCount.innerText = visibleCount;
                searchCount.classList.add('visible');
            } else {
                searchCount.classList.remove('visible');
            }

            // Mensagem de "No Results"
            let noResults = document.getElementById('noResults');
            if (visibleCount === 0 && searchTerm !== '') {
                if (!noResults) {
                    noResults = document.createElement('li');
                    noResults.id = 'noResults';
                    noResults.style.cssText = 'color: var(--text-dim); font-size: 0.8rem; text-align: center; margin-top: 20px; font-style: italic; animation: fadeIn 0.5s forwards;';
                    noResults.innerText = 'A verdade não foi encontrada...';
                    conceptsList.appendChild(noResults);
                }
            } else if (noResults) {
                noResults.remove();
            }
        };

        searchInput.addEventListener('input', filterConcepts);

        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            filterConcepts();
            searchInput.focus();
        });

        // Atalhos de Teclado
        document.addEventListener('keydown', (e) => {
            // '/' focar na busca
            if (e.key === '/' && document.activeElement !== searchInput) {
                e.preventDefault();
                searchInput.focus();
            }

            // 'Enter' navegar se houver apenas um resultado
            if (e.key === 'Enter' && document.activeElement === searchInput) {
                const visibleLinks = conceptsList.querySelectorAll('.nav-item:not(.hidden) a');
                if (visibleLinks.length === 1) {
                    window.location.href = visibleLinks[0].href;
                }
            }

            // 'Escape' limpar e sair da busca
            if (e.key === 'Escape' && document.activeElement === searchInput) {
                searchInput.value = '';
                filterConcepts();
                searchInput.blur();
            }
        });
    }

    // --- TEMPORIZADOR DE INATIVIDADE (Angústia Existencial) ---
    let idleTime = 0;
    const idleInterval = setInterval(() => {
        idleTime++;
        if (idleTime > 30) { // 30 segundos
            showExistentialMessage();
            idleTime = 0;
        }
    }, 1000);

    function showExistentialMessage() {
        const msg = document.createElement('div');
        msg.style.cssText = `
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            background: rgba(26, 26, 26, 0.9); color: var(--gold); padding: 10px 20px;
            border-radius: 20px; font-size: 0.8rem; font-style: italic; z-index: 10000;
            animation: fadeInOut 5s forwards; border: 1px solid var(--gold);
        `;
        msg.innerText = "O silêncio é a língua de Deus, o resto é apenas uma tradução pobre.";
        document.body.appendChild(msg);
        setTimeout(() => msg.remove(), 5000);
    }

    document.addEventListener('mousemove', () => idleTime = 0);
    document.addEventListener('keypress', () => idleTime = 0);

    // --- ELEMENTOS DINÂMICOS ---
    
    // 1. O Rio de Heráclito (Barra de Progresso)
    const river = document.createElement('div');
    river.className = 'heraclitus-river';
    document.body.appendChild(river);

    // 2. O Eterno Retorno (Botão Voltar ao Topo)
    const backToTop = document.createElement('div');
    backToTop.className = 'back-to-top';
    backToTop.innerHTML = '↑';
    backToTop.title = 'O Eterno Retorno';
    document.body.appendChild(backToTop);

    // --- LÓGICA DE SCROLL ---
    window.addEventListener('scroll', () => {
        // Progresso do Rio
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        river.style.width = scrolled + "%";

        // Visibilidade do Eterno Retorno
        if (winScroll > 500) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // --- REVEAL ON SCROLL ---
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

    revealElements.forEach(el => revealObserver.observe(el));

    // --- RECOMENDAÇÕES (O Oráculo) ---
    const botaoRecomendacao = document.getElementById("botaoRecomendacao");
    const areaRecomendacao = document.getElementById("recomendacao");

    const recomendacoes = [
        { tipo: "Livro", titulo: "O Estrangeiro", autor: "Albert Camus" },
        { tipo: "Filme", titulo: "Matrix", autor: "Irmãs Wachowski" },
        { tipo: "Livro", titulo: "Apologia de Sócrates", autor: "Platão" },
        { tipo: "Podcast", titulo: "Filosofia Pop", autor: "Episódio sobre Existencialismo" },
        { tipo: "Filme", titulo: "Clube da Luta", autor: "David Fincher" },
        { tipo: "Livro", titulo: "O Príncipe", autor: "Nicolau Maquiavel" },
        { tipo: "Filme", titulo: "O Show de Truman", autor: "Peter Weir" },
        { tipo: "Livro", titulo: "Meditações", autor: "Marco Aurélio" }
    ];

    if (botaoRecomendacao && areaRecomendacao) {
        botaoRecomendacao.addEventListener("click", () => {
            const item = recomendacoes[Math.floor(Math.random() * recomendacoes.length)];
            areaRecomendacao.style.opacity = 0;
            setTimeout(() => {
                areaRecomendacao.innerHTML = `<strong>${item.tipo}</strong>: ${item.titulo} <br> <small>${item.autor}</small>`;
                areaRecomendacao.style.opacity = 1;
                areaRecomendacao.style.transition = "opacity 0.5s ease";
            }, 200);
        });
    }

    // --- EASTER EGG: IRONIA SOCRÁTICA ---
    // Questiona o usuário ao clicar em elementos de texto
    const pElements = document.querySelectorAll('.card p');
    pElements.forEach(p => {
        p.addEventListener('click', function(e) {
            if (Math.random() > 0.7) {
                const rect = this.getBoundingClientRect();
                const tooltip = document.createElement('div');
                tooltip.style.position = 'fixed';
                tooltip.style.top = (e.clientY - 40) + 'px';
                tooltip.style.left = e.clientX + 'px';
                tooltip.style.background = 'var(--accent)';
                tooltip.style.color = 'var(--gold)';
                tooltip.style.padding = '5px 10px';
                tooltip.style.borderRadius = '5px';
                tooltip.style.fontSize = '0.8rem';
                tooltip.style.zIndex = '10000';
                tooltip.style.pointerEvents = 'none';
                tooltip.innerText = "Mas o que é a verdade?";
                document.body.appendChild(tooltip);
                
                setTimeout(() => tooltip.remove(), 2000);
            }
        });
    });

    // --- MUDANÇA DE TEMA (Lógica mantida para o HTML) ---
    window.toggleTheme = function() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    };

    // Carregar tema salvo
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
});
