<?php

namespace App\Http\Requests\Buku;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewBukuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required|string|max:100',
            'item_category' => 'required|string|max:100',
            'item_price' => 'required|numeric',
            'item_quantity' => 'required|integer',
        ];
    }
}