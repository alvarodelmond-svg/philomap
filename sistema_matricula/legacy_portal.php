<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Matrícula Acadêmica</title>
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
            perspective: 1200px;
        }

        .card {
            background: var(--surface);
            padding: 4rem;
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            transition: var(--transition-smooth);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            color: var(--text-main);
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }

        p.subtitle {
            text-align: center;
            color: var(--text-dim);
            margin-bottom: 3rem;
            font-size: 1rem;
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

        button:active { transform: translateY(-1px) scale(0.98); }

        /* Estilos do Resultado */
        .result-section {
            display: none;
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 1px solid var(--border);
            animation: fadeIn 1.5s ease;
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .alert {
            padding: 1.2rem;
            border-radius: 15px;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert-success { 
            background: rgba(197, 160, 89, 0.1); 
            color: var(--gold);
            border: 1px solid var(--gold);
        }
        
        .alert-error { 
            background: #fff5f5; 
            color: #c53030;
            border: 1px solid #feb2b2;
        }

        .receipt-card {
            background: var(--bg);
            padding: 2rem;
            border-radius: 20px;
            border: 1px solid var(--border);
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .receipt-label { color: var(--text-dim); font-weight: 400; }
        .receipt-value { 
            font-weight: 800; 
            color: var(--text-main); 
            font-family: 'Playfair Display', serif;
        }

        .protocol-badge {
            background: var(--accent);
            color: var(--bg);
            padding: 1rem;
            text-align: center;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            letter-spacing: 2px;
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Custom Scrollbar matching Philomap */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }
    </style>
</head>
<body>

    <div class="container">
        <div class="card" id="mainCard">
            <h1>Portal Acadêmico</h1>
            <p class="subtitle">Inscreva-se hoje e comece sua jornada.</p>

            <form id="matriculaForm">
                <div class="form-group">
                    <label for="nome">Nome do Candidato</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="idade">Idade Atual</label>
                    <input type="number" id="idade" name="idade" min="1" placeholder="Ex: 22" required>
                </div>

                <div class="form-group">
                    <label for="curso">Curso Desejado</label>
                    <select id="curso" name="curso" required>
                        <option value="" disabled selected>Selecione um curso...</option>
                        <option value="Sistemas de Informação">Sistemas de Informação</option>
                        <option value="Ciência da Computação">Ciência da Computação</option>
                        <option value="Inteligência Artificial">Inteligência Artificial</option>
                        <option value="CyberSegurança">CyberSegurança</option>
                    </select>
                </div>

                <button type="submit" id="submitBtn">Finalizar Inscrição</button>
            </form>

            <!-- Seção de Resultado Dinâmico -->
            <div id="resultSection" class="result-section">
                <div id="alertBox" class="alert"></div>
                
                <div id="receiptDetails" class="receipt-card">
                    <div class="receipt-row">
                        <span class="receipt-label">Aluno:</span>
                        <span class="receipt-value" id="resNome"></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Curso:</span>
                        <span class="receipt-value" id="resCurso"></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Data:</span>
                        <span class="receipt-value" id="resData"></span>
                    </div>
                    <div class="protocol-badge" id="resProtocolo"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('matriculaForm');
        const submitBtn = document.getElementById('submitBtn');
        const resultSection = document.getElementById('resultSection');
        const alertBox = document.getElementById('alertBox');
        const receiptDetails = document.getElementById('receiptDetails');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // UI State: Loading
            submitBtn.textContent = 'Processando...';
            submitBtn.classList.add('loading');
            resultSection.style.display = 'none';

            const formData = new FormData(form);

            try {
                // Enviando para o index.php que agora atua como container
                const response = await fetch('index.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.phpon();

                if (response.ok && result.status === 'success') {
                    // SUCESSO
                    alertBox.textContent = result.message;
                    alertBox.className = 'alert alert-success';
                    
                    document.getElementById('resNome').textContent = result.data.nome;
                    document.getElementById('resCurso').textContent = result.data.curso;
                    document.getElementById('resData').textContent = result.data.data;
                    document.getElementById('resProtocolo').textContent = result.data.protocolo;
                    
                    receiptDetails.style.display = 'block';
                    form.reset();
                } else {
                    // ERRO (Validação ou Servidor)
                    alertBox.textContent = result.message || 'Erro inesperado.';
                    alertBox.className = 'alert alert-error';
                    receiptDetails.style.display = 'none';
                }
            } catch (error) {
                alertBox.textContent = 'Não foi possível conectar ao servidor.';
                alertBox.className = 'alert alert-error';
                receiptDetails.style.display = 'none';
            } finally {
                submitBtn.textContent = 'Finalizar Inscrição';
                submitBtn.classList.remove('loading');
                resultSection.style.display = 'block';
                
                // Scroll suave para o resultado
                resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    </script>
</body>
</html>
