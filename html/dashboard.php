<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Painel do Aluno</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .dashboard-grid { display: grid; grid-template-columns: 250px 1fr; min-height: 80vh; padding: 2rem 5%; gap: 2rem; }
        .sidebar { background: var(--glass-bg); padding: 2rem; border-radius: 15px; border: 1px solid var(--glass-border); }
        .sidebar ul li { margin-bottom: 1rem; padding: 1rem; border-radius: 5px; cursor: pointer; font-weight: 700; color: #666; transition: all 0.3s; }
        .sidebar ul li:hover { background: rgba(74, 144, 226, 0.05); color: var(--accent-primary); }
        .sidebar ul li.active { background: var(--accent-primary); color: white; }
        .content-area { background: var(--glass-bg); padding: 2rem; border-radius: 15px; border: 1px solid var(--glass-border); }
        .view-section { display: none; }
        .view-section.active { display: block; }
        .stat-card { background: #ffffff; padding: 1.5rem; border-radius: 10px; text-align: center; border: 1px solid var(--glass-border); box-shadow: var(--shadow-soft); }
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
                <li><a href="login.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-grid">
        <aside class="sidebar">
            <h3>Menu</h3>
            <ul style="margin-top: 2rem;">
                <li id="menu-overview" class="active" onclick="switchView('overview', this)">Minhas Provas</li>
                <li id="menu-results" onclick="switchView('results', this)">Meus Resultados</li>
                <li id="menu-certificates" onclick="switchView('certificates', this)">Certificados</li>
                <li id="menu-settings" onclick="switchView('settings', this)">Configurações</li>
            </ul>
        </aside>

        <section class="content-area">
            <a href="index.php" class="back-link">← Voltar para o Início</a>
            <h2 style="margin-bottom: 2rem;">Olá, <span id="user-name" style="color: var(--accent-primary);">Estudante</span>!</h2>
            
            <!-- Visão Geral -->
            <div id="view-overview" class="view-section active">
                <div class="stat-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="stat-card">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">Inscrições Ativas</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--accent-primary);" id="reg-count">0</div>
                    </div>
                    <div class="stat-card">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">Ranking Global</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--accent-secondary);" id="global-rank">#421</div>
                    </div>
                    <div class="stat-card">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">Nível de Progresso</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--accent-gold);">Bronze II</div>
                    </div>
                    <div class="stat-card">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">Medalhas</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--accent-primary);">0</div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                    <div>
                        <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading);">Provas Disponíveis</h3>
                        <div id="registrations-list" style="display: grid; gap: 1.5rem;"></div>
                    </div>
                    <div>
                        <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading);">Atividade Recente</h3>
                        <div style="background: white; border-radius: 15px; padding: 1.5rem; border: 1px solid var(--glass-border);">
                            <div style="border-left: 3px solid var(--accent-secondary); padding-left: 1rem; margin-bottom: 1.5rem;">
                                <p style="font-size: 0.8rem; font-weight: 700;">Inscrição Confirmada</p>
                                <p style="font-size: 0.7rem; color: var(--text-muted);">Hoje, às 14:30</p>
                            </div>
                            <div style="border-left: 3px solid var(--accent-primary); padding-left: 1rem; margin-bottom: 1.5rem;">
                                <p style="font-size: 0.8rem; font-weight: 700;">Perfil Atualizado</p>
                                <p style="font-size: 0.7rem; color: var(--text-muted);">Ontem, às 10:15</p>
                            </div>
                            <div style="border-left: 3px solid #eee; padding-left: 1rem;">
                                <p style="font-size: 0.8rem; font-weight: 700; color: #ccc;">Nenhuma prova realizada</p>
                            </div>
                        </div>

                        <div style="margin-top: 2rem; background: var(--accent-primary); color: white; padding: 1.5rem; border-radius: 15px; position: relative; overflow: hidden;">
                            <h4 style="margin-bottom: 0.5rem; font-size: 1rem;">Dica da Semana</h4>
                            <p style="font-size: 0.75rem; opacity: 0.9; line-height: 1.4;">Revise os conceitos de Probabilidade Condicional para a prova do dia 15/06.</p>
                            <div style="position: absolute; right: -10px; bottom: -10px; font-size: 4rem; opacity: 0.2;">💡</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            <div id="view-results" class="view-section">
                <h3>Boletim de Desempenho</h3>
                <p style="margin-bottom: 2rem;">Confira suas notas e medalhas após a auditoria.</p>
                <div id="results-list" style="display: grid; gap: 1rem;">
                    <p style="color: #666; font-style: italic;">Nenhum resultado liberado ainda. Aguarde a auditoria (72h).</p>
                </div>
                <button onclick="processResults()" class="btn-secondary" style="margin-top: 2rem; font-size: 0.7rem;">[SIMULAR FIM DA AUDITORIA]</button>
            </div>

            <!-- Certificados -->
            <div id="view-certificates" class="view-section">
                <h3>Meus Certificados</h3>
                <div id="certificates-list" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
                    <p style="color: #666; font-style: italic;">Conclua as provas para liberar seus certificados.</p>
                </div>
            </div>

            <!-- Configurações -->
            <div id="view-settings" class="view-section">
                <h3>Configurações da Conta</h3>
                <div style="background: white; padding: 2rem; border-radius: 15px; margin-top: 1rem; border: 1px solid #eee;">
                    <h4 style="margin-bottom: 1rem;">Alterar Senha de Acesso</h4>
                    <div class="form-group">
                        <input type="password" id="new-password" placeholder="Nova Senha" style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 1rem; width: 100%; display: block; color: #000 !important;">
                    </div>
                    <button onclick="changePassword()" class="btn-primary" style="font-size: 0.8rem;">ATUALIZAR SENHA</button>
                </div>
            </div>
        </section>
    </main>

    <script src="../js/dashboard.js"></script>
    <script src="../js/scheduler.js"></script>
    <script src="../js/results-engine.js"></script>
    <footer><p>&copy; 2026 olunic - Odyssey of Minds. Todos os direitos reservados.</p></footer>

    <script>
        function switchView(viewId, element) {
            // 1. Esconde todas as seções e remove classe active
            const sections = document.querySelectorAll('.view-section');
            sections.forEach(v => {
                v.classList.remove('active');
                v.style.display = 'none';
            });
            
            // 2. Remove destaque de todos os itens da sidebar
            const menuItems = document.querySelectorAll('.sidebar li');
            menuItems.forEach(li => li.classList.remove('active'));
            
            // 3. Mostra a seção alvo
            const target = document.getElementById('view-' + viewId);
            if(target) {
                target.classList.add('active');
                target.style.display = 'block';
            }
            
            // 4. Ativa o item clicado
            element.classList.add('active');
        }

        function changePassword() {
            const newPass = document.getElementById('new-password').value;
            if(newPass.length < 4) {
                alert("A senha deve ter ao menos 4 caracteres.");
                return;
            }
            localStorage.setItem('olympia_password', newPass);
            alert("Senha alterada com sucesso! Use a nova senha no próximo login.");
            document.getElementById('new-password').value = "";
        }
    </script>
</body>
</html>
