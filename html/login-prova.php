<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Acesso à Prova</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .login-box {
            max-width: 450px;
            margin: 10vh auto;
            padding: 3rem;
            background: var(--bg-secondary);
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-soft);
        }
        .code-input {
            font-size: 2rem;
            letter-spacing: 10px;
            text-align: center;
            width: 100%;
            padding: 1rem;
            margin: 2rem 0;
            border: 2px solid var(--glass-border);
            border-radius: 8px;
            text-transform: uppercase;
        }
        .error-msg {
            color: #e74c3c;
            font-weight: bold;
            display: none;
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
        <div class="login-box fade-in">
            <a href="dashboard.php" class="back-link" style="margin-bottom: 2rem;">← Painel do Aluno</a>
            <h2 style="color: var(--accent-primary);">Portal de Provas</h2>
            <p>Insira abaixo o código único de 6 dígitos enviado para o seu e-mail de inscrição.</p>
            
            <input type="text" id="access-code" class="code-input" maxlength="6" placeholder="000000">
            <p id="error" class="error-msg">Código inválido ou já utilizado.</p>
            
            <button id="start-exam" class="btn-primary" style="width: 100%;">VALIDAR E INICIAR</button>
            
            <p style="margin-top: 2rem; font-size: 0.8rem; opacity: 0.7;">
                Problemas com seu código? Consulte o <a href="faq.php" style="color: var(--accent-primary);">Tira-Dúvidas</a>.
            </p>
        </div>
    </main>

    <script>
        document.getElementById('start-exam').addEventListener('click', () => {
            const code = document.getElementById('access-code').value.toUpperCase();
            const error = document.getElementById('error');

            // Simulação de validação (Em um sistema real, isso consultaria o Banco de Dados)
            // Para teste: qualquer código de 6 dígitos funciona
            if (code.length === 6) {
                localStorage.setItem('exam_access_token', 'valid_session_' + code);
                window.location.href = 'exam.php';
            } else {
                error.style.display = 'block';
            }
        });
    </script>
</body>
</html>
