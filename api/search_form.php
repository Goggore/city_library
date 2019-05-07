<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['value'],$_POST['searchBy'],$_POST['searchType'])
    &&$_POST['searchBy']!=""&&$_POST['value']!=""&&$_POST['searchType']!="") {
    $value = $_POST['value'];
    $searchBy = $_POST['searchBy'];
    $searchType = $_POST['searchType'];
    if ($searchType == "searchDoc"){
        switch ($searchBy){
            case "docid":
                $sql = "SELECT *
                        FROM DOCUMENT
                        WHERE DOCID = $value;
                        ";
                break;
            case "title":
                $sql = "SELECT *
                        FROM DOCUMENT
                        WHERE TITLE = '$value';
                        ";
                break;
            case "pname":
                $sql = "SELECT D.DOCID,D.TITLE,D.PDATE,D.PUBLISHERID
                        FROM DOCUMENT AS D, PUBLISHER AS P
                        WHERE D.PUBLISHERID = P.PUBLISHERID AND P.PUBNAME = '$value';
                        ";
                break;
            default:
                $res->error = "Unknown error occurred. Please try again later.";
        }

        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $res->msg = "";
            $i = 1;
            while($row = $result->fetch_array()){
                $res->msg = $res->msg.$i.". "."Document ID: ".$row[0].", Title: ".$row[1].", Publication Date:".$row[2].", Publisher ID:".$row[3]."\n";
                $i++;
            }
        }else{
            $res->error = "No result";
        }
    }else if($searchType == "searchPub"){
        $sql = "SELECT DOCID, TITLE
FROM DOCUMENT AS D, PUBLISHER AS P
WHERE D.PUBLISHERID = P.PUBLISHERID AND P.PUBLISHERID = $value
";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $res->msg = "";
            $i = 1;
            while($row = $result->fetch_array()){
                $res->msg = $res->msg.$i.". "."Document ID: ".$row[0].", Title: ".$row[1]."\n";
                $i++;
            }
        }else{
            $res->error = "No result";
        }

    }else{
        $res->error = "Unknown error occurred. Please try again later.";
    }
}
else{
    $res->error = "Please provide required information";
}
echo json_encode($res);
$conn->close();
?>
