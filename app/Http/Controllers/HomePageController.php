<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Channel;

class HomePageController extends Controller
{

    public function index()
    {
        $channels = Channel::all();

        return view('mainTable.index', compact('channels'));
    }

    public function channel(Channel $channel)
    {
        $videos = Video::with('channel')
            ->where('channel_id', $channel->id)
            ->paginate(9);

        return view('mainTable.channel', compact('videos', 'channel'));
    }

    public function video(Video $video)
    {
        $video->load('channel.videos');

        return view('mainTable.video', compact ('video'));
    }

}