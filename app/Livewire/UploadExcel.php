<?php

namespace App\Livewire;

use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\User;
use App\Models\Post;
use App\Models\MessageText;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;



class UploadExcel extends Component
{
    use WithFileUploads;
    public $users;
    public $user;
    public $file;
    public function render()
    {
        return view('livewire.upload-excel');
    }
    // public function mount()
    // {
    //     $this->users = User::all();
    // }
    // public function upload(User $user)
    // {
    //     $this->authorize('view', $user);

    //     // $data = fastexcel()->import("file.xlsx");

    //     $data = (new FastExcel)->import('file.xlsx', function ($line) {
    //         return Post::create([
    //             'title' => $line['title'],
    //             'content' => $line['content']
    //         ]);
    //     });
    // }
    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        // Importar y guardar en la base de datos
        (new FastExcel)->import($this->file, function ($line) {
            Post::create([
                'title' => $line['title'],
                'content' => $line['content'],
            ]);
        });

        session()->flash('success', 'Archivo importado correctamente.');
    }

}
