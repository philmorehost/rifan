<?php
include_once("fconfig.php");

if (isset($_GET['farmers'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=farmers.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Code', 'Name', 'Email', 'Phone', 'NIN', 'BVN', 'LGA', 'Farm Location', 'Address'));

    $query = "SELECT code, fullname, email, phone, nin, bvn, lga, farm_location, address FROM " . $db_json["farmer_table"] . " ORDER BY date DESC";
    $result = mysqli_query($db_conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

if (isset($_GET['agents'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=agents.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Code', 'Name', 'Email', 'Phone', 'LGA', 'Address'));

    $query = "SELECT code, fullname, email, phone, lga, address FROM " . $db_json["agent_table"] . " ORDER BY date DESC";
    $result = mysqli_query($db_conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

header("Location: index.php");
exit();
