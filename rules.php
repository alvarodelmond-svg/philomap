<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olunic - Regulamento</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .rules-container {
            padding: 5rem 15%;
        }
        .rule-section {
            margin-bottom: 3rem;
        }
        .rule-section h3 {
            color: var(--accent-gold);
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .category-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }
        .category {
            background: var(--glass-bg);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--accent-blue);
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

    <main class="rules-container">
        <h2 style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 3rem;">Diretrizes e Regulamento</h2>

        <div class="rule-section">
            <h3>1. Categorias de Participação</h3>
            <p>Os participantes são divididos em três categorias principais para garantir uma competição justa:</p>
            <div class="category-box">
                <div class="category">
                    <h4>Iniciados</h4>
                    <p>Estudantes do Ensino Fundamental (6º ao 9º ano). Foco em raciocínio lógico e conceitos base.</p>
                </div>
                <div class="category">
                    <h4>Eruditos</h4>
                    <p>Estudantes do Ensino Médio. Desafios de aplicação técnica e interdisciplinaridade.</p>
                </div>
                <div class="category">
                    <h4>Mestres</h4>
                    <p>Categoria aberta para universitários e entusiastas (Idade Livre). Nível avançado de complexidade.</p>
                </div>
            </div>
        </div>

        <div class="rule-section">
            <h3>2. Avaliação e Pontuação</h3>
            <p>Todas as provas ocorrem exclusivamente através da nossa plataforma digital segura.</p>
            <ul>
                <li><strong>Estrutura:</strong> 40 questões de múltipla escolha com 5 alternativas cada.</li>
                <li><strong>Pontuação:</strong> 2.5 pontos por acerto. Não há penalização por erro (voto nulo).</li>
                <li><strong>Critérios de Desempate:</strong> 
                    1º Tempo de conclusão; 
                    2º Menor número de tentativas de acesso fora do Safe Browser; 
                    3º Idade (mais jovem).
                </li>
                <li><strong>Duração:</strong> 3 horas de prova ininterruptas. O cronômetro inicia no momento do primeiro acesso.</li>
            </ul>
        </div>

        <div class="rule-section">
            <h3>3. Segurança e Integridade da Prova</h3>
            <p>Para garantir a justiça sem a necessidade de softwares invasivos, utilizamos métodos inteligentes de monitoramento nativo:</p>
            <ul>
                <li><strong>Questões Randomizadas:</strong> A ordem das questões e alternativas é única para cada participante, desencorajando o compartilhamento de gabaritos.</li>
                <li><strong>Janela de Foco:</strong> O sistema detecta se o participante saiu da aba da prova. Três avisos resultam no bloqueio automático da conta.</li>
                <li><strong>Tempo Estrito por Questão:</strong> Algumas seções possuem limite de tempo individual para reduzir a possibilidade de consultas externas.</li>
                <li><strong>Banco de Dados de Plágio:</strong> Respostas dissertativas (quando houver) passam por um software interno de detecção de similaridade.</li>
                <li><strong>Registro de Log:</strong> Todo o comportamento de navegação durante a prova é registrado para auditoria em caso de notas suspeitas.</li>
            </ul>
        </div>

        <div class="rule-section">
            <h3>4. Premiação e Distribuição de Medalhas</h3>
            <p>Os resultados são auditados em até 72 horas após o término da janela oficial de prova. A distribuição de medalhas segue uma lógica proporcional baseada no número de participantes ativos por categoria:</p>
            <ul>
                <li><strong>Medalha de Ouro:</strong> Destinada aos primeiros 3% dos participantes (ex: 30 medalhas para 1000 inscritos).</li>
                <li><strong>Medalha de Prata:</strong> Destinada aos próximos 7% dos participantes (ex: 70 medalhas para 1000 inscritos).</li>
                <li><strong>Medalha de Bronze:</strong> Destinada aos próximos 10% dos participantes (ex: 100 medalhas para 1000 inscritos).</li>
                <li><strong>Honra ao Mérito:</strong> Certificado digital especial para os próximos 10% que atingirem a nota de corte mínima (ex: 100 certificados para 1000 inscritos).</li>
            </ul>
            <p style="margin-top: 1rem; font-size: 0.9rem; font-style: italic;">*Nota: Em caso de empate na última vaga de cada tier, os critérios de desempate do Artigo 2 serão aplicados rigorosamente.</p>
        </div>

        <div class="rule-section">
            <h3>5. Emissão e Entrega</h3>
            <ul>
                <li><strong>Medalhas Digitais:</strong> Emitidas em formato NFT (Blockchain) para garantir autenticidade.</li>
                <li><strong>Medalhas Físicas:</strong> Enviadas via correio para os medalhistas de Ouro, Prata e Bronze (frete sob responsabilidade do Olunic).</li>
            </ul>
        </div>

        <div class="rule-section">
            <h3>5. Termos Burocráticos e Elegibilidade</h3>
            <p>Ao se inscrever, o candidato declara estar ciente de que:</p>
            <ol>
                <li>A inscrição é pessoal, intransferível e vinculada ao CPF/RG informado.</li>
                <li>É proibida a gravação, reprodução ou compartilhamento das questões da prova sob pena de processo judicial por violação de direitos autorais.</li>
                <li>Os casos omissos neste regulamento serão decididos soberanamente pelo Comitê Científico da Olunic.</li>
                <li>O foro eleito para qualquer disputa legal é o da Comarca de São Paulo/SP.</li>
            </ol>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Olunic - Odyssey of Minds. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
