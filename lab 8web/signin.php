<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: user_profile.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#subm").click(function () {
                event.preventDefault();
                $.ajax('authorization.php', {
                    type: 'POST',  // http method
                    data: {
                        email: $("#exampleInputEmail1").val(),
                        password: $("#exampleInputPassword1").val()
                    },  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            window.location.href = "user_profile.php";
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg").text('Error: ' + msg + ', ' + errorData.status);
                        $("#errormsg").show();
                    }
                });
            });
        });
        $(document).ready(function () {
            $("#registr").click(function () {
                event.preventDefault();
                $.ajax('registration.php', {
                    type: 'POST',  // http method
                    data: {
                        email: $("#InputEmail1").val(),
                        fname: $("#InputFName").val(),
                        lname: $("#InputLName").val(),
                        password: $("#InputPassword1").val(),
                        url: $("#InputURL").val(),
                        date: $("#InputBirthday").val()

                    },  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            window.location.href = "user_profile.php";
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        $("#msg2").text("Successfully registered")
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg2").text('Error: ' + msg + ', ' + errorData.status);
                        if (errorData.status != 500) {
                            $("#errormsg2").show();
                        } else if (errorData.status == 500)
                            $("#msg2").show();
                        else
                            $("#errormsg2").show();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#login input').bind('focus', function () {
                $('#login').addClass('border border-primary');
                $('#registration').removeClass('border border-success');
                $('#subm').prop('disabled', false);
                $('#registr').prop('disabled', true);

            });
            $('#registration input').bind('focus', function () {
                $('#registration').addClass('border border-success');
                $('#login').removeClass('border border-primary');
                $('#registr').prop('disabled', false);
                $('#subm').prop('disabled', true);
            });
        });
    </script>
</head>
<body>
<?php include_once('header_with_theme.php'); ?>
<div class="container container-login">
    <div class="row">
        <div class="col-md-4" id="login">
            <h2>Authorisation</h2>
            <form>
                <span class="error text-danger" id="errormsg" style="display: none"></span>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary" id="subm" disabled="disabled">Submit</button>
            </form>
        </div>
        <div class="col-md-6" id="registration">
            <h2>Registration</h2>
            <br>
            <span class="error text-success" id="msg2" style="display: none"></span>
            <form id="myform">
                <span class="error text-danger" id="errormsg" style="display: none"></span>

                <div class="form-group">
                    <label for="InputEmail1">Email address</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="InputFName">First Name</label>
                    <input type="text" class="form-control" id="InputFName" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="InputLName">Last Name</label>
                    <input type="text" class="form-control" id="InputLName" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="InputURL">URL Avatar</label>
                    <input type="text" class="form-control" id="InputURL" placeholder="Enter url">
                </div>
                <div class="form-group">
                    <label for="InputBirthday">Birthday</label>
                    <input type="date" class="form-control" id="InputBirthday">
                </div>

                <button type="submit" class="btn btn-primary" style="background-color: #4CAF50" disabled="disabled"
                        id="registr">Registrate
                </button>

            </form>
            <br>
            <br>
        </div>
    </div>

</body>
</html>