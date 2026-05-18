<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Ética</title>
    
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
                    <li class="nav-item"><a href="etica.php" class="active">Ética</a></li>
                    <li class="nav-item"><a href="logica.php">Lógica</a></li>
                    <li class="nav-item"><a href="moralismo.php">Moralismo</a></li>
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
            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Ética</span></div>

            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Conceito Fundamental</span>
                    <h1>Ética e Valores</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1200&q=80" alt="Balança da Justiça" loading="lazy" width="1200" height="800">
                </div>
                
                <p>A ética é o ramo da filosofia que busca entender os princípios que orientam o <strong>comportamento humano</strong>. Diferente da moral, que se baseia em costumes e tradições específicas de um grupo, a ética é uma reflexão universal e crítica sobre o que é "bom", "justo" ou "correto". Ela questiona a fundamentação das nossas ações e os valores que sustentam nossas escolhas em sociedade.</p>

                <p>Na Grécia Antiga, a ética estava intrinsecamente ligada à busca pela <em>Eudaimonia</em> (felicidade ou florescimento humano). Para os gregos, viver eticamente não era apenas seguir regras, mas desenvolver o caráter para atingir a excelência humana.</p>

                <blockquote class="citacao-destaque">
                    "A excelência não é um ato, mas um hábito." — Aristóteles
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Sistemas Éticos</span>
                    <h2>Principais Correntes de Pensamento</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Deontologia (Dever)</h3>
                        <p>A ética deontológica, cujo principal expoente foi <strong>Immanuel Kant</strong>, argumenta que a moralidade de uma ação reside no cumprimento do dever. Para Kant, devemos agir segundo leis universais, independentemente das consequências. É o famoso "Imperativo Categórico": <em>"Age apenas segundo uma máxima tal que possas querer ao mesmo tempo que se torne lei universal."</em></p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Utilitarismo (Consequência)</h3>
                        <p>Proposto por pensadores como <strong>Jeremy Bentham</strong> e <strong>John Stuart Mill</strong>, este sistema defende que a ação correta é aquela que maximiza o bem-estar geral. O foco está no resultado: a "maior felicidade para o maior número de pessoas". É uma ética pragmática que avalia o impacto social de cada decisão.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Ética das Virtudes (Caráter)</h3>
                        <p>Iniciada por <strong>Aristóteles</strong>, esta abordagem foca no caráter do indivíduo. A virtude (areté) é encontrada no equilíbrio — o "justo meio" — entre dois extremos viciosos. Por exemplo, a coragem é o meio termo entre a covardia e a temeridade.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Ética de Spinoza (Alegria)</h3>
                        <p><strong>Baruch Spinoza</strong> propõe uma ética baseada nos afetos. Para ele, o que aumenta nossa capacidade de agir produz alegria e é considerado "bom". O que diminui nossa potência produz tristeza e é "mau". A ética é, portanto, a arte de organizar encontros que potencializam a vida.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Grandes Filósofos da Ética</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Aristotle_Altemps_Inv8575.jpg" alt="Aristóteles" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Aristóteles</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O pai da Ética das Virtudes. Acreditava que a virtude é alcançada pela prática e pelo hábito, visando a felicidade coletiva na Polis.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.NpX8k5wB2MAyiqopx4PxHQHaKn?w=208&h=299&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Immanuel Kant" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Immanuel Kant</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Defensor da autonomia da razão. Criou o Imperativo Categórico, estabelecendo o dever moral como base absoluta da ação humana.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/John_Stuart_Mill_by_London_Stereoscopic_Company%2C_c1870.jpg" alt="John Stuart Mill" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">John Stuart Mill</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Refinou o utilitarismo, diferenciando prazeres superiores (intelectuais) de inferiores (físicos) e defendendo a liberdade individual.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Nietzsche187a.jpg" alt="Friedrich Nietzsche" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Friedrich Nietzsche</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Critico feroz da moral cristã e tradicional. Propôs a "transvaloração de todos os valores" e a ética da Vontade de Poder.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Atualidade</span>
                    <h2>Ética no Século XXI</h2>
                </header>

                <div class="image-container">
                    <img src="https://th.bing.com/th/id/R.816c3ed99a261132da8ac9352e2ea404?rik=6HJJifGaU1Xp2w&pid=ImgRaw&r=0" alt="Inteligência Artificial" loading="lazy" width="1200" height="600">
                </div>

                <div class="texto-flex">
                    <p>Hoje, a ética enfrenta desafios sem precedentes. Com o avanço da tecnologia e da ciência, surgem novos campos de estudo que exigem uma reflexão profunda sobre nossos valores e limites.</p>
                </div>

                <div style="display: grid; gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); margin-top: 2rem;">
                    <div style="padding: 1.5rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="color: var(--gold); margin-bottom: 1rem;">Bioética</h3>
                        <p style="font-size: 0.95rem;">A Bioética une a biologia e a ética para discutir as implicações morais das pesquisas biológicas e avanços médicos. Temas como a eutanásia, o aborto, a clonagem e a edição genética (CRISPR) são centrais, buscando sempre o respeito à dignidade humana.</p>
                    </div>
                    <div style="padding: 1.5rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="color: var(--gold); margin-bottom: 1rem;">Cyberética</h3>
                        <p style="font-size: 0.95rem;">Investiga os dilemas morais no ciberespaço, incluindo privacidade de dados, a ética dos algoritmos de IA, o impacto das redes sociais e a responsabilidade civil no mundo digitalizado.</p>
                    </div>
                </div>

                <div class="texto-flex" style="margin-top: 2rem;">
                    <p>A filosofia moral não é um relicário do passado, mas uma ferramenta viva e essencial para navegar em um mundo tecnologicamente complexo e globalizado.</p>
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



