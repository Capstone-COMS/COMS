<!-- ******************** -->
<!-- ***START SESSION**** -->
<!-- ******************** -->
<?php
   session_name("user_session");
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('includes/dbconnection.php');
?>
<!-- ******************** -->
<!-- ***** PHP CODE ***** -->
<!-- ******************** -->
<?php
// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit();
}

$uid = $_SESSION['uid'];
$utype = $_SESSION['utype'];

// $mappp = $_SESSION['approved_concourse'];

// Check if there are approved concourse details in the session

// **********************
// ***USER VERIFY********
// **********************
// Check the status in the user_verification table
$verificationStatus = "Not approved"; // Default status
$verificationQuery = "SELECT status, first_name, last_name, address, gender, birthday FROM user_verification WHERE user_id = $uid";
$verificationResult = mysqli_query($con, $verificationQuery);

if ($verificationResult && mysqli_num_rows($verificationResult) > 0) {
    $verificationData = mysqli_fetch_assoc($verificationResult);
    $verificationStatus = $verificationData['status'];
}


// **********************
// ***MAP VERIFY*********
// **********************

// **************************************

$uploadDirectory = __DIR__ . '/uploads/';

$approvedMapQuery = "SELECT * FROM concourse_verification WHERE status = 'approved'";
$approvedMapResult = mysqli_query($con, $approvedMapQuery);

?>
<!-- ******************** -->
<!-- **** START HTML **** -->
<!-- ******************** -->
<?php
include('includes/header.php');

include('includes/nav.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Add your custom styles here */
        body {
         font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        section {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
            margin: 10px;
            border-radius: 5px;
            height: 250px;
        }

        h2 {
            color: #c19f90;
        }

        .section-content {
            display: flex;
            justify-content: space-between;
            align-items: stretch; /* Adjusted to stretch items vertically */
            height: 75%; /* Adjusted to make all section-content elements the same height */
        }

        .section-item,
        .pie-chart {
            flex: 1;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            margin: 10px;
            text-align: center;
            display: flex;
            flex-direction: column; /* Adjusted to stack content vertically */
        }

        .section-item p,
        .pie-chart canvas {
            flex: 1; /* Adjusted to take available space */
            margin: 0;
        }

        #tenantPieChart,
        #reservationPieChart,
        #propertyOverviewPieChart {
            max-width: 80px;
            height: 80px; /* Set a fixed height for all pie charts */
            display: block;
            margin: 0 auto;
        }

        #feedbackSection {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            flex: 1; /* Take full width */
            display: flex;
            flex-direction: column;
            align-items: center;
            max-height: 300px; /* Adjust the max-height as needed */
            overflow-y: auto;
        }

        #feedbackList {
            list-style: none;
            padding: 0;
            width: 100%;
            max-width: 400px; /* Adjust the max-width as needed */
        }

        #feedbackList li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            text-align: center;
        }

        /* Adjusted pie chart sizes */
        canvas {
            width: 750px;
            height: 750px;
            display: block;
            margin: 0 auto;
        }

        button {
            padding: 10px;
            background-color: #9b593c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #c19f90;
            color: white;
        }
    </style>
</head>

<body style="margin-top: 80px;">
    <section>
        <h2>Property Overview</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Total number of maps</h5>
                <p>10</p>
            </div>
            <div class="section-item">
                <h5>Total number of spaces</h5>
                <p>100</p>
            </div>
            <div class="pie-chart">
                <canvas id="propertyOverviewPieChart"></canvas>
            </div>
        </div>
    </section>

    <section>
        <h2>Tenant Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Total number of maps</h5>
                <p>5</p>
            </div>
            <div class="pie-chart">
                <canvas id="tenantPieChart"></canvas>
            </div>
        </div>
    </section>

    <section>
        <h2>Financial Overview</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Monthly revenue</h5>
                <p>$10,000</p>
            </div>
            <div class="section-item">
                <button>Billing Information</button>
            </div>
            <div class="section-item">
                <button>Financial Reports</button>
            </div>
        </div>
    </section>

    <section>
        <h2>Reservation and Application Tracking</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Pending reservations</h5>
                <p>3</p>
            </div>
            <div class="section-item">
                <h5>Pending applications</h5>
                <p>2</p>
            </div>
            <div class="pie-chart">
                <canvas id="reservationPieChart"></canvas>
            </div>
        </div>
    </section>

    <section id="feedbackSection">
        <h2>Feedback</h2>
        <ul id="feedbackList">
            <li>Feedback 1</li>
            <li>Feedback 2</li>
            <li>Feedback 1</li>
            <li>Feedback 2</li>
            <li>Feedback 1</li>
            <li>Feedback 2</li>
            <li>Feedback 1</li>
            <li>Feedback 2</li>
            <!-- Add more feedback items -->
        </ul>
    </section>

    <script>
        // Mock data for feedback
        const feedbackData = [
            { user: 'Tenant 1', feedback: 'Positive feedback.' },
            { user: 'Tenant 2', feedback: 'Negative feedback.' },
        ];

        // Dynamically populate feedback list
        const feedbackList = document.getElementById('feedbackList');
        feedbackData.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.feedback} from ${item.user}`;
            feedbackList.appendChild(li);
        });

        // Mock data for pie charts
        const tenantPieData = {
            labels: ['Pending Users', 'Active Users'],
            datasets: [{
                data: [30, 70],
                backgroundColor: ['#FF6384', '#36A2EB'],
            }],
        };

        const reservationPieData = {
            labels: ['Reservations', 'Applications'],
            datasets: [{
                data: [40, 60],
                backgroundColor: ['#FFCE56', '#4CAF50'],
            }],
        };

        const propertyOverviewPieData = {
            labels: ['Occupied', 'Vacant'],
            datasets: [{
                data: [80, 20],
                backgroundColor: ['#FFCE56', '#4CAF50'],
            }],
        };

        // Render pie charts
        const tenantPieChart = new Chart(document.getElementById('tenantPieChart'), {
            type: 'pie',
            data: tenantPieData,
        });

        const reservationPieChart = new Chart(document.getElementById('reservationPieChart'), {
            type: 'pie',
            data: reservationPieData,
        });

        const propertyOverviewPieChart = new Chart(document.getElementById('propertyOverviewPieChart'), {
            type: 'pie',
            data: propertyOverviewPieData,
        });
    </script>

<?php include('includes/footer.php'); ?>