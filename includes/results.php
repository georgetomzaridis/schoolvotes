<?php
session_start();
include 'autoload.php';
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
    <meta property="og:url" content="https://schoolvotes.gaiagas.gr/" />
    <meta property="og:image" content="https://schoolvotes.gaiagas.gr/img/preview.jpg" />
    <title>Σύστημα Ηλεκτρονικής Ψηφοφορίας | 3 ΓΕΛ ΕΥΟΣΜΟΥ</title>
    <meta http-equiv="refresh" content="300;url=https://schoolvotes.gaiagas.gr/live" />

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/landing-page.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>

<body>
<div class="jumbotron" style="text-align: center;">
    <?php
    date_default_timezone_set("Europe/Athens");
    ?>
    <h3>Σύνολο Ψήφων: <?php echo $Votes->getTotalVotes(); ?></h3>
    <h4>Τελευταία Ενημέρωση Στατιστικών: <?php echo date("h:i:sa"); ?></h4>
    <h5>Η ροη ανανεώνεται αυτόματα κάθε 5 λεπτα</h5>
    <div class="row">
        <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <ul class="list-group" style="text-align: center; max-width: 550px; margin: auto; width: 100%;">
                    <?php
                    $get_people_list = $Votes->getStatistics();
                    $maxvote_list = array();
                    if($get_people_list != "vote_error"){
                        ?>
                        <form action="" method="POST">
                            <?php

                            foreach ($get_people_list as $value) {
                                $final = explode("<@>", $value);
                                array_push($maxvote_list, $final[3]);
                            }
                            $max_count_vote = max($maxvote_list);
                            $maxvote_arr = $Votes->getMaxVotesID($max_count_vote);
                            foreach ( $get_people_list as $value) {
                                $final = explode("<@>", $value);
                                if(count($maxvote_arr) > 1){
                                    if(in_array($final[0], $maxvote_arr)) {
                                        ?>
                                        <li class="list-group-item active"><span class="badge badge-danger" style="font-size: 20px;"><?php echo $final[3]; ?></span> <?php echo $final[1]; ?> <?php echo $final[2]; ?>
                                        </li>
                                        <?php
                                    }else{
                                        ?>
                                        <li class="list-group-item"><span class="badge badge-primary" style="font-size: 20px;"><?php echo $final[3]; ?></span> <?php echo $final[1]; ?> <?php echo $final[2]; ?></li>
                                        <?php

                                    }
                                }else{
                                    ?>
                                    <li class="list-group-item"><span class="badge badge-primary" style="font-size: 20px;"><?php echo $final[3]; ?></span> <?php echo $final[1]; ?> <?php echo $final[2]; ?></li>
                                    <?php
                                }


                            }

                            ?>
                        </form>
                        <?php
                    }

                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart_div" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                var data = google.visualization.arrayToDataTable([
                    ['Ονόματα', 'Ψήφοι'],
                    <?php
                    $get_people_list = $Votes->getStatistics();
                    if($get_people_list != "vote_error"){
                        foreach ($get_people_list as $value) {
                            $final = explode("<@>", $value);
                            $getfullname = explode(" ", $final[1]);
                            ?>
                            ['<?php echo $getfullname[0]; ?>',  <?php echo $final[3];?>],
                            <?php
                        }
                    }
                    ?>

                    ['',  '']
                ]);

                var options = {
                    title : 'Γράφημα Κατάταξης',
                    vAxis: {title: 'Συνολικοί Ψήφοι'},
                    hAxis: {title: 'Ονόματα'},
                    seriesType: 'bars',
                    series: {6: {type: 'line'}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>


</div>
</body>
</html>
