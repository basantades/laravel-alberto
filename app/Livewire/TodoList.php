<?php

namespace App\Livewire;
 
use Livewire\Component;

use function Pest\version;

class TodoList extends Component
{
    public $todos = [];
 
    public $todo = '';
 
    public function add()
    {
        // // 1 version
        // $this->todos[] = $this->todo;
        // $this->todo = '';

        // // 2 version usando reset
        // $this->todos[] = $this->todo;
        // $this->reset('todo'); 

        // // 3 version usando pull
        $this->todos[] = $this->pull('todo'); 

    }
 
    // ...
}