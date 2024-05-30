<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the dompdf and pChart libraries
    require_once '../../dompdf/autoload.inc.php';
    require_once '../../pChart2.0-for-PHP7-master/pChart/pData.php';
    require_once '../../pChart2.0-for-PHP7-master/pChart/pDraw.php';
    require_once '../../pChart2.0-for-PHP7-master/pChart/pImage.php';
    
    // Fetch your data
    include 'backend/reportfetching.php';

    // Create a new pChart pData object
    $chartData = new pData();

    // Add data to the chart
    $chartData->addPoints(array(1, 3, 4, 3, 5));

    // Create a new pImage object
    $image = new pImage(300, 300, $chartData);

    // Draw a line chart
    $image->drawLineChart();

    // Save the chart image
    $chartImagePath = "chart.png";
    $image->render($chartImagePath);

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
