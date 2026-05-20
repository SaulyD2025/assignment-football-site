<?php
    class User {
        public $username = 'John Doe';
        public $password = '123123';
    }

    $currentUser = new User();

    echo $currentUser->username;
    echo $currentUser->password;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Website</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container-xxl">
            <a href="home.php" class="navbar-brand">
                <img src="../img/Illustration8.5.png" alt="" height="70" width="70" id="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav mr-5">
                    <li class="nav-item align-self center mr-3">
                        <a href="leaguetable.php" class="nav-link fw-bold">
                            <i class="bi bi-file-ruled" id="leaguetable-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown align-self-center ms-2">
                        <a class="nav-link" href="#login" id="login-dropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person" id="login-icon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark">
                            <li><a href="login.html" class="dropdown-item text-white" id="loginbutton">Login</a></li>
                            <li><a href="register.php" class="dropdown-item text-white" id="registerbutton">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid pt-3" id="background">
      <div class="row justify-content-center" id="loginContainer">
        <div class="col-4">
          <div class="rounded text-white p-5" id="loginMenu">
            <p class="h4 fw-bold">Login below:</p>
            <hr>
            <form method="POST">
              <div class="form-group pt-3">
                <label for="userNameInput" class="">Username:</label>
                <input type="text" class="form-control" id="userNameInput" placeholder="Enter username:" name="username">
              </div>
              <div class="form-group pt-5">
                <label for="passwordInput">Password:</label>
                <input type="password" class="form-control" id="passwordInput" placeholder="Enter password:" name="password">
              </div>
              <button type="submit" id="loginSubmit" class="btn btn-dark border-light-subtle mt-5" name="submitButton">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>

