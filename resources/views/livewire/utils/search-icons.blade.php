<div>
    <x-dropdown>
        <x-slot:trigger>
            <x-button icon="o-photo" class="btn" />
        </x-slot:trigger>
     
        <x-menu-item>
            <x-input @click.stop="" placeholder="Pesquisar" icon="o-magnifying-glass" wire:model.live="search" />
        </x-menu-item>
        
        @if (empty($results))
            <x-menu-item title="Nenhum item encontrado."/>
        @else
        <div class="grid grid-cols-4 overflow-y-scroll max-h-52">
            @foreach ($icons as $icon)
                <x-menu-item wire:key="{{ $icon->id }}">
                    <x-button icon="{{ $icon->name }}" class="btn-circle btn-outline" wire:model="iconSelect"/>
                </x-menu-item>
            @endforeach
            <div x-data="{
                    more(){
                        const observer = new IntersectionObserver((items) => {
                            items.forEach((item) => {
                                if(item.isIntersecting){
                                    @this.loadMore()
                                }
                            })
                        });
                        observer.observe(this.$el);
                    }
                }" 
                x-init="more()"
            ></div>
        </div>
        @endif
        
    </x-dropdown>
</div>
