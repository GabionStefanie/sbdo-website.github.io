<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="css/admin--reports [clients]-css.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../header-footer/header.php' ?>
    <div class="reports-title">REPORTS</div>
    <div class="container-clients-services">
        <div class="undercolor"></div>
        <div class="clients-and-services">
            <div class="clients-text">
                <a href="admin--reports [clients]-page.php">
                    <p>CLIENTS</p>
                </a>
            </div>
            <div class="services-text">
                <a href="admin-reports[services]-page.php">
                    <p>SERVICES</p>
                </a>
            </div>
        </div>
        <!-- Add a canvas element for the line graph -->
        <div class="graphs">
            <canvas id="monthlyAppointmentsChart" width="400" height="200"></canvas>
        </div>
    </div>
    <?php include '../header-footer/footer.php' ?>
</div>

<!-- JavaScript code to fetch data and draw line graph -->
<script>
   // Function to fetch data from the server
function fetchData() {
    // Make an AJAX request to fetch data
    // Replace 'your_endpoint_url' with the actual endpoint URL to fetch data
    fetch('your_endpoint_url')
        .then(response => response.json())
        .then(data => {
            // Extract data for monthly appointments, total clients, and clients per week
            const monthlyAppointmentsData = data.monthlyAppointments;
            const totalClientsData = data.totalClients;
            const clientsPerWeekData = data.clientsPerWeek;

            // Extract days and appointment counts for monthly appointments
            const days = monthlyAppointmentsData.map(entry => entry.day);
            const appointmentCounts = monthlyAppointmentsData.map(entry => entry.appointment_count);

            // Extract week numbers and client counts for clients per week
            const weeks = clientsPerWeekData.map(entry => entry.week);
            const clientCountsPerWeek = clientsPerWeekData.map(entry => entry.clients_count);

            // Draw the line graph using Chart.js for monthly appointments
            drawLineGraph(days, appointmentCounts, weeks, clientCountsPerWeek);

            // Display the total number of clients
            document.getElementById('totalClients').innerText = `Total Clients: ${totalClientsData.total_clients}`;
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Function to draw line graph using Chart.js
function drawLineGraph(days, appointmentCounts, weeks, clientCountsPerWeek) {
    const ctx = document.getElementById('monthlyAppointmentsChart').getContext('2d');
    const monthlyAppointmentsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Monthly Appointments',
                data: appointmentCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Clients Per Week',
                data: clientCountsPerWeek,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// Call the fetchData function to fetch data and draw the line graph
fetchData();

</script>
</body>
</html>
