@extends('master')
@section('title','View Film')
@section('content')

    <div class="text-center">
        <h1>
            Show Film
        </h1>
    </div>

    <div class="thumbnail">
        <div class="caption">
            <h1>
                Name:{{$film->name}}
            </h1>
            <hr>
            @if( Storage::has ($film->poster))
                <img src="{{ Storage::url($film->poster) }}" height="60" width="60"
                     class="card-img-top"
                     style="max-width: 45%; margin: 0 auto; display: block;">
            @endif
            <hr>
            <h6>
                Genres:
                @if ($film->genres->count()===0)
                    No
                @else
                    {{$film->genres->count()}}
                    <br>
                    <div class="center">
                        <div class="btn-group">
                            @foreach($film->genres as $genre)
                                <a href="{{route('genres.show',$genre->id)}}"
                                   class="btn btn-sm btn btn-success">{{ ($genre->name)}}</a>
                            @endforeach
                        </div>
                    </div>
                    Published : {{$film->published  ? 'true' : 'false'}}
                @endif
            </h6>
            <hr>
        </div>
        <div class="center">
            @include('films.button.back')
            @include('films.button.edit')
            @include('films.button.delete')
        </div>
    </div>

@endsection
