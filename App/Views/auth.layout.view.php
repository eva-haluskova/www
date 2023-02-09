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

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>


    <link rel="stylesheet" href="public/css/styl.css">
    <link rel="icon" type="image/x-icon" href="public/images/cake-slice.png">
    <script src="public/js/script.js"></script>



</head>
<body>
<div id="page-container">
    <div id="content-wrap">
    <!-- Navbar -->

        <nav class="navbar navbar-expand-lg navbar-navbar navbar-light navbar-bg">

            <a class="navbar-brand" href="?c=home">VYPEČENÁ RECEPTÁREŇ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href=?c=recipes" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Recepty
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($categories as $catogory) { ?>
                                <a class="dropdown-item" href="?c=recipes&a=index&id=<?php echo $catogory->getId() ?>"><?php echo $catogory->getName() ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=home&a=contact">O nás</a>
                    </li>
                </ul>
            </div>
        </nav>


<!-- CONTENT-->
        <div class="container-fluid mt-3">
            <div class="web-content">
                <?= $contentHTML ?>
            </div>
        </div>
<!-- FOOTER -->
        <footer id="footer" class="text-center text-lg-start container-fluid" style="background-color: navajowhite;">
            <div class="container d-flex justify-content-center py-5">

                <button type="button" class="btn btn-lg btn-floating mx-2" style="background-color: white;">
                    <!--           <a href="#"><img src="css/images/facebook.png" alt="Facebook logo" width=25em height=auto></a> -->
                    <img src="public/images/facebook.png" class = "img-footer" alt="Facebook logo">
                </button>

                <button type="button" class="btn btn-lg btn-floating button-bot" style="background-color: white;">
                    <!--      <a href="?c=home"><img src="css/images/instagram.png" width=25em height=auto></a> -->
                    <img src="public/images/instagram.png" class = "img-footer" alt="Instagram logo">

                </button>
            </div>
        </footer>


</body>
</html>
