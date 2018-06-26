<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close">
        <i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="avatar" class="img-circle" src="{{ admin_assets('img/avatar.jpg') }}" width="70" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">{{ Admin::user()->nickname }}</strong></span>
                            <span class="text-muted text-xs block">{{ Admin::user()->username }} <b class="caret"></b> </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu m-t-xs">
                        <li><a href="{{ admin_url('password') }}" id="password">修改密码</a></li>
                    </ul>
                </div>
                <div class="logo-element">Cs</div>
            </li>
            @foreach ($adminMenus as $menu)
            <li>
                <a class="J_menuItem" href="">
                    <i class="fa {{ $menu['icon'] }}"></i>
                    <span class="nav-label">{{ $menu['title'] }}</span>
                </a>
                @isset($menu['children'])
                <ul class="nav nav-second-level">
                    @foreach ($menu['children'] as $children)
                    <li>
                        <a class="J_menuItem" href="{{ route($children['uri']) }}"><i class="fa {{ $children['icon'] }}"></i> {{ $children['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
                @endisset
            </li>
            @endforeach
        </ul>
    </div>
</nav>
<!--左侧导航结束-->
