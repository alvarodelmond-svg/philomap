/**
 * PhiloMap - Controller 3.1
 * Gerencia a interatividade, persistência, Modo Escuro e Notificações.
 */

const PhiloController = {
    init() {
        // --- INICIALIZAÇÃO DE TEMA (Uma única vez) ---
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }

        // Criar container de Toasts se não existir
        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.style.cssText = `
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
    }
};

document.addEventListener('DOMContentLoaded', () => PhiloController.init());

/**
 * Alterna entre o modo escuro e claro.
 */
function toggleTheme() {
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    
    exibirFeedback(
        isDark ? 'Modo Escuro Ativado' : 'Modo Claro Ativado', 
        'info'
    );
}

/**
 * Sistema de Notificações Customizado (Toast)
 */
function exibirFeedback(mensagem, tipo = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    
    // Cores baseadas no tipo
    const cores = {
        success: 'var(--gold)',
        error: '#ff4444',
        info: 'var(--accent)'
    };

    toast.style.cssText = `
        background: var(--surface);
        color: var(--text-main);
        padding: 15px 25px;
        border-radius: 12px;
        border-left: 5px solid ${cores[tipo] || cores.info};
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        font-size: 0.9rem;
        font-weight: 600;
        transform: translateX(120%);
        transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 250px;
    `;

    const icon = {
        success: '✓',
        error: '✕',
        info: 'ℹ'
    };

    toast.innerHTML = `<span>${icon[tipo] || '•'}</span> ${mensagem}`;
    container.appendChild(toast);

    // Animar entrada
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);

    // Remover após 4 segundos
    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

// --- LÓGICA DE DADOS (INDEXEDDB) ---
async function lidarComSubmissao(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const interesses = Array.from(form.querySelectorAll('input[name="interesse"]:checked')).map(cb => cb.value);

    const novoDado = {
        nome: formData.get('nome'),
        email: formData.get('email'),
        nascimento: formData.get('nascimento'),
        interesse: interesses,
        dataCriacao: new Date().toLocaleString('pt-BR')
    };

    try {
        if (typeof adicionarItem === 'function') {
            await adicionarItem(novoDado);
            form.reset();
            exibirFeedback('Inscrição realizada com sucesso!', 'success');
            if (document.getElementById('listaDados')) await atualizarListaUI();
        }
    } catch (error) {
        exibirFeedback('Erro ao processar inscrição.', 'error');
    }
}

async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container || typeof buscarItens !== 'function') return;

    try {
        const itens = await buscarItens();
        if (itens.length === 0) {
            container.innerHTML = '<p style="text-align:center; color: var(--text-dim); padding: 40px;">Ainda não há exploradores registrados.</p>';
            return;
        }

        container.innerHTML = `
            <div style="display: grid; gap: 20px; margin-top: 30px; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                ${itens.map(item => `
                    <div class="reveal active" style="background: var(--surface); padding: 25px; border-radius: 20px; border: 1px solid var(--border); transition: 0.3s; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--gold);"></div>
                        <h3 style="font-size: 1.1rem; margin-bottom: 5px;">${item.nome}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-dim); margin-bottom: 15px;">${item.email}</p>
                        <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 20px;">
                            ${item.interesse.map(int => `<span style="font-size: 0.6rem; background: var(--bg); padding: 4px 8px; border-radius: 5px; border: 1px solid var(--border); color: var(--gold); font-weight: bold;">${int.toUpperCase()}</span>`).join('')}
                        </div>
                        <button onclick="removerRegistro(${item.id})" style="background: transparent; border: 1px solid #ff4444; color: #ff4444; padding: 5px 12px; border-radius: 8px; font-size: 0.7rem; cursor: pointer; transition: 0.3s;">REMOVER</button>
                    </div>
                `).join('')}
            </div>
        `;
    } catch (error) {
        container.innerHTML = '<p>Erro ao carregar o mapa de membros.</p>';
    }
}

async function removerRegistro(id) {
    if (confirm('Deseja realmente remover este registro da história do PhiloMap?')) {
        try {
            await deletarItem(id);
            exibirFeedback('Registro removido.', 'success');
            atualizarListaUI();
        } catch (error) {
            exibirFeedback('Erro ao remover registro.', 'error');
        }
    }
}

window.PhiloController = PhiloController;
