<div>
    <form wire:submit="save" class="flex flex-col gap-3">
    
        <input placeholder="Title" type="text" wire:model.blur="form.title">
        <div>
            @error('form.title') <span class="error">{{ $message }}</span> @enderror 
        </div>
        <select placeholder="Category" type="text" wire:model="form.category">
            <option value="" disabled>Select category</option>
            <option value="cine">Cine</option>
            <option value="viajes">Viajes</option>
            <option value="ocio">Ocio</option>

        </select>
        <div>
            @error('form.category') <span class="error">{{ $message }}</span> @enderror 
        </div>
        <textarea placeholder="Content" type="text" wire:model.blur="form.content"></textarea>
        <div>
            @error('form.content') <span class="error">{{ $message }}</span> @enderror 
        </div>
        <button type="submit" class="rounded w-24 ml-auto bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 active:bg-blue-200">
            Save
        </button>

    </form>
</div>
