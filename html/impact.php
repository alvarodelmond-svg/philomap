<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Impacto Social</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/core.js" defer></script>
    <style>
        .impact-hero {
            padding: 8rem 10% 4rem;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            text-align: center;
        }
        .stats-container {
            padding: 5rem 10%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }
        .stat-box {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            text-align: center;
        }
        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--accent-primary);
            margin-bottom: 1rem;
        }
        .chart-container {
            padding: 5rem 10%;
            background: #fff;
        }
        .progress-bar-group {
            margin-bottom: 2.5rem;
        }
        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-weight: 700;
            color: #444;
        }
        .progress-track {
            height: 12px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--accent-primary);
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }
        .regional-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }
        .region-card {
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 5px solid var(--accent-secondary);
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
                <li><a href="impact.php">Impacto</a></li>
                <li><a href="committee.php">Comitê</a></li>
                <li><a href="rankings.php">Resultados</a></li>
                <li><a href="calendar.php">Calendário</a></li>
                <li><a href="rules.php">Regulamento</a></li>
                <li><a href="registration.php" style="background: var(--accent-primary); color: white; border-radius: 20px;">Inscrição</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="impact-hero fade-in">
            <h1 style="font-size: 3.5rem; color: var(--text-color); font-weight: 900; margin-bottom: 1.5rem;">Impacto Real na Educação</h1>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto; color: #555; line-height: 1.6;">A Olunic nasceu para democratizar o conhecimento de alto nível. Veja como estamos transformando o cenário educacional brasileiro através da tecnologia e inclusão.</p>
        </section>

        <section class="stats-container">
            <div class="stat-box fade-in">
                <div class="stat-number">70%</div>
                <p style="font-weight: 700; color: #444;">Alunos de Escolas Públicas</p>
                <p style="font-size: 0.9rem; color: #666; margin-top: 10px;">Nossa prioridade é garantir que o talento brilhe independente da origem financeira.</p>
            </div>
            <div class="stat-box fade-in" style="animation-delay: 0.1s;">
                <div class="stat-number">12k+</div>
                <p style="font-weight: 700; color: #444;">Municípios Alcançados</p>
                <p style="font-size: 0.9rem; color: #666; margin-top: 10px;">Do Oiapoque ao Chuí, estamos presentes em todas as regiões do Brasil.</p>
            </div>
            <div class="stat-box fade-in" style="animation-delay: 0.2s;">
                <div class="stat-number">50k+</div>
                <p style="font-weight: 700; color: #444;">Inscrições Gratuitas</p>
                <p style="font-size: 0.9rem; color: #666; margin-top: 10px;">100% digital e gratuito, eliminando as barreiras geográficas e sociais.</p>
            </div>
        </section>

        <section class="chart-container">
            <h2 style="text-align: center; margin-bottom: 4rem; color: var(--text-color);">Distribuição de Participantes</h2>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="progress-bar-group">
                    <div class="progress-label"><span>Ensino Médio</span><span>45%</span></div>
                    <div class="progress-track"><div class="progress-fill" style="width: 45%;"></div></div>
                </div>
                <div class="progress-bar-group">
                    <div class="progress-label"><span>Ensino Fundamental II</span><span>30%</span></div>
                    <div class="progress-track"><div class="progress-fill" style="width: 30%; background: var(--accent-secondary);"></div></div>
                </div>
                <div class="progress-bar-group">
                    <div class="progress-label"><span>Ensino Superior / Livre</span><span>25%</span></div>
                    <div class="progress-track"><div class="progress-fill" style="width: 25%; background: var(--accent-gold);"></div></div>
                </div>
            </div>

            <div class="regional-grid">
                <div class="region-card">
                    <h4 style="margin-bottom: 0.5rem;">Sudeste</h4>
                    <p style="font-size: 0.8rem; opacity: 0.8;">38% dos inscritos</p>
                </div>
                <div class="region-card" style="border-left-color: var(--accent-primary);">
                    <h4 style="margin-bottom: 0.5rem;">Nordeste</h4>
                    <p style="font-size: 0.8rem; opacity: 0.8;">24% dos inscritos</p>
                </div>
                <div class="region-card" style="border-left-color: var(--accent-gold);">
                    <h4 style="margin-bottom: 0.5rem;">Sul</h4>
                    <p style="font-size: 0.8rem; opacity: 0.8;">15% dos inscritos</p>
                </div>
                <div class="region-card" style="border-left-color: #ff7675;">
                    <h4 style="margin-bottom: 0.5rem;">Norte</h4>
                    <p style="font-size: 0.8rem; opacity: 0.8;">12% dos inscritos</p>
                </div>
                <div class="region-card" style="border-left-color: #a29bfe;">
                    <h4 style="margin-bottom: 0.5rem;">Centro-Oeste</h4>
                    <p style="font-size: 0.8rem; opacity: 0.8;">11% dos inscritos</p>
                </div>
            </div>
        </section>
    </main>

    <div class="floating-btn" onclick="window.location.href='faq.php'">?</div>

    <footer>
        <p>&copy; 2026 Olunic - Odyssey of Minds. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
