<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChannelRequest;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChannelsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('channel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channels = Channel::all();

        return view('admin.channels.index', compact('channels'));
    }

    public function create()
    {
        abort_if(Gate::denies('channel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.channels.create');
    }

    public function store(StoreChannelRequest $request)
    {
        $channel = Channel::create($request->all());

        return redirect()->route('admin.channels.index');

    }

    public function edit(Channel $channel)
    {
        abort_if(Gate::denies('channel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.channels.edit', compact('channel'));
    }

    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        $channel->update($request->all());

        return redirect()->route('admin.channels.index');

    }

    public function show(Channel $channel)
    {
        abort_if(Gate::denies('channel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.channels.show', compact('channel'));
    }

    public function destroy(Channel $channel)
    {
        abort_if(Gate::denies('channel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $channel->delete();

        return back();

    }

    public function massDestroy(MassDestroyChannelRequest $request)
    {
        Channel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
