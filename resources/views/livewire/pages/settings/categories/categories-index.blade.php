<div
	class="ml-4 max-w-3xl"
	x-data="{ selectDelete: false }"
>
	<x-header
		title="Categorias e Subcategorias"
		separator
	/>

	<div class="flex items-center gap-2">
		<livewire:pages.settings.categories.partials.search />
		<x-dropdown icon="o-cog-6-tooth">
			<x-button
				label="Excluir"
				icon="o-trash"
				@click="selectDelete = ! selectDelete"
			/>
		</x-dropdown>
	</div>

	<livewire:pages.settings.categories.partials.add
		type="category"
		labelButton="Nova categoria"
		placeholderInput="Nome da categoria"
		wire:key="add-category"
	/>

	@foreach ($categories as $cat)
		<x-collapse
			class="group m-0.5 bg-base-100"
			wire:key="category-{{ $cat->id }}"
			separator
		>
			<x-slot:heading
				class="flex items-center justify-between"
			>
				<div>
					{{ $cat->name }}
				</div>
				<div
					class="absolute right-12 flex items-center gap-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
				>
					<x-button
						class="btn-sm"
						x-show="!selectDelete"
						icon="c-pencil"
						responsive
					/>
				</div>
				<x-checkbox
					class="z-20"
					x-show="selectDelete"
					right
				/>
			</x-slot:heading>
			<x-slot:content>
				<ul>
					<li>
						<livewire:pages.settings.categories.partials.add
							type="subcategory"
							labelButton="Nova subcategoria"
							placeholderInput="Nome da subcategoria"
							:category_id="$cat->id"
							wire:key="add-subcategory-{{ $cat->id }}"
						/>
					</li>

					@foreach ($cat->subcategories as $sub)
						<li
							class="group/subcat relative flex items-center justify-between rounded p-2 hover:bg-base-300"
							wire:key="subcategory-{{ $sub->id }}"
						>
							<div>
								{{ $sub->name }}
							</div>
							<div
								class="absolute right-12 flex items-center opacity-0 transition-opacity duration-300 group-hover/subcat:opacity-100"
							>
								<x-button
									class="btn-sm"
									icon="c-pencil"
									responsive
								/>
							</div>
							<x-checkbox
								class="z-20"	
								x-show="selectDelete"
								right
							/>
						</li>
					@endforeach
				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach

</div>
