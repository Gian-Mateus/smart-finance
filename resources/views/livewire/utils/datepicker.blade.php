<div
    x-data="{
        open: true,
        startDate: null,
        endDate: null,
        maskDate(e, field) {
            const regex = new RegExp('^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$');
            let digits = e.target.value.replace(/\D/g, '');
                       // Aplica a máscara no formato DD/MM/YYYY
                       let self = this;
                       let masked = digits;
                       if (digits.length > 2 && digits.length <= 4) {
                           masked = digits.slice(0, 2) + '/' + digits.slice(2);
                       } else if (digits.length > 4) {
                           masked = digits.slice(0, 2) + '/' + digits.slice(2, 4) + '/' + digits.slice(4, 8);
                       }
                       // Atualiza o valor do input e da propriedade correspondente
                       e.target.value = masked;
                       this[field] = masked;

                       // Encontra o fieldset pai do input
                        const fieldset = e.target.closest('fieldset');
                        const inputLabel = e.target.closest('label');

                        // Remove erro anterior
                        const existingError = fieldset.querySelector('.js-error-message');
                        if (existingError) existingError.remove();
                        inputLabel.classList.remove('!input-error');

                       // Se o valor completo for inserido, valida com a regex
                       if (masked.length === 10) {
                           const regex = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))$)|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
                           if (!regex.test(masked)) {
                                // Adiciona classe de erro ao input
                                inputLabel.classList.add('!input-error');

                                // Cria e adiciona mensagem de erro
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'text-error js-error-message';
                                errorDiv.textContent = 'Data inválida';
                                fieldset.appendChild(errorDiv);
                            }
                       }
        },
        firstInput: false,
        secondInput: false,
        openPicker(){
            this.open = true;
        }
    }"
>

    @php
        $range = true;
        
        $days = collect($this->calendarDays($now->month, $now->year))->groupBy('date.month');
        $teste = collect();
        $startMonth = count($days) > 2 
        ? $days->slice(0, 2)->flatten(1)
        : $days->slice(0);
        
        $endMonth = count($days) > 2 
        ? $days->slice(2)->flatten(1)
        : $days->slice(1);
    @endphp
    {{-- {{dd($startMonth)}} --}}
    @if ($range)
    {{-- inputs --}}
    <div class="flex gap-4" x-ref="trigger" id="trigger-{{ $uuid }}">
        <x-input
            label="Dê:"
            icon="o-calendar"
            x-model="startDate"
            x-on:input="maskDate($event, 'startDate')"
            @click="firstInput = true; openPicker()"
        />
        <x-input
            label="Até:"
            icon="o-calendar"
            x-model="endDate"
            x-on:input="maskDate($event, 'endDate')"
            @click="secondInput = true; openPicker()"
        />
    </div>
    @endif
    {{-- grid dates --}}

    {{-- {{ dd($this->calendarDays($now->month, $now->year)[0]['date']->month) }} --}}
    <template x-teleport="main">
        <div
            id="{{ $uuid }}"
            class="bg-base-100 max-w-lg w-fit flex flex-col rounded-md"
            x-show="open"
            @click.outside="open = false"
            x-transition
            x-anchor.bottom-start.offset.10="$refs.trigger"
        >
            @if ($range)
            <div class="flex items-center justify-between px-4 mt-2">
                <x-button icon="o-arrow-left" class="btn-circle btn-ghost" @click="$wire.setMonth('dec')"/>
                <div>
                    {{ $months[$now->month - 2]['name'] }} - {{ $months[$now->month - 1]['name'] }}
                </div>
                <x-button icon="o-arrow-right" class="btn-circle btn-ghost" @click="$wire.setMonth('inc')"/>
            </div>
            <div class="h-1 bg-base-content w-[60%] mx-auto"></div>
            <div class="flex">
                <ul class="grid grid-cols-7 gap-2 p-4 text-center">
                    @foreach ($startMonth as $day)
                    <li @class([
                        'p-1',
                        'opacity-50' => !$day['current'], // Dias fora do mês atual ficam "apagados"
                        'font-bold bg-primary text-primary-content rounded-md cursor-pointer hover:brightness-90' => $day['isToday'], // Hoje em destaque
                    ])>
                        {{ $day['date']->format('d') }}
                    </li>
                @endforeach
                </ul>
                <ul class="grid grid-cols-7 gap-2 p-4 text-center">
                    @foreach ($endMonth as $day)
                    <li @class([
                        'p-1',
                        'opacity-50' => !$day['current'], // Dias fora do mês atual ficam "apagados"
                        'font-bold bg-primary text-primary-content rounded-md cursor-pointer hover:brightness-90' => $day['isToday'], // Hoje em destaque
                    ])>
                        {{ $day['date']->format('d') }}
                    </li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </template>
</div>
