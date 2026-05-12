<?php header('Content-Type: application/javascript'); ?>
/**
 * PhiloMap - Controller 3.2
 * Gerencia a interatividade, persistência, Modo Escuro e Notificações.
 */

const PhiloController = {
    init() {
        // --- INICIALIZAÇÃO DE TEMA (Uma única vez) ---
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else if (savedTheme === 'high-contrast') {
            document.body.classList.add('high-contrast');
        }

        // Recuperar outras preferências
        if (localStorage.getItem('readingRuler') === 'true') {
            this.toggleReadingRuler(true);
        }

        // Criar container de Toasts se não existir
        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.style.phpText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            `;
            document.body.appendChild(container);
        }

        this.initDynamicComponents();
    },

    initDynamicComponents() {
        console.log('Initializing Controller Dynamic Components...');
        
        // --- LISTENER DO FORMULÁRIO ---
        const form = document.getElementById('formCadastro');
        if (form && !form.dataset.listenerAttached) {
            form.addEventListener('submit', lidarComSubmissao);
            form.dataset.listenerAttached = 'true';
        }

        // --- LISTA DE DADOS ---
        if (document.getElementById('listaDados')) {
            atualizarListaUI();
        }
    },

    toggleReadingRuler(force = null) {
        let ruler = document.querySelector('.reading-ruler');
        if (!ruler) {
            ruler = document.createElement('div');
            ruler.className = 'reading-ruler';
            document.body.appendChild(ruler);
        }

        const isActive = force !== null ? force : (ruler.style.display !== 'block');
        ruler.style.display = isActive ? 'block' : 'none';
        localStorage.setItem('readingRuler', isActive);

        if (isActive) {
            const moveRuler = (e) => {
                ruler.style.top = (e.clientY - 15) + 'px';
            };
            document.addEventListener('mousemove', moveRuler);
            ruler._moveRuler = moveRuler; 
        } else if (ruler._moveRuler) {
            document.removeEventListener('mousemove', ruler._moveRuler);
        }
    }
};

document.addEventListener('DOMContentLoaded', () => PhiloController.init());

function toggleTheme() {
    document.body.classList.remove('high-contrast');
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    exibirFeedback(isDark ? 'Modo Escuro Ativado' : 'Modo Claro Ativado', 'info');
}

function toggleHighContrast() {
    document.body.classList.remove('dark-mode');
    const isHC = document.body.classList.toggle('high-contrast');
    localStorage.setItem('theme', isHC ? 'high-contrast' : 'light');
    exibirFeedback(isHC ? 'Alto Contraste Ativado' : 'Modo Padrão Ativado', 'info');
}

function toggleReadingRuler() {
    PhiloController.toggleReadingRuler();
}

function exibirFeedback(mensagem, tipo = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    const cores = { success: 'var(--gold)', error: '#ff4444', info: 'var(--accent)' };
    toast.style.phpText = `background: var(--surface); color: var(--text-main); padding: 15px 25px; border-radius: 12px; border-left: 5px solid ${cores[tipo] || cores.info}; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 0.9rem; font-weight: 600; transform: translateX(120%); transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1); display: flex; align-items: center; gap: 10px; min-width: 250px;`;
    const icon = { success: '✓', error: '✕', info: 'ℹ' };
    toast.innerHTML = `<span>${icon[tipo] || '•'}</span> ${mensagem}`;
    container.appendChild(toast);
    setTimeout(() => { toast.style.transform = 'translateX(0)'; }, 100);
    setTimeout(() => { toast.style.transform = 'translateX(120%)'; setTimeout(() => toast.remove(), 500); }, 4000);
}

async function lidarComSubmissao(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const interesses = Array.from(form.querySelectorAll('input[name="interesse"]:checked')).map(cb => cb.value);
    const novoDado = { nome: formData.get('nome'), email: formData.get('email'), nascimento: formData.get('nascimento'), interesse: interesses, dataCriacao: new Date().toLocaleString('pt-BR') };
    try { if (typeof adicionarItem === 'function') { await adicionarItem(novoDado); form.reset(); exibirFeedback('Inscrição realizada com sucesso!', 'success'); if (document.getElementById('listaDados')) await atualizarListaUI(); } } catch (error) { exibirFeedback('Erro ao processar inscrição.', 'error'); }
}

async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container || typeof buscarItens !== 'function') return;
    try {
        const itens = await buscarItens();
        if (itens.length === 0) { container.innerHTML = '<p style="text-align:center; color: var(--text-dim); padding: 40px;">Ainda não há exploradores registrados.</p>'; return; }
        container.innerHTML = `<div style="display: grid; gap: 20px; margin-top: 30px; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">${itens.map(item => `<div class="reveal active" style="background: var(--surface); padding: 25px; border-radius: 20px; border: 1px solid var(--border); transition: 0.3s; position: relative; overflow: hidden;"><div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--gold);"></div><h3 style="font-size: 1.1rem; margin-bottom: 5px;">${item.nome}</h3><p style="font-size: 0.8rem; color: var(--text-dim); margin-bottom: 15px;">${item.email}</p><div style="display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 20px;">${item.interesse.map(int => `<span style="font-size: 0.6rem; background: var(--bg); padding: 4px 8px; border-radius: 5px; border: 1px solid var(--border); color: var(--gold); font-weight: bold;">${int.toUpperCase()}</span>`).join('')}</div><button onclick="removerRegistro(${item.id})" style="background: transparent; border: 1px solid #ff4444; color: #ff4444; padding: 5px 12px; border-radius: 8px; font-size: 0.7rem; cursor: pointer; transition: 0.3s;">REMOVER</button></div>`).join('')}</div>`;
    } catch (error) { container.innerHTML = '<p>Erro ao carregar o mapa de membros.</p>'; }
}

async function removerRegistro(id) {
    if (confirm('Deseja realmente remover este registro da história do PhiloMap?')) {
        try { await deletarItem(id); exibirFeedback('Registro removido.', 'success'); atualizarListaUI(); } catch (error) { exibirFeedback('Erro ao remover registro.', 'error'); }
    }
}

window.PhiloController = PhiloController;
