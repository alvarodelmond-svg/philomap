<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Existencialismo</title>
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
                    <li class="nav-item"><a href="existencialismo.php" class="active">Existencialismo</a></li>
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

            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Existencialismo</span></div>

                        <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>
            
            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Ontologia Moderna</span>
                    <h1>Existencialismo: A Liberdade e o Peso do Ser</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://www.livroseoutros.com.br/wp-content/uploads/2021/04/EdvardMunch-Melancholy.jpeg" alt="Solidão e Reflexão" loading="lazy" width="1200" height="800">
                </div>
                
                <p>O <strong>Existencialismo</strong> é uma corrente filosófica que foca na experiência individual, na liberdade radical e na responsabilidade total. Surgido com força avassaladora no século XX, especialmente no pós-guerra francês, ele propõe que <strong>"a existência precede a essência"</strong>. Isso significa que o ser humano não nasce com um propósito ou natureza pré-definida; nós somos o que fazemos de nós mesmos através de nossas escolhas.</p>

                <p>Diferente de outras filosofias que buscam sistemas universais, o existencialismo mergulha na subjetividade: na angústia, no tédio, na finitude e na busca por um sentido em um universo que parece, muitas vezes, indiferente.</p>

                <blockquote class="citacao-destaque">
                    "O homem está condenado a ser livre; porque, uma vez lançado no mundo, ele é responsável por tudo o que faz." — Jean-Paul Sartre
                </blockquote>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Conceitos Chave</span>
                    <h2>A Jornada do Indivíduo Autêntico</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">01. A Angústia da Escolha</h3>
                        <p>A percepção de que somos os únicos arquitetos de nosso destino gera o que os existencialistas chamam de <strong>angústia</strong>. Não é uma ansiedade patológica, mas o reconhecimento da nossa liberdade absoluta e da gravidade de cada escolha nossa.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">02. O Absurdo e a Revolta</h3>
                        <p><strong>Albert Camus</strong> descreveu o "Absurdo" como o conflito entre o desejo humano de ordem e clareza e o caos silencioso do mundo. Sua solução? A revolta consciente: viver plenamente apesar do absurdo, encontrando alegria na própria luta, como Sísifo.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">03. O Outro e a Má-fé</h3>
                        <p><strong>Simone de Beauvoir</strong> explorou como a nossa liberdade é limitada pela liberdade dos outros. Já Sartre definiu a "má-fé" como a mentira que contamos a nós mesmos para fugir da responsabilidade, fingindo que somos objetos determinados pelo destino ou pela sociedade.</p>
                    </div>

                    <div style="padding: 2rem; border: 1px solid var(--border); border-radius: 12px; background: var(--bg);">
                        <h3 style="margin-bottom: 1rem; color: var(--gold);">04. O Salto da Fé</h3>
                        <p><strong>Kierkegaard</strong>, na vertente religiosa, argumentava que diante do paradoxo da existência, o indivíduo deve realizar um "salto da fé" — um compromisso subjetivo apaixonado que vai além da razão pura.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Galeria do Pensamento</span>
                    <h2>Grandes Nomes do Existencialismo</h2>
                </header>

                <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.FRjXAwF36c37wiGpxFsbWQHaFp?w=239&h=182&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Jean-Paul Sartre" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Jean-Paul Sartre</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O filósofo da liberdade. Defendeu que não há desculpas para as nossas falhas, pois somos o resultado direto de nossas escolhas conscientes.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.PeaqD3jEa3CRUnggzJfrFwHaHa?w=187&h=187&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Simone de Beauvoir" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Simone de Beauvoir</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">Expandiu o existencialismo para a ética e o feminismo, afirmando que a liberdade de um indivíduo depende da liberdade de todos.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="data:image/webp;base64,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" alt="Albert Camus" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Albert Camus</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O filósofo do absurdo e da solidariedade humana. Ensinou que devemos imaginar Sísifo feliz, apesar de sua tarefa eterna.</p>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; border: 1px solid var(--border); border-radius: 15px;">
                        <img src="https://th.bing.com/th/id/OIP.eGynDHX3HmHbnTXyF_B19QHaFY?w=208&h=151&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3" alt="Søren Kierkegaard" class="foto-filosofo" loading="lazy" width="200" height="250">
                        <h3 style="color: var(--gold);">Søren Kierkegaard</h3>
                        <p style="font-size: 0.9rem; margin-top: 1rem;">O "pai" do movimento. Focou na subjetividade e na angústia como caminhos para a verdadeira relação do indivíduo com o divino.</p>
                    </div>
                </div>
            </section>

            <section class="card reveal">
                <header class="card-header">
                    <span class="subtitulo">Vivência</span>
                    <h2>O Existencialismo no Cotidiano</h2>
                </header>

                <div class="image-container">
                    <img src="https://www.bmgart.com.au/wp-content/uploads/2023/06/2023-06-01-Andrew-Baines-07-1000x663.jpeg" alt="Cidade e Indivíduo" loading="lazy" width="1200" height="800">
                </div>

                <div class="texto-flex">
                    <p>O existencialismo não é apenas teoria; é um chamado à ação. Ele se manifesta quando você decide mudar de carreira apesar do medo, quando assume a responsabilidade por um erro ou quando escolhe ser gentil em um mundo indiferente. Na arte, no cinema e na literatura (de Kafka a <em>Matrix</em>), as questões existenciais continuam a nos assombrar e a nos motivar.</p>
                    
                    <p style="margin-top: 1rem;">O PhiloMap convida você: diante do abismo da liberdade, qual será o seu próximo passo? Lembre-se, o sentido da vida não é algo que se encontra, é algo que se cria.</p>
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



