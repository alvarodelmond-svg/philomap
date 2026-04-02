/**
 * PhiloMap - Controller
 * Gerencia a interatividade, navegação SPA e Modo Escuro.
 */

// --- CONFIGURAÇÃO INICIAL ---
document.addEventListener('DOMContentLoaded', () => {
    // Inicia na página inicial
    mostrarSecao('home');
    
    // Carrega a lista de dados salvos
    atualizarListaUI();

    // Carregar tema preferido
    if (localStorage.getItem('theme') === 'light') {
        document.body.classList.add('light-mode');
    }

    // Listener do formulário
    const form = document.getElementById('formCadastro');
    if (form) {
        form.addEventListener('submit', lidarComSubmissao);
    }
});

// --- MODO ESCURO / CLARO ---
/**
 * Alterna entre o modo escuro e claro.
 */
function toggleTheme() {
    const body = document.body;
    const isLight = body.classList.toggle('light-mode');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
}

// --- NAVEGAÇÃO SPA ---
/**
 * Alterna a visibilidade das seções para simular uma SPA.
 */
function mostrarSecao(idSecao) {
    const secoes = document.querySelectorAll('.content-section');
    const buttons = document.querySelectorAll('.nav-btn');

    secoes.forEach(secao => {
        secao.classList.remove('active');
        if (secao.id === idSecao) {
            secao.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    // Destaca o botão ativo no menu
    buttons.forEach(btn => {
        btn.classList.remove('active-nav');
        if (btn.getAttribute('onclick') && btn.getAttribute('onclick').includes(`'${idSecao}'`)) {
            btn.classList.add('active-nav');
        }
    });
}

// --- LÓGICA DE DADOS (INDEXEDDB) ---
async function lidarComSubmissao(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    
    const novoDado = {
        nome: formData.get('nome'),
        email: formData.get('email'),
        nascimento: formData.get('nascimento'),
        interesse: Array.from(form.querySelectorAll('input[type="checkbox"]:checked')).map(cb => cb.value),
        dataCriacao: new Date().toLocaleString('pt-BR')
    };

    try {
        await adicionarItem(novoDado);
        form.reset();
        
        exibirFeedback('Pensamento registrado com sucesso!', 'success');
        
        await atualizarListaUI();
        mostrarSecao('listagem');
    } catch (error) {
        console.error(error);
        exibirFeedback('Erro ao salvar no banco local.', 'error');
    }
}

async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container) return;

    try {
        const itens = await buscarItens();
        
        if (itens.length === 0) {
            container.innerHTML = '<p style="text-align:center; color: var(--text-dim);">Nenhum registro encontrado na comunidade.</p>';
            return;
        }

        container.innerHTML = itens.map(item => `
            <div class="data-card">
                <div class="card-info">
                    <h3 style="text-transform: uppercase; font-size: 1rem;">${item.nome}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-dim);">${item.email}</p>
                    <small style="color: var(--text-dim); opacity: 0.6;">Interesses: ${item.interesse.join(', ') || 'Geral'}</small>
                </div>
                <button class="btn-delete" onclick="removerRegistro(${item.id})">Remover</button>
            </div>
        `).join('');
    } catch (error) {
        container.innerHTML = '<p>Erro ao carregar dados.</p>';
    }
}

async function removerRegistro(id) {
    if (confirm('Deseja realmente remover este registro da comunidade?')) {
        try {
            await deletarItem(id);
            exibirFeedback('Registro removido.', 'success');
            atualizarListaUI();
        } catch (error) {
            exibirFeedback('Erro ao remover.', 'error');
        }
    }
}

// --- UTILITÁRIOS E INTERATIVIDADE ---
function exibirFeedback(mensagem) {
    const feedback = document.createElement('div');
    feedback.className = `feedback-toast`;
    feedback.innerText = mensagem;
    
    document.body.appendChild(feedback);
    
    setTimeout(() => {
        feedback.classList.add('show');
        setTimeout(() => {
            feedback.classList.remove('show');
            setTimeout(() => feedback.remove(), 300);
        }, 3000);
    }, 100);
}

// --- REFLEXÕES (INTERATIVIDADE) ---
const reflexoes = [
    "A vida não examinada não vale a pena ser vivida. — Sócrates",
    "Penso, logo existo. — René Descartes",
    "O homem é a medida de todas as coisas. — Protágoras",
    "Não se pode banhar-se duas vezes no mesmo rio. — Heráclito",
    "O conhecimento é o alimento da alma. — Platão",
    "A felicidade é o único objetivo da vida. — Aristóteles",
    "A liberdade é o que fazemos com o que nos foi feito. — Jean-Paul Sartre"
];

function mostrarRecomendacao() {
    const area = document.getElementById("recomendacaoArea");
    const reflexaoAleatoria = reflexoes[Math.floor(Math.random() * reflexoes.length)];
    
    area.style.opacity = 0;
    setTimeout(() => {
        area.innerHTML = `<p style="font-size: 0.9rem; text-align: center; font-style: italic;">"${reflexaoAleatoria}"</p>`;
        area.style.opacity = 1;
    }, 300);
}
