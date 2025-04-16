<li
    class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300"
    wire:key="subcategory-{{ $subcategories->id }}"
>
    <div>
        {{ $subcategories->name }}
    </div>
    <div
        class="absolute right-12 flex items-center opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100"
    >
    {{-- Button Edit SubCategory --}}
    <x-button
        class="btn-sm"
        x-show="!selectDelete"
        icon="c-pencil"
        responsive
    />
    </div>
    <x-checkbox
        class="z-20 mr-4"
        x-bind:checked="selectAll || checkCategory"
        x-show="selectDelete"
        right

    />
</li>
