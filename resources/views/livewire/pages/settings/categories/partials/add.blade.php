<x-form
	class="relative p-4"
	x-data="{ show: false }"
	wire:submit="save"
>
	<div
		class="flex transition-all duration-300 ease-in-out"
		x-show="!show"
		x-transition
	>
		<x-button
			class="w-full bg-primary"
			label="{{ $labelButton }}"
			icon="m-plus-small"
			x-on:click="show = true"
		/>
	</div>

	<div
		class="flex gap-3 transition-all duration-300 ease-in-out"
		x-show="show"
		x-transition
	>
		{{-- Search and select Icons --}}
		@if ($type == 'category')
			<livewire:utils.search-icons/>
		@endif
		<div class="flex-1">
			<x-input
				type="text"
				placeholder="{{ $placeholderInput }}"
				wire:model="name"
                required
			/>
		</div>
		<div>
			<x-button
				class="btn-primary"
				type="submit"
				icon="c-check"
				responsive
			/>
			<x-button
				class="btn-secondary"
				icon="c-x-mark"
				x-on:click="show = false"
				responsive
			/>
		</div>
	</div>
</x-form>