<?php 
// PhiloMap - Home
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>PhiloMap | Portal de Filosofia</title>
    <?php include 'components/header.php'; ?>
</head>
<body>
    <div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fdfcf9; z-index: 10002; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.4s ease;">
        <div style="font-family: serif; font-size: 2rem; color: #c5a059; margin-bottom: 20px; letter-spacing: 5px; animation: pulse 1.5s infinite;">PHILOMAP</div>
    </div>

    <div class="reading-progress"></div>

    <div class="app-container">
        <?php include 'components/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content" id="main-content" role="main">
            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
            </div>
            
            <div class="daily-quote-card reveal active">
                <div class="quote-icon">“</div>
                <p id="dailyQuoteText">"A vida não examinada não vale a pena ser vivida."</p>
                <cite id="dailyQuoteAuthor">— Sócrates</cite>
            </div>

            <section class="card reveal active">
                <header class="card-header">
                    <span class="subtitulo">Bem-vindo ao Portal</span>
                    <h1>PhiloMap: O Mapa da Filosofia</h1>
                </header>
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=800&q=60" alt="Biblioteca Clássica" loading="lazy">
                </div>
                <p>Sejam bem-vindos ao <strong>Philomap</strong>, o mapa definitivo do pensamento humano.</p>
            </section>
            
            <footer style="text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.8rem;">
                <p>&copy; 2026 PhiloMap — Todos os direitos reservados.</p>
            </footer>
        </main>
    </div>
</body>
</html>
