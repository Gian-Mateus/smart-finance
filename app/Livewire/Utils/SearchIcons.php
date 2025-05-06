<?php

namespace App\Livewire\Utils;

use App\Models\Icons;
use Livewire\Component;

class SearchIcons extends Component
{

    public int $perPage = 50;
    public ?string $search = null;
    public ?string $iconSelect = null;

    public function loadMore()
    {
        $this->perPage += 10;        
    }

    #[On('resetIcon')]
    public function resetIconSelect()
    {
        $this->iconSelect = null;
    }
    public function defineIcon($iconSelect)
    {
        $this->iconSelect = $iconSelect;
        $this->dispatch('iconSelected', icon: $this->iconSelect);
    }
    
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
