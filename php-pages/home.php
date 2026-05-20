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
            <a href="index.html" class="navbar-brand">
                <img src="../img/Illustration8.5.png" alt="" height="70" width="70" id="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
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
                            <li><a href="register.php" class="dropdown-item text-white" id="registerbutton">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid pt-3" id="background">
        <section id="main-dash">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-2 text-white border border-3 rounded border-dark shadow-lg" id="sidebar-left">
                        <p class="h4 fw-bold mt-3">Settings</p>
                        <hr>
                        <section class="mt-1" id="cards">
                            <div class="container-fluid">
                                <div class="row align-items-center justify-content-center match-card" style="font-family: BDOGrotesk;">
                                    <div class="col-5">
                                        <label for="matchOffset" class="form-label slider-label lead text-secondary">Per page:</label>
                                        <div class="range">
                                            <input type="range" class="form-range" id="matchOffset" min="5" max="25" step="5">
                                            <h5 class="h5" id="rangeNumber">15</h5>
                                        </div>
                                        <label for="dateOffset" class="form-label slider-label lead text-secondary">How long:</label>
                                        <div class="range">
                                            <input type="range" class="form-range" id="dateOffset" min="1" max="6" step="1">
                                            <h5 class="h5" id="dateNumber">3 months</h5>
                                        </div>
                                        <button type="submit" id="settingsSubmit" class="btn btn-dark border-light-subtle pt-1 mt-4">Submit</button>
                                    </div>
                                </div>

                                <hr>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6 col-sm-4 text-white border border-3 rounded border-dark shadow-lg" id="maindisplay" style="font-family: BDOGrotesk;">
                        <p class="h4 fw-bold my-3">Fixtures</p>
                        <hr>
                        <nav>
                            <ul class="pagination justify-content-center" id="pagination-parent">
                                <li class="page-item" id="toFirst"><a href="#" class="page-link bg-dark "><<</a></li>
                                <li class="page-item active" id="page1"><a href="#" class="page-link bg-dark">1</a></li>
                                <li class="page-item" id="page2"><a href="#" class="page-link bg-dark">2</a></li>
                                <li class="page-item" id="page3"><a href="#" class="page-link bg-dark">3</a></li>
                                <li class="page-item" id="page4"><a href="#" class="page-link bg-dark">4</a></li>
                                <li class="page-item" id="page5"><a href="#" class="page-link bg-dark">5</a></li>
                                <li class="page-item" id="toLast"><a href="#" class="page-link bg-dark">>></a></li>
                            </ul>
                        </nav>
                        <section class="my-5" id="matchCards">
                        </section>
    </div>
    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>