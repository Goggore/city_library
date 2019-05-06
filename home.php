<?php
if (isset($_COOKIE['logged_in'])) {
    $user = $_COOKIE['logged_in'];
    if (($user) == "admin"){
        include "admin.html";
    }else{
        include "reader.html";
    }
}
