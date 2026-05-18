<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Entrar</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .login-container { max-width: 400px; margin: 10vh auto; background: #fff; padding: 3rem; border-radius: 20px; box-shadow: var(--shadow-soft); border: 1px solid #eee; text-align: center; }
        .form-group { margin-bottom: 1.5rem; text-align: left; }
        .form-group label { font-size: 0.8rem; font-weight: 700; color: #666; text-transform: uppercase; }
        .form-group input { width: 100%; padding: 1rem; border: 2px solid #f1f2f6; border-radius: 10px; margin-top: 5px; }
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
        <div class="login-container fade-in">
            <h2 style="color: var(--accent-primary); margin-bottom: 2rem;">Acessar Portal</h2>
            <form id="login-form">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" id="login-email" required placeholder="seu@email.com">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" id="login-password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-primary" style="width: 100%;">ENTRAR</button>
            </form>
            <p style="margin-top: 2rem; font-size: 0.9rem;">Novo por aqui? <a href="registration.php" style="color: var(--accent-primary); font-weight: 700;">Inscreva-se</a></p>
        </div>
    </main>

    <script>
        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const pass = document.getElementById('login-password').value;
            
            const storedEmail = localStorage.getItem('olympia_email');
            const storedPass = localStorage.getItem('olympia_password');

            if (email === storedEmail && pass === storedPass) {
                alert("Bem-vindo de volta!");
                window.location.href = 'dashboard.php';
            } else {
                alert("E-mail ou senha incorretos.");
            }
        });
    </script>
</body>
</html>
