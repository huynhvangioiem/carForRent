<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car For Rent - Login</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="assets/css/addCardStyle.css" rel="stylesheet">


</head>
<body>

<header>
    <?php

    if (isset($_SESSION['user'])) {
        echo $_SESSION['user'];
    } ?>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">abc.xyz</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="/login" class="text-white">login</a></li>
                        <li>
                            <form action="/logout" method="post">
                                <button name="btnSubmit" type="submit">logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Home</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center text-info">ADD CARD</h3>
                        <div style="text-align: center;color: red">
                            <?php

                            if (isset($options['messageError'])) {
                                echo $options['messageError'];
                            } ?></div>
                        <div class="form-group">
                            <label for="name" class="text-info">Name:</label><br>
                            <input type="text" name="name" id="name" class="form-control" value="" required>
                            <div style="text-align: center;color: red">
                                <?php if (isset($options['name'])) {
                                    echo $options['name'];
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="text-info">Description:</label><br>
                            <input type="text" name="description" id="description" class="form-control" required>
                            <div style="text-align: center;color: red">
                                <?php if (isset($options['description'])) {
                                    echo $options['description'];
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="text-info">Price:</label><br>
                            <input type="number" name="price" id="price" class="form-control" required>
                            <div style="text-align: center;color: red">
                                <?php if (isset($options['price'])) {
                                    echo $options['price'];
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="text-info">Image:</label><br>
                            <input type="file" name="img" id="img" class="form-control">
                            <div style="text-align: center;color: red">
                                <?php if (isset($options['img'])) {
                                    echo $options['img'];
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="/register" class="text-info">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
