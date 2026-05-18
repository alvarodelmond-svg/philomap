<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Sistema de Prova</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .exam-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--shadow-soft);
        }
        .timer-bar {
            position: sticky;
            top: 80px;
            background: var(--accent-primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            font-weight: bold;
            z-index: 100;
        }
        .question-card {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            border-left: 5px solid var(--accent-primary);
        }
        .options-list {
            margin-top: 1rem;
        }
        .option-item {
            display: block;
            padding: 10px;
            margin: 5px 0;
            background: var(--bg-secondary);
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition-smooth);
        }
        .option-item:hover {
            background: #e9ecef;
        }
        .option-item input {
            margin-right: 10px;
        }
        .warning-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.9);
            color: white;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div id="warning" class="warning-overlay">
        <h1>ALERTA DE SEGURANÇA</h1>
        <p>Você saiu da aba da prova. Isso foi registrado.</p>
        <p>Mais 2 tentativas e sua prova será anulada.</p>
        <button onclick="document.getElementById('warning').style.display='none'" class="btn-primary" style="margin-top: 2rem;">ENTENDI E VOLTAR</button>
    </div>

    <header>
        <a href="index.php" class="logo-container" onclick="return confirm('Tem certeza que deseja sair da prova? Seu progresso atual não será salvo.')" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
            <img src="../assets/logo.svg" alt="olunic logo" width="30">
            <span class="logo-text">olunic</span>
        </a>
        <div style="display: flex; align-items: center; gap: 20px;">
            <div id="student-name" style="font-weight: 700; color: var(--accent-primary);"></div>
            <a href="dashboard.php" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">SAIR DA PROVA</a>
        </div>
    </header>

    <main class="exam-container">
        <!-- Barra de Progresso Visual -->
        <div id="exam-progress-bar" style="width: 100%; height: 8px; background: #eee; border-radius: 4px; margin-bottom: 15px; overflow: hidden; border: 1px solid #ddd;">
            <div id="progress-fill" style="width: 0%; height: 100%; background: var(--accent-secondary); transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);"></div>
        </div>

        <div class="timer-bar">
            <span>Tempo Restante: <span id="timer">03:00:00</span></span>
            <span id="question-counter">Questão 1 de 40</span>
        </div>

        <div id="quiz-area">
            <!-- Questões dinâmicas -->
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 2rem;">
            <button id="prev-btn" class="btn-secondary">← Anterior</button>
            <button id="next-btn" class="btn-primary">Próxima →</button>
        </div>
    </main>

    <!-- BANCO DE QUESTÕES COMPLETO -->
    <script src="../js/questions-math.js"></script>
    <script src="../js/questions-code.js"></script>
    <script src="../js/questions-astro.js"></script>
    <script src="../js/questions-ai.js"></script>
    <script src="../js/questions-eco.js"></script>
    <script src="../js/questions-history.js"></script>
    
    <script src="../js/exam-engine.js"></script>
</body>
</html>
