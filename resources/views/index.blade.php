@extends('master')
@section('title','All films')
@section('content')
    <div class="starter-template">
        @if(!$films->isEmpty())
            <h1>All films entries  [{{$allFilms}}]</h1>
            <div class="row">
                @foreach($films as $film)
                    @include('card',$film)
                @endforeach
            </div>
            {{$films->links()}}
    </div>
    @else
        <h1>No movies in the database</h1>
    @endif
@endsection
