<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <title>Laravel CRUD</title>
</head>

<body>
<br/>
<div class="container">
<div class="row">
    <div class="col-3">&nbsp;</div>
    <div class="col-6">
        <form id="reg" name="myForm" method="POST" >
            @csrf
            <br>
            <input type="hidden" name="HI" id="HI"/>
            <h3>Registration form</h3>
            <br/>
        <div class="form-group col-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Username</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <input class="form-control" type="text" name="username" id="username"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Password</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Email</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <input class="form-control" type="email" name="email" id="email"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Phone number</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <input class="form-control" type="tel" name="phone" id="phone"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Date of Birth</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <input class="form-control" type="date" name="dateofbirth" id="dateofbirth"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Gender</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <label class="form-check-label">Male</label>
                    <input type="radio" class="form-check-input" name="gender"  id="male" value="male"/>
                    <label class="form-check-label">Female</label>
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Address</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <label class="control-label">Declaration</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 declaration">
                    <input type="checkbox" class="form-check-input" name="declaration" id="declaration" value="checked"/>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-8">&nbsp;</div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                    <button type="reset" class="btn btn-danger reset">Reset</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                    <button type="submit" class="btn btn-primary" data-action='save' name="save" id="save_button">Save</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="col-3">&nbsp;</div>
</div>
</div>
<hr>
<div class="container">
<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody id="table_data">

    </tbody>
</table>
</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>