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
                    <li class="nav-item align-self-center mr-3">
                        <a href="php-pages/leaguetable.php" class="nav-link fw-bold">
                            <i class="bi bi-file-ruled" id="leaguetable-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown align-self-center ms-2">
                        <a class="nav-link" href="#login" id="login-dropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person" id="login-icon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark">
                            <li><a href="login.php" class="dropdown-item text-white" id="loginbutton">Login</a></li>
                            <li><a href="register.php" class="dropdown-item text-white" id="registerbutton">Register</a></li>
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
      <div class="row justify-content-center" id="leagueContainer" style="font-family: BDOGrotesk;">
        <div class="col-11 col-md-4">
          <div class="rounded text-white p-5" id="leagueTable">
            <p class="h4 fw-bold">Premier League 25/26 League Table</p>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">Icon:</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">Pts:</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">MP:</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">W:</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">D:</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="tableHeader">L:</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="leagueTableContainer">
                <div class="row match-card py-3 rounded">
                    <div class="col-2">
                        <div class="p-1">
                            <img src="../img/Arsenal_FC.svg.webp" alt="" height="35" width="30">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamPts">87</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="matchesPlayed">35</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamWins">21</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamDraws">10</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamLosses">3</p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        const session = document.getElementById('session');
        const loginButton = document.getElementById('loginbutton');
        const registerButton = document.getElementById('registerbutton');
        const logoutButton = document.getElementById('logoutButton');

        console.log(session.textContent.trim());

        if (session.textContent.trim() !== '') {
            loginButton.style.display = 'none';
            registerButton.style.display = 'none';
            logoutButton.style.display = 'block';
        } else {
            logoutButton.style.display = 'none';
        }

    </script>
    <script src="../js/leaguetable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>