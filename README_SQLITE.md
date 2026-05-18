# Projeto PhiloMap - Migração SQLite Concluída

A migração para SQLite foi realizada com sucesso. Siga as instruções abaixo para rodar o projeto:

## 1. Banco de Dados
O banco de dados já foi inicializado em `database/philomap.sqlite`.
A tabela `matriculas` já foi criada com os campos necessários:
- `id` (Primary Key)
- `aluno`
- `idade`
- `curso`
- `created_at`

## 2. Como Rodar o Servidor
Como você está no Windows, abra o terminal na pasta raiz do projeto e execute:
```bash
php -S localhost:8000
```
Depois, acesse no seu navegador: `http://localhost:8000`

## 3. Testar a Conexão
Você pode verificar se o PHP está conseguindo ler o banco de dados acessando:
`http://localhost:8000/db_test.php`

## 4. Alterações Realizadas
- **config.ini**: Atualizado para usar o driver `sqlite`.
- **php.ini**: Configurado para habilitar extensões SQLite no Windows.
- **app/router/Router.php**: Corrigido para suportar as rotas definidas no `index.php`.
- **app/middleware/LoggerMiddleware.php**: Removido namespace que quebrava o autoload.
- **db_test.php**: Atualizado para realizar o diagnóstico do SQLite.
- **Banco de Dados**: Criado via script auxiliar para garantir que você já comece com ele funcionando.

Boa sorte com a atividade!
