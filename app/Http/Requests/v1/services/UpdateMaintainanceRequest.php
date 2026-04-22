<?php

namespace App\Http\Requests\v1\services;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintainanceRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
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
        } else {
            return [
                'unit_id' => 'sometimes|required|string|exists:units,id',
                'tenant_id' => 'sometimes|nullable|string|exists:tenants,id',
                'title' => 'sometimes|required|string|max:255',
                'issue' => 'sometimes|required|string',
                'priority' => 'sometimes|required|in:low,medium,high',
                'status' => 'sometimes|required|in:pending,in_progress,resolved',
                'reported_date' => 'sometimes|required|date',
                'resolved_date' => 'sometimes|nullable|date|after_or_equal:reported_date',
                'cost' => 'sometimes|nullable|numeric|min:0',
                'notes' => 'sometimes|nullable|string',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('unitID')) {
            $data['unit_id'] = $this->unitID;
        }

        if ($this->has('tenantID')) {
            $data['tenant_id'] = $this->tenantID;
        }

        if ($this->has('reportedDate')) {
            $data['reported_date'] = $this->reportedDate;
        }

        if ($this->has('resolvedDate')) {
            $data['resolved_date'] = $this->resolvedDate;
        }

        $this->merge($data);
    }
}
