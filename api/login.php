<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['cardNO'])) {
    $cardNO = $_POST['cardNO'];
    $sql = "select * from READER where READERID = $cardNO";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){
            $res->name = $row["RNAME"];
            setcookie("logged_in",$row["READERID"],time()+3000,'/');
        }

    }
    else{
        $res->error = "Invalid reader ID. Please try again.";
    }
}
if(!$res){
    $res->error = "Unknown error occurred. Please try again later.";
}
echo json_encode($res);
$conn->close();
?>
