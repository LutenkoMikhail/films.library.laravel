@extends('master')
@section('title','Edit  Film')
@section('content')

    <div class="thumbnail">
        <div class="caption">
            <h3 class="text-center"> {{ __ ('Edit  Film') }} </h3>
        </div>
        <form action="{{route ('films.update', $film)}}" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                @if( Storage::has ($film->poster))
                    <img src="{{ Storage::url($film->poster) }}" height="60" width="60"
                         class="card-img-top"
                         style="max-width: 45%; margin: 0 auto; display: block;">
                @endif
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
                           name="name" value="{{ $film->name }}" minlength="5" maxlength="50"
                           placeholder="name" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="in_stock" class="col-md-4 col-form-label text-md-right">{{ __('Published') }}</label>
                <div class="col-md-6">
                    <p>
                        <input id="published" type="checkbox"
                               class="form-control @error('published') is-invalid @enderror"
                               name="published"
                              @if($film->published) checked @endif value="1"
                        >
                    </p>
                    @error('published')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">
                <label for="selectgenres" class="col-md-4 col-form-label text-md-right">{{ __('Genres') }}</label>
                <select id="selectgenres" name="genres[ ]" multiple="multiple" size="10">
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
                @include('films.button.save')
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
    </div>

@endsection
