<div 
    x-data="{ open: false }"
    @click.outside="open = false"
    class="dropdown dropdown-end"
>
    @php
        $range = true;
    @endphp
    @if ($range)
    {{-- inputs --}}
    <div class="flex gap-4" @click.prevent="open = !open">
        <x-input label="Dê:" wire:model="from" icon="o-calendar"/>
        <x-input label="Até:" wire:model="to" icon="o-calendar"/>
    </div>
    @endif
    {{-- grid dates --}}

    {{-- {{ dd($this->period) }} --}}
    <template x-if="open">
        <ul
            class="bg-base-100"
            @click="open = false"
            x-transition
        >
            @if ($range)    
            <li>
                <div class="flex items-center justify-between p-4">
                    <x-button icon="o-arrow-left" class="btn-circle btn-ghost" />
                    <div>
                        {{ $months[$this->month - 1]['name'] }}
                    </div>
                    <x-button icon="o-arrow-right" class="btn-circle btn-ghost" />
                </div>
                @foreach ($this->period as $p)
                    <div>
                        {{ $p->format('d') }}
                    </div>
                @endforeach
            </li>
            @endif
        </ul>
    </template>


</div>
