<?php
require_once 'dbConfig.php';

function getAllCustomers($pdo) {
    $query = "SELECT * FROM customers";
    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute();
    
    if ($executeQuery) {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function getCustomerByID($pdo, $customers_id) {
    if (!is_numeric($customers_id)) {
        throw new InvalidArgumentException("Customer ID must be numeric");
    }
    
    $query = "SELECT * FROM customers WHERE customers_id = ?";
    $statement = $pdo->prepare($query);
    
    if ($statement->execute([$customers_id])) {
        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    return null;
}

function getServicesByCustomersID($pdo, $customers_id) {
    if (!is_numeric($customers_id)) {
        throw new InvalidArgumentException("Customer ID must be numeric");
    }

    $query = "SELECT * FROM services WHERE customers_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$customers_id]);
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getServiceByID($pdo, $service_id) {
    if (!is_numeric($service_id)) {
        throw new InvalidArgumentException("Service ID must be numeric");
    }

    $query = "SELECT * FROM services WHERE service_id = ?";
    $statement = $pdo->prepare($query);
    
    if ($statement->execute([$service_id])) {
        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    return null;
}

function addCustomer($pdo, $first_name, $last_name, $age, $gender) {
    $query = "INSERT INTO customers (first_name, last_name, age, gender, date_registered) VALUES (?, ?, ?, ?, NOW())";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$first_name, $last_name, $age, $gender]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}

function updateCustomer($pdo, $first_name, $last_name, $age, $gender, $customers_id) {
    if (!is_numeric($customers_id)) {
        throw new InvalidArgumentException("Customer ID must be numeric");
    }

    $query = "UPDATE customers SET first_name = ?, last_name = ?, age = ?, gender = ? WHERE customers_id = ?";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$first_name, $last_name, $age, $gender, $customers_id]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}

function removeCustomer($pdo, $customers_id) {
    if (!is_numeric($customers_id)) {
        throw new InvalidArgumentException("Customer ID must be numeric");
    }

    $query = "DELETE FROM customers WHERE customers_id = ?";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$customers_id]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}

function addService($pdo, $customers_id, $service_name, $service_date) {
    if (!is_numeric($customers_id)) {
        throw new InvalidArgumentException("Customer ID must be numeric");
    }

    $query = "INSERT INTO services (customers_id, service_name, service_date) VALUES (?, ?, ?)";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$customers_id, $service_name, $service_date]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}

function updateService($pdo, $service_name, $service_date, $service_id) {
    if (!is_numeric($service_id)) {
        throw new InvalidArgumentException("Service ID must be numeric");
    }

    $query = "UPDATE services SET service_name = ?, service_date = ? WHERE service_id = ?";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$service_name, $service_date, $service_id]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}

function removeService($pdo, $service_id) {
    if (!is_numeric($service_id)) {
        throw new InvalidArgumentException("Service ID must be numeric");
    }

    $query = "DELETE FROM services WHERE service_id = ?";
    $statement = $pdo->prepare($query);
    
    try {
        $executeQuery = $statement->execute([$service_id]);
        return $executeQuery;
    } catch (Exception $e) {
        return false;
    }
}
?>
