<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = auth()->user();
        return [
            'name'=>'required|string|max:255',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignoreModel($user),
            ],
            'password'=>[
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }
    public function getData():array
    {
        $data=[
            'name'=>$this->input('name'),
            'email'=>$this->input('email')
        ];
        if($password = $this->input('password')){
            $data['password']=Hash::make($password);
        }
        return $data;
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function($validator){
            if ($this->isOldPasswordIncorrect()){
                $validator->errors()->add('old_password','wrong old password');
            }
        });
    }
    private function isOldPasswordIncorrect():bool
    {

      
        if(!Hash::check($this->input('old_password'), auth()->user()->getAuthPassword())){
            return  true;
        }
        return false;
    }
}
