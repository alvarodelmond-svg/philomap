<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olunic - Certificado Oficial</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body { background: #e0e0e0; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 2rem; }
        .certificate-border {
            width: 1000px;
            height: 700px;
            padding: 20px;
            background: #fff;
            border: 10px solid var(--accent-primary);
            box-shadow: 0 0 50px rgba(0,0,0,0.2);
            position: relative;
        }
        .inner-border {
            width: 100%;
            height: 100%;
            border: 2px solid var(--accent-secondary);
            padding: 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cert-header { font-size: 1.2rem; font-weight: 700; color: var(--accent-primary); letter-spacing: 5px; }
        .cert-title { font-size: 4rem; font-weight: 900; margin: 2rem 0; color: var(--text-color); }
        .cert-recipient { font-size: 2.5rem; font-family: 'Times New Roman', serif; border-bottom: 2px solid #ccc; display: inline-block; margin: 1rem 0; padding: 0 50px; }
        .cert-text { font-size: 1.2rem; line-height: 1.8; max-width: 80%; margin: 0 auto; }
        .cert-footer { display: flex; justify-content: space-between; align-items: flex-end; }
        .seal { width: 120px; height: 120px; background: var(--accent-primary); border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white; font-weight: 900; font-size: 0.8rem; transform: rotate(-15deg); }
        
        @media print {
            .no-print { display: none; }
            body { background: white; padding: 0; }
            .certificate-border { box-shadow: none; border: 5px solid black; }
        }
    </style>
</head>
<body>
    <div class="certificate-border fade-in">
        <div class="inner-border">
            <div class="cert-header">CERTIFICADO DE EXCELÊNCIA ACADÊMICA</div>
            
            <div class="main-content">
                <p class="cert-text">Certificamos para os devidos fins de direito e honra que</p>
                <div class="cert-recipient" id="cert-name">Carregando...</div>
                <p class="cert-text">participou com distinção da olimpíada <strong id="cert-olympiad">OLUNIC 2026</strong>, atingindo a marca de <strong id="cert-score">0.0</strong> pontos, sendo-lhe conferido este título por seu notório desempenho intelectual.</p>
            </div>

            <div class="cert-footer">
                <div style="text-align: left;">
                    <p>ID de Verificação: <span id="cert-hash">#OL-XXXXXX</span></p>
                    <p>Data: 09 de Maio de 2026</p>
                </div>
                <div class="seal">SELO OFICIAL<br>OLUNIC</div>
                <div style="text-align: right;">
                    <p style="border-top: 1px solid #000; padding-top: 10px;">COMITÊ CIENTÍFICO OLUNIC</p>
                </div>
            </div>
        </div>
    </div>

    <button onclick="window.print()" class="btn-primary no-print" style="position: fixed; bottom: 30px; right: 30px;">IMPRIMIR / SALVAR PDF</button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const name = localStorage.getItem('olympia_user') || 'Estudante Exemplo';
            const olympiad = localStorage.getItem('selected_olympiad') || 'Nebula Math';
            
            document.getElementById('cert-name').textContent = name;
            document.getElementById('cert-olympiad').textContent = olympiad.replace('-', ' ').toUpperCase();
            document.getElementById('cert-score').textContent = "95.5"; // Simulado
            document.getElementById('cert-hash').textContent = "#OL-" + Math.random().toString(36).substr(2, 9).toUpperCase();
        });
    </script>
</body>
</html>
