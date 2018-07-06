@extends('RuLong::layouts.app')

@section('title', 'roles - index')

@section('content')
<div class="row">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-8 m-b">
                    <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="{{ route('RuLong.roles.create') }}">
                        <i class="fa fa-plus"></i>
                        新增角色
                    </a>
                </div>
                <div class="col-sm-4 m-b">
                    <form action="{{ url()->current() }}" method="get" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">序号</th>
                            <th width="150">角色名称</th>
                            <th>角色描述</th>
                            <th width="140">创建时间</th>
                            <th width="220"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr class="edit" data-url="{{ route('RuLong.roles.edit', $role) }}">
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <a href="{{ route('RuLong.roles.edit', $role) }}" title="编辑角色" data-toggle="layer" data-height="300">编辑</a> |
                                <form action="{{ route('RuLong.roles.destroy', $role) }}" method="POST" style="display:inline">
                                    <a href="javascript:void(0);" class="ajax-post confirm">
                                        删除
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                </form> |
                                <a href="{{ route('RuLong.roles.menus', $role) }}" title="菜单授权">菜单授权</a> |
                                <a href="{{ route('RuLong.roles.users', $role) }}" title="菜单授权">用户授权</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
