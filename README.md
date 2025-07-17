# Gerenciador de Finanças Pessoais

Este é um projeto para gerenciador de finanças pessoais, desenvolvido com Laravel. Ele permite aos usuários acompanhar suas receitas e despesas, organizar transações por categorias e subcategorias, gerenciar contas bancárias e orçamentos, e importar dados financeiros.

### Estrutura de Dados

Este projeto utiliza um banco de dados relacional para armazenar informações financeiras. As principais entidades e suas relações são as seguintes:

| Entidade        | Relação | Entidade Relacionada | Descrição                                    |
| --------------- | ------- | -------------------- | -------------------------------------------- |
| `User`          | 1 -> n  | `BanksAccount`       | Um usuário pode ter várias contas bancárias.  |
| `User`          | 1 -> n  | `Category`           | Um usuário pode ter várias categorias.       |
| `Category`      | 1 -> n  | `Subcategory`        | Uma categoria pode ter várias subcategorias. |
| `BanksAccount`  | 1 -> n  | `Transaction`        | Uma conta bancária pode ter várias transações.|
| `Category`      | 1 -> n  | `Transaction`        | Uma categoria pode ter várias transações.    |
| `Subcategory`   | 1 -> n  | `Transaction`        | Uma subcategoria pode ter várias transações. |
| `Import`        | 1 -> n  | `ImportsTransaction` | Um import pode ter várias transações importadas.|
| `ImportsTransaction` | 1 -> 1 | `Transaction`     | Uma transação importada corresponde a uma transação. |
| `Budget`        | 1 -> 1  | `Category`           | Un orçamento está associado a uma categoria. |
| `PaymentMethod` | 1 -> n  | `Transaction`        | Um método de pagamento pode ter várias transações. |
| `Bank`          | 1 -> n  | `BanksAccount`       | Um banco pode ter várias contas bancárias.   |

### Contribuição

Se você deseja contribuir para este projeto, por favor, siga os seguintes passos:

1. Faça um fork do repositório.
2. Crie uma branch para a sua feature (`git checkout -b feature/minha-feature`).
3. Faça commit das suas alterações (`git commit -m 'Adiciona minha feature'`).
4. Faça push para a branch (`git push origin feature/minha-feature`).
5. Crie um novo Pull Request.

### Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo `LICENSE` para mais detalhes.