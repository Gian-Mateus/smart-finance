<?php

namespace App\Livewire\Utils;

use App\Models\Icon;
use Livewire\Attributes\On;
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

    public function defineIcon($iconSelect)
    {
        $this->iconSelect = $iconSelect;
        $this->dispatch('iconSelected', $this->iconSelect);
    }

    #[On('resetIcon')]
    public function resetIcon()
    {
        $this->iconSelect = null;
        $this->dispatch('iconSelected', $this->iconSelect);
    }

    public function render()
    {
        $results = [];
        if (strlen($this->search) >= 1) {
            $results = Icon::where('name', 'like', '%'.$this->search.'%')->get();
        }

        return view('livewire.utils.search-icons', [
            'results' => $results,
            'icons' => Icon::query()->latest()->paginate($this->perPage),
        ]);
    }
}
