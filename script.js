/**
 * PhiloMap - Lógica JavaScript Moderna
 * Conceitos: Variáveis (const/let), Tipos de Dados (Array/Object), 
 * Arrow Functions, Manipulação de DOM e Eventos.
 */

"use strict";

// 1. Variáveis e Tipos de Dados (Array de Objetos)
// Priorizamos 'const' para dados que não serão reatribuídos
const RECOMENDACOES_FILOSOFICAS = [
    { tipo: "Livro", titulo: "O Estrangeiro", autor: "Albert Camus" },
    { tipo: "Filme", titulo: "Matrix", autor: "Lana e Lilly Wachowski" },
    { tipo: "Livro", titulo: "Apologia de Sócrates", autor: "Platão" },
    { tipo: "Podcast", titulo: "Filosofia Pop", autor: "Existencialismo" },
    { tipo: "Filme", titulo: "Clube da Luta", autor: "David Fincher" },
    { tipo: "Livro", titulo: "Meditações", autor: "Marco Aurélio" }
];

// 2. O DOM: Seleção de Elementos (querySelector)
const elementos = {
    botao: document.querySelector("#btnRecommend"),
    display: document.querySelector("#recommendationDisplay"),
    header: document.querySelector(".main-header")
};

// 3. Funções (Arrow Function) e Lógica
// Usamos 'let' para uma variável que mudará de valor (controle de repetição)
let ultimoIndice = -1;

const gerarNovaRecomendacao = () => {
    let novoIndice;
    
    // Estrutura de repetição (do-while) para não repetir a mesma dica seguida
    do {
        novoIndice = Math.floor(Math.random() * RECOMENDACOES_FILOSOFICAS.length);
    } while (novoIndice === ultimoIndice);

    ultimoIndice = novoIndice;
    const item = RECOMENDACOES_FILOSOFICAS[novoIndice];
    
    // Manipulação do DOM: Alterando HTML e Estilo
    exibirNaTela(item);
};

const exibirNaTela = (item) => {
    // Aplicando efeito visual de fade-out antes de trocar o texto
    elementos.display.style.opacity = "0";
    
    setTimeout(() => {
        elementos.display.innerHTML = `
            <div class="fade-in-content">
                <small style="color: var(--primary); text-transform: uppercase; font-size: 0.7rem;">${item.tipo}</small>
                <p style="margin-top: 5px;"><strong>${item.titulo}</strong> <br> ${item.author}</p>
            </div>
        `;
        elementos.display.style.opacity = "1";
    }, 200);
};

// 4. Eventos (addEventListener)
// A ponte entre a ação do usuário (clique) e a lógica JS
if (elementos.botao) {
    elementos.botao.addEventListener("click", gerarNovaRecomendacao);
}

// Efeito de rolagem no Header
window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        elementos.header.style.boxShadow = "0 10px 30px rgba(0,0,0,0.5)";
        elementos.header.style.background = "rgba(15, 23, 42, 0.95)";
    } else {
        elementos.header.style.boxShadow = "none";
        elementos.header.style.background = "rgba(15, 23, 42, 0.9)";
    }
});

console.log("PhiloMap: JS Fundamental Carregado.");
