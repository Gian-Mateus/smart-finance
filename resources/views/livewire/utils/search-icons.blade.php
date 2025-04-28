<div x-data="{
    init() {
        this.observe();
    },
    observe() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.dispatch('load-more');
                }
            });
        });
        observer.observe(document.getElementById('loadMore'));
    }
}">
    <x-dropdown>
        <x-slot:trigger>
            <x-button icon="o-photo" class="btn" />
        </x-slot:trigger>
     
        <x-menu-item>
            <x-input placeholder="Pesquisar" icon="o-magnifying-glass" wire:model.live='search' />
        </x-menu-item>
        <div class="grid grid-cols-4 overflow-y-scroll max-h-52" wire:ignore>
            @foreach ($icons as $icon)
            <x-menu-item wire:key="{{ $icon }}">
                <x-icon name="{{ $icon }}" />
            </x-menu-item>
            @endforeach
            <div id="loadMore"></div>
        </div>
    </x-dropdown>
</div>
