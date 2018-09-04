<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JmesPath\Env;
use League\Flysystem\Config;
use Symfony\Component\HttpFoundation\Response;

use App\Episode;

class EpisodeController extends Controller
{
    public function createEpisode(){
        return view('episode.createEpisode');
    }

    public function store(Request $request){
        //Validation form
        $validateData = $this->validate($request,[
            'title' => 'required|min:5',
            'description' => 'required',
        ]);

        $episode = new Episode();
        $user = \Auth::user();
        $episode->user_id = $user->id;
        $episode->title = $request->input('title');
        $episode->description = $request->input('description');
        $episode->ep_number = $request->input('ep-number');

        $episode_file = $request->file('episode');

        if($episode_file){
            $episode->url = $this->storeFile($episode_file);
        }

        $episode->save();

        return redirect()->route('home')->with(array(
            'message' => 'The episode was uploaded correctly'
        ));
    }

    public function getEpisodeDetail($episode_id){
        $episode = Episode::find($episode_id);
        return view('episode.detailEpisode', array(
            'episode' => $episode
        ));
    }

    public function edit($id){

        $user = \Auth::user();
        $episode = Episode::findOrFail($id);

        if($user && $episode->user_id == $user->id){

            return view('episode.editEpisode', array(
                'episode'=>$episode
            ));
        }else{
            return redirect()->route('home');
        }
    }

    public function update($episode_id, Request $request){
        $user = \Auth::user();
        $episode = Episode::findOrFail($episode_id);
        $episode->user_id = $user->id;
        $episode->title = $request->input('title');
        $episode->description = $request->input('description');
        $episode->podcast_number = $request->input('ep-number');

        // Upload the podcast
        $episode_file = $request->file('episode');
        if($episode_file){
            // Delete podcast
            if($episode->url) {
                Storage::disk('do_spaces')->delete($episode->url);
            }

            $episode->url = $this->storeFile($episode_file);
        }

        $episode->update();

        return redirect()->route('home')->with(array(
            'message' => 'The episode was updated correctly'
        ));
    }

    public function delete($podcast_id){
        $user = \Auth::user();

        $episode = Episode::find($podcast_id);

        if($user && ($episode->user_id == $user->id)){
            //Delete Files from DigitalOcean

            Storage::disk('do_spaces')->delete($episode->url);

            //Delete video from DB
            $episode->delete();
            $message = array('message','Episode deleted correctly');
        }else{
            $message = array('message','Episode couldn\'t be deleted');
        }

        return redirect()->route('home')->with($message);
    }

    public function storeFile($episode_file){
        $url_generated = '';

        $extension = $episode_file->extension();
        $mimeType = $episode_file->getMimeType();
        $path = Storage::disk('do_spaces')->putFileAs('uploads', $episode_file, time().$episode_file->getClientOriginalName(), 'public');

        $DIGITALOCEAN_DOMAIN = '.nyc3.digitaloceanspaces.com/';
        $HTTPS = 'https://';

        $url_generated = $HTTPS.$_ENV['DO_SPACES_BUCKET'].$DIGITALOCEAN_DOMAIN.$path;

        return $url_generated;
    }
}
