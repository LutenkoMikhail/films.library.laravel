@extends('master')
@section('title','View Genre')
@section('content')

    <div class="text-center">
        <h1>
            Show Genre.
        </h1>
        <br>
        <h3>
            <p>{{$genre->name}}</p>
        </h3>
    </div>

    <div class="starter-template">
        @if(!$films->isEmpty())
            <div class="row">
                @foreach($films as $film)
                    @include('films.card',$film)
                @endforeach
            </div>
            {{$films->links()}}
    </div>
    @else
        <h1>No movies in the database</h1>
    @endif

@endsection
