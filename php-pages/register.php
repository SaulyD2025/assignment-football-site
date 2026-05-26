<?php
session_start();
?>
<?php
    require('../php/config.php');
    require('../php/validator.php');

    $host = 'localhost';
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
    $dbname = $_ENV['USER_TABLE'];
    $registered = false;

    $dsn = "mysql:host=$host;port=3306;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);

    if (isset($_POST['submitButton'])) {
        $regValidation = new validator($_POST);
        $errors = $regValidation->validateForm();
        if (empty($errors)) {
            $sql = 'INSERT INTO MEMBERS(username, password) VALUES(:username, :password)';
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            $registered = true;
        }
    }
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
            <a href="#" class="navbar-brand">
                <img src="../img/Illustration8.5.png" alt="" height="70" width="70" id="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
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
            <p class="h4 fw-bold">Register below:</p>
            <hr>
              <div class="lead text-success" id="successMessage">
                  <?php echo htmlspecialchars(!empty($registered) ? 'Registration successful! Redirecting...' : '')?>
              </div>
            <form action="" method="post">
              <div class="form-group pt-3">
                <label for="regUsernameInput" class="">Username:</label>
                <input type="text" class="form-control" id="regUsernameInput" placeholder="Enter username:" name="username">
              </div>
              <div class="lead text-danger">
                  <?php echo htmlspecialchars(isset($errors['username']) ? $errors['username'] : '') ?>
              </div>
              <div class="form-group pt-5">
                <label for="regPasswordInput">Password:</label>
                <input type="password" class="form-control" id="regPasswordInput" placeholder="Enter password:" name="password">
              </div>
                <div class="lead text-danger">
                    <?php echo htmlspecialchars(isset($errors['password']) ? $errors['password'] : '') ?>
                </div>
              <div class="form-group pt-5">
                <label for="regPasswordConfirm">Confirm password:</label>
                <input type="password" class="form-control" id="regPasswordConfirm" placeholder="Confirm password:" name="confirmPassword">
              </div>
                <div class="lead text-danger">
                    <?php echo htmlspecialchars(isset($errors['confirmPassword']) ? $errors['confirmPassword'] : '') ?>
                </div>
              <button type="submit" id="loginSubmit" class="btn btn-dark border-light-subtle mt-5" name="submitButton">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
        const session = document.getElementById('session');
        const loginButton = document.getElementById('loginbutton');
        const registerButton = document.getElementById('registerbutton');
        const logoutButton = document.getElementById('logoutButton');
        const settingsButton = document.getElementById('settingsButton');

        console.log(session.textContent.trim());

        if (session.textContent.trim() !== '') {
            loginButton.style.display = 'none';
            registerButton.style.display = 'none';
            logoutButton.style.display = 'block';
            settingsButton.style.display = 'block';
        } else {
            logoutButton.style.display = 'none';
            settingsButton.style.display = 'none';
        }

    </script>
    <script>
        const successMessage = document.getElementById('successMessage');

        if (successMessage.textContent.trim() !== '') {
            setTimeout(() => {
                window.location.href = '../index.php';
            }, 3000);
        }
    </script>
    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>