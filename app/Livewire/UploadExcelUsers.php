<?php

namespace App\Livewire;

use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class UploadExcelUsers extends Component
{
    use WithFileUploads;

    public $file;
    public function render()
    {
        return view('livewire.upload-excel-users');
    }
    public function importUsers()
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
                User::create([
                    'name' => $line['name'],
                    'email' => $line['email'],
                    'profile_photo_url' => $line['profile_photo_url'] ?? null,
                    'password' => $line['password'],

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
