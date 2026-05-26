<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trequartista Football News</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-xxl">
        <a href="../index.php" class="navbar-brand">
            <img src="../img/Illustration8.5.png" alt="" height="70" width="70" id="brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
            <ul class="navbar-nav mr-5">
                <li class="nav-item align-self-center mr-3">
                    <a href="worldcup.php" class="nav-link fw-bold">
                        <i class="bi bi-trophy" id="worldcup-icon"></i>
                    </a>
                </li>
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
                        <li><a href="login.php" class="dropdown-item text-white" id="loginbutton">Login</a></li>
                        <li><a href="register.html" class="dropdown-item text-white" id="registerbutton">Register</a></li>
                        <li><a href="accountoptions.php" class="dropdown-item text-white hidden" id="settingsButton">Account settings</a></li>
                        <li><a href="../php/logout.php" class="dropdown-item text-white hidden" id="logoutButton">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<p class="hidden" id="session">
    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ""; ?>
</p>
<div class="container-fluid pt-3" id="background">
    <div class="row justify-content-center" id="registerContainer">
        <div class="col-md-4 col-11">
            <div class="rounded text-white p-5" id="registerMenu">
                <p class="h4 fw-bold">Account settings</p>
                <hr>
                <form action="">
                    <div class="form-group pt-5 text-center">
                        <button class="btn btn-primary border-light-subtle mt-5 text-white" id="changeUsernameButton">
                            <a href="changeUsername.php" style="text-decoration: none" class="text-white">Change username.</a>
                        </button>
                    </div>
                    <div class="form-group pt-5 text-center">
                        <button class="btn btn-primary border-light-subtle mt-5 text-white" id="changePasswordButton">
                            <a href="changePassword.php" style="text-decoration: none" class="text-white">Change password.</a>
                        </button>
                        <div class="form-group pt-5 text-center">
                            <button class="btn btn-primary border-light-subtle mt-5 text-white" id="deleteAccountButton">
                                <a href="deleteAccount.php" style="text-decoration: none" class="text-white">Delete Account.</a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" style="font-family: BDOGrotesk;" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #1d1d1d;">
            <div class="modal-header justify-content-center">
                <p class="display-9 fw-bold modal-title text-white">Please login or register before accessing this site:</p>
            </div>
            <div class="modal-body justify-content-between">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text-center">
                            <button class="btn btn-primary"><a href="login.php" style="text-decoration: none" class="text-white">Login</a></button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-primary"><a href="register.php" style="text-decoration: none" class="text-white">Register</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    const session = document.getElementById('session');
    const loginButton = document.getElementById('loginbutton');
    const registerButton = document.getElementById('registerbutton');
    const logoutButton = document.getElementById('logoutButton');
    const settingsButton = document.getElementById('settingsButton');
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

    console.log(session.textContent.trim());

    if (session.textContent.trim() !== '') {
        loginButton.style.display = 'none';
        registerButton.style.display = 'none';
        logoutButton.style.display = 'block';
        settingsButton.style.display = 'block';
        loginModal.hide();
    } else {
        logoutButton.style.display = 'none';
        settingsButton.style.display = 'none';
        loginModal.show();
    }

</script>
<script src="../js/index.js"></script>
</body>
</html>