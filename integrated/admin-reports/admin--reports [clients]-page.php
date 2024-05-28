<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Contact Us | Sulit & Bagasan Dental Office</title>
		<link rel="stylesheet" type="text/css" href="css/admin--reports [clients]-css.css">
		<style>
    		<?php include '../header-footer/header-footer.css';?>
			
		</style>
	</head>
	<body>
	<div class="wrapper">
		<?php include '../header-footer/header.php' ?>
		<?php include 'backend/reportfetching.php' ?>
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
				<div class="firstlayer">
					<div>
						<h2>TOTAL APPOINTMENTS:<br><br><h1><?php echo isset($totalappointment) ? $totalappointment: 0; ?></h1></h2>
						<h2></h2>
					</div>
				</div>
				<div class="secondlayer">
					<div class="details">
						<div>
							<h2>TOTAL APPOINTMENTS THIS WEEK:<br><h1><?php echo $total_appointments_current_week ?> </h1></h2>
							<h2></h2>
						</div>
					</div>
					<div class="firstline">
					<canvas id="myChart"></canvas>
					</div>
				</div>
				<div class="thirdlayer">
					<div class="secondline">
						<canvas id="myChart1"></canvas>
					</div>
					<div class="details">
						<div>
							<h2>TOTAL APPOINTMENTS THIS MONTH<BR><h1><?php echo isset($result_month) ? $result_month: 0; ?></h1> </h2>
							<h2></h2>
						</div>
					</div>
				</div>

			
			</div>
		</div>
		<?php include '../header-footer/footer.php' ?>
		</div>
	</body>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('myChart');
<?php
if (isset($weekly_data) && !empty($weekly_data)) {
    echo "var weeklyData = " . json_encode($weekly_data). ";";
} else {
    echo "var weeklyData = {};";
}
?>

const labels = [];
const data = [];
let weeksCount = 5;


for (let weekNumber in weeklyData) {
    if (weeklyData.hasOwnProperty(weekNumber)) {
        weeksCount = Math.max(weeksCount, parseInt(weekNumber));
    }
}

for (let i = 1; i <= weeksCount; i++) {
    labels.push('Week ' + i);

    if (weeklyData[i]) {
        data.push(weeklyData[i]);
    } else {
        data.push(0);
    }
}

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: "",
            data: data,
			borderColor: 'red', 
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
		plugins: {
			title: {
                display: true,
                text: '<?php echo date('M - Y'); ?>',
                font: {
                    size: 20
                }
            },
            legend: {
                labels: {
                    boxWidth: 0
                }
            }
        }
    }
});
var monthlyData = <?php echo json_encode($monthly_data); ?>;


var appointmentCounts = [];
for (var i = 1; i <= 12; i++) {
	appointmentCounts.push(monthlyData[i] || 0); 
}


const ctx1 = document.getElementById('myChart1');

new Chart(ctx1, {
	type: 'line',
	data: {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		datasets: [{
			label: '',
			data: appointmentCounts,
			borderWidth: 1,
			borderColor: '#0D98BA', 
			backgroundColor: 'rgba(75, 192, 192, 0.2)', 
		}]
	},
	options: {
		scales: {
			x: {
                ticks: {
                    autoSkip: false, 
                    maxRotation: 45, 
                    minRotation: 45, 
					fontSize: 20
                }
            },
			y: {
				beginAtZero: true
			}
		},
		plugins: {
			title: {
                display: true,
                text: 'Months',
                font: {
                    size: 20 
                }
            },
            legend: {
                labels: {
                    boxWidth: 0
                }
            }
			
        } 
	}
}); 
</script>



</html>

