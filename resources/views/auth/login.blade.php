<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{ config('app.name') }} 管理登录</title>
    <link rel="stylesheet" href="{{ admin_assets('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/login_v2.css') }}" />
    <link rel="stylesheet" href="{{ admin_assets('css/plugins/sweetalert/sweetalert.css') }}" />
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location
        }
    </script>
</head>
<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>[ {{ config('app.name') }} ]</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>{{ config('app.name') }} 管理系统</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5">
                <form method="post" action="{{ url()->current() }}">
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录到 {{ config('app.name') }}</p>
                    <input type="text" class="form-control uname" name="username" placeholder="登录手机号" />
                    <input type="password" class="form-control pword" name="password" placeholder="登录密码" />
                    <div class="verify">
                        <input type="text" name="verify" class="form-control" placeholder="请输入验证码"/>
                        <div class="code" style="background-image:url({{ captcha_src() }});"></div>
                    </div>
                    @csrf
                    <button class="btn btn-success btn-block ajax-post">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2018 All Rights Reserved. C.Jason
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ admin_assets('js/jquery.min.js?v=2.1.4') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/plugins/layer/layer.min.js') }}"></script>
    <script type="text/javascript" src="{{ admin_assets('js/common.js') }}"></script>
    <script type="text/javascript">
        $('.code').click(function() {
            $(this).attr('style', 'background-image:url({{ captcha_src() }}&_='+ Math.random() +');');
        });
    </script>
</body>
</html>
