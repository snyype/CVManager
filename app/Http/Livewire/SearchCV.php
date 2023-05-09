<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cv;

class SearchCV extends Component
{
    public $query;
    public $cv;
    
    protected $queryString = ['query'];

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
   

        if (!empty($this->query)) {
            $this->cv = Cv::where('name', 'LIKE', $this->query[0].'%')->orWhere('tech', 'LIKE', '%'.$this->query.'%')->get();
        } else {
            $this->cv = [];
        }
    }

    public function render()
    {
        return view('livewire.search-c-v');
    }
}
