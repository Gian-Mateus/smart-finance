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
                    <x-button wire:click="$set('range', 7)" label="Últimos 7 dias" class="btn-neutral"/>
                    <x-button wire:click="$set('range', 15)" label="Últimos 15 dias" class="btn-neutral" />
                    <x-button wire:click="$set('range', 30)" label="Últimos 30 dias" class="btn-neutral" />
                    <x-button wire:click="$set('range', 60)" label="Últimos 60 dias" class="btn-neutral" />

                    <div class="col-span-2" @click.stop="">
                        <x-datepicker label="Período personalizado" wire:model="dateRange" icon="o-calendar" :config="$configDatePicker"/>
                    </div>
                    
                    <div class="flex-1">
                        <x-select label="Mês" wire:model="month" :options="$this->months" @click.stop=""
                            class="flex-1" />
                    </div>
                    <div class="flex-1">
                        <x-select label="Ano" wire:model="year" :options="$this->years" @click.stop="" class="flex-1" />
                    </div>

                    <x-button label="Filtrar" class="btn-primary col-span-2" wire:click="filter"/>
                </div>
            </x-dropdown>
        </div>

        <div class="p-4 mt-4 border-1 rounded-xl">
            {{-- {{dd($rows)}} --}}
            <x-table :rows="$this->transactions" :headers="$headers" striped />
        </div>
    </div>
</div>
