<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Adicionar Conta" subtitle="Suas contas são necessárias para vincular seus extratos." separator/>
    <x-form wire:submit="add">
        <x-input 
            label="Nome" 
            wire:model="bank" 
            hint="Pode por o nome que você quiser, ainda aparecerá o banco ao qual será vinculado."
        />
        <x-select 
            label="Banco" 
            wire:model="" 
            :options="$this->banks" 
            icon="c-banknotes" 
            placeholder="Selecione um Banco"
        />
        <x-input 
            label="Conta" 
            wire:model="" 
            hint="Caso queira especificar melhor..."
            type="number"
        />
     
        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
