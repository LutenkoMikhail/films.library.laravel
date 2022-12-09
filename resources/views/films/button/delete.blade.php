<form method="post" action="{{ route('films.destroy', $film->id) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
</form>
