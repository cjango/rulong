@extends('CPanel::layouts.app')

@section('title', 'permissions - index')

@section('content')
<form class="form-horizontal" method="post" action="{{ route('CPanel.permissions.update', $role )}}">
    <div class="form-group">
        <label class="col-xs-3 control-label">角色名称</label>
        <div class="col-xs-8">
            <input type="text" placeholder="角色名称" name="name" class="form-control" value="{{ $role->name }}" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">指定看守器</label>
        <div class="col-xs-8">
            <select name="guard_name" class="form-control">
                @foreach ($guards as $guard)
                <option @if ($role->guard_name == $guard) selected @endif value="{{ $guard }}">{{ $guard }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            @csrf
            @method('PUT')
            <button class="btn btn-primary ajax-post" type="button">编辑角色</button>
        </div>
    </div>
</form>
@endsection
