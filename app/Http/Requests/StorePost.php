<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //we use bail to prefair the first error to stop the rest of the roles for a faileld from  running at the bala rule to the least
            'title' =>'bail|required|min:5|max:100', //length of title min 5 max 100 letters
            'content' => 'required|min:10'
        ];
    }
}
