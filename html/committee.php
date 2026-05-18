<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Comitê Científico</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/core.js" defer></script>
    <style>
        .committee-hero {
            padding: 8rem 10% 4rem;
            background: #2d3436;
            color: white;
            text-align: center;
        }
        .profiles-grid {
            padding: 5rem 10%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 4rem;
        }
        .profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            border: 1px solid #eee;
        }
        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        }
        .profile-img {
            width: 100%;
            height: 300px;
            background: #dfe6e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
        }
        .profile-info {
            padding: 2rem;
        }
        .profile-name {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--accent-primary);
            margin-bottom: 0.5rem;
        }
        .profile-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--accent-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }
        .profile-bio {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
        }
        .expertise-tags {
            margin-top: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .tag {
            padding: 0.4rem 0.8rem;
            background: #f1f2f6;
            border-radius: 20px;
            font-size: 0.75rem;
            color: #555;
            font-weight: 600;
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
        <section class="committee-hero fade-in">
            <h1 style="font-size: 3.5rem; font-weight: 900; margin-bottom: 1.5rem;">Comitê Científico</h1>
            <p style="font-size: 1.1rem; max-width: 800px; margin: 0 auto; opacity: 0.9;">Conheça os especialistas e pesquisadores responsáveis pela curadoria pedagógica e excelência acadêmica da Olunic.</p>
        </section>

        <section class="profiles-grid">
            <div class="profile-card fade-in">
                <div class="profile-img">👨‍🔬</div>
                <div class="profile-info">
                    <h3 class="profile-name">Dr. Augusto Schliemann</h3>
                    <p class="profile-title">Ph.D. em Inteligência Artificial (MIT)</p>
                    <p class="profile-bio">Pesquisador sênior com foco em ética algorítmica e redes neurais. Responsável pela curadoria da Olimpíada de IA.</p>
                    <div class="expertise-tags">
                        <span class="tag">Machine Learning</span>
                        <span class="tag">Ética Digital</span>
                    </div>
                </div>
            </div>

            <div class="profile-card fade-in" style="animation-delay: 0.1s;">
                <div class="profile-img">👩‍💻</div>
                <div class="profile-info">
                    <h3 class="profile-name">Dra. Helena Varejão</h3>
                    <p class="profile-title">Doutora em Matemática Aplicada (Oxford)</p>
                    <p class="profile-bio">Especialista em teoria das probabilidades e modelos estocásticos. Coordena o desenvolvimento da Nebula Math.</p>
                    <div class="expertise-tags">
                        <span class="tag">Estatística</span>
                        <span class="tag">Sistemas Dinâmicos</span>
                    </div>
                </div>
            </div>

            <div class="profile-card fade-in" style="animation-delay: 0.2s;">
                <div class="profile-img">👨‍🎨</div>
                <div class="profile-info">
                    <h3 class="profile-name">Dr. Marcus Vinícius</h3>
                    <p class="profile-title">Ph.D. em História da Arte (Sorbonne)</p>
                    <p class="profile-bio">Historiador focado nas relações entre arte e tecnologia durante o Renascimento. Lidera a curadoria de Pinturas Artísticas.</p>
                    <div class="expertise-tags">
                        <span class="tag">Renascimento</span>
                        <span class="tag">Museologia</span>
                    </div>
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
