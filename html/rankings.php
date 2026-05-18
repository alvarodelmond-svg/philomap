<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Hall da Fama</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .ranking-container { padding: 5rem 10%; }
        .podium-section { margin-bottom: 5rem; }
        .podium-title { 
            text-align: center; 
            font-size: 2.5rem; 
            font-weight: 900; 
            color: var(--accent-primary); 
            margin-bottom: 3rem;
            text-transform: uppercase;
        }
        .ranking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .category-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--glass-border);
        }
        .medal-list { margin-top: 1.5rem; }
        .medal-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .medal-icon { font-size: 1.5rem; width: 30px; text-align: center; }
        .student-name { font-weight: 700; color: var(--text-color); }
        .student-info { font-size: 0.8rem; color: #666; }
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

    <main class="ranking-container">
        <section class="podium-section fade-in">
            <h1 class="podium-title">Hall da Fama 2026</h1>
            <p style="text-align: center; margin-bottom: 4rem;">Os maiores intelectos do Brasil reunidos em um só lugar.</p>

            <div class="ranking-grid">
                <!-- Iniciados -->
                <div class="category-card">
                    <h2 style="color: var(--accent-secondary);">INICIADOS (Fundamental)</h2>
                    <div class="medal-list">
                        <div class="medal-item">
                            <span class="medal-icon">🥇</span>
                            <div>
                                <p class="student-name">Arthur Silva Mendes</p>
                                <p class="student-info">Escola Municipal Dom Pedro II | São Paulo - SP</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥈</span>
                            <div>
                                <p class="student-name">Beatriz Oliveira</p>
                                <p class="student-info">Colégio Adventista | Curitiba - PR</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥉</span>
                            <div>
                                <p class="student-name">Carlos Eduardo</p>
                                <p class="student-info">Escola Estadual Tiradentes | Belo Horizonte - MG</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eruditos -->
                <div class="category-card">
                    <h2 style="color: var(--accent-primary);">ERUDITOS (Médio)</h2>
                    <div class="medal-list">
                        <div class="medal-item">
                            <span class="medal-icon">🥇</span>
                            <div>
                                <p class="student-name">Daniela Souza</p>
                                <p class="student-info">IFSP Campus Cubatão | Cubatão - SP</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥈</span>
                            <div>
                                <p class="student-name">Eduardo Santos</p>
                                <p class="student-info">Colégio Militar | Fortaleza - CE</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥉</span>
                            <div>
                                <p class="student-name">Fernanda Lima</p>
                                <p class="student-info">Escola Técnica Federal | Rio de Janeiro - RJ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mestres -->
                <div class="category-card">
                    <h2 style="color: #003366;">MESTRES (Livre)</h2>
                    <div class="medal-list">
                        <div class="medal-item">
                            <span class="medal-icon">🥇</span>
                            <div>
                                <p class="student-name">Gabriel Henrique</p>
                                <p class="student-info">Universidade de São Paulo (USP) | São Paulo - SP</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥈</span>
                            <div>
                                <p class="student-name">Heloísa Matos</p>
                                <p class="student-info">UNICAMP | Campinas - SP</p>
                            </div>
                        </div>
                        <div class="medal-item">
                            <span class="medal-icon">🥉</span>
                            <div>
                                <p class="student-name">Igor Cavalcante</p>
                                <p class="student-info">UFMG | Belo Horizonte - MG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer><p>&copy; 2026 olunic - Odyssey of Minds. Todos os direitos reservados.</p></footer>
</body>
</html>
