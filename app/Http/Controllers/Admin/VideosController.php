<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVideoRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videos = Video::all();

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        abort_if(Gate::denies('video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channels = Channel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.videos.create', compact('channels'));
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->all());

        return redirect()->route('admin.videos.index');

    }

    public function edit(Video $video)
    {
        abort_if(Gate::denies('video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channels = Channel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $video->load('channel');

        return view('admin.videos.edit', compact('channels', 'video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());

        return redirect()->route('admin.videos.index');

    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->load('channel');

        return view('admin.videos.show', compact('video'));
    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return back();

    }

    public function massDestroy(MassDestroyVideoRequest $request)
    {
        Video::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
