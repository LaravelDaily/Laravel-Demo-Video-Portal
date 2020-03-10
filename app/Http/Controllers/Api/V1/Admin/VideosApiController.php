<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\Admin\VideoResource;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource(Video::with(['channel'])->get());

    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->all());

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource($video->load(['channel']));

    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
