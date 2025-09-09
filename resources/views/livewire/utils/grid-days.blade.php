<div x-data="{ open: false }" class="relative">
    <x-input 
        label="{{ $label }}" 
        @click="open = !open" 
        type="number" 
        wire:model="day"
        readonly 
    />
    <ul 
        x-show="open" 
        @click.outside="open = false" 
        class="absolute appearance-none grid grid-cols-7 gap-1 p-4 items-center w-sm h-auto z-100 bg-base-100 border-2 rounded-lg"
    >
        @foreach ($days as $day)    
            <li class="col-span-1 btn" @click="$wire.day = {{ $day['value'] }}; open = false">
                {{ $day['value'] }}
            </li>
        @endforeach
    </ul>
</div>
