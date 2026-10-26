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

{{--    <div>--}}
{{--        <label for="price">Price</label>--}}
{{--        <input type="text" id="price" name="price" value="{{ old('price') }}"/>--}}
{{--        @error('price')--}}
{{--            <span class="text-pink-500">{{ $message }}</span>--}}
{{--        @enderror--}}
{{--    </div>--}}


    <button type="submit" name="submit">Save</button>
</form>
