<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Medalhas Exclusivas</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .medals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            padding: 5rem 10%;
        }
        .medal-card {
            background: white;
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-soft);
        }
        .medal-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: var(--accent-primary);
            box-shadow: 0 20px 40px rgba(74, 144, 226, 0.15);
        }
        .medal-svg {
            width: 140px;
            height: 140px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        }
        .medal-card h3 {
            color: var(--accent-primary);
            font-weight: 900;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        .medal-desc {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.5;
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
        <section style="text-align: center; padding-top: 5rem;" class="fade-in">
            <h2 style="font-size: 3rem; color: var(--text-color); font-weight: 900;">Galeria de Honrarias</h2>
            <p style="color: #666;">Cada conquista na olunic é coroada com um design único e atemporal.</p>
        </section>

        <div class="medals-grid fade-in">
            <!-- Nebula Math -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <path d="M30 50 L50 20 L70 50 L50 80 Z" fill="none" stroke="#4a90e2" stroke-width="3"/>
                    <circle cx="50" cy="50" r="6" fill="#00cec9"/>
                </svg>
                <h3>Medalha Nebula</h3>
                <p class="medal-desc">Simboliza a precisão geométrica e o equilíbrio dos números primos.</p>
            </div>

            <!-- Cyber Code -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <rect x="15" y="15" width="70" height="70" rx="8" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <path d="M35 40 L45 50 L35 60 M55 40 L65 50 L55 60" fill="none" stroke="#00cec9" stroke-width="4" stroke-linecap="round"/>
                </svg>
                <h3>Medalha Cyber</h3>
                <p class="medal-desc">Inspirada na arquitetura de software e no fluxo da lógica binária.</p>
            </div>

            <!-- Eco Future -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <path d="M50 25 Q70 40 50 75 Q30 40 50 25" fill="#00cec9" opacity="0.4"/>
                    <path d="M50 30 C65 45 65 55 50 70 C35 55 35 45 50 30" fill="none" stroke="#4a90e2" stroke-width="3"/>
                </svg>
                <h3>Medalha Eco</h3>
                <p class="medal-desc">Representa a simbiose entre tecnologia e a preservação da vida.</p>
            </div>

            <!-- History Explorer -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <path d="M30 30 L70 30 M30 50 L70 50 M30 70 L60 70" stroke="#4a90e2" stroke-width="4" stroke-linecap="round"/>
                    <circle cx="75" cy="75" r="10" stroke="#00cec9" stroke-width="2" fill="none"/>
                </svg>
                <h3>Medalha Explorer</h3>
                <p class="medal-desc">Homenagem aos registros históricos e à bússola do conhecimento humano.</p>
            </div>

            <!-- Astro Physics -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <ellipse cx="50" cy="50" rx="35" ry="12" stroke="#00cec9" stroke-width="2" fill="none" transform="rotate(-20 50 50)"/>
                    <circle cx="50" cy="50" r="10" fill="#4a90e2"/>
                </svg>
                <h3>Medalha Astro</h3>
                <p class="medal-desc">Representa os corpos celestes e a órbita do entendimento universal.</p>
            </div>

            <!-- AI Revolution -->
            <div class="medal-card">
                <svg class="medal-svg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#f8f9fa" stroke="#4a90e2" stroke-width="2"/>
                    <circle cx="35" cy="35" r="5" fill="#00cec9"/>
                    <circle cx="65" cy="35" r="5" fill="#00cec9"/>
                    <circle cx="50" cy="65" r="5" fill="#00cec9"/>
                    <path d="M35 35 L65 35 L50 65 Z" fill="none" stroke="#4a90e2" stroke-width="2"/>
                </svg>
                <h3>Medalha AI</h3>
                <p class="medal-desc">Simboliza as redes neurais e a conexão exponencial da inteligência.</p>
            </div>
        </div>
    </main>

    <div class="floating-btn" onclick="window.location.href='faq.php'">?</div>

    <footer><p>&copy; 2026 olunic - Odyssey of Minds</p></footer>
</body>
</html>
