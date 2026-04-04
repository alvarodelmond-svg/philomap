/**
 * PhiloMap - Animations and Interactivity
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log("Scripts de animação carregados");

    // --- REVEAL ON SCROLL ---
    const revealElements = document.querySelectorAll('.reveal');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    });

    revealElements.forEach(el => {
        revealObserver.observe(el);
    });

    // --- RECOMENDAÇÕES ---
    const botaoRecomendacao = document.getElementById("botaoRecomendacao");
    const areaRecomendacao = document.getElementById("recomendacao");

    const recomendacoes = [
        { tipo: "Livro", titulo: "O Estrangeiro", autor: "Albert Camus" },
        { tipo: "Filme", titulo: "Matrix", autor: "Irmãs Wachowski" },
        { tipo: "Livro", titulo: "Apologia de Sócrates", autor: "Platão" },
        { tipo: "Podcast", titulo: "Filosofia Pop", autor: "Episódio sobre Existencialismo" },
        { tipo: "Filme", titulo: "Clube da Luta", autor: "David Fincher" },
        { tipo: "Livro", titulo: "O Príncipe", autor: "Nicolau Maquiavel" },
        { tipo: "Filme", titulo: "O Show de Truman", autor: "Peter Weir" },
        { tipo: "Livro", titulo: "Meditações", autor: "Marco Aurélio" }
    ];

    if (botaoRecomendacao && areaRecomendacao) {
        botaoRecomendacao.addEventListener("click", () => {
            const item = recomendacoes[Math.floor(Math.random() * recomendacoes.length)];
            areaRecomendacao.style.opacity = 0;
            setTimeout(() => {
                areaRecomendacao.innerHTML = `<strong>${item.tipo}</strong>: ${item.titulo} <br> <small>${item.autor}</small>`;
                areaRecomendacao.style.opacity = 1;
                areaRecomendacao.style.transition = "opacity 0.5s ease";
            }, 200);
        });
    }
});
