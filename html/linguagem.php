<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Linguagem</title>
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
                    <li class="nav-item"><a href="moralismo.php">Moralismo</a></li>
                    <li class="nav-item"><a href="existencialismo.php">Existencialismo</a></li>
                    <li class="nav-item"><a href="estetica.php">Estética</a></li>
                    <li class="nav-item"><a href="metafisica.php">Metafísica</a></li>
                    <li class="nav-item"><a href="epistemologia.php">Epistemologia</a></li>
                    <li class="nav-item"><a href="politica.php">Política</a></li>
                    <li class="nav-item"><a href="linguagem.php" class="active">Linguagem</a></li>
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

            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Linguagem</span></div>

                        <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">A Estrutura do Significado</span>
                    <h1>Filosofia da Linguagem: O Mundo em Palavras</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1200&q=80" alt="Linguagem e Escrita Clássica" loading="lazy" width="1200" height="800">
                </div>
                
                <p>A <strong>Filosofia da Linguagem</strong> investiga a natureza da comunicação, a origem das línguas e a relação intrínseca entre as palavras, o pensamento e a realidade. Ela não estuda apenas gramática, mas como os signos linguísticos moldam nossa percepção do que é real. Para muitos filósofos modernos, os problemas da filosofia são, na verdade, problemas de linguagem mal resolvidos.</p>

                <p>Será que as palavras representam as coisas como elas são, ou são apenas convenções arbitrárias? A linguagem é uma ferramenta que usamos para descrever o mundo ou é ela que constrói o mundo em que vivemos?</p>

                <blockquote class="citacao-destaque">
                    "Os limites da minha linguagem são os limites do meu mundo." — Ludwig Wittgenstein
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Conceitos</span>
                    <h2>Signos, Jogos e Atos de Fala</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. Significado e Referência</h3>
                        <p><strong>Gottlob Frege</strong> distinguiu entre o "sentido" de uma expressão e sua "referência". Por exemplo, "Estrela da Manhã" e "Estrela da Tarde" têm sentidos diferentes, mas referem-se ao mesmo objeto: o planeta Vênus. Essa distinção foi vital para a lógica moderna.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. Jogos de Linguagem</h3>
                        <p>Em sua fase madura, <strong>Wittgenstein</strong> propôs que a linguagem funciona como um jogo. O significado de uma palavra não é uma definição fixa, mas o seu <strong>uso</strong> dentro de um contexto social específico. Entender uma língua é saber jogar as suas regras sociais.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. Atos de Fala</h3>
                        <p><strong>J.L. Austin</strong> argumentou que falar é <em>fazer</em> coisas. Quando dizemos "eu prometo" ou "eu te batizo", não estamos apenas descrevendo algo, estamos realizando uma ação através das palavras. A linguagem tem um poder performativo.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. Gramática Universal</h3>
                        <p><strong>Noam Chomsky</strong> revolucionou a área ao propor que todos os seres humanos nascem com uma estrutura inata para a linguagem. Existe uma "gramática universal" biológica que nos permite aprender qualquer língua complexa em poucos anos.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Grandes Mentes da Linguagem</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b3/Ludwig_Wittgenstein.jpg" alt="Wittgenstein" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Ludwig Wittgenstein</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O filósofo que "matou" a metafísica ao mostrar que muitos problemas filosóficos são apenas confusões linguísticas.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/07/Ferdinand_de_Saussure.jpg" alt="Ferdinand de Saussure" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">F. de Saussure</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O pai da linguística estrutural. Definiu o signo como a união arbitrária entre um conceito e uma imagem acústica.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Chomsky.jpg" alt="Noam Chomsky" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Noam Chomsky</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Linguista e ativista. Sua teoria sobre a estrutura profunda da linguagem mudou a psicologia e a ciência cognitiva.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Plato_Silanion_Musei_Capitolini_MC1377.jpg" alt="Platão" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Platão</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">No diálogo <em>Crátilo</em>, ele iniciou o debate sobre se os nomes das coisas são naturais ou puramente convencionais.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">A Fronteira Digital</span>
                    <h2>Linguagem, Código e Inteligência Artificial</h2>
                </header>

                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1516116216624-53e697fedbea?auto=format&fit=crop&w=1200&q=80" alt="Código e Dados" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>Na era digital, a linguagem tornou-se <strong>código</strong>. Os grandes modelos de linguagem (LLMs) como os que alimentam as IAs modernas mostram que a estrutura da linguagem pode ser traduzida em pura matemática e probabilidade. No entanto, o debate filosófico continua: uma máquina que manipula signos com perfeição realmente "entende" o que está dizendo? Onde termina o processamento de dados e começa o verdadeiro significado?</p>
                    
                    <p style="margin-top: 1rem;">O PhiloMap convida você a refletir: em um mundo de algoritmos, nossa capacidade de usar a linguagem com consciência e ética é o que ainda nos define como humanos.</p>
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



