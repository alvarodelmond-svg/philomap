/* 
 * PhiloMap - Lógica da Sidebar Moderna
 */

document.addEventListener('DOMContentLoaded', () => {
    const conceptsToggle = document.getElementById('conceptsToggle');
    const conceptsList = document.getElementById('conceptsList');
    const chevron = conceptsToggle.querySelector('.chevron');

    if (conceptsToggle && conceptsList) {
        conceptsToggle.addEventListener('click', () => {
            // Alternar classe expanded
            conceptsList.classList.toggle('expanded');
            
            // Rotacionar chevron
            if (chevron) {
                chevron.classList.toggle('rotated');
            }

            // Feedback tátil/visual extra pode ser adicionado aqui
            console.log('Conceitos ' + (conceptsList.classList.contains('expanded') ? 'expandidos' : 'recolhidos'));
        });
    }

    // Opcional: Expandir automaticamente se estiver em uma página de conceito
    const currentPath = window.location.pathname;
    if (currentPath.includes('/pages/') && !currentPath.includes('inscricao.html')) {
        conceptsList.classList.add('expanded');
        if (chevron) chevron.classList.add('rotated');
    }
});
