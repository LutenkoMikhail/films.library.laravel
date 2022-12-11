@extends('master')
@section('title','Edit Genre')
@section('content')
    <div class="thumbnail">
        <div class="caption">
            <h3 class="text-center"> {{ __ ('Edit  Genre') }} </h3>
        </div>
        <form action="{{route ('genres.update', $genre)}}" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ $genre->name }}" minlength="5" maxlength="30"
                           placeholder="name" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                @include('genres.button.save')
                @include('genres.button.back')
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
