console.log("JS funcionando - PhiloMap");

// 1. Seleciona os elementos do HTML
const botao = document.getElementById("botaoRecomendacao");
const areaRecomendacao = document.getElementById("recomendacao");

// 2. Lista unificada de conteúdo (Objetos com Livros, Filmes e Frases)
const conteudo = [
    { tipo: "Livro", titulo: "O Estrangeiro", autor: "Albert Camus" },
    { tipo: "Filme", titulo: "Matrix", autor: "Irmãs Wachowski" },
    { tipo: "Livro", titulo: "Apologia de Sócrates", autor: "Platão" },
    { tipo: "Podcast", titulo: "Filosofia Pop", autor: "Existencialismo" },
    { tipo: "Filme", titulo: "Clube da Luta", autor: "David Fincher" },
    { tipo: "Frase", titulo: "A vida não examinada não vale a pena ser vivida", autor: "Sócrates" },
    { tipo: "Frase", titulo: "Penso, logo existo", autor: "René Descartes" },
    { tipo: "Frase", titulo: "O homem é o lobo do homem", autor: "Thomas Hobbes" },
    { tipo: "Frase", titulo: "Felicidade é viver de acordo com a virtude", autor: "Aristóteles" }
];

// 3. Adiciona o "ouvinte" de evento para o clique do botão
botao.addEventListener("click", function() {
    
    // Gera um índice aleatório baseado no tamanho da lista
    const indiceAleatorio = Math.floor(Math.random() * conteudo.length);
    const item = conteudo[indiceAleatorio];

    // 4. Manipulação do DOM: Altera o conteúdo HTML da página
    areaRecomendacao.innerHTML = `
        <div style="padding: 15px; border-top: 2px solid #eee; margin-top: 15px; background-color: #f9f9f9; border-radius: 5px;">
            <strong style="color: #d32f2f;">${item.tipo}</strong>: "${item.titulo}" <br> 
            <span style="font-style: italic; color: #555;">— ${item.autor}</span>
        </div>
    `;
    
    // 5. Manipulação de Estilo: Garante que a cor mude no clique
    areaRecomendacao.style.transition = "all 0.5s";
    areaRecomendacao.style.opacity = "1";

    // Log para conferir no Console (F12)
    console.log("Botão clicado! Exibindo: " + item.titulo);
});