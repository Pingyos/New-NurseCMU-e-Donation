<?php
session_start();

if (!isset($_SESSION['login_info'])) {
    header("Location: https://app.nurse.cmu.ac.th/edonation/oauth/login.php");
    exit;
}
$jsonData = isset($_GET['data']) ? urldecode($_GET['data']) : null;
$data = json_decode($jsonData, true);
if ($data !== null) {
    $loginInfo = $data['login_info'];
    $status = $data['status'];
    echo "Login Info:<br>";
    echo "Name: " . $loginInfo['firstname_EN'] . "<br>";
    echo "Surname: " . $loginInfo['lastname_EN'] . "<br>";
    echo "Organization: " . $loginInfo['organization_name_EN'] . "<br>";
    echo "CMU IT Account: " . $loginInfo['cmuitaccount'] . "<br>";
    echo "IT Account Type (EN): " . $loginInfo['itaccounttype_EN'] . "<br>";

    echo "<br>";

    echo "Status: " . $status . "<br>";
} else {
    echo "Invalid or missing JSON data";
}
