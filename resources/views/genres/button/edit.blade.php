<form method="get" action="{{ route('genres.edit', $genre->id) }}">
    @csrf
    @method('GET')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Edit</button>
</form>
