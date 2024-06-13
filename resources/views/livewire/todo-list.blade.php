<div>
    <input type="text" wire:model="todo" placeholder="Todo..."> 
 
    <button wire:click="add" class="ml-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 active:bg-blue-200">Add Todo</button>
 
    <ul>
        @foreach ($todos as $todo)
            <li class="text-xl mt-4">- {{ $todo }} </li>
        @endforeach
    </ul>
</div>
