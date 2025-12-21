<div>
    <x-form>
        <x-input label="Nome" />
        <x-select 
            label="Recorrência" 
            :options="$this->recurringTypes" 
            option-value="id" 
            option-label="name" 
            wire:model="rTypeSelected"
        />
        <div>
            @foreach($this->recurringTypes as $type)
                <div x-show="$wire.rTypeSelected === {{ $type->id }}">{{ $type->name }}</div>
            @endforeach
        </div>
        <x-slot:actions>
            <x-button label="Cancelar" icon="o-x-mark"/>
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" icon="o-check-circle"/>
        </x-slot:actions>
    </x-form>
</div>
