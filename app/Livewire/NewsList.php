<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;


class NewsList extends Component
{
    public $posts;
    public $allposts;
    public $lastposts;


    public function mount()
    {
        $this->posts = Post::all();
        $this->allposts = Post::latest()->get();
        $this->lastposts = Post::orderBy('created_at', 'desc')->take(3)->get();


    }

    public function render()
    {
        return view('livewire.news-list');
    }
}
