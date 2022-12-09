<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <h3>
                <p>{{$film->name}}</p>
            </h3>
            @if( Storage::has ($film->poster))
                <img src="{{ Storage::url($film->poster) }}" height="60" width="60"
                     class="card-img-top"
                     style="max-width: 45%; margin: 0 auto; display: block;">
            @endif
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
                            <a  href="{{route('genres.show',$genre->id)}}"
                               class="btn btn-sm btn btn-success">{{ ($genre->name)}}</a>
                            @endforeach
                        </div>
                    </div>
                    Published : {{$film->published  ? 'true' : 'false'}}
                @endif
            </h6>
            <div class="btn-group-vertical" >
                <div class="btn-group">
                    @include('films.button.show')
                    @include('films.button.edit')
                    @include('films.button.delete')
                </div>
            </div>

        </div>
    </div>
</div>
