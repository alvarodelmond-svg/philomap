console.log("JS funcionando");
const botaoRecomendacao = document.getElementById("botaoRecomendacao");
const areaRecomendacao = document.getElementById("recomendacao");

const recomendacoes = [
{
tipo: "Livro",
titulo: "O Estrangeiro",
autor: "Albert Camus"
},

{
tipo: "Filme",
titulo: "Matrix",
autor: "Irmãs Wachowski"
},

{
tipo: "Livro",
titulo: "Apologia de Sócrates",
autor: "Platão"
},

{
tipo: "Podcast",
titulo: "Filosofia Pop",
autor: "Episódio sobre Existencialismo"
},

{
tipo: "Filme",
titulo: "Clube da Luta",
autor: "David Fincher"
}
];

botaoRecomendacao.addEventListener("click", mostrarRecomendacao);

function mostrarRecomendacao(){

const indiceAleatorio = Math.floor(Math.random() * recomendacoes.length);

const item = recomendacoes[indiceAleatorio];

areaRecomendacao.innerHTML =
`<strong>${item.tipo}</strong>: ${item.titulo} <br> ${item.autor}`;

}
function toggleMenu(){
    document.querySelector(".menu-lateral").classList.toggle("ativo");
}