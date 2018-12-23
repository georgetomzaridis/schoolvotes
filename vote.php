<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'includes/autoload.php';
$system_status = $Votes->checkSystemStatus();
$votecode_check = $_SESSION['votecode'];
$checkcode_response = $Votes->checkVoteCodeStatus($votecode_check);
if($checkcode_response != "vote_active" || empty($votecode_check) || !isset($votecode_check)){
    $_SESSION['votecode'] = "";
    header("Location: /auth");
}

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
    <meta property="og:url" content="url" />
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
    <h1 class="display-4" style="font-size: 36px;">Βήμα 2</h1>
    <p class="lead">Επιλέξτε έως 7 υποψηφίους</p>
    <hr class="my-4">
    <?php

    if (isset($_POST['votenow']))
    {
        $id_list = array();
        $votes_selection_array = $_POST['people'];
        $count_not_votes = $Votes->checkSuccess($votes_selection_array, "nothing");
        if($count_not_votes >= 1){
            $destroycode_res = $Votes->CancelCode($votecode_check);
            if($destroycode_res == "code_destroyed"){
                header("Location: /complete");
            }else{
                header("Location: /failed");
            }
        }else{

            foreach ($votes_selection_array as $countitems){
                if($countitems != "nothing"){
                    array_push($id_list, $countitems);
                }

            }
            if(count($id_list) <= 7){
                $update_vote_response = $Votes->addVote($votes_selection_array);
                if(is_array($update_vote_response)){
                    //Yeahh but check if something went wrong
                    $count_success = $Votes->checkSuccess($update_vote_response, "ok");
                    if($count_success == count($votes_selection_array)){
                        $destroycode_res = $Votes->CancelCode($votecode_check);
                        if($destroycode_res == "code_destroyed"){
                            header("Location: /complete");
                        }else{
                            header("Location: /failed");
                        }
                    }else{
                        header("Location: /failed");
                    }
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert" style="max-width: 500px; width: 100%; margin: auto;">
                        <h4 class="alert-heading">Σφάλμα συστήματος</h4>
                        <p>Παρακαλώ ενημερώστε τον διαχειριστή</p>
                        <p>Κωδικός Σφάλματος: 78273</p>
                    </div><br>
                    <?php
                }
            }else{
                //Oppsss no more than 7 people
                ?>
                <div class="alert alert-danger" role="alert" style="max-width: 500px; width: 100%; margin: auto;">
                    <h4 class="alert-heading">Προσοχή</h4>
                    <p>Μπορείτε να ψηφίσετε εώς και 7 υποψηφίους.</p>
                </div><br>
                <?php
            }
        }
    }
    ?>
    <ul class="list-group" style="text-align: center; max-width: 550px; margin: auto; width: 100%;">
        <?php
        $get_people_list = $Votes->getPeopleList();
        if($get_people_list != "vote_error"){
            ?>
            <form action="" method="POST">
                <?php

                foreach ( $get_people_list as $value) {
                    $final = explode("<@>", $value);
                    ?>
                    <li class="list-group-item"><input type='checkbox' name='people[]' value='<?php echo $final[0]; ?>'> <?php echo $final[1]; ?> <?php echo $final[2]; ?></li>
                    <?php

                }
                ?>
                <li class="list-group-item"><input type='checkbox' name='people[]' value='nothing'> Κανέναν απο τους παραπάνω</li>
                <button type="submit" class="btn btn-primary" name="votenow">Υποβολή</button>
            </form>
            <?php
        }

        ?>
    </ul>

</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
