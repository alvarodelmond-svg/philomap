<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Inscrição Segura</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/core.js" defer></script>
    <style>
        .form-container { max-width: 800px; margin: 3rem auto; background: var(--card-bg); padding: 4rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); border: 1px solid var(--glass-border); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        .security-badge { background: var(--accent-success); color: #14532d; padding: 10px; border-radius: 8px; font-size: 0.8rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; opacity: 0.9; }
        .form-group label { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block; margin-bottom: 8px; font-weight: 700; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; border: 2px solid var(--glass-border); padding: 1rem; border-radius: var(--radius-md); transition: var(--transition-smooth); font-family: inherit; background: var(--bg-color); color: var(--text-color); }
        .form-group input:focus { border-color: var(--accent-primary); background: var(--bg-secondary); outline: none; }
        .btn-tab { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-weight: 700; }
        .checkbox-item { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; color: var(--text-color); }
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

    <main>
        <div class="form-container fade-in">
            <a href="index.php" class="back-link">← Início</a>
            <div class="security-badge">
                <span>🛡️</span> Seus dados estão protegidos por criptografia de ponta a ponta (LGPD Compliance).
            </div>
            <h2 style="color: var(--accent-primary); margin-bottom: 1rem;">Formulário de Inscrição Oficial</h2>
            <p style="margin-bottom: 3rem; color: var(--text-muted);">Complete as informações abaixo para validar sua participação.</p>

            <form id="registration-form" class="form-grid">
                <!-- SELETOR DE MODO -->
                <div class="full-width" style="display: flex; gap: 10px; margin-bottom: 2rem; background: var(--bg-secondary); padding: 5px; border-radius: 15px;">
                    <button type="button" id="tab-individual" class="btn-tab" onclick="switchRegMode('individual')" style="flex: 1; padding: 12px; border-radius: 10px; background: var(--accent-primary); color: white;">👤 Individual</button>
                    <button type="button" id="tab-institutional" class="btn-tab" onclick="switchRegMode('institutional')" style="flex: 1; padding: 12px; border-radius: 10px; background: transparent; color: var(--text-muted);">🏫 Colégios</button>
                </div>

                <input type="hidden" id="registration-mode" value="individual">

                <!-- SEÇÃO INDIVIDUAL -->
                <div id="section-individual" class="form-grid full-width">
                    <div class="form-group">
                        <label for="name">Nome Completo do Aluno</label>
                        <input type="text" id="name" placeholder="Como no documento" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF do Aluno</label>
                        <input type="text" id="cpf" placeholder="000.000.000-00" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail para Contato</label>
                        <input type="email" id="email" placeholder="exemplo@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="birth">Data de Nascimento</label>
                        <input type="date" id="birth" required>
                    </div>
                </div>

                <!-- SEÇÃO INSTITUCIONAL -->
                <div id="section-institutional" class="form-grid full-width" style="display: none;">
                    <div class="form-group">
                        <label for="school-full-name">Nome Oficial da Instituição</label>
                        <input type="text" id="school-full-name" placeholder="Ex: Colégio Estadual Olunic">
                    </div>
                    <div class="form-group">
                        <label for="director-name">Nome do Diretor/Coordenador</label>
                        <input type="text" id="director-name" placeholder="Responsável pelas inscrições">
                    </div>
                    <div class="form-group">
                        <label for="school-email">E-mail Institucional</label>
                        <input type="email" id="school-email" placeholder="contato@escola.edu.br">
                    </div>
                    <div class="form-group">
                        <label for="student-count">Estimativa de Alunos</label>
                        <input type="number" id="student-count" placeholder="Ex: 150">
                    </div>
                    <div class="form-group full-width">
                        <label for="school-address">Endereço Completo</label>
                        <input type="text" id="school-address" placeholder="Rua, Número, Bairro, Cidade - UF">
                    </div>
                    <div class="full-width" style="background: var(--bg-secondary); padding: 20px; border-radius: 12px; font-size: 0.85rem; color: var(--text-muted); border: 1px solid var(--glass-border);">
                        <strong>Procedimento para Colégios:</strong> Após o envio deste formulário, nosso comitê entrará em contato em até 24h para fornecer a planilha de importação e os códigos master.
                    </div>
                </div>

                <!-- Acadêmico -->
                <div class="form-group full-width" style="margin-top: 20px;">
                    <label for="inep-code">Código INEP (8 dígitos)</label>
                    <div style="position: relative;">
                        <input type="text" id="inep-code" placeholder="Ex: 12345678" maxlength="8" required>
                        <span id="inep-verify-badge" style="position: absolute; right: 10px; top: 12px; font-size: 0.7rem; padding: 4px 8px; border-radius: 4px; display: none;"></span>
                    </div>
                    <div id="inep-confirmation" style="display: none; margin-top: 8px; padding: 12px; background: var(--accent-success); border-radius: 8px; opacity: 0.9;">
                        <span style="font-size: 0.75rem; color: #166534; font-weight: 700; display: block;">🏫 INSTITUIÇÃO IDENTIFICADA:</span>
                        <span id="school-name-display" style="font-size: 0.9rem; color: #14532d; font-weight: 900;">---</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="institution">Sigla ou Nome Curto</label>
                    <input type="text" id="institution" placeholder="Ex: USP, ETEC..." required>
                </div>
                <div class="form-group">
                    <label for="education">Nível Atual</label>
                    <select id="education" required>
                        <option value="">Selecione...</option>
                        <option value="fundamental">Ensino Fundamental</option>
                        <option value="medio">Ensino Médio</option>
                        <option value="superior">Ensino Superior</option>
                        <option value="livre">Curso Livre / Outros</option>
                    </select>
                </div>

                <!-- Olimpíadas -->
                <div class="form-group full-width">
                    <label style="margin-bottom: 15px; display: block; font-weight: bold; color: var(--accent-primary);">Selecione suas Olimpiadas</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: var(--bg-secondary); padding: 20px; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="history-north" data-name="Olimpíada de História da Região Norte"> Hist. Região Norte</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="art-paintings" data-name="Olimpíada de Pinturas Artísticas"> Pinturas Artísticas</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="oceania-peoples" data-name="Olimpíada de Povos da Oceania"> Povos da Oceania</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="geology" data-name="Olimpíada de Geologia"> Geologia</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="socratic-philosophy" data-name="Olimpíada de Filosofia Socrática"> Filo. Socrática</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="ai-intelligence" data-name="Olimpíada de Inteligência Artificial"> Inteligência Artificial</label>
                        <label class="checkbox-item"><input type="checkbox" name="olympiads" value="math-probability" data-name="Olimpíada de Probabilidade"> Probabilidade (Matemática)</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary full-width" style="padding: 1.5rem; border-radius: 12px; margin-top: 2rem;">
                    CONCLUIR INSCRIÇÃO
                </button>
            </form>
        </div>
    </main>

    <script src="../js/registration.js"></script>
    <footer><p>&copy; 2026 olunic - Excelência Acadêmica Brasileira</p></footer>
</body>
</html>
