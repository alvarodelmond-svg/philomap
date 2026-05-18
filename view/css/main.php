<?php header('Content-Type: text/css'); ?>
/*
 * PhiloMap - CSS Principal Consolidado
 * Este arquivo unifica o estilo base, a sidebar e os estilos de inscrição.
 */

@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Inter:wght@300;400;600;800&display=swap&font-display=swap');

:root {
    --bg: #fdfcf9;
    --surface: #ffffff;
    --border: #e8e2d8;
    --text-main: #1a1a1a;
    --text-dim: #706c61;
    --accent: #0f0f0f;
    --gold: #c5a059;
    --gold-glow: rgba(197, 160, 89, 0.4);
    --sidebar-width: 320px;
    --transition-smooth: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    --font-scale: 1;
    --line-height-scale: 1.7;
    --letter-spacing: normal;
}

html {
    font-size: calc(16px * var(--font-scale));
}

body.dyslexia-font {
    font-family: 'OpenDyslexic', sans-serif !important;
}

:focus-visible {
    outline: 3px solid var(--gold) !important;
    outline-offset: 4px;
}

.reading-ruler {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 30px;
    background: rgba(197, 160, 89, 0.15);
    border-top: 2px solid var(--gold);
    border-bottom: 2px solid var(--gold);
    pointer-events: none;
    z-index: 9999;
    display: none;
    mix-blend-mode: multiply;
}

body.dark-mode .reading-ruler {
    mix-blend-mode: screen;
    background: rgba(197, 160, 89, 0.25);
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

body.dark-mode {
    --bg: #0a0a0a;
    --surface: #141414;
    --border: #2a2a2a;
    --text-main: #f0ede5;
    --text-dim: #a09c94;
    --accent: #d2b48c;
    --gold-glow: rgba(210, 180, 140, 0.3);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg);
    color: var(--text-main);
    line-height: 1.7;
    overflow-x: hidden;
}

h1, h2, h3 { font-family: 'Playfair Display', serif; }

.sidebar {
    width: var(--sidebar-width);
    background: var(--surface);
    border-right: 1px solid var(--border);
    padding: 3.5rem 1.5rem;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    box-shadow: 15px 0 60px rgba(0,0,0,0.03);
}

.sidebar-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    margin-bottom: 3rem;
    perspective: 1200px;
    position: relative;
}

.sidebar-logo img {
    height: 280px;
    width: auto;
    margin-bottom: 0;
    transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
    animation: philosophy-grandeur 12s infinite ease-in-out;
    transform-style: preserve-3d;
}

body:not(.dark-mode) .sidebar-logo img {
    filter: grayscale(0.3) contrast(1.1) drop-shadow(0 0 30px rgba(197, 160, 89, 0.3));
}

body.dark-mode .sidebar-logo img {
    filter: invert(0.8) sepia(1) saturate(3) hue-rotate(340deg) drop-shadow(0 0 40px var(--gold)) drop-shadow(0 0 80px rgba(197, 160, 89, 0.5));
    animation: philosophy-grandeur 12s infinite ease-in-out, dark-breathing-glow 4s infinite ease-in-out;
}

@keyframes dark-breathing-glow {
    0%, 100% {
        filter: invert(0.8) sepia(1) saturate(3) hue-rotate(340deg) drop-shadow(0 0 40px var(--gold)) brightness(1);
    }
    50% {
        filter: invert(0.8) sepia(1.2) saturate(5) hue-rotate(350deg) drop-shadow(0 0 70px var(--gold)) drop-shadow(0 0 120px rgba(197, 160, 89, 0.8)) brightness(1.5);
    }
}

@keyframes philosophy-grandeur {
    0%, 100% {
        transform: translateY(0) rotateY(0deg) rotateX(0deg) scale(1);
        filter: drop-shadow(0 0 20px rgba(197, 160, 89, 0.3));
    }
    33% {
        transform: translateY(-30px) rotateY(20deg) rotateX(10deg) scale(1.08);
        filter: drop-shadow(0 0 50px var(--gold)) brightness(1.1);
    }
    66% {
        transform: translateY(-15px) rotateY(-20deg) rotateX(-5deg) scale(1.15);
        filter: drop-shadow(0 0 70px var(--gold)) brightness(1.3);
    }
}

.sidebar-logo:hover img {
    transform: rotateY(360deg) scale(1.2) translateY(-10px);
    filter: drop-shadow(0 0 100px var(--gold)) brightness(1.4);
    cursor: pointer;
}

.sidebar-logo::after {
    content: 'ΓΝΩΘΙ ΣΑΥΤΟΝ';
    position: absolute;
    bottom: -15px;
    font-family: 'Playfair Display', serif;
    font-size: 0.8rem;
    color: var(--gold);
    letter-spacing: 8px;
    opacity: 0;
    transition: all 0.8s ease;
    pointer-events: none;
}

.sidebar-logo:hover::after {
    opacity: 0.8;
    bottom: 0px;
}

@keyframes button-shine { to { background-position: 200% center; } }

.search-container {
    position: relative;
    margin-bottom: 3rem;
    padding: 0 0.5rem;
}

#searchConcepts {
    width: 100%;
    padding: 22px 55px 22px 30px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 25px;
    color: var(--text-main);
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    transition: var(--transition-smooth);
    outline: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}

#searchConcepts:focus {
    border-color: var(--gold);
    box-shadow: 0 10px 30px var(--gold-glow);
    transform: translateY(-2px);
}

.card {
    padding: 4rem;
    margin-bottom: 5rem;
    border: none;
    background: transparent;
}

.main-content {
    max-width: 1100px;
    margin-left: var(--sidebar-width);
    padding: 8rem 4rem;
}

p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dim);
    margin-bottom: 2rem;
}

h1 {
    font-size: 3.5rem;
    margin-bottom: 2.5rem;
    letter-spacing: -1px;
}

h2 {
    font-size: 2.2rem;
    margin-bottom: 2rem;
    color: var(--text-main);
}

.search-count {
    position: absolute;
    right: 55px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.65rem;
    font-weight: 800;
    color: var(--gold);
    background: var(--border);
    padding: 2px 8px;
    border-radius: 10px;
    opacity: 0;
    transition: var(--transition-smooth);
    pointer-events: none;
}

.search-count.visible {
    opacity: 0.8;
}

.search-icon, .search-clear {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gold);
    font-size: 1.1rem;
    transition: var(--transition-smooth);
    cursor: pointer;
}

.sidebar {
    background: var(--sidebar-bg);
    border-right: 1px solid var(--border);
    box-shadow: 20px 0 50px rgba(0,0,0,0.05);
}

body.dark-mode .sidebar {
    box-shadow: 20px 0 50px rgba(0,0,0,0.5);
}

.nav-collapsible-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 1rem;
    cursor: pointer;
    border-radius: 12px;
    transition: var(--sidebar-transition);
    margin-bottom: 0.5rem;
    border: 1px solid transparent;
}

.nav-collapsible-header:hover {
    background: var(--nav-item-hover);
    border-color: var(--gold);
    box-shadow: 0 0 15px var(--glow-color);
}

.nav-collapsible-header .nav-label {
    margin-bottom: 0 !important;
    padding-left: 0 !important;
    color: var(--gold) !important;
    font-weight: 800;
    letter-spacing: 2px !important;
}

.chevron {
    color: var(--gold);
    transition: transform 0.3s ease;
    font-size: 0.8rem;
}

.chevron.rotated {
    transform: rotate(180deg);
}

.collapsible-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
    opacity: 0;
    list-style: none;
    padding-left: 0.5rem;
}

.collapsible-content.expanded {
    max-height: 1000px;
    opacity: 1;
    margin-bottom: 1.5rem;
}

.collapsible-content .nav-item {
    margin-bottom: 8px;
}

.collapsible-content .nav-item a {
    padding: 12px 20px !important;
    font-size: 0.85rem !important;
    background: var(--nav-item-bg);
    border: 1px solid var(--border);
    border-radius: 10px !important;
    text-transform: none !important;
    letter-spacing: 1px !important;
    color: var(--gold) !important;
    -webkit-text-fill-color: var(--gold) !important;
    transition: var(--sidebar-transition);
}

.collapsible-content .nav-item a:hover {
    background: var(--nav-item-hover) !important;
    border-color: var(--gold) !important;
    transform: translateX(5px) !important;
    box-shadow: 0 5px 15px var(--glow-color) !important;
}

.collapsible-content .nav-item a.active {
    background: var(--gold) !important;
    color: var(--sidebar-bg) !important;
    -webkit-text-fill-color: var(--sidebar-bg) !important;
    font-weight: 800;
}

.sidebar::-webkit-scrollbar-thumb {
    background: var(--border) !important;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--gold) !important;
}

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
    background-image: radial-gradient(circle at 2px 2px, var(--border) 1px, transparent 0);
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
}
