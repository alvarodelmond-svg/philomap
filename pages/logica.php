<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Lógica</title>
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
                    <li class="nav-item"><a href="logica.html" class="active">Lógica</a></li>
                    <li class="nav-item"><a href="moralismo.html">Moralismo</a></li>
                    <li class="nav-item"><a href="existencialismo.html">Existencialismo</a></li>
                    <li class="nav-item"><a href="estetica.html">Estética</a></li>
                    <li class="nav-item"><a href="metafisica.html">Metafísica</a></li>
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
            <div class="breadcrumbs"><a href="../index.html">Início</a> / <span>Lógica</span></div>

                        <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Raciocínio Formal</span>
                    <h1>O Caminho do Pensamento Correto</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://static.todamateria.com.br/upload/ar/te/arte-grega-og.jpg?class=ogImageWide" alt="Lógica e Geometria" loading="lazy" width="1200" height="800">
                </div>
                
                <p>A <strong>lógica</strong> é a ciência e a arte que estuda as leis do pensamento e as condições da verdade. Em um mundo saturado de informações e argumentos convincentes, a lógica atua como a ferramenta fundamental para separar o que é válido do que é apenas persuasivo. Ela não se preocupa com o <em>conteúdo</em> do que é dito, mas com a <em>forma</em> como o argumento é construído.</p>

                <p>Historicamente, a lógica nasceu como uma análise da linguagem natural, mas evoluiu para se tornar a base rigorosa da matemática e da computação moderna. Sem a lógica, não haveria programação, algoritmos ou a própria internet.</p>

                <blockquote class="citacao-destaque">
                    "A lógica é o princípio da sabedoria, não o fim." — Leonard Nimoy (como Spock)
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Estruturas Fundamentais</span>
                    <h2>Tipos de Raciocínio e Inferência</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Dedução</h3>
                        <p>O raciocínio dedutivo é aquele em que, se as premissas forem verdadeiras, a conclusão será <strong>necessariamente</strong> verdadeira. É o movimento do geral para o particular. Exemplo: <em>"Todos os homens são mortais. Sócrates é homem. Logo, Sócrates é mortal."</em></p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Indução</h3>
                        <p>A indução parte de observações particulares para sugerir uma lei geral. É a base do método científico. Se observamos mil cisnes brancos, induzimos que todos os cisnes são brancos. Ela lida com <strong>probabilidades</strong>, não certezas absolutas.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Abdução</h3>
                        <p>A abdução formula uma hipótese para explicar um fenômeno. É o processo de escolher a <strong>melhor explicação</strong> disponível. Usada por médicos em diagnósticos e por detetives como Sherlock Holmes.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Lógica Simbólica</h3>
                        <p>Substitui as palavras por símbolos matemáticos (P ∧ Q → R). Permite realizar cálculos lógicos complexos sem a ambiguidade das línguas humanas, sendo essencial para o desenvolvimento do hardware e software.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Os Grandes Mestres da Lógica</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Aristotle_Altemps_Inv8575.jpg" alt="Aristóteles" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Aristóteles</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O "Pai da Lógica". Criou o Silogismo e as categorias do pensamento, dominando a lógica ocidental por mais de dois mil anos.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.0uu3onGYmBRL4u8TANHMhAAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Gottlob Frege" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Gottlob Frege</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O arquiteto da lógica moderna. Criou o sistema de predicados e quantificadores, ligando a lógica profundamente à matemática.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://tse3.mm.bing.net/th/id/OIP.IiAE26HZqs9XwVmqANf0fQHaJy?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Kurt Gödel" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Kurt Gödel</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Provou que existem verdades na matemática que não podem ser demonstradas por sistemas lógicos (Teorema da Incompletude).</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.SGYKFaGDtijXUr9yNhEzgQHaFQ?w=238&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Alan Turing" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Alan Turing</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Traduziu a lógica para máquinas físicas, criando a base teórica da computação e da Inteligência Artificial moderna.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Aplicações</span>
                    <h2>Lógica e Inteligência Artificial</h2>
                </header>

                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=1200&q=80" alt="Robótica e Lógica" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>A Inteligência Artificial (IA) é, em sua essência, <strong>lógica aplicada</strong>. Os modelos de linguagem modernos, embora operem por probabilidades estatísticas, dependem de estruturas lógicas profundas para processar informação e responder com coerência. A "Lógica de Programação" é o que permite que máquinas executem tarefas complexas, desde sugerir um filme até dirigir um carro autônomo.</p>
                    
                    <p style="margin-top: 1rem;">Entender lógica hoje não é apenas um exercício acadêmico; é entender a linguagem da era digital e ser capaz de avaliar criticamente os algoritmos que moldam nossa realidade.</p>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Defesa Intelectual</span>
                    <h2>O Guia Rápido de Falácias</h2>
                </header>
                <div style="display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    <div style="border-left: 3px solid var(--gold); padding-left: 15px;">
                        <strong>Ad Hominem:</strong> Atacar o argumentador em vez do argumento.
                    </div>
                    <div style="border-left: 3px solid var(--gold); padding-left: 15px;">
                        <strong>Espantalho:</strong> Distorcer o argumento do outro para refutá-lo mais facilmente.
                    </div>
                    <div style="border-left: 3px solid var(--gold); padding-left: 15px;">
                        <strong>Falso Dilema:</strong> Apresentar apenas duas opções quando existem outras.
                    </div>
                    <div style="border-left: 3px solid var(--gold); padding-left: 15px;">
                        <strong>Ladeira Escorregadia:</strong> Afirmar que um pequeno passo levará inevitavelmente ao caos.
                    </div>
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

