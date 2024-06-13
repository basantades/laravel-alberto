<?php
 
namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
 
class PostForm extends Form
{
    #[Validate('required|min:5')]
    public $title = '';
 
    #[Validate('required|min:5')]
    public $content = '';

    #[Validate('min:3|nullable')]
    public $category = '';
}