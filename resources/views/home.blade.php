@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container col-md-5">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message')}}
                    </div>
                @endif

                    @include('episode.episodeList')

            </div>

        </div>
    </div>
@endsection
