<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Metafísica</title>
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
                    <li class="nav-item"><a href="metafisica.html" class="active">Metafísica</a></li>
                    <li class="nav-item"><a href="epistemologia.html">Epistemologia</a></li>
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

            <div class="breadcrumbs"><a href="../index.html">Início</a> / <span>Metafísica</span></div>

                        <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">A Natureza do Ser</span>
                    <h1>Metafísica: Além do Visível</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1464802686167-b939a6910659?auto=format&fit=crop&w=1200&q=80" alt="Cosmos e Realidade Metafísica" loading="lazy" width="1200" height="800">
                </div>
                
                <p>A <strong>Metafísica</strong> é o ramo fundamental da filosofia que estuda a natureza última da realidade, do ser e do mundo. Ela vai além das observações físicas imediatas para investigar os primeiros princípios e as causas fundamentais de todas as coisas. O termo, que significa literalmente "depois da física", lida com questões que a ciência empírica não pode responder sozinha: O que é a existência? Existe uma alma? O que é o tempo?</p>

                <p>Para os filósofos metafísicos, a realidade que vemos é apenas a superfície. Por baixo dela, existem estruturas, leis e essências que sustentam tudo o que há. É a busca pela "Filosofia Primeira".</p>

                <blockquote class="citacao-destaque">
                    "Todos os homens, por natureza, desejam saber." — Aristóteles
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Pilares</span>
                    <h2>Os Fundamentos da Realidade</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Ontologia (O Ser)</h3>
                        <p>O estudo do <em>ser</em> enquanto ser. Ela pergunta: o que significa existir? Quais são as categorias fundamentais de tudo o que há no universo? Filósofos como Heidegger trouxeram a ontologia para o centro do debate moderno, questionando o esquecimento do ser na técnica.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Dualismo Mente-Corpo</h3>
                        <p><strong>René Descartes</strong> propôs que a realidade é composta por duas substâncias distintas: a <em>res extensa</em> (matéria física) e a <em>res cogitans</em> (mente ou alma). Esse dualismo moldou séculos de debates sobre a consciência e a identidade humana.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Teoria das Ideias</h3>
                        <p>Platão argumentava que o mundo que percebemos pelos sentidos é apenas uma sombra de uma realidade superior, o Mundo das Ideias. Lá residem as formas perfeitas, eternas e imutáveis de todas as coisas, das quais as coisas terrenas são meras cópias.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Mônadas e Harmonia</h3>
                        <p><strong>Leibniz</strong> visualizou o universo composto por "mônadas" — unidades simples de substância, cada uma refletindo o universo inteiro de sua própria perspectiva, coordenadas em uma harmonia pré-estabelecida por Deus.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Grandes Arquitetos da Realidade</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Plato_Silanion_Musei_Capitolini_MC1377.jpg" alt="Platão" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Platão</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O idealista supremo. Sua metafísica nos convida a transcender o mundo material em busca da verdade absoluta e eterna.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Aristotle_Altemps_Inv8575.jpg" alt="Aristóteles" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Aristóteles</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O realista. Focou na substância, na potência e no ato, buscando os fundamentos da realidade dentro da própria natureza.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/73/Frans_Hals_-_Portret_van_Ren%C3%A9_Descartes.jpg" alt="René Descartes" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">René Descartes</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O pai do racionalismo moderno. Usou a dúvida metódica para encontrar a primeira certeza metafísica: "Penso, logo existo".</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6a/Gottfried_Wilhelm_von_Leibniz%2C_Bernhard_Christoph_Francke.jpg" alt="Gottfried Wilhelm Leibniz" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">G.W. Leibniz</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Um polímata que uniu lógica e metafísica, defendendo que vivemos no "melhor de todos os mundos possíveis".</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">A Fronteira</span>
                    <h2>Metafísica e Ciência Contemporânea</h2>
                </header>

                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1462331940025-496dfbfc7564?auto=format&fit=crop&w=1200&q=80" alt="Nebulosa e Física Quântica" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>Muitos acreditavam que a ciência mataria a metafísica, mas aconteceu o contrário. A <strong>Física Quântica</strong> levanta questões profundamente metafísicas sobre a natureza da observação e a realidade da matéria. Teorias sobre <strong>Multiversos</strong> e a simulação computacional do universo (<em>Simulated Reality</em>) nos levam de volta aos diálogos de Platão. A metafísica hoje é a ponte entre o que sabemos matematicamente e o que intuímos filosoficamente sobre o infinito.</p>
                    
                    <p style="margin-top: 1rem;">No PhiloMap, entendemos que a ciência nos diz como o mundo funciona, mas a metafísica nos ajuda a perguntar por que ele existe e o que ele realmente é.</p>
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

