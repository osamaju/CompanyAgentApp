<?php
if (isset($_POST["login-admin"])){header('location: login-admin.php');}
if (isset($_POST["login"])){header('location: login.php');}
if (isset($_POST["signup"])){header('location: signup.php');}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Home Page survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="./slick.css" type="text/css" />   
    <link rel="stylesheet" href="./tooplate-simply-amazed.css" type="text/css" />

</head>

<body>
    <div id="outer">
        <header class="header order-last" id="tm-header">
            <nav class="navbar">
                <div class="collapse navbar-collapse single-page-nav">
                <form method="POST">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <input type="submit" value="Admin Login"name="login-admin" <?php ?>>
                        </li>
                        <li class="nav-item">
                        <input type="submit" value="User Login"name="login" <?php ?>>
                        </li>
                        <li class="nav-item">
                        <input type="submit" value="New user"name="signup" <?php ?>>
                        </li>
                    </ul>
                    </form>
                </div>
            </nav>
        </header>
        
        <button class="navbar-button collapsed" type="button">
            <span class="menu_icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
        
        <main id="content-box" class="order-first">
            <div class="banner-section section parallax-window" data-parallax="scroll" data-image-src="img/section-1-bg.jpg" id="section-1">
                <div class="container">
                    <div class="item">
                        <div class="bg-blue-transparent simple"><p>Welcome to our website, there many survey to answer it!</p></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>
</html>