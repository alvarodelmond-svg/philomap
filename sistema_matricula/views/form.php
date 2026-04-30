<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Matrícula Acadêmica</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --success: #10b981;
            --bg: #f8fafc;
            --card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: var(--card);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            color: var(--primary);
            letter-spacing: -0.025em;
        }

        p.subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        input, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.2s;
            background: #fdfdfd;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: #fff;
        }

        button {
            width: 100%;
            padding: 0.875rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        /* Estilo do Comprovante (Summary) */
        .receipt {
            margin-top: 2.5rem;
            border-top: 2px dashed var(--border);
            padding-top: 2rem;
            position: relative;
        }

        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .status-badge {
            background: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .receipt-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .receipt-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .receipt-value {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-main);
        }

        .protocol {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            font-family: monospace;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            border: 1px solid var(--border);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>Sistema de Matrícula</h1>
            <p class="subtitle">Portal do Candidato - Ingresso 2026</p>

            <form action="/philomap/sistema_matricula/store" method="POST">
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
