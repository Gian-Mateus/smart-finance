<div>
    <x-header title="Transações Recorrentes" subtitle="Aqui você pode ver todas as transações recorrentes das contas cadastradas" separator />

    <div>
        <div>
            <x-button label="Adicionar" class="btn-primary" icon="o-plus" link="{{ route('recurring-transactions.add') }}"/>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
            <div>
                <x-header title="Receitas" separator/>
            </div>
            <div>
                <x-header title="Despesas" separator/>
            </div>
            <div>
                <x-header title="Por mês" separator/>
            </div>
            <div>
                <x-header title="Outros" separator/>
            </div>
        </div>
    </div>
</div>
