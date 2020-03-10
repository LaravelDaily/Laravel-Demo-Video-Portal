@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.channel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.channels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.channel.fields.id') }}
                        </th>
                        <td>
                            {{ $channel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.channel.fields.name') }}
                        </th>
                        <td>
                            {{ $channel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.channel.fields.published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $channel->published ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.channels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection