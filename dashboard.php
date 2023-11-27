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

$propertyOverviewQuery = "SELECT status, COUNT(*) AS count FROM space GROUP BY status";
$propertyOverviewResult = mysqli_query($con, $propertyOverviewQuery);

// Fetch data into an associative array
$propertyOverviewData = [];
while ($row = mysqli_fetch_assoc($propertyOverviewResult)) {
    $propertyOverviewData[$row['status']] = $row['count'];
}

// Calculate total spaces
$totalSpacesQuery = "SELECT COUNT(*) AS total FROM space";
$totalSpacesResult = mysqli_query($con, $totalSpacesQuery);
$totalSpacesRow = mysqli_fetch_assoc($totalSpacesResult);
$totalSpaces = $totalSpacesRow['total'];

// Calculate percentage occupancy
$percentOccupied = ($propertyOverviewData['occupied'] / $totalSpaces) * 100;
$percentAvailable = ($propertyOverviewData['available'] / $totalSpaces) * 100;

// Close result sets
mysqli_free_result($propertyOverviewResult);
mysqli_free_result($totalSpacesResult); 

// Fetch tenant data for Tenant Management
$tenantManagementQuery = "SELECT utype, COUNT(*) AS count FROM user WHERE utype = 'Tenant'";
$tenantManagementResult = mysqli_query($con, $tenantManagementQuery);

// Fetch data into an associative array
$tenantManagementData = mysqli_fetch_assoc($tenantManagementResult);

// Close result set
mysqli_free_result($tenantManagementResult);

$totalBillsQuery = "SELECT SUM(total) AS totalBills FROM bill";
$totalBillsResult = mysqli_query($con, $totalBillsQuery);
$totalBills = 0;

if ($totalBillsResult && mysqli_num_rows($totalBillsResult) > 0) {
    $totalBillsData = mysqli_fetch_assoc($totalBillsResult);
    $totalBills = $totalBillsData['totalBills'];
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Add your custom styles here */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        text-align: center;
    }

    .row {
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
        height: 260px;
    }

    h2 {
        color: #c19f90;
    }

    .section-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-item,
    .pie-chart {
        flex: 1;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
        margin: 10px;
        height: 150px; /* Set the desired height */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .section-item i,
    .section-item h5 {
        margin-top: auto;
        margin-bottom: 10px;
    }

    .section-item p {
        font-size: 40px; /* Set the desired font size */
        margin-top: 20px;
    }

    .pie-chart {
        text-align: center;
        padding-top: 35px;
    }

    .pie-chart canvas {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #tenantPieChart,
    #reservationPieChart,
    #propertyOverviewPieChart {
        max-width: 80px;
        height: auto;
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

    #feedbackList,
    #tenantList {
        list-style: none;
        padding: 0;
        width: 100%;
        max-width: 400px; /* Adjust the max-width as needed */
    }

    #feedbackList li,
    #tenantList li {
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
        text-align: center;
    }

    /* Adjusted pie chart sizes */
    canvas {
        max-width: 80px;
        height: 100%;
        display: block;
        margin: 0 auto;
    }

    button:hover {
        background-color: #c19f90 !important;
    }

    button {
        background-color: #9b593c;
    }
</style>

<body style="margin-top: 75px;">
    <div class="row">
         <section>
            <h2>Property Overview</h2>
            <div class="section-content">
                <div class="section-item">
                    <p><?php echo $propertyOverviewData['occupied']; ?></p>
                    <i class="fas fa-map-marker-alt"></i> <!-- Icon for Maps -->
                </div>
                <div class="section-item">
                    <p><?php echo $totalSpaces; ?></p>
                    <i class="fas fa-th-large"></i> <!-- Icon for Spaces -->
                </div>
                <div class="pie-chart">
                    <canvas id="propertyOverviewPieChart"></canvas>
                </div>
            </div>
        </section>

        <section style="width: 600px;">
    <h2>Tenant Management</h2>
    <div class="section-content">
        <?php
        // Count the number of active and inactive tenants
        $activeTenantQuery = "SELECT COUNT(*) as count FROM `user` WHERE `utype` = 'Tenant' AND `status` = 'active'";
        $inactiveTenantQuery = "SELECT COUNT(*) as count FROM `user` WHERE `utype` = 'Tenant' AND `status` = 'inactive'";

        $activeTenantResult = mysqli_query($con, $activeTenantQuery);
        $inactiveTenantResult = mysqli_query($con, $inactiveTenantQuery);

        $activeTenantCount = ($activeTenantResult && mysqli_num_rows($activeTenantResult) > 0) ? mysqli_fetch_assoc($activeTenantResult)['count'] : 0;
        $inactiveTenantCount = ($inactiveTenantResult && mysqli_num_rows($inactiveTenantResult) > 0) ? mysqli_fetch_assoc($inactiveTenantResult)['count'] : 0;
        ?>
        <div class="section-item">
            <p><?php echo $activeTenantCount; ?></p>
            <i class="fas fa-users"></i> <!-- Icon for Active Tenants -->
        </div>
        <div class="section-item">
            <p><?php echo $inactiveTenantCount; ?></p>
            <i class="fas fa-users"></i> <!-- Icon for Inactive Tenants -->
        </div>
        <div class="pie-chart">
            <canvas id="tenantPieChart"></canvas>
        </div>
    </div>
</section>

        <section>
            <h2>Reservation Tracking</h2>
            <div class="section-content">
                <div class="section-item">
                    <p>28</p>
                    <i class="fas fa-calendar-check"></i> <!-- Icon for Reservations -->
                </div>
                <div class="section-item">
                    <p>65</p>
                    <i class="fas fa-file-alt"></i> <!-- Icon for Applications -->
                </div>
                <div class="pie-chart">
                    <canvas id="reservationPieChart"></canvas>
                </div>
            </div>
        </section>
    </div>

    <div style="margin-left: 55px;" class="row">
        <section>
            <h2>Financial Overview</h2>
            <div class="section-content">
    <div class="section-item">
        <p>$<?php echo number_format($totalBills, 2); ?></p>
        <h5>Total Bills</h5>
    </div>
    <div style="padding-top: 35px;" class="section-item">
        <button style="margin-bottom: 10px;">Billing Information</button>
        <button>Financial Reports</button>
    </div>
</div>
        </section>

        <section style="width: 600px;" id="feedbackSection">
            <h2>Feedback</h2>
            <div class="section-content" style="width: 300px;">
                <ul id="feedbackList">
                    <li>Ekis dito</li>
                    <li>Walang kuryente</li>
                    <li>4 years online parin</li>
                    <li>Midterm na </li>
                    <li>1 palang ftf class </li>
                    <li>Ngyek</li>
                </ul>
                <ul id="tenantList">
                    <li>Walter White</li>
                    <li>Jesse Pinkman</li>
                    <li>Mike Ermanshrout</li>
                    <li>Gus Fring</li>
                    <li>Isagi Yoichi</li>
                    <li>Eren Yeager</li>
                </ul>
            </div>
        </section>
    </div>

    <script>
        // Fetch the counts of active and inactive tenants from PHP
    const activeTenantCount = <?php echo $activeTenantCount; ?>;
    const inactiveTenantCount = <?php echo $inactiveTenantCount; ?>;

    // Data for tenant pie chart
    const tenantPieData = {
        labels: ['Active Tenants', 'Inactive Tenants'],
        datasets: [{
            data: [activeTenantCount, inactiveTenantCount],
            backgroundColor: ['#36A2EB', '#FF6384'],
        }],
    };

    // Render tenant pie chart
    const tenantPieChart = new Chart(document.getElementById('tenantPieChart'), {
        type: 'pie',
        data: tenantPieData,
    });

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
                data: [<?php echo $percentOccupied; ?>, <?php echo 100 - $percentOccupied; ?>],
                backgroundColor: ['#FFCE56', '#4CAF50'],
            }],
        };

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