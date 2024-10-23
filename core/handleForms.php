<?php
require_once 'dbConfig.php';
require_once 'functions.php';

if (isset($_POST['addCustomerButton'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $function = addCustomer($pdo, $first_name, $last_name, $age, $gender);
    if ($function) {
        header("Location: ../index.php");
    } else {
        echo "<h2>Customer addition failed.</h2>";
        echo '<a href="../index.php">';
        echo '<input type="button" id="returnHomeButton" value="Return to home page" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}

if (isset($_POST['editCustomerButton'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $customer_id = $_GET['customers_id'];

    $function = updateCustomer($pdo, $first_name, $last_name, $age, $gender, $customer_id);
    if ($function) {
        header("Location: ../index.php");
    } else {
        echo "<h2>Customer editing failed.</h2>";
        echo '<a href="../index.php">';
        echo '<input type="button" id="returnHomeButton" value="Return to home page" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}

if (isset($_POST['removeCustomerButton'])) {
    $customer_id = $_GET['customers_id'];

    $function = removeCustomer($pdo, $customer_id);
    if ($function) {
        header("Location: ../index.php");
    } else {
        echo "<h2>Customer removal failed.</h2>";
        echo '<a href="../index.php">';
        echo '<input type="button" id="returnHomeButton" value="Return to home page" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}

if (isset($_POST['editServiceButton'])) {
    $service_name = trim($_POST['service_name']);
    $service_date = $_POST['service_date'];
    $service_id = $_GET['service_id'];

    $function = updateService($pdo, $service_name, $service_date, $service_id);
    if ($function) {
        header("Location: ../viewServices.php?customers_id=" . $_GET['customers_id']);
    } else {
        echo "<h2>Service editing failed.</h2>";
        echo '<a href="../viewServices.php?customers_id=' . $_GET['customers_id'] . '">';
        echo '<input type="button" id="returnHomeButton" value="Return to services list" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}

if (isset($_POST['addServiceButton'])) {
    $customers_id = $_GET['customers_id'];
    $service_name = trim($_POST['services']);
    $service_date = $_POST['service_date'];

    $function = addService($pdo, $customers_id, $service_name, $service_date);
    if ($function) {
        header("Location: ../viewServices.php?customers_id=" . $customers_id);
    } else {
        echo "<h2>Service addition failed.</h2>";
        echo '<a href="../viewServices.php?customers_id=' . $customers_id . '">';
        echo '<input type="button" id="returnHomeButton" value="Return to services list" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}

if (isset($_POST['removeServiceButton'])) {
    $service_id = $_GET['service_id']; 

    $function = removeService($pdo, $service_id);
    if ($function) {
        header("Location: ../viewServices.php?customers_id=" . $_GET['customers_id']); 
    } else {
        echo "<h2>Service removal failed.</h2>";
        echo '<a href="../viewServices.php?customers_id=' . $_GET['customers_id'] . '">';
        echo '<input type="button" id="returnHomeButton" value="Return to services list" style="padding: 6px 8px; margin: 8px 2px;">';
        echo '</a>';
    }
}
?>
