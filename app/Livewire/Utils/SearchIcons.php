<?php

namespace App\Livewire\Utils;

use App\Models\Icons;
use Livewire\Component;

class SearchIcons extends Component
{

    public int $perPage = 50;
    public string $search = '';    

    public function loadMore()
    {
        $this->perPage += 10;        
    }
    
    // Eu preciso verificar na view se o valor de search é diferente de "" ou null
    // Se for, eu mostro a lista de ícones com a div com o Observer para ter o comportamento de carregamento infinito
    // Se não for, eu mostro a lista de pesquisa e tiro a div do Observer

    // Também preciso dizer que o prímeiro ícone do trigger é o 'o-photo'
    // No click de um ícone, eu mudo o valor do iconSelect para o ícone selecionado, também mudando o trigger para o ícone selecionado

    // Ao clicar em salvar, ele deve pegar o valor atual do trigger

    // Por um X do lado do input caso não queira nenhum ícone, o mesmo para fora do dropdown
    public function render()
    {
        $results = [];
        
        if(strlen($this->search) >= 1){
            $results = Icons::where('name', 'like', '%'.$this->search.'%')->get();
        }
        
        return view('livewire.utils.search-icons', [
            'results' => $results,
            'icons' => Icons::query()->latest()->paginate($this->perPage)
        ]);
    }
}
