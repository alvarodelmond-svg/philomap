/**
 * PhiloMap - Banco de Dados (IndexedDB)
 * Mini-framework para persistência de dados local.
 */

const DB_NAME = 'PhiloMapDB';
const DB_VERSION = 1;
const STORE_NAME = 'inscricoes';

/**
 * Inicia o banco de dados e cria a object store se necessário.
 * @returns {Promise} Resolvida com a instância do IDBDatabase.
 */
function iniciarBanco() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NAME, DB_VERSION);

        request.onupgradeneeded = (event) => {
            const db = event.target.result;
            if (!db.objectStoreNames.contains(STORE_NAME)) {
                // Criamos a store com auto-incremento para o ID
                db.createObjectStore(STORE_NAME, { keyPath: 'id', autoIncrement: true });
            }
        };

        request.onsuccess = (event) => resolve(event.target.result);
        request.onerror = (event) => reject('Erro ao abrir banco: ' + event.target.error);
    });
}

/**
 * Adiciona um novo registro ao banco.
 * @param {Object} dado - O objeto a ser salvo.
 */
async function adicionarItem(dado) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readwrite');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.add(dado);

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao adicionar item: ' + request.error);
    });
}

/**
 * Recupera todos os registros salvos.
 * @returns {Promise<Array>} Lista de objetos.
 */
async function buscarItens() {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readonly');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.getAll();

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao buscar itens: ' + request.error);
    });
}

/**
 * Remove um item pelo seu ID único.
 * @param {number} id - ID do registro.
 */
async function deletarItem(id) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NAME], 'readwrite');
        const store = transaction.objectStore(STORE_NAME);
        const request = store.delete(Number(id));

        request.onsuccess = () => resolve();
        request.onerror = () => reject('Erro ao deletar item: ' + request.error);
    });
}
