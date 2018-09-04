@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <div class="row card">
            <div class="card-body">
                <div class="text-center">
                    <h1>{{$episode->title}}</h1>
                    <p>Uploaded by <strong>{{$episode->user->name.' '.$episode->user->surname}}</strong> and created {{\FormatTime::LongTimeFilter($episode->created_at)}}</p>
                </div>
                <hr>
                <div class="col-md-12">
                    <br>
                    <div class="panel panel-default podcast-data">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h2 class="text-center">Episode Metadata</h2>
                            </div>
                        </div>
                        <div class="panel-body">
                            <episodecast data -->
                            @if($episode->url)
                                <div class=""><h3 class="text-left">Url:</h3><a href="{{$episode->url}}" download>{{$episode->url}}</a></div><br><br>
                            @else
                                <div class=""><h1 class="text-left">There is not episode</h1></div><br><br>
                            @endif
                            <div class="">
                                <h3>Description:</h3>
                                <p>{{$episode->description}}</p>
                            </div><br>
                            <div class="">
                                <h3>Episode number:</h3>
                                <p>{{$episode->ep_number}}</p>
                            </div><br>
                            <div>
                                <h3>Created at:</h3>
                                <p>{{$episode->created_at}}</p>
                            </div><br>
                        </div>
                    </div>
                </div>

                <div class="button-actions-area">
                    <a href="{{route('home')}}" class="btn btn-sm btn-warning">Return to List</a>

                    @if(Auth::check() && Auth::user()->id == $episode->user->id)
                        <a href="{{route('episodeEdit',['episode'=>$episode->id])}}" class="btn btn-sm btn-primary float-right">Edit</a>

                        <!-- Button HTML (launch modal on Bootstrap) -->
                        <a href="#deleteModal{{$episode->id}}" role="button" class="btn btn-sm btn-danger float-right mx-1" data-toggle="modal">Delete</a>

                        <!-- Modal / Window / Overlay on HTML -->
                        <div id="deleteModal{{$episode->id}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delele this episode?</p>
                                        <p class="text-danger"><small>{{$episode->title}}</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="{{url('/delete-episode/'.$episode->id)}}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-10 col-md-offset-1">


    </div>

@endsection