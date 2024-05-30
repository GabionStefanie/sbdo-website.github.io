<?php
use pChart\pData; // Add this line
use pChart\pPie; // Add this line
use pChart\pCharts; // Add this line
use pChart\pDraw; // Add this line

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the dompdf and pChart libraries
    require_once '../../dompdf/autoload.inc.php';
    require_once '../../pChart2.0-for-PHP7-master/pChart/pData.php'; // Corrected path
    require_once '../../pChart2.0-for-PHP7-master/pChart/pDraw.php'; // Corrected path
    require_once '../../pChart2.0-for-PHP7-master/pChart/pPie.php'; // Corrected path
    require_once '../../pChart2.0-for-PHP7-master/pChart/pCharts.php'; // Corrected path
    
    // Fetch your data
    include 'backend/reportfetching.php';
    
    // Create a new pChart pData object
    $chartData = new pData();
    
    // Add data to the chart
    $chartData->addPoints(array(1, 3, 4, 3, 5), "SerieName");
    
    // Create a new pChart object
    $chart = new pCharts(300, 300); // Add this line
    
    // Draw the background
    $chart->drawFilledRectangle(0,0,300,300,["R"=>255,"G"=>255,"B"=>255]);
    
    // Create a pPie object
    $draw = new pDraw(300, 300); // Add this line with the desired width and height
    $pie = new pPie($draw); // Replace $chart with $draw
    
    // Draw a 2D pie chart
    $pie->draw2DPie(150, 150, ["DataGapAngle"=>10,"DataGapRadius"=>10,"Border"=>TRUE]);
    
    // Save the chart image
    $chartImagePath = "chart.png";
    $chart->render($chartImagePath);

    // Create HTML content for the PDF
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Report</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="reports-title">REPORTS</div>
            <div class="container-clients-services">
                <div class="undercolor"></div>
                <div class="clients-and-services">
                    <div class="clients-text">
                        <p>APPOINTMENTS</p>
                    </div>
                    <div class="services-text">
                        <p>SERVICES</p>
                    </div>
                </div>
                <div class="graphs">            
                    <div class="upper">
                        <div class="complicaterchart">
                            <img src="' . $chartImagePath . '" alt="Chart">
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
                                <tbody>';

    if (!empty($services)) { 
        foreach ($services as $service) {
            $html .= '<tr>';
            $html .= '<td>' . $service['Service_Name'] . '</td>';
            $html .= '<td>' . $service['availed_count'] . '</td>';
            $html .= '</tr>';
        }
    } else {
        $html .= '<tr><td colspan="2">No data available.</td></tr>';
    }

    $html .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>';

    // Initialize dompdf
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF
    $dompdf->stream('report.pdf');
}
?>
