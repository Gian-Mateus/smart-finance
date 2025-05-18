<div>
    <x-dropdown>
        <x-slot:trigger>
            <x-button icon="{{ $iconSelect ? $iconSelect : 'o-photo' }}" class="btn"/>
        </x-slot:trigger>
     
        <div class="p-4">
            <x-input @click.stop="" placeholder="Pesquisar" icon="o-magnifying-glass" wire:model.live.debounce.50ms="search"/>

            <x-button label="Sem ícone" class="mt-2 w-full" wire:click="resetIcon"/>
        </div>

        @if(empty($search) && empty($results))
            <div class="grid grid-cols-4 overflow-y-scroll max-h-52 p-2 gap-2">
                @foreach ($icons as $icon)
                  <x-button icon="{{ $icon->name }}" class="btn-circle btn-outline" wire:click="defineIcon('{{ $icon->name }}')"/> 
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

        @elseif(empty($results))
            <span>Nenhum item encontrado.</span>
        @else

        <div class="grid grid-cols-4 overflow-y-scroll max-h-52">
            @foreach ($results as $icon)
                <x-button icon="{{ $icon->name }}" class="btn-circle btn-outline" wire:click="defineIcon('{{ $icon->name }}')"/>
            @endforeach
        </div>

        @endif
    </x-dropdown>
</div>
