<form method="post" action="{{ route('films.publication', $film->id) }}">
    @csrf
    @method('POST')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Publication</button>
</form>
