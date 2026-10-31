<h1>Create new Game</h1>
{{--@dump($errors)--}}
<form action="{{ route('games.store') }}" method="post">
    @csrf

    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}"/>
        @error('title')
            <span class="text-pink-500">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="{{ old('description') }}"/>
        @error('description')
            <span class="text-pink-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="category" class="block font-semibold mb-2">
            Category
        </label>

        <select
            id="category"
            name="category"
            required
            class="w-full rounded border-gray-300"
        >
            <option value="">Choose a category</option>

            @foreach (['Action', 'Adventure', 'Puzzle', 'Racing', 'Simulation', 'Roleplay'] as $category)
                <option
                    value="{{ $category }}"
                    @selected(old('category') === $category)
                >
                    {{ $category }}
                </option>
            @endforeach
        </select>

        @error('category')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <button type="submit" name="submit">Save</button>
</form>
