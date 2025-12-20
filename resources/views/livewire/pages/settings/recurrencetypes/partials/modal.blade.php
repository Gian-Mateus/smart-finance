<x-modal wire:model="modalOpen" title="{{ $title }}">
    <x-form wire:submit="save">

        {{-- 1. Identificação (O quê?) - Campo sempre visível --}}
        <x-input label="Nome" placeholder="Ex: Aluguel, Assinatura Spotify" wire:model="form.name" />
        <hr class="my-4" />

        {{-- 2. Padrão da Repetição (Como?) - O Maestro --}}
        <x-select
            label="Repetir a cada"
            placeholder="Selecione a frequência"
            :options="$selectsTypes"
            wire:model.live="form.type"
            option-value="id"
            option-label="label"
            class="mb-4"
        />

        {{-- Campos dinâmicos que aparecem com base no `form.type` --}}
        @if($form->type)
            <div class="space-y-3 p-3 border rounded-lg bg-base-200/50">
                {{-- Para tipos Mensal e Anual, pedimos o dia do mês --}}
                @if (in_array($form->type, ['monthly', 'yearly']))
                    <livewire:utils.grid-days label="No dia:" wire:model="form.day_of_month" />
                @endif

                {{-- Para tipo Semanal, pedimos o dia da semana --}}
                @if ($form->type == 'weekly')
                    <x-select
                        label="No dia da semana:"
                        :options="$weekDays"
                        option-value="id"
                        option-label="label"
                        placeholder="Selecione o dia"
                        wire:model="form.week_day"
                    />
                @endif
                
                {{-- Para tipo por Intervalo (dias) ou Anual, pedimos o intervalo --}}
                @if ($form->type == 'interval')
                    <x-input label="A cada" wire:model="form.interval" type="number" suffix="dias" />
                @endif
                 @if ($form->type == 'yearly')
                    <x-input label="A cada" wire:model="form.interval" type="number" suffix="ano(s)" />
                @endif
            </div>
            <hr class="my-4" />
        @endif


        {{-- 3. Limites da Repetição (Quando?) --}}
        @if($form->type)
            <x-utils.date-picker label="Começa em" wire:model="form.start_date" icon="o-calendar" class="mb-4" />

            <x-select
                label="Termina"
                wire:model.live="form.end_condition"
                :options="$endConditions"
                option-value="id"
                option-label="label"
                single
            />

            @if($form->end_condition == 'on_date')
                <x-utils.date-picker  label="Em" wire:model="form.end_date" icon="o-calendar-days" class="mt-3" />
            @endif

            @if($form->end_condition == 'after_occurrences')
                <x-input label="Após" wire:model="form.occurrences" type="number" suffix="ocorrências" class="mt-3" />
            @endif
        @endif


        <x-slot:actions>
            <x-button label="Cancelar" wire:click="close" />
            <x-button label="Salvar" class="btn-primary" type="submit" />
        </x-slot:actions>
    </x-form>
</x-modal>
