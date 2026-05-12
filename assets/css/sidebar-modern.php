<?php header('Content-Type: text/css'); ?>
/* 
 * PhiloMap - Sidebar Moderna e Colapsável
 */

:root {
    --sidebar-bg: var(--surface);
    --nav-item-bg: var(--bg);
    --nav-item-hover: #f0f0f0;
    --glow-color: rgba(197, 160, 89, 0.2);
    --sidebar-transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

body.dark-mode {
    --sidebar-bg: #000000;
    --nav-item-bg: #111111;
    --nav-item-hover: #1a1a1a;
}

.sidebar {
    background: var(--sidebar-bg);
    border-right: 1px solid var(--border);
    box-shadow: 20px 0 50px rgba(0,0,0,0.05);
}

body.dark-mode .sidebar {
    box-shadow: 20px 0 50px rgba(0,0,0,0.5);
}

/* Header Colapsável */
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
    letter-spacing: 2px;
}

.chevron {
    color: var(--gold);
    transition: transform 0.3s ease;
    font-size: 0.8rem;
}

.chevron.rotated {
    transform: rotate(180deg);
}

/* Conteúdo Colapsável */
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

/* Itens da Lista */
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

/* Scrollbar */
.sidebar::-webkit-scrollbar-thumb {
    background: var(--border) !important;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--gold) !important;
}
