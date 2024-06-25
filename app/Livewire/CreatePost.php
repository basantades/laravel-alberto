<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Importamos el trait para manejar subidas de archivos
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Importamos Storage para manejar el almacenamiento de archivos

class CreatePost extends Component
{
    use WithFileUploads; // Usamos el trait para las subidas de archivos

    public $form = [
        'title' => '',
        'content' => '',
        'category' => '',
    ];

    public $image; // Propiedad pública para la imagen

    protected $rules = [
        'form.title' => 'required|string|max:255',
        'form.content' => 'required|string',
        'form.category' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048' // Validación para la imagen
    ];

    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->image) {
            // Guardamos la imagen en el almacenamiento público
            $imageName = $this->image->store('images', 'public');
            $imagePath = $imageName;
        }

        // Crear el nuevo post con la imagen y el user_id del usuario autenticado
        Post::create(
            array_merge($this->form, [
                'image' => $imagePath, // Guardamos la ruta de la imagen
                'user_id' => Auth::id(), // Asignamos el user_id del usuario autenticado
            ])
        );

        return $this->redirect('/posts');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
