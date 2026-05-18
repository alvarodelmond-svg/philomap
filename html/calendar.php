<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olunic - Calendário</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .calendar-container {
            padding: 5rem 10%;
        }
        .event-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .event-item {
            display: flex;
            align-items: center;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 2rem;
            border-radius: 15px;
            gap: 2rem;
        }
        .event-date {
            min-width: 100px;
            text-align: center;
            border-right: 1px solid var(--glass-border);
            padding-right: 2rem;
        }
        .event-date span {
            display: block;
            font-size: 2rem;
            font-weight: bold;
            color: var(--accent-blue);
        }
        .event-info h3 {
            color: var(--accent-gold);
            margin-bottom: 0.5rem;
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

    <main class="calendar-container">
        <h2 style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 3rem;">Calendário de Torneios 2026</h2>
        
        <div class="event-list">
            <div class="event-item">
                <div class="event-date">
                    <span>15</span> JUN
                </div>
                <div class="event-info">
                    <h3>Nebula Math - Fase Única</h3>
                    <p>Horário: 14:00 (Brasília). Todas as categorias.</p>
                </div>
            </div>
            <div class="event-item">
                <div class="event-date">
                    <span>22</span> JUN
                </div>
                <div class="event-info">
                    <h3>Cyber Code Quest</h3>
                    <p>Horário: 10:00 (Brasília). Categorias Eruditos e Mestres.</p>
                </div>
            </div>
            <div class="event-item">
                <div class="event-date">
                    <span>05</span> JUL
                </div>
                <div class="event-info">
                    <h3>Quantum Horizon</h3>
                    <p>Horário: 15:00 (Brasília). Categoria Mestres.</p>
                </div>
            </div>
            <div class="event-item">
                <div class="event-date">
                    <span>12</span> JUL
                </div>
                <div class="event-info">
                    <h3>Bio Genesis</h3>
                    <p>Horário: 09:00 (Brasília). Todas as categorias.</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Olunic - Odyssey of Minds. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
