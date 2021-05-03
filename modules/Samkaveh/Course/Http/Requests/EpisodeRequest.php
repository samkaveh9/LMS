<?php

namespace Samkaveh\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Samkaveh\Course\Rule\ValidSeason;
use Samkaveh\Media\Services\MediaUploadService;

class EpisodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->isMethod('post')) {
            return [
                'title' => 'required|min:3|max:190',
                'number' => 'nullable|numeric',
                'time' => 'required|numeric|min:0|max:255',
                'is_free' => 'required|boolean',
                'episode_file' => 'required|file|mimes:'. MediaUploadService::getExtensions(),
                'season_id' => 'required',
            ]; 
        }

        if ($this->isMethod('put')) {
            return [
                'title' => 'required|min:3|max:190',
                'number' => 'nullable|numeric',
                'time' => 'required|numeric|min:0|max:255',
                'is_free' => 'required|boolean',
                'episode_file' => 'nullable|file|mimes:'. MediaUploadService::getExtensions(),
                'season_id' => 'required',
            ];
        }
    }
}
