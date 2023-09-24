<?php

namespace App\Http\Requests;

use App\Models\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('submissions')->where(function ($query) {
                    return $query->where('collection_id', $this->input('collection_id'));
                }),
            ],
            'why' => 'required|max:100',
            'throtl_username' => 'required|max:255',
            'active_vip' => 'required|boolean',
            'vehicle_make' => 'required|max:255',
            'vehicle_model' => 'required|max:255',
            'vehicle_year' => 'required|integer',
            'car_info' => 'required',
            'dream_build' => 'required',
            'ig_post' => 'required',
            'fav_episode' => 'required',
            'social_media' => 'required',
            'terms_of_service' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $default = 'Please provide a response';

        return [
            'name.required' => 'A name is required',
            'email.required' => 'An email is required',
            'email.unique' => 'Whoa! Looks like you already submitted.',
            'why.required' => $default,
            'throtl_username.required' => 'A throtl username or email is required',
            'active_vip.required' => 'This is a required field',
            'vehicle_make.required' => 'Please select a vehicle make',
            'vehicle_model.required' => 'Please select a vehicle model',
            'vehicle_year.required' => 'Please select a vehicle year',
            'car_info.required' => $default,
            'dream_build.required' => $default,
            'ig_post.required' => $default,
            'fav_episode.required' => 'Please select a favorite episode',
            'social_media.required' => 'Please provide social media handles',
            'terms_of_service.required' => 'Terms of service must be accepted',
            'collection_id.unique' => 'A collection_id is required',
        ];
    }

    public function collection(): Collection
    {
        return Collection::findOrFail($this->input('collection_id'));
    }
}
