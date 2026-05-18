<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olunic - Tira-Dúvidas</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .faq-container {
            padding: 5rem 15%;
        }
        .faq-section {
            margin-bottom: 4rem;
        }
        .faq-section h3 {
            color: var(--accent-gold);
            margin-bottom: 2rem;
            border-left: 5px solid var(--accent-blue);
            padding-left: 1rem;
        }
        .faq-item {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .faq-item:hover {
            border-color: var(--accent-blue);
            background: rgba(0, 31, 63, 0.05);
        }
        .faq-question {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .faq-answer {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--glass-border);
            display: none;
            color: var(--text-color);
            opacity: 0.9;
        }
        .faq-item.active .faq-answer {
            display: block;
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

    <main class="faq-container fade-in">
        <h2 style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 3rem; text-align: center;">Tira-Dúvidas</h2>

        <!-- Acesso -->
        <div class="faq-section">
            <h3>Acesso e Códigos</h3>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Como recebo meu código de acesso? <span>+</span></div>
                <div class="faq-answer">O código é enviado individualmente para o e-mail cadastrado 24 horas antes do início da prova. Verifique sua caixa de entrada e spam.</div>
            </div>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Meu código não funciona, o que fazer? <span>+</span></div>
                <div class="faq-answer">Certifique-se de que não há espaços extras. Cada código é de uso único; se você já iniciou a prova uma vez, não poderá usar o mesmo código novamente.</div>
            </div>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Posso fazer a prova em dois dispositivos? <span>+</span></div>
                <div class="faq-answer">Não. O sistema bloqueia acessos simultâneos. Se detectar um segundo login com o mesmo código, a primeira sessão será encerrada e o alerta de segurança será ativado.</div>
            </div>
        </div>

        <!-- Específicas -->
        <div class="faq-section">
            <h3>Dúvidas por Olimpíada</h3>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Nebula Math: Posso usar calculadora? <span>+</span></div>
                <div class="faq-answer">O uso de calculadoras externas é proibido. Para algumas questões de cálculo avançado, uma interface de calculadora científica básica será fornecida dentro da própria plataforma.</div>
            </div>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Cyber Code: Quais linguagens são aceitas? <span>+</span></div>
                <div class="faq-answer">A prova foca em lógica de programação e algoritmos. Você poderá responder em Python, C++, Java ou JavaScript através do nosso compilador integrado.</div>
            </div>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Quantum Horizon: Preciso saber física moderna? <span>+</span></div>
                <div class="faq-answer">Para a categoria "Mestres", sim. Já para "Iniciados", o foco é em mecânica básica e fenômenos térmicos do dia a dia.</div>
            </div>
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <div class="faq-question">Bio Genesis: A prova inclui laboratório virtual? <span>+</span></div>
                <div class="faq-answer">Sim! Algumas questões exigem a manipulação de simuladores de genética e microscopia virtual diretamente no navegador.</div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Olunic - Odyssey of Minds. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
