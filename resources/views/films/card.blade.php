<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <h3>
                <p>{{$film->name}}</p>
            </h3>
            <hr>
            @if( Storage::has ($film->poster))
                <img src="{{ Storage::url($film->poster) }}" height="60" width="60"
                     class="card-img-top"
                     style="max-width: 45%; margin: 0 auto; display: block;">
            @endif
            <h6>
                <hr>
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
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    Published : {{$film->filmPublication()}}
                    <br>
                    <hr>
                    Date : {{$film->dateFilm()}}
                @endif
            </h6>
            <hr>
            <div class="btn-group-vertical">
                <div class="btn-group">
                    @include('films.button.show')
                    @include('films.button.edit')
                    @include('films.button.delete')
                    @if($film->filmPublication()==='false')
                        @include('films.button.publication')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
