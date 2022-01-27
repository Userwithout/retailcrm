<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
          'name' => 'required',
          'art' => 'required',
          'brand' => 'required'
            //
        ];
    }
    public function messages()
    {
      return [
        'name.required' => 'Нужно написать свое имя',
        'art.required' => 'Нужен артикул, чтобы найти товар',
        'brand.required' => 'Нужен бренд товара'
      ];
    }
}
