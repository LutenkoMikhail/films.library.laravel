<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <h3>
                <p>{{$genre->name}}</p>
            </h3>
            <h6>
                Films:
                @if ($genre->films->count()===0)
                    No
                @else
                    {{$genre->films->count()}}
                    <br>
                @endif
            </h6>
            <div class="btn-group-vertical">
                <div class="btn-group">
                    @include('genres.button.show')
                    @include('genres.button.edit')
                    @if ($genre->isDestroy())
                        @include('genres.button.delete')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
