<div>
    <form wire:submit.prevent="updatePost" class="space-y-4">

        <!-- Title -->
        <div>
            <input
                type="text"
                class="w-full p-4 border rounded-md"
                wire:model.defer="name"
                placeholder="Enter title"
            >
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <textarea
                class="w-full p-4 border rounded-md"
                wire:model.defer="description"
                placeholder="Enter description"
                rows="4"
            ></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-primary">
            Update
        </button>

    </form>
</div>
