<form method="get" action="{{ route('films.create') }}">
    @csrf
    @method('POST')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Create Film</button>
</form>
