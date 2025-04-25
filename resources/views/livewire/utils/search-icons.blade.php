<div>
    <x-dropdown>
        <x-slot:trigger>
            <x-button icon="o-photo" class="btn" />
        </x-slot:trigger>
     
        <x-menu-item>
            <x-input placeholder="Pesquisar" icon="o-magnifying-glass" />
        </x-menu-item>
        @foreach ($icons as $icon)
        <x-menu-item class="block">
            <x-icon name="{{ $icon }}" />
        </x-menu-item>
        @endforeach
    </x-dropdown>
</div>
