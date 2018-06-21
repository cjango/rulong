<?php

namespace RuLong\Panel\Requests;

class MenuRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
                $rules = [
                    'title' => 'required|max:16',
                    'sort'  => 'required|integer',
                    'uri'   => 'required_unless:parent_id,0',
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
            'title.required'      => '菜单名称必须填写',
            'title.max'           => '菜单名称长度应在:max以内',
            'sort.required'       => '菜单排序必须填写',
            'sort.integer'        => '菜单排序只能是数字',
            'uri.required_unless' => '菜单连接地址必须填写',
        ];
    }
}
