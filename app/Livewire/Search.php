<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Search extends Component
{
    public $results = [] ;
    #[Validate('required')]
    public $searchText = '';
    public function render()
    {
        return view('livewire.search');
    }

    public function updatedSearchText($value){
        $this->reset('results');
        $this->validate();
        $searchTerm = "%$value%";
        $this->results = Article::where('title','LIKE',$searchTerm)->get();
    }
}
