<form method="post" action="{{ route('genres.destroy', $genre->id) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
</form>
