<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanitizeFormRequest extends FormRequest
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

        $this->sanitize();

        return [
            'placeName' => 'required',
            'street'=> 'required',
            'city' => 'required',
            'zip' => 'min:5|max:5|nullable',
        ];
    }

    /**
     * Sanitize input before validating it
     * from: http://www.easylaravelbook.com/blog/2015/02/09/creating-a-contact-form-in-laravel-5-using-the-form-request-feature/
     *  and: http://www.easylaravelbook.com/blog/2015/03/31/sanitizing-input-using-laravel-5-form-requests/
     */
    public function sanitize()
    {
        $input = $this->all();

        $input['placeName'] = filter_var($input['placeName'], FILTER_SANITIZE_STRING);
        $input['street'] = filter_var($input['street'], FILTER_SANITIZE_STRING);
        $input['city'] = filter_var($input['city'], FILTER_SANITIZE_STRING);
        $input['zip'] = filter_var($input['zip'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }

}
