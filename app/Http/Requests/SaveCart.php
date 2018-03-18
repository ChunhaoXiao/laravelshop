<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCart extends FormRequest
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
            'numbers' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator){

            $product = \App\Models\Product::find($this->product);
            if(!$product)
            {
                $validator->errors()->add('error', '产品不存在');
            }
            if($this->numbers > $product->number)
            {
                $validator->errors()->add('error', '数量超过了库存量') ;
            }
        });
    }
}
