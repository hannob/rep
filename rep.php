<?php
// SPDX-License-Identifier: 0BSD

require_once("config.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    // Required for Reporting-Endpoints
    header("Access-Control-Allow-Headers: content-type");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");
}

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postdata = file_get_contents("php://input");

    if ($postdata) {
        $msg .= "Data:\n";
        $msg .= json_encode(json_decode($postdata), JSON_PRETTY_PRINT);
    }

    if ($_POST) {
        $msg .= "\nPOST:\n";
        $msg .= print_r($_POST, true);
    }
    if ($_GET) {
        $msg .= "\nGET:\n";
        $msg .= print_r($_GET, true);
    }
    $msg .= "\nServer variables:\n";
    $msg .= print_r($_SERVER, true);

    mail($_mailto, "HTTPREP", $msg, ["X-Http-Reporting" => "1"]);
}

?><!DOCTYPE html><html><head><title>&nbsp;</title>
<meta name="robots" content="noindex">
