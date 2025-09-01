
# Documentação das Tabelas do Banco de Dados

Este documento fornece um resumo de cada uma das tabelas no banco de dados da aplicação, descrevendo sua finalidade e os dados que armazenam.

## Tabelas Principais

### `users`

Esta tabela armazena as informações dos usuários da aplicação.

- `id`: Identificador único para cada usuário.
- `name`: Nome do usuário.
- `email`: Endereço de e-mail do usuário, usado para login e comunicação.
- `password`: Senha do usuário (armazenada de forma segura).
- `remember_token`: Token para a funcionalidade "lembrar de mim".
- `timestamps`: Datas de criação e atualização do registro.

### `banks`

Armazena uma lista de bancos.

- `id`: Identificador único para cada banco.
- `name`: Nome curto do banco.
- `full_name`: Nome completo do banco.
- `ispb`: ISPB do banco.
- `code`: Código do banco.

### `banks_accounts`

Representa as contas bancárias dos usuários.

- `id`: Identificador único para cada conta bancária.
- `user_id`: Chave estrangeira que referencia o usuário (`users`) a quem a conta pertence.
- `bank_id`: Chave estrangeira que referencia o banco (`banks`) da conta.
- `name`: Nome dado pelo usuário à conta (ex: "Minha Conta Corrente").
- `account_number`: Número da conta.

### `categories`

Categorias para classificar as transações.

- `id`: Identificador único para cada categoria.
- `user_id`: Chave estrangeira que referencia o usuário (`users`) que criou a categoria.
- `name`: Nome da categoria (ex: "Alimentação", "Transporte").
- `icon`: Ícone associado à categoria.

### `subcategories`

Subcategorias para uma classificação mais detalhada das transações.

- `id`: Identificador único para cada subcategoria.
- `category_id`: Chave estrangeira que referencia a categoria (`categories`) principal.
- `user_id`: Chave estrangeira que referencia o usuário (`users`) que criou a subcategoria.
- `name`: Nome da subcategoria (ex: "Restaurante", "Supermercado").

### `transactions`

Registros de todas as transações financeiras.

- `id`: Identificador único para cada transação.
- `description`: Descrição da transação.
- `amount`: Valor da transação.
- `date`: Data em que a transação ocorreu.
- `user_id`: Chave estrangeira para `users`.
- `banks_account_id`: Chave estrangeira para `banks_accounts`.
- `category_id`: Chave estrangeira para `categories`.
- `subcategory_id`: Chave estrangeira para `subcategories`.
- `payment_method_id`: Chave estrangeira para `payment_methods`.

### `budgets`

Orçamentos (teto de gastos) criados pelos usuários.

- `id`: Identificador único do orçamento.
- `user_id`: Chave estrangeira para `users`.
- `budgetable_id`: Chave estrangeira polimórfica.
- `budgetable_type`: Representa a model que está relacionada.
- `target_value`: Valor do orçamento.


### `imports`

Registros de importações de extratos bancários.

- `id`: Identificador único da importação.
- `user_id`: Chave estrangeira para `users`.
- `banks_account_id`: Chave estrangeira para `banks_accounts`.
- `file_name`: Nome do arquivo importado.
- `status`: Status da importação (ex: "processando", "concluído").

### `imports_transactions`

Tabela pivot para relacionar transações a importações.

- `import_id`: Chave estrangeira para `imports`.
- `transaction_id`: Chave estrangeira para `transactions`.

## Tabelas de Suporte

### `recurrence_types`

Tipos de recorrência para transações (ex: "Mensal", "Anual"). Ainda em definição, utilizarei para definir recorrências de transação, se são a cada 15 dias, data fixa, despesas ou receitas,etc.

- `id`: Identificador único do tipo de recorrência.
- `interval`: Nome do tipo de recorrência.

### `payment_methods`

Métodos de pagamento (ex: "Cartão de Crédito", "Dinheiro").

- `id`: Identificador único do método de pagamento.
- `name`: Nome do método de pagamento.

### `icons`

Ícones que podem ser usados nas categorias.

- `id`: Identificador único do ícone.
- `name`: Nome do ícone.

## Tabelas do Laravel

### `password_reset_tokens`

Armazena tokens para a funcionalidade de redefinição de senha.

### `sessions`

Armazena as sessões dos usuários.

### `cache` e `cache_locks`

Tabelas para o sistema de cache do Laravel.

### `jobs`, `job_batches`, `failed_jobs`

Tabelas para o sistema de filas e jobs em segundo plano do Laravel.
