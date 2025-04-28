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
    
    public function render()
    {
        $results = [];
        
        if(strlen($this->search) >= 1){
            $results = Icons::where('name', 'like', '%'.$this->search.'%');
        }
        
        return view('livewire.utils.search-icons', [
            'results' => $results,
            'icons' => Icons::query()->latest()->paginate($this->perPage)
        ]);
    }
}
