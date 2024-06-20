<div>
    <form wire:submit.prevent="save" class="flex flex-col gap-3" enctype="multipart/form-data">
        
        <!-- Campo para el título -->
        <input placeholder="Title" type="text" wire:model.blur="form.title" class="border p-2">
        <div>
            @error('form.title') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>

        <!-- Campo para la categoría -->
        <select wire:model="form.category" class="border p-2">
            <option value="" disabled>Select category</option>
            <option value="cine">Cine</option>
            <option value="viajes">Viajes</option>
            <option value="ocio">Ocio</option>
        </select>
        <div>
            @error('form.category') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>

        <!-- Campo para el contenido -->
        <textarea placeholder="Content" wire:model.blur="form.content" class="border p-2"></textarea>
        <div>
            @error('form.content') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>

        <!-- Campo para la imagen -->
        <h3 class="text-lg font-bold">Imagen de portada</h3>
        <input type="file" wire:model="image" class="border p-2">
        <div>
            @error('image') <span class="error text-red-500">{{ $message }}</span> @enderror 
        </div>

        <!-- Botón de guardar -->
        <button type="submit" class="rounded w-24 ml-auto bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 active:bg-blue-200">
            Save
        </button>

    </form>

    <!-- Mostrar la imagen seleccionada (opcional) -->
    @if ($image)
        <div class="mt-4">
            <p>Preview:</p>
            <img src="{{ $image->temporaryUrl() }}" class="w-48 h-48 object-cover">
        </div>
    @endif
</div>

