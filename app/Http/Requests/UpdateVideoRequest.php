<?php

namespace App\Http\Requests;

use App\Video;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVideoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'channel_id'    => [
                'required',
                'integer'],
            'title'         => [
                'required'],
            'youtube_embed' => [
                'required'],
        ];

    }
}
