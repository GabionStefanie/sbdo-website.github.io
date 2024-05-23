
-- Create patients table
CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    profile_picture VARCHAR(255)
);

-- Create transactions table
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    date DATE NOT NULL,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status ENUM('DONE', 'RESCHED', 'CANCELLED') NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- Insert sample data into patients table
INSERT INTO patients (username, email, phone_number, profile_picture) VALUES
('JohnDoe', 'john.doe@example.com', '123-456-7890', 'path/to/profile_picture.jpg'),
('JaneDoe', 'jane.doe@example.com', '098-765-4321', 'path/to/profile_picture.jpg');

-- Insert sample data into transactions table
INSERT INTO transactions (patient_id, date, name, amount, status) VALUES
(1, '2023-05-20', 'Teeth Cleaning', 75.00, 'DONE'),
(1, '2023-06-15', 'Cavity Filling', 150.00, 'RESCHED'),
(2, '2023-04-10', 'Root Canal', 300.00, 'CANCELLED'),
(2, '2023-04-25', 'Tooth Extraction', 200.00, 'DONE');
