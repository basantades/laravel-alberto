<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Post;
 
class CreatePost extends Component
{
public PostForm $form;
 
    public function save()
    {
        $this->validate(); 
        Post::create(
            $this->form->all() 
        );
  
        return $this->redirect('/posts');
    }
    public function destroy()
    {

    }
 
    public function render()
    {
        return view('livewire.create-post');
    }
}
