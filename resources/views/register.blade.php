<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>Register</title>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <form action="/api/register" method="POST">
                @csrf
                Name:<input type="text" name="name" class="form-control"><br><br>
                Email:<input type="email" name="email" class="form-control"><br><br>
                Password:<input type="password" name="password" class="form-control"><br><br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>