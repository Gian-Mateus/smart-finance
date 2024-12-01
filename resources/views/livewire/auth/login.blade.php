<div class="flex min-h-screen flex-col items-center justify-center">
    <x-header title="Smart Finance" subtitle="Suas finanças em ordem, na palma da sua mão." />

    <x-form wire:submit="login" class="w-80">
        <x-input label="Login" wire:model="email" placeholder="Digite seu e-mail"/>
        <x-password label="Senha" wire:model="password" right/>
        <x-button class="btn btn-primary" type="submit">Entrar</x-button>
    </x-form>

    <p class="mt-4 text-center">
        Não tem uma conta?
        <a href="{{ route('register') }}" class="text-primary hover:underline">
            Registre-se
        </a>
    </p>
</div>
