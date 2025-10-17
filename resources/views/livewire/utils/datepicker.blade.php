<div
    x-data="{ 
        open: false,
    }"
>
    @php
        $range = true;
    @endphp
    @if ($range)
    {{-- inputs --}}
    <div class="flex gap-4" @click.prevent="open = !open" x-ref="trigger" id="trigger-{{ $uuid }}">
        <x-input label="Dê:" icon="o-calendar"/>
        <x-input label="Até:" icon="o-calendar"/>
    </div>
    @endif
    {{-- grid dates --}}

    {{-- {{ dd($this->period) }} --}}
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
                    {{ $months[$now->month - 1]['name'] }}
                </div>
                <x-button icon="o-arrow-right" class="btn-circle btn-ghost" @click="$wire.setMonth('inc')"/>
            </div>
            <div class="h-1 bg-base-content w-[60%] mx-auto"></div>
            <ul class="grid grid-cols-7 gap-2 p-4 text-center">
                @foreach ($this->calendarDays($now->month, $now->year) as $day)
                    <li @class([
                        'p-1',
                        'opacity-50' => !$day['current'], // Dias fora do mês atual ficam "apagados"
                        'font-bold bg-primary text-primary-content rounded-md cursor-pointer hover:brightness-90' => $day['isToday'], // Hoje em destaque
                    ])>
                        {{ $day['date']->format('d') }}
                    </li>
                @endforeach
            </ul>
            @endif
        </div>
    </template>


</div>
