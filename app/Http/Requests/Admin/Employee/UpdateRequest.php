<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Admin\Employee
 */
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        // If admin
        return admin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ($this->get('updateType') == 'bank') {
            $rules['accountName'] = 'required';
            $rules['accountNumber'] = 'required';
            $rules['bank'] = 'required';
        /**$rules['ifsc'] = 'required';
            $rules['pan'] = 'required|max:10';
            $rules['branch'] = 'required';**/
        }

        if ($this->get('updateType') == 'company') {
            $rules['employeeID'] = [
                'required',
                Rule::unique('employees')->ignore($this->route('employee'), 'employeeID'),
            ];
        }

        if ($this->get('updateType') == 'personalInfo') {
            $rules['fullName'] = 'required';
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->route('employee'), 'employeeID'),
            ];
            $rules['profileImage'] = 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:4000';
        }
        if ($this->get('updateType') == 'documents') {
            $rules['cv'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['diplome'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['cni'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['cn'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx|max:4000';
            $rules['cj'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['iban'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['ipres'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['cm'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['lf'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['cbm'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
			$rules['vcv'] = 'mimes:pdf,jpeg,jpg,png,bmp|max:4000';
        }

        return $rules;
    }

}
