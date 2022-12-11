@extends('master')
@section('title','Create Film')
@section('content')

    <div class="caption">
        <h3 class="text-center"> {{ __ ('Create Film') }} </h3>
    </div>
    <form action="{{route ('films.store')}}" method="post"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group row">

            <label for="poster" class="col-md-4 col-form-label text-md-right">{{ __('Poster') }}</label>
            <div class="col-md-6">
                <input id="poster" type="file" class="form-control @error('poster') is-invalid @enderror"
                       name="poster" value="{{ old('poster') }}" accept="image/jpeg,image/png">
                @error('poster')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="" minlength="5" maxlength="50"
                       placeholder="name" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="selectgenres" class="col-md-4 col-form-label text-md-right">{{ __('Genres') }}</label>
            <select id="selectgenres" name="genres[ ]" multiple="multiple" size="10" required>
                @foreach($genres as $genre)
                    <option value={{$genre->id}} >{{$genre->name}}</option>
                @endforeach
            </select>
            </p>
            @error('selectgenres')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="text-center">
            @include('films.button.create')
            @include('films.button.back')
        </div>
    </form>
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

@endsection
