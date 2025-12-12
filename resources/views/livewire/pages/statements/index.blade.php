<div>
    <x-header title="Extratos" subtitle="Aqui você pode ver todos os extratos das contas cadatradas" separator />

    <div>
        <div class="flex gap-4">
            <x-select wire:model="account" :options="$this->accounts" />
            {{-- {{ dd($this->months) }} --}}
            <x-dropdown>
                <x-slot:trigger>
                    <x-button label="Período" icon="o-calendar" class="btn-neutral" />
                </x-slot:trigger>

                <div class="p-4 grid grid-cols-2 gap-2">
                    <x-button wire:click="$set('range', 7); $wire.set('currentFilter', 'Últimos 7 dias')" label="Últimos 7 dias" class="btn-neutral"/>
                    <x-button wire:click="$set('range', 15); $wire.set('currentFilter', 'Últimos 15 dias')" label="Últimos 15 dias" class="btn-neutral" />
                    <x-button wire:click="$set('range', 30); $wire.set('currentFilter', 'Últimos 30 dias')" label="Últimos 30 dias" class="btn-neutral" />
                    <x-button wire:click="$set('range', 60); $wire.set('currentFilter', 'Últimos 60 dias')" label="Últimos 60 dias" class="btn-neutral" />

                    <div class="col-span-2" @click.stop="">
                        <livewire:utils.datepicker label="Período personalizado" wire:model="dateRange" range/>
                    </div>
                    
                    <div class="flex-1">
                        <x-select label="Mês" wire:model="month" :options="$this->months" @click.stop=""
                            class="flex-1" />
                    </div>
                    <div class="flex-1">
                        <x-select label="Ano" wire:model="year" :options="$this->years" @click.stop="" class="flex-1" />
                    </div>

                    <div class="col-span-2 flex gap-2">
                        <x-button 
                            label="Limpar"
                            icon="o-x-circle"
                            class="btn-secondary flex-1"
                            wire:click="$set('range', 15); $wire.set('currentFilter', 'Últimos 15 dias')"
                        />
                        <x-button 
                            label="Filtrar" 
                            icon="o-funnel"
                            class="btn-primary flex-1"
                            wire:click="filter"
                        />
                    </div>
                </div>
            </x-dropdown>
            <div class="flex items-center justify-center gap-1">
                <span>Filtro atual: </span>
                <span class="text-secondary">{{ $currentFilter }}.</span>
            </div>
        </div>

        <div class="p-4 mt-4 border rounded-xl">
            {{-- {{dd($rows)}} --}}
            <x-table :rows="$this->transactions" :headers="$headers" striped>
                <x-slot:empty>
                    <x-icon name="o-cube" label="Sem histórico de transações para esse período." />
                </x-slot:empty>
            </x-table>
        </div>
    </div>
</div>
