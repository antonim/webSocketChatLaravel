<html>
    <head>
        <title>Auth</title>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="container" >

            <h2 class="text-center"> Auth page</h2>

            <div class="col-xs-6">

                <form role="form" method="POST" action="/auth/login">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="login">Username or Email</label>
                        <input class="form-control"  type="text" name="login" value="{{ old('login') }}">
                    </div>


                    <div>
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>

                    <div>
                         <label><input class="form-control" type="checkbox" name="remember"> Remember Me</label>
                    </div>

                    <div>
                        <button class="btn btn-default" type="submit">Login</button>
                    </div>
                </form>


                <form method="POST" action="/auth/register">
                    {!! csrf_field() !!}

                    <div>
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="username" value="{{ old('username') }}">
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input class="form-control"  type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>

                    <div>
                        <label for="confirm password">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>

                    <div>
                        <button class="btn btn-default" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>