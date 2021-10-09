<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>Login</title>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <form action="/api/login" method="POST">
                @csrf
                Email:<input type="email" name="email" id="email" class="form-control"><br><br>
                Password:<input type="password" name="password" id="password" class="form-control"><br><br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>