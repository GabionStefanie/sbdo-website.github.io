<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Contact Us | Sulit & Bagasan Dental Office</title>
		<link rel="stylesheet" type="text/css" href="css/admin-reports[service]-css.css">
		<style>
    		<?php include '../header-footer/header-footer.css' ?>
		</style>
	</head>
	<body>
	<?php include 'backend/reportfetching.php' ?>
		<div class="wrapper">
		<?php include '../header-footer/header.php' ?>
		<div class="reports-title">REPORTS</div>
		<div class="container-clients-services">
			<div class="undercolor"></div>
			<div class="clients-and-services">
				<div class="clients-text">
					<a href="admin--reports [clients]-page.php">
						<p>APPOINTMENTS</p>
					</a>
				</div>
				<div class="services-text">
					<a href="admin-reports[services]-page.php">
						<p>SERVICES</p>
					</a>
				</div>
			</div>
			<div class="graphs">            
				<div class="upper">
					<div class="complicaterchart">
						<canvas id="myChart3"></canvas>
					</div>
				</div>
				<div class="lower">
					<div class="table">
    			<table>
        <thead>
			<tr><th colspan="2">MOST AVAILED TYPE OF SERVICE</th></tr>
            <tr>
                <td>Name</td>
                <td>NO.</td>
            </tr>
        </thead>
        <tbody>
		<?php
  
			 if (!empty($services)) { 
				 foreach ($services as $service) {
					 echo "<tr>";
					 echo "<td>" . $service['Service_Name'] . "</td>";
					 echo "<td>" . $service['availed_count'] . "</td>";
					 echo "</tr>";
				 }
			 } else {
				 echo "<tr><td colspan='2'>No data available.</td></tr>";
			 }
            ?>
        </tbody>
    </table>
</div>
				</div>
			</div>
		</div>
		<?php include '../header-footer/footer.php' ?>
		</div>
	</body>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const data = {
  labels: <?php echo json_encode($service_names); ?>,
  datasets: [
    {
      label: 'DAILY',
      data: <?php echo json_encode($daily_counts); ?>, 
      backgroundColor: 'green',
      borderColor: 'green',
      borderWidth: 1
    },
    {
      label: 'WEEKLY',
      data: <?php echo json_encode($weekly_counts); ?>, 
      backgroundColor: 'orange',
      borderColor: 'orange',
      borderWidth: 1
    },
    {
      label: 'MONTHLY',
      data: <?php echo json_encode($monthly_counts); ?>,
      backgroundColor: '#0D98BA',
      borderColor: '#0D98BA',
      borderWidth: 1
    }
  ]
};

const config = {
  type: 'pie',
  data: data,
  options: {
    indexAxis: 'y',
    elements: {
      bar: {
        borderWidth: 1,
      }
    },
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom',
		labels: {
          boxWidth: 10,
        }
      },
      title: {
        display: true,
        text: ''
      }
    }
  },
};
var ctx = document.getElementById('myChart3').getContext('2d');


var myChart = new Chart(ctx, config);
</script>
</html>
