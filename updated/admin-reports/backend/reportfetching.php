<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdodatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query1 = "SELECT COUNT(*) AS total_appointments FROM appointment";
$result = $conn->query($query1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalappointment = $row["total_appointments"];
} else {
    $totalappointment = 0;
}
$result->free();
$current_year = date('Y');
$current_month = date('m');

$current_year = date('Y');
$current_month = date('m');
$query_weekly = "SELECT FLOOR((DAY(Time_Created)-1)/7)+1 AS week_number, COUNT(*) AS total_appointments 
                FROM appointment 
                WHERE YEAR(Time_Created) = $current_year 
                AND MONTH(Time_Created) = $current_month 
                GROUP BY week_number";
$result_weekly = $conn->query($query_weekly);
$weekly_data = array();

if ($result_weekly) {
    while ($row = $result_weekly->fetch_assoc()) {
        $weekly_data[$row["week_number"]] = $row["total_appointments"];
    }
} else {
    $weekly_data = array(); 
}


$result_weekly->free();
$current_week = floor((date('j') - 1) / 7) + 1;


if (isset($weekly_data[$current_week])) {
    $total_appointments_current_week = $weekly_data[$current_week];
} else {
    $total_appointments_current_week = 0;
}

$current_year = date('Y');

$monthly_data = array();
$query_monthly = "SELECT MONTH(Time_Created) AS month_number, COUNT(*) AS monthly
                  FROM appointment 
                  WHERE YEAR(Time_Created) = $current_year 
                  GROUP BY MONTH(Time_Created)";
$result_monthly = $conn->query($query_monthly);
$monthly_data = array();

if ($result_monthly) {
    while ($row = $result_monthly->fetch_assoc()) {
        $monthly_data[$row["month_number"]] = $row["monthly"];
    }
    $result_monthly->free();
}

for ($i = 1; $i <= 12; $i++) {
    if (!isset($monthly_data[$i])) {
        $monthly_data[$i] = 0;
    }
}
ksort($monthly_data); 


$current_year = date('Y');
$current_month = date('n');

$query_current_month = "SELECT COUNT(*) AS appointments
                        FROM appointment 
                        WHERE YEAR(Time_Created) = $current_year 
                        AND MONTH(Time_Created) = $current_month";

$result_current_month = $conn->query($query_current_month);

if ($result_current_month) {
    $row = $result_current_month->fetch_assoc();
    $result_month = $row["appointments"];
    $result_current_month->free();
} else {
    $result_month = 0; // No appointments for the current month
}



$service_query = "SELECT 
                        s.Service_ID, 
                        s.Service_Name, 
                        COUNT(a.Service_ID) AS service_count,
                        AVG(CASE WHEN DATE_FORMAT(a.Time_Created, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') THEN 1 ELSE 0 END) AS daily_count,
                        AVG(CASE WHEN YEARWEEK(a.Time_Created) = YEARWEEK(CURDATE()) THEN 1 ELSE 0 END) AS weekly_count,
                        AVG(CASE WHEN YEAR(a.Time_Created) = YEAR(CURDATE()) THEN 1 ELSE 0 END) AS monthly_count
                    FROM 
                        service AS s
                    LEFT JOIN 
                        appointment AS a ON s.Service_ID = a.Service_ID
                    GROUP BY 
                        s.Service_ID, 
                        s.Service_Name";
$service_result = $conn->query($service_query);


if ($service_result === false) {
    echo "Error: " . $conn->error;
} else {
    $service_names = [];
    $daily_counts = [];
    $weekly_counts = [];
    $monthly_counts = [];
    while ($row = $service_result->fetch_assoc()) {
        $service_names[] = $row['Service_Name'];
        $daily_counts[] = $row['daily_count'];
        $weekly_counts[] = $row['weekly_count'];
        $monthly_counts[] = $row['monthly_count'];
    }
}

$most_availed_query = "SELECT 
                            s.Service_ID, 
                            s.Service_Name, 
                            COUNT(a.Service_ID) AS availed_count
                        FROM 
                            service AS s
                        LEFT JOIN 
                            appointment AS a ON s.Service_ID = a.Service_ID
                        GROUP BY 
                            s.Service_ID, 
                            s.Service_Name
                        ORDER BY 
                            availed_count DESC
                        LIMIT 5";

$most_availed_result = $conn->query($most_availed_query);

$services = array(); // Initialize an empty array to store the fetched data

if ($most_availed_result->num_rows > 0) {
    while ($row = $most_availed_result->fetch_assoc()) {
        $services[] = $row; // Append each row to the $services array
    }
}


$conn->close();
?>
