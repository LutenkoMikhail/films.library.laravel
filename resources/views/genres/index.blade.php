@extends('master')
@section('title','All genres')
@section('content')
    <div class="starter-template">
        @if(!$genres->isEmpty())
            <h1>All genres entries [{{$allGenres}}]</h1>
            <div class="row">
                @foreach($genres as $genre)
                    @include('genres.card',$genre)
                @endforeach
            </div>
            {{$genres->links()}}
    </div>
    @else
        <h1>No genres in the database</h1>
    @endif
@endsection
