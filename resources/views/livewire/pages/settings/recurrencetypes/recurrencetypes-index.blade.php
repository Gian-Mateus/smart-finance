<div>
    <x-header title="Transações recorrentes" subtitle="Aqui você define recorrências personalizadas para suas transações" separator/>
    <x-button label="Nova Recorrência" icon="s-plus-small" class="btn-primary my-4" wire:click="newRecurrence" />

    <div class="container">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 mx-auto gap-8">
            @foreach ($this->recurrencetypes as $r)
            {{-- O título do card já diferencia o tipo 'custom' --}}
            <x-card  class="shadow-md">
            <x-slot:title>
                <div class="flex items-center justify-between">
                    <div>
                        {{ $r->type == 'custom' ? 'Customizado: '.ucfirst($r->name) : ucfirst($r->name) }}
                    </div>
                    <x-dropdown>
                        <x-slot:trigger>
                            <x-button icon="o-ellipsis-vertical" class="btn-ghost" />
                        </x-slot:trigger>
                    
                        <x-menu-item title="Editar" icon="o-pencil" />
                        <x-menu-item title="Excluir" icon="o-trash" />
                    </x-dropdown>
                </div>
            </x-slot:title>

                <div class="text-sm text-gray-600 space-y-2">
                    {{-- Bloco 1: Descreve a regra principal da recorrência --}}
                    <div class="font-semibold">
                        @switch($r->type)
                            @case('daily')
                                <span>Ocorre todo dia.</span>
                                @break
                            @case('weekly')
                                <span>Ocorre toda semana.</span>
                                @break
                            @case('monthly')
                                <span>Ocorre todo mês.</span>
                                @break
                            @case('yearly')
                                <span>Ocorre anualmente.</span>
                                @break
                            @case('custom')
                                <span>Ocorre a cada <strong>{{ $r->interval }}</strong> dias.</span>
                                @break
                        @endswitch
                    </div>

                    {{-- Bloco 2: Mostra os limites da recorrência (datas ou ocorrências) --}}
                    <div class="border-t pt-2">
                        @if($r->start_date)
                            <div class="text-xs text-gray-500">
                                Início em: <strong>{{ $r->start_date->format('d/m/Y') }}</strong>
                            </div>
                        @endif

                        @if($r->end_date)
                             <div class="text-xs text-gray-500">
                                Fim em: <strong>{{ $r->end_date->format('d/m/Y') }}</strong>
                            </div>
                        @elseif($r->occurrences)
                            <div class="text-xs text-gray-500">
                                Repete <strong>{{ $r->occurrences }}</strong> vezes.
                            </div>
                        @else
                             <div class="text-xs text-gray-500">
                                Repetição contínua.
                            </div>
                        @endif
                    </div>
                </div>
            </x-card>
            @endforeach
        </div>
    </div>

    <livewire:pages.settings.recurrencetypes.partials.modal />
</div>
