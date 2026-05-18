<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Literatura Filosófica</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    
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

<style>
    #main-content {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
</style>
</head>
<body>
    <a href="#main-content" class="skip-link">Pular para o conteúdo</a>

    <div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fdfcf9; z-index: 10002; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.4s ease;">
        <div style="font-family: serif; font-size: 2rem; color: #c5a059; margin-bottom: 20px; letter-spacing: 5px; animation: pulse 1.5s infinite;">PHILOMAP</div>
        <div style="width: 150px; height: 1px; background: #e8e2d8; position: relative; overflow: hidden;">
            <div style="position: absolute; width: 40px; height: 100%; background: #c5a059; animation: loading 1.5s infinite linear;"></div>
        </div>
    </div>

    <div class="reading-progress"></div>

    <div class="app-container">
        <!-- SIDEBAR -->
        <aside class="sidebar" role="navigation">
            <a href="../index.php" class="sidebar-logo">
                <img src="../view/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" width="280" height="280" loading="lazy" width="1200" height="800">
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
                    <li class="nav-item"><a href="literatura.php" class="active">Literatura</a></li>
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
        <main class="main-content" id="main-content" role="main">
            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Literatura Filosófica</span></div>

            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <header class="card reveal active">
                <span class="subtitulo">Biblioteca Digital</span>
                <h1>Literatura Filosófica</h1>
                <p>Navegue pela nossa curadoria de obras fundamentais. Filtre por período ou dificuldade e acompanhe seu progresso na busca pela sabedoria.</p>
            </header>

            <!-- Barra de Filtros -->
            <div class="filter-bar reveal">
                <button class="filter-btn active" onclick="filterBooks('all')">Todos</button>
                <button class="filter-btn" onclick="filterBooks('antiguidade')">Antiguidade</button>
                <button class="filter-btn" onclick="filterBooks('moderna')">Moderna</button>
                <button class="filter-btn" onclick="filterBooks('contemporanea')">Contemporânea</button>
                <button class="filter-btn" onclick="filterBooks('iniciante')">Nível: Iniciante</button>
                <button class="filter-btn" onclick="filterBooks('avancado')">Nível: Avançado</button>
            </div>

            <div class="book-grid reveal">
                <!-- LIVRO 1 -->
                <article class="book-card" data-era="antiguidade" data-level="avancado">
                    <span class="book-tag">Antiguidade</span>
                    <h3 class="book-title">A República</h3>
                    <span class="book-author">Platão</span>
                    <p class="book-desc">A obra seminal que fundou a ciência política e a metafísica ocidental através da busca pela justiça ideal e a famosa Alegoria da Caverna.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'republica')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Avançada">
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                        </div>
                    </div>
                </article>

                <!-- LIVRO 2 -->
                <article class="book-card" data-era="antiguidade" data-level="iniciante">
                    <span class="book-tag">Antiguidade</span>
                    <h3 class="book-title">Cartas de um Estoico</h3>
                    <span class="book-author">Sêneca</span>
                    <p class="book-desc">Uma coleção de lições práticas sobre resiliência, tempo e como viver uma vida plena diante das adversidades.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'seneca')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Iniciante">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </article>

                <!-- LIVRO 3 -->
                <article class="book-card" data-era="moderna" data-level="avancado">
                    <span class="book-tag">Moderna</span>
                    <h3 class="book-title">Crítica da Razão Pura</h3>
                    <span class="book-author">Immanuel Kant</span>
                    <p class="book-desc">A investigação monumental sobre os limites do conhecimento humano e a estrutura da experiência a priori.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'kant')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Muito Avançada">
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                        </div>
                    </div>
                </article>

                <!-- LIVRO 4 -->
                <article class="book-card" data-era="contemporanea" data-level="intermediario">
                    <span class="book-tag">Contemporânea</span>
                    <h3 class="book-title">O Ser e o Nada</h3>
                    <span class="book-author">Jean-Paul Sartre</span>
                    <p class="book-desc">O manifesto definitivo do existencialismo, explorando a liberdade absoluta do indivíduo e a natureza da consciência.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'sartre')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Intermediária">
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </article>

                <!-- LIVRO 5 -->
                <article class="book-card" data-era="moderna" data-level="iniciante">
                    <span class="book-tag">Moderna</span>
                    <h3 class="book-title">Discurso do Método</h3>
                    <span class="book-author">René Descartes</span>
                    <p class="book-desc">O ponto de partida da filosofia moderna, estabelecendo a dúvida como caminho para a certeza racional.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'descartes')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Iniciante/Média">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </article>

                <!-- LIVRO 6 -->
                <article class="book-card" data-era="contemporanea" data-level="avancado">
                    <span class="book-tag">Contemporânea</span>
                    <h3 class="book-title">Vigiar e Punir</h3>
                    <span class="book-author">Michel Foucault</span>
                    <p class="book-desc">Uma análise profunda sobre o nascimento das prisões e as tecnologias de poder e vigilância na sociedade moderna.</p>
                    <div class="book-footer">
                        <label class="read-status">
                            <input type="checkbox" onchange="toggleRead(this, 'foucault')"> Lido
                        </label>
                        <div class="difficulty-indicator" title="Dificuldade: Avançada">
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                            <span class="dot active"></span>
                        </div>
                    </div>
                </article>
            </div>

            <section class="card reveal" style="margin-top: 5rem;">
                <header class="card-header">
                    <span class="subtitulo">Guia Acadêmico</span>
                    <h2>Metodologia de Estudo</h2>
                </header>
                <div style="background: var(--surface); padding: 3rem; border-radius: 25px; border: 1px solid var(--border); display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    <div>
                        <h4 style="color: var(--gold); margin-bottom: 1rem;">1. Hermenêutica</h4>
                        <p style="font-size: 0.85rem;">Busque compreender o contexto histórico e a intenção original do autor antes de criticar.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--gold); margin-bottom: 1rem;">2. Análise Lógica</h4>
                        <p style="font-size: 0.85rem;">Mapeie as premissas e a conclusão. O argumento é válido? Ele é sólido?</p>
                    </div>
                    <div>
                        <h4 style="color: var(--gold); margin-bottom: 1rem;">3. Dialética</h4>
                        <p style="font-size: 0.85rem;">Coloque diferentes autores para dialogar sobre o mesmo tema (Ex: Hobbes vs Rousseau).</p>
                    </div>
                </div>
            </section>

            <footer style="text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.8rem;">
                <p>&copy; 2026 PhiloMap — Todos os direitos reservados.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts Específicos para Literatura -->
    <script>
        function filterBooks(criteria) {
            const cards = document.querySelectorAll('.book-card');
            const btns = document.querySelectorAll('.filter-btn');
            
            btns.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            cards.forEach(card => {
                const era = card.getAttribute('data-era');
                const level = card.getAttribute('data-level');
                
                if (criteria === 'all' || era === criteria || level === criteria) {
                    card.style.display = 'flex';
                    setTimeout(() => card.style.opacity = '1', 50);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        }

        function toggleRead(checkbox, bookId) {
            localStorage.setItem('read_' + bookId, checkbox.checked);
            if (checkbox.checked) {
                checkbox.parentElement.style.color = 'var(--gold)';
            } else {
                checkbox.parentElement.style.color = 'var(--text-dim)';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('.read-status input');
            checkboxes.forEach(cb => {
                const bookId = cb.getAttribute('onchange').match(/'([^']+)'/)[1];
                const isRead = localStorage.getItem('read_' + bookId) === 'true';
                cb.checked = isRead;
                if (isRead) cb.parentElement.style.color = 'var(--gold)';
            });
        });
    </script>
</body>
</html>



