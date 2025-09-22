<div>
    <x-header title="Importações" subtitle="Aqui você pode importar extratos e dados dos seus cartões de crédito." separator/>

    <div class="flex flex-col gap-4 mt-4">
        <div class="w-full">
            <x-button label="Importar OFX" icon="o-arrow-down-tray" wire:click="openModal('ofx')"/>
            {{-- <x-button label="Importar CSV" icon="o-table-cells" wire:click="openModal('csv')"/> --}}
        </div>
        <div class="shadow-md border-2 p-4 rounded-lg max-w-xl">
            <h3 class="text-lg font-semibold">Últimas importações</h3>

            <x-menu-separator/>

            <x-table :rows="$this->lastImports" :headers="$headers" striped/>
        </div>

    </div>
    <livewire:pages.imports.partials.modal />
</div>
