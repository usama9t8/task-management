<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'string|required',
            'priority' => 'required|unique:tasks,priority',
            'project_id' => 'required|exists:projects,id'
        ];
        if (\Route::currentRouteName() === 'tasks.update') {
            $rules['priority'] .= ',' . $this->task->priority;
        }

        return $rules;
    }
}