/* 
 * PhiloMap - Lógica da Sidebar Moderna
 */

document.addEventListener('DOMContentLoaded', () => {
    const conceptsToggle = document.getElementById('conceptsToggle');
    const conceptsList = document.getElementById('conceptsList');
    const chevron = conceptsToggle ? conceptsToggle.querySelector('.chevron') : null;

    if (conceptsToggle && conceptsList) {
        conceptsToggle.addEventListener('click', () => {
            const isExpanded = conceptsList.classList.contains('expanded');
            
            if (isExpanded) {
                conceptsList.classList.remove('expanded');
                if (chevron) chevron.classList.remove('rotated');
            } else {
                conceptsList.classList.add('expanded');
                if (chevron) chevron.classList.add('rotated');
            }

            // Persistir preferência do usuário (opcional)
            localStorage.setItem('sidebarConceptsExpanded', !isExpanded);
        });
    }

    // Lógica de Ativação e Expansão Automática
    const currentPath = window.location.pathname;
    const isConceptPage = currentPath.includes('/pages/') && 
                          !currentPath.includes('inscricao.html') && 
                          !currentPath.includes('literatura.html');

    // Se estiver em uma página de conceito, expande para mostrar o item ativo
    if (isConceptPage) {
        conceptsList.classList.add('expanded');
        if (chevron) chevron.classList.add('rotated');
        
        // Garantir que o item ativo esteja visível
        const activeLink = conceptsList.querySelector('a.active');
        if (activeLink) {
            activeLink.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    } else {
        // Recuperar estado anterior se não for uma página de conceito
        const savedState = localStorage.getItem('sidebarConceptsExpanded');
        if (savedState === 'true') {
            conceptsList.classList.add('expanded');
            if (chevron) chevron.classList.add('rotated');
        }
    }

    // Adicionar funcionalidade de fechar ao clicar fora (opcional para mobile)
    // if (window.innerWidth < 768) { ... }
});
