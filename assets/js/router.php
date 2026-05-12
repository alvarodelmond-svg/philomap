<?php header('Content-Type: application/javascript'); ?>
/**
 * PhiloMap - Router 1.0
 * Gerencia a navegação entre páginas sem recarregar a barra lateral.
 */

const Router = {
    init() {
        // Normaliza links do sidebar para absolutos
        this.normalizeSidebarLinks();

        document.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (this.isInternalLink(link)) {
                e.preventDefault();
                this.navigate(link.href);
            }
        });

        window.addEventListener('popstate', () => {
            this.navigate(window.location.href, false);
        });

        console.log('Router initialized');
    },

    normalizeSidebarLinks() {
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        sidebarLinks.forEach(link => {
            // A propriedade .href já retorna o URL absoluto resolvido pelo browser
            // ao carregar a página inicialmente.
            const absoluteUrl = link.href;
            link.setAttribute('href', absoluteUrl);
        });
    },

    isInternalLink(link) {
        return link && 
               link.href && 
               link.href.startsWith(window.location.origin) && 
               !link.hash && 
               link.target !== '_blank' &&
               (link.href.endsWith('.html') || link.href.endsWith('/'));
    },

    async navigate(url, addToHistory = true) {
        const mainContent = document.getElementById('main-content');
        if (!mainContent) return;

        // Início da transição
        mainContent.style.opacity = '0';
        mainContent.style.transform = 'translateY(20px)';
        
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Falha ao carregar página');
            
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newMain = doc.querySelector('#main-content');
            const newTitle = doc.title;

            if (!newMain) throw new Error('Conteúdo principal não encontrado na página de destino');

            // Aguarda o fim da animação de saída
            setTimeout(() => {
                // Atualiza o conteúdo
                mainContent.innerHTML = newMain.innerHTML;
                document.title = newTitle;

                // Atualiza o histórico
                if (addToHistory) {
                    history.pushState({ url }, newTitle, url);
                }

                // Scroll para o topo
                window.scrollTo({ top: 0, behavior: 'smooth' });

                // Reinicializa componentes específicos do PhiloMap
                if (window.PhiloMap && typeof window.PhiloMap.initPage === 'function') {
                    window.PhiloMap.initPage();
                }
                if (window.PhiloController && typeof window.PhiloController.initDynamicComponents === 'function') {
                    window.PhiloController.initDynamicComponents();
                }

                // Fim da transição
                mainContent.style.opacity = '1';
                mainContent.style.transform = 'translateY(0)';
                
                // Atualiza estado ativo no menu lateral
                this.updateActiveLinks(url);
            }, 300);

        } catch (error) {
            console.error('Erro na navegação:', error);
            // Fallback: navegação normal se algo falhar
            if (addToHistory) window.location.href = url;
        }
    },

    updateActiveLinks(url) {
        const links = document.querySelectorAll('.sidebar .nav-item a');
        const currentPath = new URL(url).pathname;
        
        links.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            if (currentPath === linkPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
};

// Inicializa o roteador
document.addEventListener('DOMContentLoaded', () => Router.init());
window.PhiloRouter = Router;
