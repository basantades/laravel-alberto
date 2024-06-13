<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class SearchPosts extends Component
{
    public $searchTerm;
    public $posts;
    public $searchTermCategory;
    public $categories;
    public $selectedCategory;
    public function render()
    {
        return view('livewire.search-posts');
    }
    
public function mount()
{
    $this->posts = Post::latest()->get();
    $this->categories = Post::pluck('category')->unique();
}
// public function search()
//     {
//         $this->posts = Post::where('title', 'LIKE', "%$this->searchTerm%")
//         ->orWhere('content', 'LIKE', "%$this->searchTerm%")
//         ->orWhere('category', 'LIKE', "%$this->searchTerm%")
//         ->get();    
//         }

public function search()
{
    // dd($this->selectedCategory);
    $query = Post::query();

    if ($this->searchTerm) {
        $query->where(function ($subquery) {
            $subquery->where('title', 'LIKE', "%{$this->searchTerm}%")
                     ->orWhere('content', 'LIKE', "%{$this->searchTerm}%")
                     ->orWhere('category', 'LIKE', "%{$this->searchTerm}%");
        });
    }

    if ($this->selectedCategory) {
        $query->where('category', $this->selectedCategory);
    }

    $this->posts = $query->get();
}

public function clearSearch()
{
    $this->searchTerm = null;
    $this->selectedCategory = null;
    $this->posts = Post::latest()->get();
}
  
}
