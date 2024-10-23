CREATE TABLE customers (
    customers_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(32),
    last_name VARCHAR(32),
    age INT,
    gender VARCHAR(32),
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    customers_id INT,  
    service_name VARCHAR(64),  
    service_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
