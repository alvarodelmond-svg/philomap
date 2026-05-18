<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Moralismo</title>
        <!-- PRECONNECT PARA VELOCIDADE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    
    <link rel="stylesheet" href="../view/css/main.php">
    
    <!-- SCRIPTS DEFER (NÃO BLOQUEANTES) -->
    <script src="../view/js/main.php" defer></script>
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
            <a href="../index.php" class="sidebar-logo">
                <img src="../view/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" loading="eager" width="280" height="280">
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
                    <li class="nav-item"><a href="etica.php">Ética</a></li>
                    <li class="nav-item"><a href="logica.php">Lógica</a></li>
                    <li class="nav-item"><a href="moralismo.php" class="active">Moralismo</a></li>
                    <li class="nav-item"><a href="existencialismo.php">Existencialismo</a></li>
                    <li class="nav-item"><a href="estetica.php">Estética</a></li>
                    <li class="nav-item"><a href="metafisica.php">Metafísica</a></li>
                    <li class="nav-item"><a href="epistemologia.php">Epistemologia</a></li>
                    <li class="nav-item"><a href="politica.php">Política</a></li>
                    <li class="nav-item"><a href="linguagem.php">Linguagem</a></li>
                    <li class="nav-item"><a href="estoicismo.php">Estoicismo</a></li>
                    <li class="nav-item"><a href="fenomenologia.php">Fenomenologia</a></li>
                    <li class="nav-item"><a href="cinismo.php">Cinismo</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Estudos</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="literatura.php">Literatura</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Institucional</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="../index.php">Início</a></li>
                    <li class="nav-item"><a href="inscricao.php">Inscrição</a></li>
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
                        
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>

            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Moralismo</span></div>

                        <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Normatividade e Caráter</span>
                    <h1>O Rigor e a Observação: Moralismo</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://www.analisidellopera.it/wp-content/uploads/2022/10/a_fontanesi_novembre-1024x677.jpg" alt="Estátua Clássica" loading="lazy" width="1200" height="800">
                </div>
                
                <p>O <strong>moralismo</strong> é frequentemente confundido com a ética, mas possui matizes distintos. Enquanto a ética busca fundamentos racionais universais, o moralismo pode referir-se tanto à aplicação rigorosa de normas sociais quanto à tradição dos "Moralistas" — pensadores que se dedicaram a observar e descrever os costumes, o caráter e as contradições do coração humano.</p>

                <p>No sentido filosófico clássico, ser um moralista é ser um observador da condição humana. É a busca por entender por que fazemos o que fazemos, para além do que dizemos que deveríamos fazer.</p>

                <blockquote class="citacao-destaque">
                    "Ocupa-te com o que és, e não com o que os outros pensam que és." — Sêneca
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Tradições</span>
                    <h2>As Facetas do Moralismo</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Estoicismo</h3>
                        <p>O estoicismo é uma forma de moralismo prático que foca no controle das emoções e no cultivo da virtude interior. Para os estoicos, a moralidade consiste em viver de acordo com a natureza e aceitar o que não podemos mudar, focando apenas em nossa própria vontade e caráter.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Moralismo Francês</h3>
                        <p>No século XVII, surgiu na França uma linhagem de escritores conhecidos como "Moralistas". Eles não criavam sistemas éticos abstratos, mas usavam aforismos e ensaios para desmascarar a vaidade, a hipocrisia e as motivações ocultas das ações humanas.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Relativismo Moral</h3>
                        <p>Questiona se as normas morais são verdades absolutas ou construções culturais. O moralismo aqui é visto como a imposição de uma cultura sobre outra, desafiando a ideia de uma moralidade única e imutável para todos os tempos.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Moralidade de Rebanho</h3>
                        <p>Termo cunhado por Nietzsche para descrever o moralismo que busca a conformidade e a obediência às normas sociais em vez do desenvolvimento de uma individualidade forte e autêntica.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Observadores da Natureza Humana</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.TIwbQAHyyc95vkVM53U9lgHaLO?w=123&h=186&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Sêneca" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Sêneca</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Filósofo estoico que ensinou como manter a serenidade diante da adversidade e a importância da autodisciplina moral.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.zN57xrx3mua0HroEfMQRFQHaEK?w=333&h=187&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Marco Aurélio" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Marco Aurélio</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Imperador romano e estoico. Suas "Meditações" são um guia de autoexame moral e resiliência psicológica.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.84VArtha--y-uTCpESEbXAHaJB?w=208&h=254&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Michel de Montaigne" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Montaigne</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Criador do gênero "Ensaio". Observou com ceticismo e tolerância as variações dos costumes humanos e a fragilidade do julgamento.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.nzIE2FmxpTfnYWreI-rxUAHaEK?w=284&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Blaise Pascal" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Blaise Pascal</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Cientista e filósofo que explorou a miséria e a grandeza do homem, destacando o papel da fé e da intuição moral.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Contemporaneidade</span>
                    <h2>O Dilema do Rigorismo na Era Digital</h2>
                </header>

                <div class="image-container">
                    <img src="https://media.mutualart.com/Images/2016_01/04/08/083521053/d809672b-1d5f-48c9-b18c-c723c16fbe79.Jpeg?w=768" alt="Sociedade Moderna" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>Atualmente, o moralismo ressurge em novas formas, como a "cultura do cancelamento" e o policiamento das redes sociais. Esse novo rigorismo digital levanta questões sobre a linha tênue entre a defesa legítima de valores e a intolerância cega. O desafio moderno é equilibrar a necessidade de normas morais saudáveis com a liberdade de pensamento e a complexidade individual.</p>
                    
                    <p style="margin-top: 1rem;">A tradição moralista nos ensina que, antes de julgar os costumes alheios, devemos mergulhar no conhecimento de nós mesmos e na compreensão da natureza humana, sempre imperfeita e mutável.</p>
                </div>
            </section>

            <footer style="text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.8rem;">
                <p>&copy; 2026 PhiloMap — Todos os direitos reservados.</p>
            </footer>
        </main>
    </div>

        <!-- Scripts -->
</body>
</html>



