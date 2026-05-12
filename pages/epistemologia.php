<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Epistemologia</title>
        <!-- PRECONNECT PARA VELOCIDADE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    
    <link rel="stylesheet" href="../assets/css/style.php">
    <link rel="stylesheet" href="../assets/css/sidebar-modern.php">
    
    <!-- SCRIPTS DEFER (NÃO BLOQUEANTES) -->
    <script src="../assets/js/db.php" defer></script>
    <script src="../assets/js/controller.php" defer></script>
    <script src="../assets/js/script.php" defer></script>
    <script src="../assets/js/sidebar.php" defer></script>
</head>
<body>
    <!-- LOADING SCREEN OPTIMIZED -->
    <div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fdfcf9; z-index: 10002; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.4s ease;">
        <div style="font-family: serif; font-size: 2rem; color: #c5a059; margin-bottom: 20px; letter-spacing: 5px; animation: pulse 1.5s infinite;">PHILOMAP</div>
        <div style="width: 150px; height: 1px; background: #e8e2d8; position: relative; overflow: hidden;">
            <div style="position: absolute; width: 40px; height: 100%; background: #c5a059; animation: loading 1.5s infinite linear;"></div>
        </div>
    </div>

    <script>
        // Script de segurança para remover o loader caso o JS principal demore
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(function() { loader.style.display = 'none'; }, 500);
            }
        });
        // Fallback de 3 segundos
        setTimeout(function() {
            var loader = document.getElementById('loader');
            if (loader && loader.style.display !== 'none') {
                loader.style.opacity = '0';
                setTimeout(function() { loader.style.display = 'none'; }, 500);
            }
        }, 3000);
    </script>

    <style>
        @keyframes pulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 1; } }
        @keyframes loading { 0% { left: -40px; } 100% { left: 150px; } }
    </style>

    <div class="reading-progress"></div>

    <div class="app-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="../index.html" class="sidebar-logo">
                <img src="../assets/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" loading="eager" width="280" height="280">
            </a>

            <nav class="nav-group">
                <span class="nav-label">Explorar</span>
                <div class="search-container">
                    <input type="text" id="searchConcepts" placeholder="Buscar verdade..." autocomplete="off">
                    <span class="search-icon">⚲</span>
                </div>
                
                <div class="nav-collapsible-header" id="conceptsToggle">
                    <span class="nav-label">Conceitos</span>
                    <span class="chevron">▼</span>
                </div>
                <ul class="nav-list collapsible-content" id="conceptsList">
                    <li class="nav-item"><a href="etica.html">Ética</a></li>
                    <li class="nav-item"><a href="logica.html">Lógica</a></li>
                    <li class="nav-item"><a href="moralismo.html">Moralismo</a></li>
                    <li class="nav-item"><a href="existencialismo.html">Existencialismo</a></li>
                    <li class="nav-item"><a href="estetica.html">Estética</a></li>
                    <li class="nav-item"><a href="metafisica.html">Metafísica</a></li>
                    <li class="nav-item"><a href="epistemologia.html" class="active">Epistemologia</a></li>
                    <li class="nav-item"><a href="politica.html">Política</a></li>
                    <li class="nav-item"><a href="linguagem.html">Linguagem</a></li>
                    <li class="nav-item"><a href="estoicismo.html">Estoicismo</a></li>
                    <li class="nav-item"><a href="fenomenologia.html">Fenomenologia</a></li>
                    <li class="nav-item"><a href="cinismo.html">Cinismo</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Estudos</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="literatura.html">Literatura</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Institucional</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="../index.html">Início</a></li>
                    <li class="nav-item"><a href="inscricao.html">Inscrição</a></li>
                </ul>
            </nav>

                        <div class="sidebar-footer">
                <div class="accessibility-controls">
                    <span class="nav-label" style="margin-bottom: 10px; display: block;">Acessibilidade</span>
                    <div class="font-controls">
                        <button onclick="changeFontSize('small')" title="Fonte Pequena">A-</button>
                        <button onclick="changeFontSize('medium')" title="Fonte Normal">A</button>
                        <button onclick="changeFontSize('large')" title="Fonte Grande">A+</button>
                    </div>
                    <button class="theme-toggle" onclick="toggleHighContrast()" style="margin-top: 10px; font-size: 0.7rem;">Alto Contraste</button>
                </div>
                <button class="theme-toggle" onclick="toggleTheme()" style="margin-top: 10px;">Mudar Tema</button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="breadcrumbs"><a href="../index.html">Início</a> / <span>Epistemologia</span></div>

            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Teoria do Conhecimento</span>
                    <h1>Epistemologia: Como Sabemos o que Sabemos?</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://img.elo7.com.br/product/zoom/3C239B3/quadro-reflexo-tranquilo-pintura-a-oleo-arte-natureza-arte.jpg" alt="Estudo e Conhecimento" loading="lazy" width="1200" height="800">
                </div>
                
                <p>A <strong>Epistemologia</strong> é o estudo da natureza, origem e limites do conhecimento humano. Ela investiga as condições que tornam o conhecimento possível e as bases sobre as quais construímos nossas certezas. Em um mundo de "fatos alternativos" e excesso de informação, a epistemologia nos ensina a distinguir entre opinião (<em>doxa</em>) e conhecimento fundamentado (<em>episteme</em>).</p>

                <p>O grande desafio epistemológico é entender a relação entre o sujeito que conhece e o objeto que é conhecido. Será que o mundo é exatamente como o percebemos, ou nossa mente molda a realidade?</p>

                <blockquote class="citacao-destaque">
                    "O que se sabe com certeza é pouco; o que se acredita é muito." — Bertrand Russell
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">A Grande Batalha</span>
                    <h2>Racionalismo vs. Empirismo</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Racionalismo (A Razão)</h3>
                        <p>Liderado por <strong>Descartes</strong> e <strong>Spinoza</strong>, defende que a razão pura é a fonte mais confiável do conhecimento. Acreditam em ideias inatas — verdades que já nascem conosco e que podem ser descobertas apenas pelo pensamento lógico, como a matemática.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Empirismo (A Experiência)</h3>
                        <p>Pensadores como <strong>John Locke</strong> e <strong>David Hume</strong> argumentam que a mente é uma "tábua rasa" ao nascer. Todo o conhecimento viria exclusivamente da experiência sensorial. <em>"Nada está no intelecto que não tenha passado antes pelos sentidos."</em></p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Criticismo (A Síntese)</h3>
                        <p><strong>Immanuel Kant</strong> revolucionou a epistemologia ao unir as duas correntes. Para ele, o conhecimento começa com a experiência (empirismo), mas é organizado por estruturas inatas da nossa mente (racionalismo), como o tempo e o espaço.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Falsificacionismo</h3>
                        <p><strong>Karl Popper</strong> propôs que a ciência não avança provando verdades absolutas, mas tentando refutar (falsificar) teorias. Uma teoria é científica apenas se puder ser testada e, potencialmente, provada falsa.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Exploradores da Verdade</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/73/Frans_Hals_-_Portret_van_Ren%C3%A9_Descartes.jpg" alt="Descartes" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">René Descartes</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O racionalista que buscou uma base indestrutível para o saber, encontrando-a na própria consciência pensante.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/JohnLocke.png" alt="John Locke" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">John Locke</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O pai do empirismo moderno. Defendeu que nossas ideias são formadas por impressões sensoriais e reflexão sobre elas.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ea/David_Hume.jpg" alt="David Hume" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">David Hume</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O cético radical que questionou até a causalidade, forçando a filosofia a repensar a validade das leis científicas.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/43/Karl_Popper.jpg" alt="Karl Popper" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Karl Popper</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O filósofo da ciência que definiu o critério de demarcação entre o que é ciência e o que é pseudociência.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Ciência e Paradigmas</span>
                    <h2>A Estrutura das Revoluções Científicas</h2>
                </header>

                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80" alt="Laboratório e Descoberta" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>Thomas Kuhn introduziu a ideia de <strong>paradigmas</strong>. A ciência não evolui de forma linear e tranquila, mas através de crises que levam a rupturas totais de visão de mundo — as revoluções científicas. Quando um paradigma não consegue mais explicar anomalias, ele cai, dando lugar a um novo (como a transição da física de Newton para a de Einstein).</p>
                    
                    <p style="margin-top: 1rem;">O PhiloMap nos lembra: o conhecimento é uma construção humana em constante transformação. Estar aberto à mudança de paradigma é a marca de uma mente verdadeiramente filosófica.</p>
                </div>
            </section>

            <footer style="text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.8rem;">
                <p>&copy; 2026 PhiloMap — Todos os direitos reservados.</p>
            </footer>
        </main>
    </div>

        <!-- Scripts -->
    <script src="../assets/js/db.php" defer></script>
    <script src="../assets/js/controller.php" defer></script>
    <script src="../assets/js/script.php" defer></script>
</body>
</html>

