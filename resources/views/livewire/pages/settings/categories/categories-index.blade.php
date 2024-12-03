<div>
	<x-header title="Categorias e Subcategorias" separator />
	@foreach ($categories as $cat)
		<x-collapse wire:key="$cat->id" separator class="m-0.5 bg-base-100">
			<x-slot:heading>{{ $cat->name }}</x-slot:heading>
			<x-slot:content>
				<ul>
					<li>
						<x-button icon="m-plus-small" class="flex w-full justify-start rounded-md" />
					</li>
					@foreach ($cat->subcategories as $sub)
						<li class="rounded p-2 hover:bg-base-300">{{ $sub->name }}</li>
					@endforeach
				</ul>
			</x-slot:content>
		</x-collapse>
	@endforeach
</div>
