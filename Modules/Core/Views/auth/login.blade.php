<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    @include('layouts._head')

    @include('layouts._js_global')

</head>
<body class="app flex-row align-items-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Sign In</span>
                </div>
                <div class="card-body p-5">

                    <form class="form-signin" method="POST" action="{{ route('session.login') }}">

                    @include('layouts._alerts')
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </div>
                        </div>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="@lang('ip.email')">
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="@lang('ip.password')">
                    </div>

                    <div class="input-group mb-3">
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="remember_me" value="0">
                                <input type="checkbox" name="remember_me" value="1"> @lang('ip.remember_me')
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">@lang('ip.sign_in')</button>
                        </div>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
