<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olunic - Olimpíadas</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .olympiad-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 5rem 10%;
        }
        .olympiad-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 2rem;
            transition: transform 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }
        .olympiad-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-blue);
        }
        .olympiad-card h3 {
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }
        .tag {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: rgba(0, 242, 255, 0.1);
            color: var(--accent-blue);
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo-container" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
            <img src="../assets/logo.svg" alt="olunic logo" width="30">
            <span class="logo-text">olunic</span>
        </a>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="olympiads.php">Olimpíadas</a></li>
                <li><a href="medals.php">Medalhas</a></li>
                <li><a href="rankings.php">Resultados</a></li>
                <li><a href="calendar.php">Calendário</a></li>
                <li><a href="rules.php">Regulamento</a></li>
                <li><a href="faq.php">Dúvidas</a></li>
                <li><a href="registration.php">Inscrição</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section style="text-align: center; padding: 5rem 10% 2rem;">
            <h2 style="font-size: 3.5rem; color: var(--accent-gold); font-family: var(--font-heading);">Nossas Olimpíadas</h2>
            <p style="color: var(--text-muted); margin-bottom: 3rem;">Escolhemos desafios que moldam o futuro. Use o filtro para encontrar sua área.</p>
            
            <div style="max-width: 600px; margin: 0 auto; display: flex; gap: 10px; background: var(--bg-secondary); padding: 10px; border-radius: 50px; border: 1px solid var(--glass-border);">
                <input type="text" id="olympiad-search" placeholder="🔍 Buscar por nome ou categoria..." style="flex: 1; border: none; background: transparent; padding: 10px 20px; font-size: 1rem; color: var(--text-color); outline: none;">
                <button class="btn-primary" style="padding: 10px 30px; border-radius: 50px; font-size: 0.8rem;">FILTRAR</button>
            </div>
        </section>

        <div class="olympiad-grid" id="olympiad-grid">
            <div class="olympiad-card">
                <span class="tag">Exatas</span>
                <h3>Nebula Math</h3>
                <p>O desafio supremo de matemática pura e aplicada. Da aritmética ao cálculo avançado.</p>
                <a href="registration.php" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</a>
            </div>
            <div class="olympiad-card">
                <span class="tag">Sustentabilidade</span>
                <h3>Eco Future</h3>
                <p>Projete soluções para os desafios ambientais globais. Ecologia, energia renovável e urbanismo.</p>
                <a href="registration.php" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</a>
            </div>
            <div class="olympiad-card">
                <span class="tag">Humanas</span>
                <h3>History Explorer</h3>
                <p>Uma jornada pelas grandes civilizações e eventos que moldaram o mundo contemporâneo.</p>
                <a href="registration.php" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</a>
            </div>
            <div class="olympiad-card">
                <span class="tag">Tecnologia</span>
                <h3>Cyber Code Quest</h3>
                <p>Maratona de programação e algoritmos. Resolva problemas complexos em tempo recorde.</p>
                <button onclick="checkExamAccess('cyber-code')" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</button>
            </div>
            <div class="olympiad-card">
                <span class="tag">Espaço</span>
                <h3>Astro Physics</h3>
                <p>Explore as leis do universo, buracos negros e a mecânica das estrelas.</p>
                <button onclick="checkExamAccess('astro-physics')" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</button>
            </div>
            <div class="olympiad-card">
                <span class="tag">Inteligência</span>
                <h3>AI Revolution</h3>
                <p>Desafios sobre redes neurais, ética e o futuro da inteligência artificial.</p>
                <button onclick="checkExamAccess('ai-revolution')" class="btn-primary" style="display: inline-block; padding: 0.5rem 1.5rem; font-size: 0.9rem;">Inscrever-se</button>
            </div>
        </div>
    </main>

    <div class="floating-btn" onclick="window.location.href='faq.php'">?</div>

    <footer>
        <p>&copy; 2026 Olunic - Odyssey of Minds. Todos os direitos reservados.</p>
    </footer>

    <script>
        document.getElementById('olympiad-search').addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.olympiad-card');
            
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const desc = card.querySelector('p').textContent.toLowerCase();
                const tag = card.querySelector('.tag').textContent.toLowerCase();
                
                if (title.includes(term) || desc.includes(term) || tag.includes(term)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
