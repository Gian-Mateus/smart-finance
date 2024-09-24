SPEC-001: Projeto de Gerenciamento de Finanças Pessoais
== Background

Este projeto visa construir uma aplicação de gerenciamento de finanças pessoais. A aplicação permitirá o controle de transações, orçamento por categorias e subcategorias, além da organização de dados bancários e tipos de transações (débito e crédito). A solução será desenvolvida utilizando o framework Laravel, com frontend utilizando Flowbite e o banco de dados MySQL.

== Requirements

Abaixo estão os requisitos principais do sistema priorizados com a metodologia MoSCoW:

Must Have:

Registro de categorias e subcategorias de transações.
Controle de transações financeiras com campos como: data, descrição, tipo, valor e observação.
Relacionamento entre categorias e subcategorias de transações.
Orçamento por categoria e subcategoria, com a validação de que o orçamento de subcategorias não pode exceder o orçamento total da categoria.
Integração com bancos e controle de periodicidade de transações.
Should Have:

Histórico de transações para auditoria de extratos.
Interface para visualizar o saldo orçado e os valores gastos em tempo real.
Controle de bancos (nome, agência) para facilitar o registro das transações.
Cadastro de tipos de transação (débito/crédito).
Could Have:

Suporte para múltiplos usuários com controle de acesso.
Exportação de relatórios financeiros em diferentes formatos (CSV, PDF).
Won't Have:

Integração com APIs de terceiros para sincronização automática de extratos bancários na versão inicial.
== Method

== Implementation

Banco de Dados:

Criação das tabelas usando migrations do Laravel.
Implementação de relacionamentos e validações usando Eloquent ORM.
Validação para garantir que o valor orçado das subcategorias não ultrapasse o valor total da categoria.
Backend:

Definição dos controladores para gerenciar transações, categorias, subcategorias e orçamentos.
Implementação de middlewares de autenticação e controle de acesso.
Frontend:

Utilização do Flowbite para criação da interface, permitindo aos usuários visualizar e editar suas finanças pessoais.
Validação do Orçamento:

Implementação de uma lógica no backend para validar o somatório das subcategorias em relação ao valor total da categoria.
== Milestones

Configuração inicial do banco de dados com todas as tabelas definidas.
Implementação das funcionalidades de CRUD para categorias, subcategorias, transações e orçamento.
Validação de regras de orçamento entre categorias e subcategorias.
Criação da interface de usuário usando Flowbite.
Testes e ajustes de funcionalidades com base no feedback.
== Gathering Results

Verificação de Funcionalidade: Confirmar que todas as funcionalidades principais, como gerenciamento de transações e orçamento, funcionam conforme o esperado.
Validação de Orçamentos: Garantir que os valores orçados para as subcategorias não excedam o orçamento definido para a categoria.
Testes de Integração: Verificar que o sistema se integra bem com o banco de dados e funciona adequadamente em diferentes navegadores.