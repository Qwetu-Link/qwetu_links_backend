<?php

namespace App\Http\Requests\v1\services;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaintainanceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_id' => 'required|string|exists:units,id',
            'tenant_id' => 'nullable|string|exists:tenants,id',
            'title' => 'required|string|max:255',
            'issue' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,resolved',
            'reported_date' => 'required|date',
            'resolved_date' => 'nullable|date|after_or_equal:reported_date',
            'cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tenant_id' => $this->tenantID,
            'unit_id' => $this->unitID,
            'reported_date' => $this->reportedDate,
            'resolved_date' => $this->resolvedDate,
        ]);
    }
}
