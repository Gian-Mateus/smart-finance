<div>
    <x-header title="Importações" subtitle="Aqui você pode importar extratos e dados dos seus cartões de crédito." separator/>

    <div class="grid grid-cols-4 gap-4 mt-4">
        <div class="col-span-1">
            <h3 class="text-lg font-semibold">Últimas importações</h3>
            <x-menu-separator/>
        </div>

        <div class="col-span-1">
            <x-button label="Importar OFX" icon="o-arrow-down-tray" wire:click="openModal('ofx')"/>
            <x-button label="Importar CSV" icon="o-table-cells" wire:click="openModal('csv')"/>
        </div>
    </div>
    <livewire:pages.imports.partials.modal />
</div>
