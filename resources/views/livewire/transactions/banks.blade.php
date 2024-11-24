@php
	$extratoBancario = [
	    [
	        'id' => 1,
	        'data' => '2024-11-01',
	        'descricao' => 'Depósito em conta',
	        'valor' => 1500.0,
	        'saldo_atual' => 1500.0,
	    ],
	    [
	        'id' => 2,
	        'data' => '2024-11-03',
	        'descricao' => 'Pagamento de conta - Internet',
	        'valor' => -100.0,
	        'saldo_atual' => 1400.0,
	    ],
	    [
	        'id' => 3,
	        'data' => '2024-11-05',
	        'descricao' => 'Transferência recebsluga',
	        'valor' => 500.0,
	        'saldo_atual' => 1900.0,
	    ],
	    [
	        'id' => 4,
	        'data' => '2024-11-06',
	        'descricao' => 'Compra em supermercado',
	        'valor' => -250.0,
	        'saldo_atual' => 1650.0,
	    ],
	    [
	        'id' => 5,
	        'data' => '2024-11-07',
	        'descricao' => 'Pagamento de conta - Energia elétrica',
	        'valor' => -180.0,
	        'saldo_atual' => 1470.0,
	    ],
	    [
	        'id' => 6,
	        'data' => '2024-11-09',
	        'descricao' => 'Saque em caixa eletrônico',
	        'valor' => -200.0,
	        'saldo_atual' => 1270.0,
	    ],
	    [
	        'id' => 7,
	        'data' => '2024-11-10',
	        'descricao' => 'Crédito salário',
	        'valor' => 2500.0,
	        'saldo_atual' => 3770.0,
	    ],
	    [
	        'id' => 8,
	        'data' => '2024-11-12',
	        'descricao' => 'Compra online - Eletrônicos',
	        'valor' => -800.0,
	        'saldo_atual' => 2970.0,
	    ],
	    [
	        'id' => 9,
	        'data' => '2024-11-13',
	        'descricao' => 'Taxa de manutenção',
	        'valor' => -15.0,
	        'saldo_atual' => 2955.0,
	    ],
	    [
	        'id' => 10,
	        'data' => '2024-11-15',
	        'descricao' => 'Transferência enviada',
	        'valor' => -500.0,
	        'saldo_atual' => 2455.0,
	    ],
	];

	$headers = [
	    [
	        'key' => 'id',
	        'label' => 'Id',
	    ],
	    [
	        'key' => 'data',
	        'label' => 'Data',
	        'format' => ['date', 'd/m/Y'],
	    ],
	    [
	        'key' => 'descricao',
	        'label' => 'Descrição',
	    ],
	    [
	        'key' => 'valor',
	        'label' => 'Valor',
	        'format' => ['currency', '2,.', 'R$ '],
	    ],
	    [
	        'key' => 'saldo_atual',
	        'label' => 'Saldo',
	        'format' => ['currency', '2,.', 'R$ '],
	    ],
	];

@endphp
    <x-mary-tabs wire:model="selectedTab" label-class="text-2xl mt-3" selected="nubank-tab">
		<x-mary-tab name="nubank-tab" label="Nubank">

			<form class="flex gap-6 p-6">
				<x-mary-datetime label="Dê" wire:model="myDate1" value="{{ now()->startOfMonth()->format('Y-m-d') }}" />
				<x-mary-datetime label="Até" wire:model="myDate1" value="{{ now()->endOfMonth()->format('Y-m-d') }}" />

				<div class="flex items-end">
					<x-mary-button type="submit" class="btn-square bg-base-content shadow-lg">
						<x-mary-icon name="o-magnifying-glass" class="text-base-100" />
					</x-mary-button>
				</div>
			</form>

			<div class="rounded-lg bg-base-300 p-4 shadow-lg">
				<x-mary-table :headers="$headers" :rows="$extratoBancario" striped
					class="rounded [&>thead]:uppercase [&>thead]:text-base-content">
				</x-mary-table>
			</div>
		</x-mary-tab>
	</x-mary-tabs>

