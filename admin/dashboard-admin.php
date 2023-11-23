<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Admin Dashboard</title>
    <!-- Include Chart.js library -->
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
        }
        section {
            flex: 1;
            padding: 30px; /* Increase the padding for more height */
            background-color: #f4f4f4;
            margin: 10px;
            border-radius: 5px;
        }
        h2 {
            color: #333;
        }
        .section-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-item {
            flex: 1;
            padding: 20px; /* Increase the padding for more height */
            background-color: #fff;
            border-radius: 5px;
            margin: 10px;
            text-align: center;
        }
        .pie-chart {
            flex: 1;
            padding: 20px; /* Increase the padding for more height */
            background-color: #fff;
            border-radius: 5px;
            margin: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        canvas {
            max-width: 150px; /* Increase the max-width for larger charts */
            max-height: 150px; /* Increase the max-height for larger charts */
            width: 100%;
            height: auto;
        }
        /* Ensure labels are visible */
        .legend {
            display: flex;
            justify-content: center;
        }
        #feedbackSection {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            flex: 1; /* Take full width */
            margin-top: 20px; /* Adjust the top margin as needed */
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
    </style>
</head>
<body>
    <section>
        <h2>User Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h3>Owners</h3>
                <p>100</p>
            </div>
            <div class="section-item">
                <h3>Tenants</h3>
                <p>100</p>
            </div>
            <div class="section-item">
                <h3>Accountants</h3>
                <p>100</p>
            </div>
            <div class="pie-chart legend">
                <canvas id="userManagementPieChart"></canvas>
            </div>
        </div>
    </section>
    <section>
        <h2>Map Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h3>Total Map Applications</h3>
                <p>20</p>
            </div>
            <div class="section-item">
                <h3>Total Verified Maps</h3>
                <p>80</p>
            </div>
            <div class="pie-chart legend">
                <canvas id="mapManagementPieChart"></canvas>
            </div>
        </div>
    </section>
    <section>
        <h2>Verified Users</h2>
        <div class="section-content">
            <div class="section-item">
                <h3>Total Users</h3>
                <p>150</p>
            </div>
            <div class="pie-chart legend">
                <canvas id="verifiedUsersPieChart"></canvas>
            </div>
            <div class="section-item">
                <button>Approve User</button>
                <button>Deny User</button>
                <button>Deactivate User</button>
            </div>
        </div>
    </section>
    <section>
        <h2>Concession Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h3>Total Concessions</h3>
                <p>50</p>
            </div>
            <div class="pie-chart legend">
                <canvas id="concessionManagementPieChart"></canvas>
            </div>
            <div class="section-item">
                <button>Add Concession</button>
                <button>Edit Concession</button>
                <button>Deactivate Concession</button>
            </div>
        </div>
    </section>
    <section>
        <h2>System Logs</h2>
        <div class="section-content">
            <div class="section-item">
                <h3>System Activities</h3>
                <p>Detailed logs go here</p>
            </div>
            <div class="section-item">
                <h3>Login/Logout History</h3>
                <p>Logs go here</p>
            </div>
        </div>
    </section>
    <section id="feedbackSection">
        <h2>Feedback</h2>
        <ul id="feedbackList">
            <!-- Add more feedback items -->
            <li>User Feedback 1</li>
            <li>User Feedback 2</li>
            <li>User Feedback 3</li>
            <li>User Feedback 4</li>
            <li>User Feedback 5</li>
            <li>User Feedback 6</li>
            <li>User Feedback 7</li>
            <li>User Feedback 8</li>
            <li>User Feedback 9</li>
            <li>User Feedback 10</li>
        </ul>
    </section>
    <script>
        // Mock data for pie charts
        const userManagementPieData = {
            labels: ['Owners', 'Tenants', 'Accountant'],
            datasets: [{
                data: [30, 50, 20],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }],
        };
        const mapManagementPieData = {
            labels: ['Applications', 'Verified Maps'],
            datasets: [{
                data: [30, 70],
                backgroundColor: ['#FF6384', '#36A2EB'],
            }],
        };
        const verifiedUsersPieData = {
            labels: ['Verified', 'Not Verified'],
            datasets: [{
                data: [80, 20],
                backgroundColor: ['#FFCE56', '#4CAF50'],
            }],
        };
        const concessionManagementPieData = {
            labels: ['Active', 'Pending', 'Inactive'],
            datasets: [{
                data: [40, 20, 40],
                backgroundColor: ['#FFCE56', '#36A2EB', '#4CAF50'],
            }],
        };
        // Render pie charts
        const userManagementPieChart = new Chart(document.getElementById('userManagementPieChart'), {
            type: 'pie',
            data: userManagementPieData,
        });
        const mapManagementPieChart = new Chart(document.getElementById('mapManagementPieChart'), {
            type: 'pie',
            data: mapManagementPieData,
        });
        const verifiedUsersPieChart = new Chart(document.getElementById('verifiedUsersPieChart'), {
            type: 'pie',
            data: verifiedUsersPieData,
        });
        const concessionManagementPieChart = new Chart(document.getElementById('concessionManagementPieChart'), {
            type: 'pie',
            data: concessionManagementPieData,
        });
    </script>
</body>
</html>