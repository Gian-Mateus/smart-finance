# Issues do Projeto - Sistema de Gestão Financeira

## 🔄 Issue #1: Finalizar Implementação de Transações Recorrentes

**Prioridade:** Alta
**Labels:** `feature`, `recurring-transactions`, `backend`
**Estimativa:** 8 pontos

### Descrição
Completar a funcionalidade de transações recorrentes, incluindo CRUD completo, validações e testes.

### Tarefas
- [ ] Implementar endpoint POST `/api/recurring-transactions` para criação
- [ ] Implementar endpoint PUT `/api/recurring-transactions/:id` para edição
- [ ] Implementar endpoint DELETE `/api/recurring-transactions/:id` para exclusão
- [ ] Implementar endpoint GET `/api/recurring-transactions` com filtros e paginação
- [ ] Implementar endpoint GET `/api/recurring-transactions/:id` para detalhes
- [ ] Adicionar validações de campos obrigatórios
- [ ] Validar que recurrence_pattern_id existe e pertence ao usuário
- [ ] Validar valores monetários (positivos, formato correto)
- [ ] Adicionar testes unitários para todas as operações
- [ ] Adicionar testes de integração
- [ ] Documentar endpoints na API docs

### Critérios de Aceitação
- [ ] Todas as operações CRUD funcionam corretamente
- [ ] Validações impedem dados inválidos
- [ ] Testes cobrem pelo menos 80% do código
- [ ] Documentação está completa
- [ ] Não há regressões em funcionalidades existentes

### Dependências
- Modelo de dados de recorrências já existe
- Banco de dados configurado

---

## 💡 Issue #2: Sistema de Hints Automáticos para Recorrências

**Prioridade:** Média
**Labels:** `feature`, `ux`, `recurring-transactions`
**Estimativa:** 5 pontos

### Descrição
Adicionar geração automática de hints descritivos para facilitar o entendimento das regras de recorrência configuradas.

### Tarefas
- [ ] Criar serviço `RecurrenceHintGenerator`
- [ ] Implementar lógica para frequência diária
  - "Repetição diária" ou "A cada X dias"
- [ ] Implementar lógica para frequência semanal
  - "Toda segunda-feira" ou "Segundas e quartas-feira"
- [ ] Implementar lógica para frequência mensal
  - "Todo dia 10 de cada mês"
  - "Último dia de cada mês"
  - "A cada 2 meses"
- [ ] Implementar lógica para frequência anual
  - "Todo ano em 15 de março"
- [ ] Implementar lógica para data de início/fim
  - "Repetição contínua" (sem fim)
  - "Até 31/12/2024"
  - "Por 12 ocorrências"
- [ ] Adicionar campo `hint` na resposta da API
- [ ] Adicionar testes para todas as combinações
- [ ] Suportar internacionalização (PT-BR)

### Exemplos de Hints
- "Repetição contínua • Todo dia 15 de cada mês"
- "Até 31/12/2024 • Toda segunda e sexta-feira"
- "12 vezes • A cada 3 meses no dia 1"
- "Repetição contínua • A cada 2 dias"
- "Por 24 ocorrências • Todo mês no último dia"

### Critérios de Aceitação
- [ ] Hint é gerado automaticamente ao criar/editar recorrência
- [ ] Hint é claro e descreve precisamente a regra
- [ ] Todas as combinações possíveis geram hints corretos
- [ ] Testes cobrem casos extremos
- [ ] Interface exibe o hint de forma legível

---

## 📄 Issue #3: Parser de Arquivos CSV para Importação de Extratos

**Prioridade:** Alta
**Labels:** `feature`, `import`, `csv`, `backend`
**Estimativa:** 13 pontos

### Descrição
Implementar sistema de importação de extratos bancários via arquivo CSV com mapeamento flexível de colunas.

### Tarefas
- [ ] Criar modelo `ImportConfig` para salvar mapeamentos
- [ ] Implementar parser CSV genérico (suporta diferentes delimitadores)
- [ ] Criar endpoint POST `/api/imports/preview` para pré-visualização
- [ ] Criar endpoint POST `/api/imports/execute` para importação final
- [ ] Implementar detecção automática de encoding (UTF-8, ISO-8859-1)
- [ ] Implementar mapeamento de colunas:
  - Data (suportar vários formatos: DD/MM/YYYY, YYYY-MM-DD, etc)
  - Descrição
  - Valor (detectar separadores decimais)
  - Tipo (entrada/saída ou crédito/débito)
  - Categoria (opcional)
  - Referência/ID do banco (opcional)
- [ ] Implementar validações:
  - Verificar duplicatas por referência bancária
  - Verificar duplicatas por data + valor + descrição
  - Validar formatos de data
  - Validar valores numéricos
- [ ] Criar sistema de transformações:
  - Converter crédito/débito para income/expense
  - Normalizar descrições (trim, uppercase)
  - Aplicar regras de categorização automática
- [ ] Implementar logs de importação
- [ ] Criar interface para upload de arquivo
- [ ] Criar interface para mapeamento de colunas
- [ ] Adicionar testes com arquivos reais de diferentes bancos

### Estrutura de Dados
```typescript
interface ImportConfig {
  id: string;
  user_id: string;
  name: string; // "Extrato Banco X"
  delimiter: string; // "," ou ";"
  has_header: boolean;
  encoding: string;
  column_mapping: {
    date: number;
    description: number;
    amount: number;
    type?: number;
    reference?: number;
  };
  date_format: string;
  decimal_separator: string;
  type_mapping?: {
    income: string[]; // ["C", "CREDITO"]
    expense: string[]; // ["D", "DEBITO"]
  };
}
Critérios de Aceitação
- [ ] Sistema importa CSVs de pelo menos 3 bancos brasileiros diferentes
- [ ] Detecta e previne duplicatas
- [ ] Pré-visualização mostra erros e avisos
- [ ] Usuário pode salvar configurações de importação
- [ ] Log completo de todas as importações
- [ ] Tratamento adequado de erros (arquivo inválido, formato incorreto)
- [ ] Importação de 1000+ transações acontece em menos de 5 segundos

---

## ⚡ Issue #4: Cálculo Paralelo de Saldo por Transação

**Prioridade:** Alta
**Labels:** `feature`, `performance`, `backend`
**Estimativa:** 8 pontos

### Descrição
Implementar sistema de cálculo de saldo evolutivo para cada transação, armazenando o resultado para consultas rápidas.

### Tarefas
- [ ] Adicionar coluna `balance` na tabela `transactions`
- [ ] Adicionar coluna `running_balance` na tabela `transactions`
- [ ] Criar índice composto em (account_id, date, created_at)
- [ ] Implementar função `calculateBalances(accountId, fromDate?)`:
  - Buscar saldo inicial da conta
  - Ordenar transações por data e hora de criação
  - Calcular saldo progressivo
  - Atualizar registros em lote
- [ ] Implementar trigger/evento para recalcular ao inserir transação
- [ ] Implementar trigger/evento para recalcular ao atualizar transação
- [ ] Implementar trigger/evento para recalcular ao deletar transação
- [ ] Criar job para recálculo completo (manutenção)
- [ ] Otimizar recálculo para afetar apenas transações posteriores
- [ ] Implementar cálculo paralelo para múltiplas contas (workers)
- [ ] Adicionar testes de performance
- [ ] Adicionar logs de recálculo

### Exemplo de Estrutura
```sql
-- Transação 1: 01/01/2024 - Saldo inicial: R$ 1000
-- + R$ 500 (receita) = R$ 1500 (running_balance)

-- Transação 2: 02/01/2024
-- - R$ 200 (despesa) = R$ 1300 (running_balance)

-- Se inserir transação entre elas:
-- Recalcula apenas da data da nova transação em diante
```

### Critérios de Aceitação
- [ ] Saldo é calculado corretamente para todas as transações
- [ ] Recálculo incremental funciona ao adicionar/editar/deletar
- [ ] Performance: 10.000 transações calculadas em < 2 segundos
- [ ] Múltiplas contas são processadas em paralelo
- [ ] Sistema se recupera de erros de cálculo
- [ ] Testes garantem consistência dos saldos

---

## 💰 Issue #5: Tabela de Saldo Atual por Conta

**Prioridade:** Alta
**Labels:** `feature`, `dashboard`, `frontend`
**Estimativa:** 5 pontos

### Descrição
Criar tabela/card mostrando o saldo atual de cada conta com indicadores visuais e comparação com período anterior.

### Tarefas
- [ ] Criar endpoint GET `/api/accounts/balances`
  - Retornar saldo atual de todas as contas
  - Incluir saldo do mês anterior
  - Incluir variação percentual
  - Incluir última atualização
- [ ] Criar componente `AccountBalancesTable`
- [ ] Exibir informações:
  - Nome da conta
  - Saldo atual (formatado)
  - Variação do mês (+ verde, - vermelho)
  - Última transação
  - Ícone/cor da conta
- [ ] Adicionar filtros:
  - Tipo de conta (corrente, poupança, investimento)
  - Ordenação (nome, saldo, variação)
- [ ] Adicionar ações rápidas:
  - Ver extrato
  - Adicionar transação
  - Editar conta
- [ ] Implementar totalizadores:
  - Total em todas as contas
  - Total por tipo de conta
- [ ] Adicionar indicadores visuais:
  - Saldo negativo em vermelho
  - Badges para contas com problemas
- [ ] Implementar refresh automático
- [ ] Adicionar skeleton loading
- [ ] Tornar responsivo (mobile)

### Layout Sugerido
```
+----------------------------------------------------------+
| 💰 Saldo Total: R$ 15.450,00 (+12,5% este mês)          |
+----------------------------------------------------------+
| Conta              | Saldo      | Variação | Última mov. |
|--------------------|------------|----------|-------------|
| 🏦 Conta Corrente  | R$ 5.200   | +5,2%   | Hoje        |
| 💳 Cartão Crédito  | -R$ 1.500  | -25%    | Ontem       |
| 📈 Investimentos   | R$ 11.750  | +18%    | 3 dias      |
+----------------------------------------------------------+
```

### Critérios de Aceitação
- [ ] Exibe todas as contas do usuário
- [ ] Saldos são precisos e atualizados
- [ ] Variação percentual calculada corretamente
- [ ] Interface responsiva e performática
- [ ] Atualização em tempo real ao adicionar transações
- [ ] Funciona bem com 20+ contas

---

## ➕ Issue #6: Adicionar Transações Manualmente

**Prioridade:** Alta
**Labels:** `feature`, `transactions`, `frontend`, `backend`
**Estimativa:** 8 pontos

### Descrição
Implementar interface completa para adicionar transações manualmente com validações e UX otimizado.

### Tarefas Backend
- [ ] Criar endpoint POST `/api/transactions`
- [ ] Implementar validações:
  - Campos obrigatórios (account_id, amount, date, type)
  - Valor deve ser número positivo
  - Data não pode ser futura (configurável)
  - Categoria deve existir e pertencer ao usuário
  - Conta deve existir e pertencer ao usuário
- [ ] Permitir adicionar múltiplas tags
- [ ] Permitir anexar comprovantes (upload de arquivo)
- [ ] Implementar duplicação de transação (template)
- [ ] Retornar saldo atualizado após inserção
- [ ] Adicionar ao histórico/audit log

### Tarefas Frontend
- [ ] Criar modal/página de adição de transação
- [ ] Implementar formulário com campos:
  - Tipo (receita/despesa) - toggle visual
  - Valor - input monetário formatado
  - Data - date picker
  - Conta - select/dropdown
  - Categoria - select com ícones
  - Descrição - textarea
  - Tags - multi-select ou input com chips
  - Anexos - drag & drop area
  - Recorrente? - checkbox (redireciona para outra tela)
- [ ] Implementar validações client-side
- [ ] Adicionar sugestões de categoria baseado em descrição
- [ ] Implementar auto-complete de descrições frequentes
- [ ] Adicionar botão "Adicionar outra" (não fecha o modal)
- [ ] Implementar atalhos de teclado (Ctrl+Enter para salvar)
- [ ] Adicionar feedback visual de sucesso/erro
- [ ] Implementar modo rápido (campos mínimos)
- [ ] Adicionar templates/favoritos de transações frequentes

### Melhorias de UX
- [ ] Lembrar última conta/categoria usada
- [ ] Sugerir categoria baseado em histórico
- [ ] Permitir trocar tipo (receita/despesa) facilmente
- [ ] Calcular valor automaticamente (ex: "100*3")
- [ ] Focar automaticamente no campo valor ao abrir

### Critérios de Aceitação
- [ ] Transação é criada corretamente no banco
- [ ] Todas as validações funcionam
- [ ] Saldo é recalculado automaticamente
- [ ] Interface é intuitiva e rápida
- [ ] Funciona bem em mobile
- [ ] Suporta adição rápida de múltiplas transações
- [ ] Anexos são salvos corretamente

---

## 🔗 Issue #7: Conciliação Automática - Transações Recorrentes vs Reais

**Prioridade:** Média
**Labels:** `feature`, `recurring-transactions`, `matching`, `backend`
**Estimativa:** 13 pontos

### Descrição
Implementar sistema de conciliação automática entre transações recorrentes esperadas e transações reais (importadas ou manuais).

### Tarefas - Estrutura de Dados
- [ ] Criar tabela `recurring_transaction_instances`
  - id, recurring_transaction_id, transaction_id
  - expected_date, expected_amount
  - status (pending, matched, missed, skipped, manual)
  - matched_at, amount_variance, confidence_score
- [ ] Criar índices apropriados
- [ ] Implementar migrations

### Tarefas - Geração de Instâncias
- [ ] Criar serviço `InstanceGenerator`
- [ ] Implementar cálculo de datas baseado em padrão de recorrência
- [ ] Gerar instâncias para próximos 3 meses automaticamente
- [ ] Criar job agendado para geração contínua
- [ ] Implementar lógica de datas especiais (último dia do mês, feriados)

### Tarefas - Matching Automático
- [ ] Criar serviço `TransactionMatcher`
- [ ] Implementar algoritmo de matching:
  - Tolerância de data (±3 dias configurável)
  - Tolerância de valor (±10% configurável)
  - Similaridade de descrição (fuzzy match)
  - Score de confiança (0-100%)
- [ ] Implementar matching ao importar transações
- [ ] Implementar matching ao criar transação manual
- [ ] Criar fila para processamento assíncrono
- [ ] Implementar matching em lote para transações antigas

### Tarefas - API
- [ ] Criar endpoint GET `/api/reconciliation/pending`
  - Listar instâncias pendentes
  - Filtrar por conta, período, categoria
- [ ] Criar endpoint GET `/api/reconciliation/suggestions`
  - Sugerir matches para instância específica
  - Ordenar por score de confiança
- [ ] Criar endpoint POST `/api/reconciliation/match`
  - Confirmar match manual
- [ ] Criar endpoint POST `/api/reconciliation/unmatch`
  - Desfazer match
- [ ] Criar endpoint POST `/api/reconciliation/skip`
  - Marcar instância como pulada (não vai acontecer)
- [ ] Criar endpoint GET `/api/reconciliation/stats`
  - Estatísticas de cumprimento de recorrências

### Tarefas - Interface
- [ ] Criar página de reconciliação
- [ ] Seção 1: Instâncias pendentes (aguardando pagamento)
- [ ] Seção 2: Matches sugeridos (precisam confirmação)
- [ ] Seção 3: Transações sem vínculo
- [ ] Implementar drag-and-drop para matching manual
- [ ] Mostrar diferenças (data, valor) destacadas
- [ ] Adicionar filtros e busca
- [ ] Implementar ações em lote
- [ ] Adicionar confirmação antes de ações críticas

### Algoritmo de Matching
```typescript
interface MatchCriteria {
  dateToleranceDays: number; // padrão: 3
  amountTolerancePercent: number; // padrão: 10
  descriptionSimilarityThreshold: number; // padrão: 0.7
  autoMatchThreshold: number; // padrão: 0.9 (90% de confiança)
}

// Score calculado como média ponderada:
// - Data: 30%
// - Valor: 40%
// - Descrição: 30%
```

### Critérios de Aceitação
- [ ] Instâncias são geradas automaticamente
- [ ] Matching automático funciona com alta precisão (>90%)
- [ ] Usuário pode confirmar/rejeitar sugestões
- [ ] Matching manual é simples e intuitivo
- [ ] Sistema não cria matches duplicados
- [ ] Performance adequada com 1000+ transações
- [ ] Estatísticas são precisas
- [ ] Suporta desfazer matches incorretos

---

## 📊 Issue #8: Esboço do Dashboard Principal

**Prioridade:** Média
**Labels:** `feature`, `dashboard`, `frontend`, `ux`
**Estimativa:** 13 pontos

### Descrição
Criar dashboard principal com visão geral financeira, gráficos e indicadores chave.

### Tarefas - Backend
- [ ] Criar endpoint GET `/api/dashboard/summary`
  - Saldo total
  - Receitas do mês
  - Despesas do mês
  - Comparação com mês anterior
- [ ] Criar endpoint GET `/api/dashboard/cashflow`
  - Fluxo de caixa mensal (últimos 12 meses)
  - Receitas vs Despesas
- [ ] Criar endpoint GET `/api/dashboard/categories`
  - Top 5 categorias de despesa
  - Percentual de cada categoria
- [ ] Criar endpoint GET `/api/dashboard/upcoming`
  - Próximas recorrências (7 dias)
  - Contas a vencer
- [ ] Criar endpoint GET `/api/dashboard/alerts`
  - Recorrências atrasadas
  - Orçamentos estourados
  - Metas não cumpridas
- [ ] Implementar cache para queries pesadas
- [ ] Otimizar queries com índices apropriados

### Tarefas - Frontend: Layout
- [ ] Criar estrutura de grid responsivo
- [ ] Definir breakpoints (desktop, tablet, mobile)
- [ ] Implementar tema claro/escuro
- [ ] Adicionar loading states em todos os cards

### Tarefas - Frontend: Cards/Widgets

**Card 1: Resumo Financeiro**
- [ ] Exibir saldo total (destaque)
- [ ] Exibir receitas do mês
- [ ] Exibir despesas do mês
- [ ] Exibir saldo projetado (fim do mês)
- [ ] Mostrar variação percentual vs mês anterior
- [ ] Adicionar indicadores visuais (cores, ícones)

**Card 2: Gráfico de Fluxo de Caixa**
- [ ] Implementar gráfico de linha/área
- [ ] Mostrar últimos 6-12 meses
- [ ] Linhas separadas para receita e despesa
- [ ] Área sombreada para saldo líquido
- [ ] Tooltip com detalhes ao passar mouse
- [ ] Permitir alternar período (3m, 6m, 12m)

**Card 3: Despesas por Categoria**
- [ ] Implementar gráfico de rosca/pizza
- [ ] Mostrar top 5-7 categorias
- [ ] Agrupar resto em "Outros"
- [ ] Exibir valor e percentual
- [ ] Permitir clicar para ver detalhes

**Card 4: Próximas Recorrências**
- [ ] Listar próximas 5-7 recorrências
- [ ] Mostrar data, descrição, valor
- [ ] Indicar se já foi paga
- [ ] Permitir marcar como paga rapidamente
- [ ] Link para ver todas

**Card 5: Alertas e Notificações**
- [ ] Badge com número de alertas
- [ ] Listar recorrências atrasadas
- [ ] Listar orçamentos próximos do limite
- [ ] Cores de prioridade
- [ ] Ação rápida para resolver

**Card 6: Atividade Recente**
- [ ] Listar últimas 5 transações
- [ ] Exibir data, descrição, valor
- [ ] Ícone da categoria
- [ ] Link para ver extrato completo

### Tarefas - Interatividade
- [ ] Implementar refresh manual (botão)
- [ ] Implementar auto-refresh (a cada 5 min)
- [ ] Adicionar filtros globais (período, contas)
- [ ] Permitir reordenar cards (drag-and-drop)
- [ ] Salvar preferências de layout do usuário
- [ ] Adicionar tour guiado para novos usuários

### Tarefas - Performance
- [ ] Implementar virtual scrolling para listas grandes
- [ ] Lazy loading de gráficos
- [ ] Otimizar renderização (React.memo, useMemo)
- [ ] Implementar skeleton screens
- [ ] Adicionar error boundaries

### Exemplo de Layout
```
+------------------+------------------+------------------+
|    💰 Saldo      |   📈 Receitas    |   📉 Despesas    |
|   R$ 15.450      |    R$ 8.500      |    R$ 6.300      |
|   +12,5% ↑       |    +5% ↑         |    -8% ↓         |
+------------------+------------------+------------------+
|                                                        |
|         📊 Fluxo de Caixa (Últimos 12 meses)          |
|                  (Gráfico de Linha)                    |
|                                                        |
+---------------------------+----------------------------+
|  🥧 Despesas por          |  🔔 Próximas Recorrências |
|     Categoria             |                            |
|  (Gráfico Pizza)          |  - Aluguel: R$ 2.000      |
|                           |    (em 3 dias)             |
|                           |  - Netflix: R$ 40          |
+---------------------------+----------------------------+
|  ⚠️ Alertas              |  📋 Atividade Recente      |
|  • 2 recorrências atrasadas| • Mercado: -R$ 250       |
|  • Orçamento estourado    |  • Salário: +R$ 5.000     |
+---------------------------+----------------------------+
```

### Critérios de Aceitação
- [ ] Dashboard carrega em menos de 2 segundos
- [ ] Todos os gráficos são responsivos
- [ ] Dados são atualizados em tempo real
- [ ] Interface é intuitiva e visualmente agradável
- [ ] Funciona bem em mobile, tablet e desktop
- [ ] Sem erros de console
- [ ] Acessível (ARIA labels, keyboard navigation)
- [ ] Suporta temas claro e escuro

---

## 📋 Roadmap Sugerido

### Sprint 1 (2 semanas)
1. Issue #1 - Finalizar transações recorrentes
2. Issue #6 - Adicionar transações manualmente
3. Issue #5 - Tabela de saldo atual

### Sprint 2 (2 semanas)
4. Issue #4 - Cálculo paralelo de saldo
5. Issue #3 - Parser de CSV (início)

### Sprint 3 (2 semanas)
6. Issue #3 - Parser de CSV (conclusão)
7. Issue #2 - Hints automáticos
8. Issue #8 - Dashboard (início)

### Sprint 4 (2 semanas)
9. Issue #8 - Dashboard (conclusão)
10. Issue #7 - Conciliação automática

### Observações
- As issues estão ordenadas por dependência e prioridade
- Estimativas em pontos de história (fibonacci)
- Labels ajudam a filtrar e organizar
- Cada issue pode ser dividida em sub-tasks menores se necessário
```

Criei uma lista detalhada de 8 issues principais com:

1. **Descrição clara** de cada funcionalidade
2. **Tarefas específicas** e acionáveis
3. **Critérios de aceitação** bem definidos
4. **Estimativas de esforço** (pontos de história)
5. **Labels** para organização
6. **Exemplos práticos** onde aplicável
7. **Considerações técnicas** (performance, UX, segurança)

Também inclui um **roadmap sugerido** dividindo as issues em 4 sprints de 2 semanas cada.

Você gostaria que eu:
1. Detalhasse mais alguma issue específica?
2. Criasse sub-tasks mais granulares para alguma issue?
3. Adicionasse mais issues que possam estar faltando?
4. Reformatasse isso em outro formato (JSON, YAML, template do GitHub Issues)?