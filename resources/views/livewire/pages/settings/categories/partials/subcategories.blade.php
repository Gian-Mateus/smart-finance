<li class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300">
    <div>
        {{ $subcategory->name }}
    </div>
    <div class="flex items-center justify-between pr-6 gap-2 opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100">
        {{-- Button Edit SubCategory --}}
        <x-button
            class="btn-sm"
            icon="c-pencil"
            responsive
        />
        <x-button
            class="btn-sm"
            icon="o-trash"
            responsive
            wire:click="delete"
        />
    </div>
</li>
