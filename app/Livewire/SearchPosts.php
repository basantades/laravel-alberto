<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class SearchPosts extends Component
{
    public $searchTerm;
    public $posts;
    public $searchTermCategory;
    public $categories;
    public $selectedCategory;
    public $users;
    public $selectedUserId;

    public function mount()
    {
        // Cargar posts iniciales ordenados por la fecha de creación más reciente
        $this->posts = Post::latest()->get();
        
        // Obtener las categorías únicas de los posts
        $this->categories = Post::pluck('category')->unique();
        
        // Obtener todos los usuarios
        $this->users = User::all();
    }

    public function search()
    {
        $query = Post::query();

        // Aplicar filtro de búsqueda
        if ($this->searchTerm) {
            $query->where(function ($subquery) {
                $subquery->where('title', 'LIKE', "%{$this->searchTerm}%")
                         ->orWhere('content', 'LIKE', "%{$this->searchTerm}%")
                         ->orWhere('category', 'LIKE', "%{$this->searchTerm}%");
            });
        }

        // Aplicar filtro de categoría seleccionada
        if ($this->selectedCategory) {
            $query->where('category', $this->selectedCategory);
        }

        // Aplicar filtro de usuario seleccionado
        if ($this->selectedUserId) {
            $query->where('user_id', $this->selectedUserId);
        }

        // Ordenar los resultados por fecha de creación más reciente
        $this->posts = $query->orderBy('created_at', 'desc')->get();
    }

    public function clearSearch()
    {
        // Limpiar los términos de búsqueda y filtros
        $this->searchTerm = null;
        $this->selectedCategory = null;
        $this->selectedUserId = null;

        // Recargar los posts iniciales ordenados por la fecha de creación más reciente
        $this->posts = Post::latest()->get();
    }

    public function render()
    {
        return view('livewire.search-posts');
    }
}
