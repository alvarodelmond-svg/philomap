<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Matrícula Acadêmica</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #fdfcf9;
            --surface: #ffffff;
            --border: #e8e2d8;
            --text-main: #1a1a1a;
            --text-dim: #706c61;
            --accent: #0f0f0f;
            --gold: #c5a059;
            --gold-glow: rgba(197, 160, 89, 0.4);
            --transition-smooth: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            line-height: 1.7;
        }

        .container {
            width: 100%;
            max-width: 550px;
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: var(--surface);
            padding: 4rem;
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 0.8rem;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        p.subtitle {
            text-align: center;
            color: var(--text-dim);
            font-size: 1rem;
            margin-bottom: 3rem;
            font-style: italic;
            font-family: 'Playfair Display', serif;
        }

        .form-group { margin-bottom: 2rem; }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 800;
            margin-bottom: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--gold);
        }

        input, select {
            width: 100%;
            padding: 1.2rem;
            border: 1px solid var(--border);
            border-radius: 15px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: var(--transition-smooth);
            background: var(--bg);
            color: var(--text-main);
            outline: none;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 10px 30px var(--gold-glow);
            transform: translateY(-2px);
        }

        button {
            width: 100%;
            padding: 1.2rem;
            background: var(--accent);
            color: var(--bg);
            border: none;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: var(--transition-smooth);
            margin-top: 1.5rem;
        }

        button:hover {
            background: var(--gold);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px var(--gold-glow);
        }

        /* Estilo do Comprovante (Summary) */
        .receipt {
            margin-top: 3rem;
            border-top: 1px solid var(--border);
            padding-top: 2.5rem;
            position: relative;
        }

        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .status-badge {
            background: rgba(197, 160, 89, 0.1);
            color: var(--gold);
            padding: 6px 16px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 1px solid var(--gold);
        }

        .receipt-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
        }

        .receipt-label {
            font-size: 0.75rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .receipt-value {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-main);
            font-family: 'Playfair Display', serif;
        }

        .protocol {
            background: var(--accent);
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            color: var(--bg);
            margin-top: 2rem;
            border: 1px solid var(--gold);
            letter-spacing: 2px;
            font-weight: 800;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>Sistema de Matrícula</h1>
            <p class="subtitle">Portal do Candidato - Ingresso 2026</p>

            <form action="/sistema_matricula/store" method="POST">
                <div class="form-group">
                    <label for="nome">Nome do Aluno</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
                </div>

                <div class="form-group">
                    <label for="idade">Idade</label>
                    <input type="number" id="idade" name="idade" min="16" max="100" placeholder="Ex: 20" required>
                </div>

                <div class="form-group">
                    <label for="curso">Curso de Graduação</label>
                    <select id="curso" name="curso" required>
                        <option value="" disabled selected>Escolha sua carreira...</option>
                        <option value="Engenharia de Software">Engenharia de Software</option>
                        <option value="Ciência de Dados">Ciência de Dados</option>
                        <option value="Arquitetura Digital">Arquitetura Digital</option>
                        <option value="Gestão de TI">Gestão de TI</option>
                    </select>
                </div>

                <button type="submit">Efetivar Matrícula</button>
            </form>

            <?php if (isset($exibirResumo) && $exibirResumo): ?>
            <div class="receipt">
                <div class="receipt-header">
                    <h2 style="font-size: 1.1rem; font-weight: 700;">Comprovante de Registro</h2>
                    <span class="status-badge">Confirmado</span>
                </div>

                <div class="receipt-item">
                    <span class="receipt-label">Aluno Matriculado</span>
                    <span class="receipt-value"><?php echo $dados['nome']; ?></span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="receipt-item">
                        <span class="receipt-label">Idade</span>
                        <span class="receipt-value"><?php echo $dados['idade']; ?> anos</span>
                    </div>
                    <div class="receipt-item">
                        <span class="receipt-label">Data/Hora</span>
                        <span class="receipt-value"><?php echo $dados['data']; ?></span>
                    </div>
                </div>

                <div class="receipt-item">
                    <span class="receipt-label">Curso Escolhido</span>
                    <span class="receipt-value"><?php echo $dados['curso']; ?></span>
                </div>

                <div class="protocol">
                    <span style="font-size: 0.7rem; display: block; margin-bottom: 4px; color: var(--text-muted);">PROTOCOLO DE SEGURANÇA</span>
                    <strong><?php echo $dados['protocolo']; ?></strong>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
