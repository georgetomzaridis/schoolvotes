<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'includes/autoload.php';
$system_status = $Votes->checkSystemStatus();

if($system_status != "system_ready"){
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

<div class="jumbotron" style="text-align: center;">
    <h1 class="display-4" style="font-size: 36px;">Βήμα 1</h1>
    <p class="lead">Παρακαλώ συμπληρώστε το μοναδικό κωδικό ψηφοφορίας που έχετε παραλάβει απο το σχολείο.</p>
    <hr class="my-4">
    <?php
        if(isset($_POST['verifycodenow'])){
            if(!empty($_POST['votecode'])){
                $votecode = $_POST['votecode'];
                $votesystem_response = $Votes->checkVoteCode($votecode);
                switch ($votesystem_response){
                    case "vote_continue":
                        $_SESSION['votecode'] = $votecode;
                        $_SESSION['systemstatus'] = $system_status;
                        header("Location: /vote");
                    case "vote_error":
                        ?>
                        <div class="alert alert-danger" role="alert" style="max-width: 500px; width: 100%; margin: auto;">
                            <h4 class="alert-heading">Σφάλμα</h4>
                            <p>Ο κωδικός ψηφοφορίας δεν είναι έγκυρος, παρακαλώ δοκιμάστε ξανά.</p>
                        </div>
                        <?php
                }
            }else{
                ?>
                <div class="alert alert-danger" role="alert" style="max-width: 500px; width: 100%; margin: auto;">
                    <h4 class="alert-heading">Σφάλμα</h4>
                    <p>Ο κωδικός ψηφοφορίας δεν πρέπει να είναι κενός, παρακαλώ δοκιμάστε ξανά.</p>
                </div>
                <?php
            }
        }
    ?>
    <form action="" method="POST" style="text-align: center; margin: auto; max-width: 400px; width: 100%;">
        <div class="form-group">
            <label for="exampleInputEmail1">Κωδικός Ψηφοφορίας</label>
            <input type="text" class="form-control" name="votecode" aria-describedby="emailHelp" placeholder="Κωδικός Ψηφοφορίας">
        </div>
        <button type="submit" class="btn btn-primary" name="verifycodenow">Είσοδος</button>
    </form>
</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
