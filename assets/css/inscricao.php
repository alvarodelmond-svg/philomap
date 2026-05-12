<?php header('Content-Type: text/css'); ?>
/* 
 * PhiloMap - Inscrição
 * Estilos específicos para a área de matrícula e certificados
 */

.modern-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.form-group label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 800;
    color: var(--gold);
}

.form-group input, 
.form-group select, 
.form-group textarea {
    padding: 1.2rem;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--bg);
    color: var(--text-main);
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    outline: none;
    transition: var(--transition-smooth);
}

.form-group select {
    font-family: 'Playfair Display', serif;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23c5a059' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1.2rem center;
    background-size: 1.2rem;
}

.form-group input:focus, 
.form-group select:focus {
    border-color: var(--gold);
    box-shadow: 0 5px 15px var(--gold-glow);
    transform: translateY(-2px);
}

.btn-submit {
    padding: 1.2rem;
    width: 100%;
    margin-top: 2rem;
    font-weight: 800;
    letter-spacing: 2px;
    border-radius: 15px;
    background: var(--gold);
    color: white;
    border: none;
    text-transform: uppercase;
    cursor: pointer;
    transition: var(--transition-smooth);
}

.btn-submit:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px var(--gold-glow);
    filter: brightness(1.1);
}

.btn-submit:active {
    transform: translateY(-2px);
}

/* CERTIFICADO */

@keyframes revealCert {
    from { opacity: 0; transform: translateY(40px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.certificate-container {
    background: var(--surface);
    padding: 4rem;
    border-radius: 4px;
    border: 1px solid var(--border);
    position: relative;
    box-shadow: 0 30px 70px rgba(0,0,0,0.1);
    background-image: 
        radial-gradient(circle at 2px 2px, var(--border) 1px, transparent 0);
    background-size: 40px 40px;
    margin-top: 2rem;
}

.certificate-container::before {
    content: '';
    position: absolute;
    top: 15px; left: 15px; right: 15px; bottom: 15px;
    border: 2px solid var(--gold);
    pointer-events: none;
    opacity: 0.4;
}

.cert-header {
    text-align: center;
    margin-bottom: 3rem;
}

.cert-header h3 {
    font-family: 'Playfair Display', serif;
    font-size: 0.8rem;
    letter-spacing: 6px;
    color: var(--gold);
    text-transform: uppercase;
    margin-bottom: 1rem;
}

.cert-header h2 {
    font-size: 2.2rem;
    color: var(--text-main);
    margin: 0;
}

.cert-body {
    max-width: 500px;
    margin: 0 auto;
}

.cert-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
    border-bottom: 1px solid var(--border);
    padding-bottom: 0.5rem;
    transition: 0.3s;
}

.cert-row:hover {
    border-bottom-color: var(--gold);
}

.cert-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--text-dim);
    margin-bottom: 0.5rem;
}

.cert-value {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-main);
}

.cert-footer {
    margin-top: 4rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.cert-signature {
    border-top: 1px solid var(--text-main);
    padding-top: 0.5rem;
    width: 200px;
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 0.9rem;
    color: var(--text-dim);
}

.cert-seal {
    width: 120px;
    height: 120px;
    background: var(--gold);
    color: white;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-weight: 900;
    box-shadow: 0 10px 25px var(--gold-glow);
    transform: rotate(-15deg);
    border: 4px double white;
    position: relative;
}

.cert-seal::after {
    content: 'OFFICIAL';
    font-size: 0.5rem;
    letter-spacing: 2px;
    margin-top: 5px;
    opacity: 0.8;
}

#alertBox {
    padding: 1.5rem;
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    border-radius: 12px;
    transition: var(--transition-smooth);
    display: none;
}

#alertBox.alert-success {
    display: block;
    background: rgba(197, 160, 89, 0.1);
    color: var(--gold);
    border: 1px solid var(--gold);
}

#alertBox.alert-error {
    display: block;
    background: #fff5f5;
    color: #c53030;
    border: 1px solid #feb2b2;
}

body.dark-mode #alertBox.alert-error {
    background: rgba(197, 48, 48, 0.1);
    color: #feb2b2;
    border-color: #f56565;
}
