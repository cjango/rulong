<?php

namespace RuLong\Panel\Requests;

class RoleRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'name'        => 'required|between:2,32|unique:admin_roles',
                    'description' => 'max:255',
                ];
                break;
            case 'PUT':
                $id    = $this->route('role')->id;
                $rules = [
                    'name'        => 'required|between:2,32|unique:admin_roles,name,' . $id,
                    'description' => 'max:255',
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'   => '角色名称必须填写',
            'name.between'    => '角色名称长度应在:min-:max位之间',
            'name.unique'     => '角色名称已经存在',
            'description.max' => '角色描述应小于:max字符',
        ];
    }
}
