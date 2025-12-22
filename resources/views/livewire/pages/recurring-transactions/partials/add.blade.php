<div>
    <x-form>
        <x-input label="Nome" required placeholder="Ex: Aluguel, Netflix, Plano de Internet"/>
        <x-textarea label="Descrição" />
       
       
        <x-slot:actions>
            <x-button label="Cancelar" icon="o-x-mark"/>
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" icon="o-check-circle"/>
        </x-slot:actions>
    </x-form>
</div>
