<?php
/**
 * Created by PhpStorm.
 * User: geotom
 * Date: 10/12/18
 * Time: 11:03 PM
 */

class Votes
{

    function __construct(){
            $this->servername = "DATABASE HOST";
            $this->username = "DATABASE USERNAME";
            $this->password = 'DATABASE PASSWORD';
            $this->dbname = "DATABASE NAME";
    }


    function checkSystemStatus(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn,"utf8");
        if ($conn->connect_error) {
            return "conn_failed";
        }

        $sql = "SELECT * FROM settings";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
               if($row['SettingName'] == "systemstatus" && $row['SettingValue'] == "on"){
                   return "system_ready";
               }else{
                   $sql_msg = "SELECT * FROM settings WHERE SettingName='systemstatus_msg'";
                   $result_msg = $conn->query($sql_msg);
                   $row_msg = $result->fetch_row();
                   return $row_msg[2]; //Get the value
               }
            }

            // output data of each row
            /*while($row = $result->fetch_assoc()) {
                if($row['SettingName'] == "on"){
                    return "system_ready";
                }else{
                    return $row['systemstatus_msg'];
                }
            }*/
        } else {
            return "systemstatus_error";
        }
    }

    function checkVoteCode($code)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $code_secure = htmlspecialchars(mysqli_escape_string($conn, $code));

        if ($conn->connect_error) {
            return "conn_failed";
        }

        $sql = "SELECT * FROM codes WHERE VoteCode='$code_secure'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if ($row['VoteCodeStatus'] == "active") {
                    return "vote_continue";
                }else{
                    return "vote_error";
                }
            }

        }else{
            return "vote_error";
        }

    }

    function getPeopleList(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");

        $sql = "SELECT * FROM people ORDER BY FullName ASC ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $people_list = array();
            while ($row = $result->fetch_assoc()) {
                $ID_Array[] = $row['ID'];
                $FullName_Array[] = $row['FullName'];
                $Department_Array[] = $row['Department'];
                $VotesCount_Array[] = $row['VoteCount'];

            }

            if(mysqli_num_rows($result) > 1){
                $return_data = array();
                for ($x = 0; $x <= mysqli_num_rows($result); $x++) {
                    if($x >= mysqli_num_rows($result)){
                        break;
                    }
                    array_push($return_data, $ID_Array[$x]."<@>".$FullName_Array[$x]."<@>".$Department_Array[$x]."<@>".$VotesCount_Array[$x]);
                }
                return $return_data;
            }else{
                $return_data = array();
                for ($x = 0; $x <= mysqli_num_rows($result); $x++) {
                    if($x >= mysqli_num_rows($result)){
                        break;
                    }
                    array_push($return_data, $ID_Array[$x]."<@>".$FullName_Array[$x]."<@>".$Department_Array[$x]."<@>".$VotesCount_Array[$x]);
                }
                return $return_data;
            }

        }else{
            return "vote_error";
        }
    }

    function checkVoteCodeStatus($votecode){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $code_secure = htmlspecialchars(mysqli_escape_string($conn, $votecode));

        $sql = "SELECT * FROM codes WHERE VoteCode='$code_secure'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if ($row['VoteCodeStatus'] == "active") {
                    return "vote_active";
                }else{
                    return "vote_locked";
                }
            }

        }else{
            return "vote_locked";
        }
    }

    function addVote($people_array){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $checklist = array();
        foreach ($people_array as $votesfinal){
            if($votesfinal != "nothing"){
                $sql = "SELECT * FROM people WHERE ID='$votesfinal'";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    return "vote_error";
                }

                $row = mysqli_fetch_row($result);

                $previous_count = $row[3];

                $finalcount = $previous_count + 1;

                echo $sql_update = "UPDATE people SET VoteCount='$finalcount' WHERE ID='$votesfinal'";

                if ($conn->query($sql_update) === TRUE) {
                    array_push($checklist, "ok");
                } else {
                    array_push($checklist, "error");
                }

            }
        }
        return $checklist;
    }

    function checkSuccess($array, $match){
        $count = 0;

        foreach ($array as $key => $value)
        {
            if ($value == $match)
            {
                $count++;
            }
        }

        return $count;
    }

    function CancelCode($votecode){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $votecode_secure = htmlspecialchars(mysqli_escape_string($conn, $votecode));

        $sql = "UPDATE codes SET VoteCodeStatus='locked' WHERE VoteCode='$votecode_secure'";

        if ($conn->query($sql) === TRUE) {
            return "code_destroyed";
        } else {
            return "code_failed_destroy";
        }

    }

    function getStatistics(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");

        $sql = "SELECT * FROM people ORDER BY VoteCount DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $people_list = array();
            while ($row = $result->fetch_assoc()) {
                $ID_Array[] = $row['ID'];
                $FullName_Array[] = $row['FullName'];
                $Department_Array[] = $row['Department'];
                $VotesCount_Array[] = $row['VoteCount'];

            }

            if(mysqli_num_rows($result) > 1){
                $return_data = array();
                for ($x = 0; $x <= mysqli_num_rows($result); $x++) {
                    if($x >= mysqli_num_rows($result)){
                        break;
                    }
                    array_push($return_data, $ID_Array[$x]."<@>".$FullName_Array[$x]."<@>".$Department_Array[$x]."<@>".$VotesCount_Array[$x]);
                }
                return $return_data;
            }else{
                $return_data = array();
                for ($x = 0; $x <= mysqli_num_rows($result); $x++) {
                    if($x >= mysqli_num_rows($result)){
                        break;
                    }
                    array_push($return_data, $ID_Array[$x]."<@>".$FullName_Array[$x]."<@>".$Department_Array[$x]."<@>".$VotesCount_Array[$x]);
                }
                return $return_data;
            }

        }else{
            return "vote_error";
        }
    }

    function getMaxVotesID($maxcount){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $count_secure = htmlspecialchars(mysqli_escape_string($conn, $maxcount));
        $maxids = array();

        $sql = "SELECT * FROM people WHERE VoteCount='$count_secure'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                array_push($maxids, $row['ID']);
            }
            return $maxids;

        }
    }

    function getTotalVotes(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn, "utf8");
        $sql = "SELECT SUM(VoteCount) FROM people";
        $result = $conn->query($sql);
        $num_rows = $result->fetch_row();
        return $num_rows[0];

    }
}

