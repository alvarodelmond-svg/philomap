<?php 
// Preparação para integração futura com Sessões ou Auth se necessário
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiloMap | Inscrição</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    
    <link rel="stylesheet" href="../assets/css/style.php">
    <link rel="stylesheet" href="../assets/css/inscricao.php">
    <link rel="stylesheet" href="../assets/css/sidebar-modern.php">
    
    <script src="../assets/js/db.php" defer></script>
    <script src="../assets/js/controller.php" defer></script>
    <script src="../assets/js/script.php" defer></script>
    <script src="../assets/js/sidebar.php" defer></script>
</head>
<body>
    <div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fdfcf9; z-index: 10002; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.4s ease;">
        <div style="font-family: serif; font-size: 2rem; color: #c5a059; margin-bottom: 20px; letter-spacing: 5px; animation: pulse 1.5s infinite;">PHILOMAP</div>
        <div style="width: 150px; height: 1px; background: #e8e2d8; position: relative; overflow: hidden;">
            <div style="position: absolute; width: 40px; height: 100%; background: #c5a059; animation: loading 1.5s infinite linear;"></div>
        </div>
    </div>

    <div class="reading-progress"></div>

    <div class="app-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="../index.php" class="sidebar-logo">
                <img src="../assets/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" loading="eager" width="280" height="280">
            </a>

            <nav class="nav-group">
                <span class="nav-label">Explorar</span>
                <div class="search-container">
                    <input type="text" id="searchConcepts" placeholder="Buscar verdade..." autocomplete="off">
                    <span class="search-icon">⚲</span>
                </div>
                
                <div class="nav-collapsible-header" id="conceptsToggle">
                    <span class="nav-label">Conceitos</span>
                    <span class="chevron">▼</span>
                </div>
                <ul class="nav-list collapsible-content" id="conceptsList">
                    <li class="nav-item"><a href="etica.php">Ética</a></li>
                    <li class="nav-item"><a href="logica.php">Lógica</a></li>
                    <li class="nav-item"><a href="moralismo.php">Moralismo</a></li>
                    <li class="nav-item"><a href="existencialismo.php">Existencialismo</a></li>
                    <li class="nav-item"><a href="estetica.php">Estética</a></li>
                    <li class="nav-item"><a href="metafisica.php">Metafísica</a></li>
                    <li class="nav-item"><a href="epistemologia.php">Epistemologia</a></li>
                    <li class="nav-item"><a href="politica.php">Política</a></li>
                    <li class="nav-item"><a href="linguagem.php">Linguagem</a></li>
                    <li class="nav-item"><a href="estoicismo.php">Estoicismo</a></li>
                    <li class="nav-item"><a href="fenomenologia.php">Fenomenologia</a></li>
                    <li class="nav-item"><a href="cinismo.php">Cinismo</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Estudos</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="literatura.php">Literatura</a></li>
                </ul>
            </nav>

            <nav class="nav-group">
                <span class="nav-label">Institucional</span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="../index.php">Início</a></li>
                    <li class="nav-item"><a href="inscricao.php" class="active">Inscrição</a></li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="accessibility-controls">
                    <span class="nav-label" style="margin-bottom: 10px; display: block;">Acessibilidade</span>
                    <div class="font-controls">
                        <button onclick="changeFontSize('small')" title="Fonte Pequena">A-</button>
                        <button onclick="changeFontSize('medium')" title="Fonte Normal">A</button>
                        <button onclick="changeFontSize('large')" title="Fonte Grande">A+</button>
                    </div>
                    <button class="theme-toggle" onclick="toggleHighContrast()" style="margin-top: 10px; font-size: 0.7rem;">Alto Contraste</button>
                </div>
                <button class="theme-toggle" onclick="toggleTheme()" style="margin-top: 10px;">Mudar Tema</button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="breadcrumbs"><a href="../index.php">Início</a> / <span>Inscrição</span></div>

            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>

            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Adesão</span>
                    <h1>Portal de Membros PhiloMap</h1>
                </header>
                
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=1200&q=80" alt="Estudo e Reflexão" loading="lazy" width="1200" height="800">
                </div>
                
                <p>Seja bem-vindo ao processo de registro do PhiloMap. Ao se tornar um membro de nossa comunidade, você terá acesso a materiais exclusivos e fóruns de discussão sobre os grandes temas da filosofia clássica e contemporânea.</p>
            </section>

            <section class="card reveal" id="matriculaSection">
                <header class="card-header">
                    <span class="subtitulo">O Oráculo</span>
                    <h2>O que deseja estudar, filósofo?</h2>
                </header>

                <form id="matriculaForm" class="modern-form">
                    <div class="form-group">
                        <label for="nome">COMO DEVEMOS CHAMÁ-LO, BUSCADOR?</label>
                        <input type="text" id="nome" name="nome" placeholder="Seu nome ou pseudônimo" required>
                    </div>

                    <div class="form-group">
                        <label for="idade">QUANTO TEMPO DE JORNADA NESTA EXISTÊNCIA?</label>
                        <input type="number" id="idade" name="idade" min="1" placeholder="Sua idade atual" required>
                    </div>

                    <div class="form-group">
                        <label for="curso">QUAL CAMINHO DA SABEDORIA VOCÊ ESCOLHE?</label>
                        <select id="curso" name="curso" required>
                            <option value="" disabled selected>Escolha sua trilha...</option>
                            <option value="Ética e Moralismo">Ética e a Arte de Viver</option>
                            <option value="Metafísica e Ontologia">O Mistério do Ser (Metafísica)</option>
                            <option value="Lógica e Razão">As Leis do Pensamento (Lógica)</option>
                            <option value="Existencialismo">A Liberdade e o Absurdo (Existencialismo)</option>
                            <option value="Estética e Arte">A Natureza do Belo (Estética)</option>
                            <option value="Política e Sociedade">O Contrato Social (Política)</option>
                        </select>
                    </div>

                    <button type="submit" id="submitBtn" class="btn-submit">CONFIRMAR MINHA JORNADA</button>
                </form>

                <!-- Seção de Resultado Dinâmico -->
                <div id="resultSection" style="display: none;">
                    <div id="alertBox"></div>

                    <div class="certificate-container" id="receiptDetails">
                        <div class="cert-header">
                            <h3>Decreto de Admissão</h3>
                            <h2>Certificado de Iniciação</h2>
                        </div>
                        
                        <div class="cert-body">
                            <div class="cert-row">
                                <span class="cert-label">Buscador da Verdade</span>
                                <span class="cert-value" id="resNome"></span>
                            </div>
                            <div class="cert-row">
                                <span class="cert-label">Trilha do Conhecimento</span>
                                <span class="cert-value" id="resCurso" style="color: var(--gold);"></span>
                            </div>
                            <div class="cert-row">
                                <span class="cert-label">Data da Iluminação</span>
                                <span class="cert-value" id="resData"></span>
                            </div>
                        </div>

                        <div class="cert-footer">
                            <div class="cert-signature">
                                Conselho PhiloMap
                            </div>
                            <div class="cert-seal">
                                <div id="resProtocolo" style="font-size: 1rem; letter-spacing: 1px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="listaDados" style="margin-top: 40px;">
                </div>
            </section>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const form = document.getElementById('matriculaForm');
                    const submitBtn = document.getElementById('submitBtn');
                    const resultSection = document.getElementById('resultSection');
                    const alertBox = document.getElementById('alertBox');
                    const receiptDetails = document.getElementById('receiptDetails');

                    if (form) {
                        form.addEventListener('submit', async (e) => {
                            e.preventDefault();
                            
                            submitBtn.textContent = 'PROCESSANDO...';
                            submitBtn.style.opacity = '0.7';
                            submitBtn.disabled = true;
                            resultSection.style.display = 'none';

                            const formData = new FormData(form);

                            try {
                                const response = await fetch('../sistema_matricula/index.php', {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: formData
                                });

                                if (!response.ok) {
                                    const errorData = await response.phpon();
                                    throw new Error(errorData.message || 'Erro no servidor.');
                                }

                                const result = await response.phpon();

                                if (result.status === 'success') {
                                    alertBox.textContent = result.message;
                                    alertBox.className = 'alert-success';
                                    
                                    document.getElementById('resNome').textContent = result.data.nome;
                                    document.getElementById('resCurso').textContent = result.data.curso;
                                    document.getElementById('resData').textContent = result.data.data;
                                    document.getElementById('resProtocolo').textContent = result.data.protocolo;
                                    
                                    receiptDetails.style.display = 'block';
                                    form.reset();
                                } else {
                                    alertBox.textContent = result.message || 'Erro inesperado.';
                                    alertBox.className = 'alert-error';
                                    receiptDetails.style.display = 'none';
                                }
                            } catch (error) {
                                alertBox.textContent = error.message;
                                alertBox.className = 'alert-error';
                                receiptDetails.style.display = 'none';
                            } finally {
                                submitBtn.textContent = 'CONFIRMAR MINHA JORNADA';
                                submitBtn.style.opacity = '1';
                                submitBtn.disabled = false;
                                resultSection.style.display = 'block';
                                resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        });
                    }
                });
            </script>

            <footer style="text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.8rem;">
                <p>&copy; 2026 PhiloMap — Todos os direitos reservados.</p>
            </footer>
        </main>
    </div>
</body>
</html>
