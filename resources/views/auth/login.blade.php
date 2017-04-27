
                   <!-- <form class="form-horizontal" role="form" method="POST" action="@{{ route('login') }}">
                        @{{ csrf_field() }}

                        <div class="form-group@{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>


                                    <span class="help-block">
                                        <strong>@{{ $errors->first('email') }}</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>


                                    <span class="help-block">
                                        <strong>@{{ $errors->first('password') }}</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" @{{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="@{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- iCheck -->
<link rel="stylesheet" href="{{asset('css/dashboard/all.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body">
            <p class="login-box-msg">Faça o login para começar uma sessão</p>

        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" {{ old('email') }}>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" placeholder="Senha" name="password" {{ old('password') }}>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input id="remenber" type="checkbox" name="remember" {{ old('remember') }}> Lembre-me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- iCheck -->
<script src="{{ asset('js/dashboard/all.js') }}"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
