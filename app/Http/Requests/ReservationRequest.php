<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',

            'check_in_date' => 'required|date|after_or_equal:today',

            'check_out_date' => 'required|date|after:check_in_date',
        ];
    }
}