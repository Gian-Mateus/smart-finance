<div class="ml-4 max-w-3xl mt-10">
    <x-header title="Bancos" subtitle="Organize quantas suas contas" separator />

    <x-button label="Adicionar Conta" class="btn-primary" link="{{ route('banks.addAccount') }}" icon="s-plus-small"/>

    <div class="grid mt-10">
        <x-header title="Suas Contas" separator />
        <div class="card">
            <h2>
                @php
                    $response = Http::get("https://brasilapi.com.br/api/banks/v1");
                    if (! $response->ok()) {
                        $this->command->error("Falha ao buscar bancos: HTTP {$response->status()}");
                        return;
                    }
                    $banksAPI = $response->json();
                    foreach ($banksAPI as $bank) {
                        dd($bank['name']);
                    }
                    //dd($banksAPI[0]);
                    // for($i = 0; $i < 10; $i++){
                    //     dd($banksAPI[$i]);
                    // }
                @endphp
            </h2>
        </div>
    </div>
</div>
