<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-6">
            Game bewerken
        </h1>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('games.update', $game) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Game title --}}
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-2">
                    Game Title
                </label>

                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title', $game->title) }}"
                    required
                    maxlength="255"
                    class="w-full rounded border-gray-300"
                >
            </div>

            {{-- Game description --}}
            <div class="mb-6">
                <label for="description" class="block font-semibold mb-2">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    required
                    class="w-full rounded border-gray-300"
                >{{ old('description', $game->description) }}</textarea>
            </div>

            {{-- Current image --}}
            @if ($game->image)
                <div class="mb-4">
                    <p class="font-semibold mb-2">Current Image</p>

                    <img
                        src="{{ asset('storage/' . $game->image) }}"
                        alt="{{ $game->title }}"
                        class="w-full max-w-sm rounded-lg mb-3"
                    >
                </div>
            @endif

            {{-- Upload replacement image --}}
            <div class="mb-6">
                <label for="image" class="block font-semibold mb-2">
                    Upload New Image (Optional)
                </label>

                <input
                    id="image"
                    name="image"
                    type="file"
                    accept="image/*"
                    class="w-full rounded border border-gray-300 p-2"
                >

                <p class="mt-2 text-sm text-gray-500">
                    Leave this empty to keep the current image.
                    Accepted formats: JPG, PNG, WEBP. Maximum size: 2 MB.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="rounded-lg bg-purple-700 px-5 py-3 font-semibold text-white hover:bg-purple-800"
                >
                    Save Changes
                </button>

                <a
                    href="{{ route('games.show', $game) }}"
                    class="rounded-lg bg-gray-200 px-5 py-3 font-semibold text-gray-800 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
