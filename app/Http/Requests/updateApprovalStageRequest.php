<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class updateApprovalStageRequest extends FormRequest
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
        $id = $this->route('approval_stage');

        return [
            'approver_id' => [
                'required',
                'exists:approvers,id',
                Rule::unique('approval_stages', 'approver_id')->ignore($id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'approver_id.required' => 'ID approver tidak boleh kosong.',
            'approver_id.exists' => 'ID approver tidak ditemukan.',
            'approver_id.unique' => 'ID approver sudah ada.'
        ];
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return new JsonResponse($errors, 422);
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
