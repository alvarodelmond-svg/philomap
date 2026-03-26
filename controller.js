/**
 * PhiloMap - Controller
 * Gerencia a interatividade, navegação SPA e lógica de interface.
 */

// --- CONFIGURAÇÃO INICIAL ---
document.addEventListener('DOMContentLoaded', () => {
    // Inicia na página inicial
    mostrarSecao('home');
    
    // Carrega a lista de dados salvos
    atualizarListaUI();

    // Listener do formulário
    const form = document.getElementById('formCadastro');
    if (form) {
        form.addEventListener('submit', lidarComSubmissao);
    }
});

// --- NAVEGAÇÃO SPA ---
/**
 * Alterna a visibilidade das seções para simular uma SPA.
 * @param {string} idSecao - O ID da seção a ser exibida.
 */
function mostrarSecao(idSecao) {
    const secoes = document.querySelectorAll('.content-section');
    secoes.forEach(secao => {
        secao.classList.remove('active');
        if (secao.id === idSecao) {
            secao.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    // Fecha o menu lateral se estiver aberto (mobile)
    const menu = document.querySelector('.menu-lateral');
    if (menu) menu.classList.remove('ativo');
}

/**
 * Toggle do menu lateral para dispositivos móveis.
 */
function toggleMenu() {
    const menu = document.querySelector('.menu-lateral');
    if (menu) menu.classList.toggle('ativo');
}

// --- LÓGICA DE DADOS (INDEXEDDB) ---

/**
 * Captura os dados do formulário e salva no banco.
 */
async function lidarComSubmissao(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    
    // Criamos o objeto de dados
    const novoDado = {
        nome: formData.get('nome'),
        email: formData.get('email'),
        nascimento: formData.get('nascimento'),
        interesse: Array.from(form.querySelectorAll('input[type="checkbox"]:checked')).map(cb => cb.value),
        experiencia: formData.get('experiencia'),
        mensagem: formData.get('mensagem'),
        dataCriacao: new Date().toLocaleString('pt-BR')
    };

    try {
        await adicionarItem(novoDado);
        form.reset();
        
        // Feedback visual de sucesso
        exibirFeedback('Cadastro realizado com sucesso!', 'success');
        
        // Atualiza a listagem e vai para a página de lista
        await atualizarListaUI();
        mostrarSecao('listagem');
    } catch (error) {
        console.error(error);
        exibirFeedback('Erro ao salvar dados.', 'error');
    }
}

/**
 * Busca os dados no banco e renderiza na tela.
 */
async function atualizarListaUI() {
    const container = document.getElementById('listaDados');
    if (!container) return;

    try {
        const itens = await buscarItens();
        
        if (itens.length === 0) {
            container.innerHTML = '<p class="empty-msg">Nenhum registro encontrado.</p>';
            return;
        }

        container.innerHTML = itens.map(item => `
            <div class="data-card animate-in">
                <div class="card-header">
                    <h3>${item.nome}</h3>
                    <button class="btn-delete" onclick="removerRegistro(${item.id})">
                        &times;
                    </button>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> ${item.email}</p>
                    <p><strong>Interesses:</strong> ${item.interesse.join(', ') || 'Nenhum'}</p>
                    <p><strong>Experiência:</strong> ${item.experiencia || 'Não informada'}</p>
                    <small>Cadastrado em: ${item.dataCriacao}</small>
                </div>
            </div>
        `).join('');
    } catch (error) {
        container.innerHTML = '<p class="error-msg">Erro ao carregar dados.</p>';
    }
}

/**
 * Remove um registro do banco e da tela.
 */
async function removerRegistro(id) {
    if (confirm('Deseja realmente excluir este registro?')) {
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

/**
 * Exibe um toast de feedback visual.
 */
function exibirFeedback(mensagem, tipo) {
    const feedback = document.createElement('div');
    feedback.className = `feedback-toast ${tipo}`;
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

// --- FUNCIONALIDADE EXTRA (RECOMENDAÇÕES) ---
const recomendacoes = [
    { tipo: "Livro", titulo: "O Estrangeiro", autor: "Albert Camus" },
    { tipo: "Filme", titulo: "Matrix", autor: "Irmãs Wachowski" },
    { tipo: "Livro", titulo: "Apologia de Sócrates", autor: "Platão" },
    { tipo: "Podcast", titulo: "Filosofia Pop", autor: "Existencialismo" },
    { tipo: "Filme", titulo: "Clube da Luta", autor: "David Fincher" }
];

function mostrarRecomendacao() {
    const area = document.getElementById("recomendacaoArea");
    const item = recomendacoes[Math.floor(Math.random() * recomendacoes.length)];
    
    area.style.opacity = 0;
    setTimeout(() => {
        area.innerHTML = `
            <div class="rec-item">
                <span class="rec-tipo">${item.tipo}</span>
                <h4 class="rec-titulo">${item.titulo}</h4>
                <p class="rec-autor">${item.autor}</p>
            </div>
        `;
        area.style.opacity = 1;
    }, 300);
}
