@extends('layouts.app')
@section('content')
    <div class="container col-md-4">
        <div class="row card">
            <div class="card-body">
                <h2>Update a new Episode</h2>
                <hr>
                <form action="{{route('updateEpisode',['episode_id' => $episode->id])}}" method="post" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{$episode->title}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{$episode->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Episode Number</label>
                        <input type="number" name="ep-number" id="ep-number" class="form-control" value="{{$episode->podcast_number}}">
                    </div>
                    <div class="form-group">
                        <label for="video">Episode File</label>
                        <input type="file" name="episode" id="episode" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            Update Episode
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection