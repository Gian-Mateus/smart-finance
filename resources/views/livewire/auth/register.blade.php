<div class="flex min-h-screen flex-col items-center justify-center">
	<x-header title="Smart Finance" subtitle="Suas finanças em ordem, na palma da sua mão." />

	<x-form wire:submit.prevent="register" method="POST" class="w-80">
		@csrf
		<x-input label="Nome" wire:model="name" placeholder="Digite seu nome completo" />
		<x-input label="Login" wire:model="email" placeholder="Digite seu e-mail" />
		<x-password label="Senha" wire:model="password" right/>
		<x-input label="Confirme sua senha" type="password" wire:model.live="password_confirmation" right/>
		<x-button class="btn btn-primary" type="submit">Criar conta</x-button>
	</x-form>

	<p class="mt-4 text-center">
		Já tem uma conta?
		<a href="{{ route('login') }}" class="text-primary hover:underline">
			Faça login
		</a>
	</p>
</div>
