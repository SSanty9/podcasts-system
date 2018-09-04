<div id="podcasts-list">
    @if(count($episodes) >= 1 )
        @foreach ($episodes as $episode)
                <div class="podcast-item col-md-12 pull-left panel panel-default card text-center mb-3">
                <div class="panel-body card-body">
                    <div class="data">
                        <h3 class="episode-title"><a href="{{route('detailEpisode',['episode-id'=>$episode->id])}}">{{$episode->title}}</a></h3>
                        <p>Uploaded by <strong>{{$episode->user->name.' '.$episode->user->surname}}</strong> | {{\FormatTime::LongTimeFilter($episode->created_at)}}</p>

                    </div>
                    <!-- BUTTONS VIDEO-->
                    <a href="{{route('detailEpisode',['episode'=>$episode->id])}}" class="btn btn-sm btn-success">Watch</a>
                    @if(Auth::check() && Auth::user()->id == $episode->user->id)
                        <a href="{{route('episodeEdit',['episode-id'=>$episode->id])}}" class="btn btn-sm btn-primary">Edit</a>

                        <!-- Button HTML (launch modal on Bootstrap) -->
                        <a href="#deleteModal{{$episode->id}}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>

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
        @endforeach
    @else
        <div class="alert alert-warning"><p class="text-center">There are not episodes with this criteria</p></div>
    @endif
</div>
<div class="clearfix"></div>
{{$episodes->links()}}