/**
 * PhiloMap - Lógica de Inscrição
 */

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formInscricao');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const feedback = document.getElementById('feedback');

        try {
            feedback.innerText = 'Enviando...';
            feedback.style.color = 'var(--text-dim)';

            // Note: Adjust the path if necessary depending on where the HTML is served from
            const response = await fetch('../backend/index.php?action=inscrever', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                feedback.innerText = result.message;
                feedback.style.color = 'var(--gold)';
                form.reset();
            } else {
                feedback.innerText = result.message || 'Erro ao realizar inscrição.';
                feedback.style.color = '#ff4444';
            }
        } catch (error) {
            console.error('Error:', error);
            feedback.innerText = 'Erro na conexão com o servidor.';
            feedback.style.color = '#ff4444';
        }
    });
});
