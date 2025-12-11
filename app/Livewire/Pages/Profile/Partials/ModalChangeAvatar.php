<?php

namespace App\Livewire\Pages\Profile\Partials;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class ModalChangeAvatar extends Component
{
    use Toast;
    use WithFileUploads;

    public $openModal = false;
    public $avatar = [];

    #[On("openModal")]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function saveProcessedAvatar()
    {
        Log::info("saveProcessedAvatar chamado");

        try {
            // Validar se há arquivo
            if (empty($this->avatar)) {
                $this->error("Nenhuma imagem selecionada.");
                return;
            }

            $user = auth()->user();
            Log::info("Usuário ID: " . $user->id);

            // Deletar avatar antigo se existir
            if (
                $user->avatar &&
                Storage::disk("public")->exists($user->avatar)
            ) {
                Storage::disk("public")->delete($user->avatar);
                Log::info("Avatar antigo deletado: " . $user->avatar);
            }

            // Gerar nome único para o arquivo
            $filename = "avatar_" . $user->id . "_" . time() . ".jpg";

            // Salvar o arquivo na pasta avatars
            $path = $this->avatar[0]->storeAs("avatars", $filename, "public");

            Log::info("Avatar salvo em: " . $path);

            // Atualizar registro do usuário
            $user->avatar = $path;
            $saved = $user->save();

            Log::info("Save retornou: " . ($saved ? "true" : "false"));
            Log::info("Avatar no banco: " . $user->fresh()->avatar);

            // Limpar upload temporário
            $this->avatar = [];

            // Fechar modal
            $this->openModal = false;

            // Emitir evento para atualizar a UI
            $this->success("Avatar atualizado com sucesso!");
        } catch (\Exception $e) {
            $this->error("Erro ao salvar avatar. Tente novamente.");
            Log::error("Erro ao salvar avatar: " . $e->getMessage());
        }
    }

    public function render()
    {
        return view("livewire.pages.profile.partials.modal-change-avatar");
    }
}
