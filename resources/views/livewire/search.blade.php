<div>
    <form wire:submit.prevent="storePost" class="mt-4 space-y-4">

        <!-- Title -->
        <input
            type="text"
            class="w-full p-4 border rounded-md bg-gray-700"
            wire:model.defer="name"
            placeholder="Enter title">
        @error('name')
        <p>{{$message}}</p>
        @enderror

        <!-- Description -->
        <textarea
            class="w-full p-4 border rounded-md bg-gray-700"
            wire:model.defer="description"
            placeholder="Enter description"
            rows="4"></textarea>
        @error('description')
        <p>{{$message}}</p>
        @enderror
        <!-- Submit Button -->
        <button
            type="submit"
            class="px-6 py-2 font-medium bg-indigo-600 rounded-md hover:bg-indigo-700">
            Submit
        </button>

    </form>
</div>