/**
 * PhiloMap - Controller
 * Gerencia a interatividade, persistência e Modo Escuro.
 */

// --- CONFIGURAÇÃO INICIAL ---
document.addEventListener('DOMContentLoaded', () => {
    // Carregar tema preferido
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }

    // Listener do formulário (se existir na página)
    const form = document.getElementById('formCadastro');
    if (form) {
        form.addEventListener('submit', lidarComSubmissao);
    }

    // Carrega a lista de dados salvos (se existir o container)
    if (document.getElementById('listaDados')) {
        atualizarListaUI();
    }
});

// --- MODO ESCURO / CLARO ---
/**
 * Alterna entre o modo escuro e claro.
 */
function toggleTheme() {
    const body = document.body;
    const isDark = body.classList.toggle('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

// --- LÓGICA DE DADOS (INDEXEDDB) ---
async function lidarComSubmissao(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    
    // Captura interesses (checkboxes)
    const interesses = Array.from(form.querySelectorAll('input[name="interesse"]:checked')).map(cb => cb.value);

    const novoDado = {
        nome: formData.get('nome') || form.querySelector('input[type="text"]').value,
        email: formData.get('email') || form.querySelector('input[type="email"]').value,
        nascimento: formData.get('nascimento') || form.querySelector('input[type="date"]').value,
        interesse: interesses,
        dataCriacao: new Date().toLocaleString('pt-BR')
    };

    try {
        if (typeof adicionarItem === 'function') {
            await adicionarItem(novoDado);
            form.reset();
            
            exibirFeedback('Inscrição realizada com sucesso!', 'success');
            
            if (document.getElementById('listaDados')) {
                await atualizarListaUI();
            }
        } else {
            console.error('db.js não carregado corretamente.');
        }
    } catch (error) {
        console.error(error);
        exibirFeedback('Erro ao salvar no banco local.', 'error');
    }
}

async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container) return;

    try {
        if (typeof buscarItens !== 'function') return;
        
        const itens = await buscarItens();
        
        if (itens.length === 0) {
            container.innerHTML = '<p style="text-align:center; color: var(--text-dim); padding: 20px;">Nenhum membro registrado ainda.</p>';
            return;
        }

        container.innerHTML = `
            <div style="display: grid; gap: 20px; margin-top: 30px;">
                ${itens.map(item => `
                    <div class="card-texto" style="padding: 20px; margin-bottom: 0;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 5px;">${item.nome}</h3>
                        <p style="font-size: 0.9rem; color: var(--text-dim); margin-bottom: 10px;">${item.email}</p>
                        <p style="font-size: 0.8rem; margin-bottom: 15px;"><strong>Interesses:</strong> ${item.interesse.join(', ') || 'Geral'}</p>
                        <button class="theme-toggle" onclick="removerRegistro(${item.id})" style="font-size: 0.6rem;">REMOVER</button>
                    </div>
                `).join('')}
            </div>
        `;
    } catch (error) {
        container.innerHTML = '<p>Erro ao carregar dados.</p>';
    }
}

async function removerRegistro(id) {
    if (confirm('Deseja realmente remover este registro?')) {
        try {
            await deletarItem(id);
            exibirFeedback('Registro removido.', 'success');
            atualizarListaUI();
        } catch (error) {
            exibirFeedback('Erro ao remover.', 'error');
        }
    }
}

// --- UTILITÁRIOS ---
function exibirFeedback(mensagem, tipo = 'info') {
    // Usando alert por simplicidade, mas o 'tipo' pode ser usado para estilização futura
    alert(`${tipo.toUpperCase()}: ${mensagem}`);
}
