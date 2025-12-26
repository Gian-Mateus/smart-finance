<div x-data="{
        selectedType: $wire.entangle('selectedType'),
        typeMonth: null,
    }"
>
    <x-form wire:submit.prevent="save" class="max-w-2xl space-y-6">
        <x-input
            label="Nome"
            required
            placeholder="Ex: Aluguel, Netflix, Plano de Internet"
            wire:model.defer="name"
        />

        <x-textarea
            label="Descrição"
            placeholder="Opcional: informações sobre a transação"
            wire:model="description"
        />
        
        <x-select
            label="Tipo"
            wire:model="selectedType"
            :options="$selectsTypes"
            optionLabel="label"
            optiooptionValue="id"
            required
        />
        
        <div class="grid grid-cols-[min-content_auto] items-start gap-4">
            <x-radio 
                class="col-span-1"
                label="" 
                x-model="typeMonth" 
                :options="$optionsMonth"
                optionValue="id"
                optionLabel="label"
            />
            <div class="col-span-1">
                <div x-show="typeMonth == 'fixedDay'">
                    <x-input prefix="Dia:" type="number" min="1" max="31" required/>  
                </div>
                
                <div x-show="typeMonth == 'dayOfWeek'">
                    <x-select
                        label="Semana"
                        x-model=""
                        :options="[
                            ['id' => 1, 'name' => 'Primeira'],
                            ['id' => 2, 'name' => 'Segunda'],
                            ['id' => 3, 'name' => 'Terceira'],
                            ['id' => 4, 'name' => 'Quarta']
                        ]"
                    />
                    <x-select
                        label="Dia da Semana"
                        x-model=""
                        :options="$weekDays"
                        optionValue="id"
                        optionLabel="label"
                    />
                </div>
            </div>
        </div>
        
        <x-slot:actions>
            <x-button label="Cancelar" type="button" icon="o-x-mark"/>
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" icon="o-check-circle"/>
        </x-slot:actions>
    </x-form>
</div>
