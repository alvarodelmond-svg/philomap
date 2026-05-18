<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro do Sistema</title>
    <style>
        body { background: #f8f5ef; color: #2d2d2d; font-family: Inter, sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; border: 1px solid #e6e0d9; border-radius: 24px; padding: 3rem; max-width: 620px; box-shadow: 0 30px 80px rgba(0,0,0,0.08); }
        h1 { margin: 0 0 1rem; font-size: 2rem; }
        p { line-height: 1.7; color: #5a5a5a; }
        a { color: #c5a059; text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Ops! Algo deu errado.</h1>
        <p>O sistema não pôde carregar corretamente. Aguarde alguns instantes e tente novamente.</p>
        <?php if (!empty($message)): ?>
            <p><strong>Mensagem técnica:</strong> <?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <p><a href="/">Voltar para a página inicial</a></p>
    </div>
</body>
</html>
