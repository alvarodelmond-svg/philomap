/**
 * PhiloMap - Sistema de Favoritos (Backend PHP)
 */

const FavoritesManager = {
    apiUrl: 'backend/index.php',

    async favoritar(usuario_id, conteudo_id, titulo_conteudo) {
        const formData = new FormData();
        formData.append('usuario_id', usuario_id);
        formData.append('conteudo_id', conteudo_id);
        formData.append('titulo_conteudo', titulo_conteudo);

        try {
            const response = await fetch(`${this.apiUrl}?action=favoritar`, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                if (typeof exibirFeedback === 'function') exibirFeedback(result.message, 'success');
            } else {
                if (typeof exibirFeedback === 'function') exibirFeedback(result.message, 'error');
            }
            return result;
        } catch (error) {
            if (typeof exibirFeedback === 'function') exibirFeedback('Erro ao conectar com o servidor.', 'error');
            console.error('Error:', error);
        }
    },

    async listar(usuario_id) {
        try {
            const response = await fetch(`${this.apiUrl}?action=listar&usuario_id=${usuario_id}`);
            const result = await response.json();
            return result.success ? result.data : [];
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    async remover(usuario_id, conteudo_id) {
        const formData = new FormData();
        formData.append('usuario_id', usuario_id);
        formData.append('conteudo_id', conteudo_id);

        try {
            const response = await fetch(`${this.apiUrl}?action=remover`, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                if (typeof exibirFeedback === 'function') exibirFeedback(result.message, 'success');
            } else {
                if (typeof exibirFeedback === 'function') exibirFeedback(result.message, 'error');
            }
            return result;
        } catch (error) {
            if (typeof exibirFeedback === 'function') exibirFeedback('Erro ao conectar com o servidor.', 'error');
            console.error('Error:', error);
        }
    }
};

// Exemplo de como usar no HTML:
// <button onclick="FavoritesManager.favoritar(1, 'etica', 'Ética')">Favoritar</button>
