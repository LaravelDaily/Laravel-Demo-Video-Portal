@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.video.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.videos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="channel_id">{{ trans('cruds.video.fields.channel') }}</label>
                <select class="form-control select2 {{ $errors->has('channel') ? 'is-invalid' : '' }}" name="channel_id" id="channel_id" required>
                    @foreach($channels as $id => $channel)
                        <option value="{{ $id }}" {{ old('channel_id') == $id ? 'selected' : '' }}>{{ $channel }}</option>
                    @endforeach
                </select>
                @if($errors->has('channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.channel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.video.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="youtube_embed">{{ trans('cruds.video.fields.youtube_embed') }}</label>
                <textarea class="form-control {{ $errors->has('youtube_embed') ? 'is-invalid' : '' }}" name="youtube_embed" id="youtube_embed" required>{{ old('youtube_embed') }}</textarea>
                @if($errors->has('youtube_embed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_embed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.youtube_embed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.video.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection