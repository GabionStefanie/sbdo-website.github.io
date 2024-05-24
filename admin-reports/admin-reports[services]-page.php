<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="css/admin-reports[services]-css.css">
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
        <!-- Display bar graph for monthly, weekly, and daily availed services -->
        <div class="graphs">            
            <canvas id="servicesBarChart" width="400" height="200"></canvas>
        </div>
        <!-- Display table for top 5 services availed -->
        <div class="top-services-table">
            <h2>Top 5 Services Availed</h2>
            <table>
                <tr>
                    <th>Service Name</th>
                    <th>Total Count</th>
                </tr>
                <?php foreach ($topServices ?? [] as $service): ?>
						<tr>
					<td><?php echo $service['Service_Name']; ?></td>
					<td><?php echo $service['Total_Count']; ?></td>
				</tr>
			<?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php include '../header-footer/footer.php' ?>
</div>

<!-- JavaScript code to draw bar graph -->
<script>
    const monthlyServices = <?php echo json_encode($monthlyServices); ?>;
    const weeklyServices = <?php echo json_encode($weeklyServices); ?>;
    const dailyServices = <?php echo json_encode($dailyServices); ?>;

    const serviceNames = monthlyServices.map(service => service.Service_Name);
    const monthlyCounts = monthlyServices.map(service => service.Monthly_Count);
    const weeklyCounts = weeklyServices.map(service => service.Weekly_Count);
    const dailyCounts = dailyServices.map(service => service.Daily_Count);

    const ctx = document.getElementById('servicesBarChart').getContext('2d');
    const servicesBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: serviceNames,
            datasets: [
                {
                    label: 'Monthly Count',
                    data: monthlyCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Weekly Count',
                    data: weeklyCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Daily Count',
                    data: dailyCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
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
</script>
</body>
</html>
