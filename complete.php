<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'includes/autoload.php';
$system_status = $Votes->checkSystemStatus();
if ($system_status == ""){
    $system_status = "Το σύστημα είναι απασχολημένο, παρακαλώ δοκιμάστε αργότερα.";
}

if(isset($_POST['back'])){
    header("Location: /");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="Σύστημα Ηλεκτρονικής Ψηφοφορίας | 3 ΓΕΛ ΕΥΟΣΜΟΥ" />
    <meta property="og:type" content="vote.system" />
    <meta property="og:url" content="URL" />
    <meta property="og:image" content="img/preview.jpg" />
    <title>Σύστημα Ηλεκτρονικής Ψηφοφορίας | 3 ΓΕΛ ΕΥΟΣΜΟΥ</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/landing-page.min.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Σύστημα Ηλεκτρονικής Ψηφοφορίας</a>
    </div>
</nav>

<!-- Masthead -->
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5">Ευχαριστούμε, η ψήφος σας καταχωρήθηκε με επιτυχία</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form action="" method="POST">
                    <button type="submit" class="btn btn-block btn-lg btn-primary" name="back">Επιστροφή στην αρχική</button>
                </form>
            </div>

        </div>
    </div>
</header>

<!-- Testimonials -->
<section class="testimonials text-center bg-light">
    <div class="container">
        <h2 class="mb-5">Ευχαριστούμε</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/georgetomzaridis.jpg" alt="">
                    <h5>George Tomzaridis</h5>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/plutengroup.png" alt="">
                    <h5>Pluten Group</h5>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="img/gaiagas.png" alt="" style="height: 196px;">
                    <h5>GaiaGas</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/george.tomzaridis">George Tomzaridis</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/plutengroupgr/">Pluten Group</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="https://gaiagas.gr">GaiaGas</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="http://3lyk-evosm.thess.sch.gr">3 Gel Euosmou</a>
                    </li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; School Votes 2018-2019. Created by George Tomzaridis.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
