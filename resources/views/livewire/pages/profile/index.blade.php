<div>
    <x-avatar  class="!w-22">
        <x-slot:title class="text-3xl !font-bold pl-2">
            {{ Auth::user()->name }}
        </x-slot:title>
     
        <x-slot:subtitle class="grid gap-1 mt-2 pl-2 text-xs">
            Meu nome de usuário
        </x-slot:subtitle>
     
    </x-avatar>
</div>
