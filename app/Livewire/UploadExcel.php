<?php

namespace App\Livewire;

use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class UploadExcel extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.upload-excel');
    }

    public function importNews()
    {
        // Validar el archivo usando la validación de Livewire
        $this->validate([
            'file' => 'required|mimes:xlsx|max:2048', // Ajusta el tamaño máximo si es necesario
        ]);

        // Verificar si el archivo se ha subido
        if ($this->file) {
            // Mueve el archivo a una ubicación permanente en el almacenamiento local
            $path = $this->file->store('uploads');

            // Obtén la ruta completa del archivo
            $filePath = storage_path('app/' . $path);

            // Importa el archivo usando FastExcel
            (new FastExcel)->import($filePath, function ($line) {
                Post::create([
                    'title' => $line['title'],
                    'category' => $line['category'] ?? null,
                    'content' => $line['content'],
                ]);
            });

            // Elimina el archivo temporal si es necesario
            Storage::delete($path);

            // Establecer un mensaje de éxito
            session()->flash('success', 'Archivo importado correctamente.');
        } else {
            session()->flash('error', 'No se encontró el archivo.');
        }

        // Redireccionar o retornar una respuesta (puede ser un evento Livewire)
        return redirect()->back();
    }



}
