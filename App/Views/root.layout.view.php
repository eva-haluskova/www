<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\Type;
$categories = Type::getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= \App\Config\Configuration::APP_NAME ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="public/css/styl.css">
    <link rel="icon" type="image/x-icon" href="public/images/cake-slice.png">
    <script src="public/js/script.js"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body class="family-font">

<div id="page-container">
    <div id="content-wrap">

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-navbar navbar-light navbar-bg">
            <a class="navbar-brand" href="?c=home">VYPEČENÁ RECEPTÁREŇ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="?c=recipes" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Recepty
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($categories as $catogory) { ?>
                                <a class="dropdown-item" href="?c=recipes&id=<?php echo $catogory->getId() ?>"><?php echo $catogory->getName() ?></a>
                            <?php } ?>
                        </div>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=home&a=contact">O nás</a>
                    </li>

                </ul>

                <ul class="navbar-nav mr-auto navbar-right">

                    <li class="nav-item ">
                        <?php if ($auth->isLogged()) { ?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $auth->getLoggedUserName() ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?c=auth&a=logout">Logout</a>
                            <?php if ($auth->isLogged() && $auth->getLoggedUserName() == 'admin') { ?>
                                <a class="dropdown-item" href="?c=types">Spravovat kategorie</a>
                            <?php } ?>
                        </div>
                    </li>

                    <?php } else { ?>
                        <a class="nav-link" href="?c=auth&a=login">Login</a>
                    <?php } ?>

                </ul>

            </div>
        </nav>



<!-- CONTENT -->
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>

<!-- FOOTER -->
    </div>

    <footer id="footer" class="text-center text-lg-start container-fluid" style="background-color: navajowhite;">
        <div class="container d-flex justify-content-center py-5">

            <button type="button" class="btn btn-lg btn-floating mx-2" style="background-color: white;" onclick="window.location.href='https://www.facebook.com';">
               <img src="public/images/facebook.png" class = "img-footer" alt="Facebook logo">
            </button>

            <button type="button" class="btn btn-lg btn-floating button-bot" style="background-color: white;" onclick="window.location.href='https://www.instagram.com/';">
                <img src="public/images/instagram.png" class = "img-footer" alt="Instagram logo">
            </button>

        </div>
    </footer>

</div>

</body>
</html>
