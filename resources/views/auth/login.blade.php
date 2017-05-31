<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/dashboard/all.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body">
            <p class="login-box-msg">Faça o login para começar uma sessão</p>
{{bcrypt('123456')}}
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" placeholder="Senha" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            </div>
            <div class="row">
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
