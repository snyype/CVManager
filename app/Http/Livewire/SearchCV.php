<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cv;

class SearchCV extends Component
{
    public $query;
    public $cv;

    public function mount()
    {
       $this->reset();

    }

    public function resetData()
    {
        $this->query = '';
        $this->cv = [];

    }
   



    public function updatedQuery()
    {
        
        $this->cv = Cv::where('name',"=",$this->query)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.search-c-v');
    }
}
