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
            padding: 20px;
            background-color: #f4f4f4;
            margin: 10px;
            border-radius: 5px;
            height: 250px;
            width: 600px;
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

        #userManagementPieChart,
        #mapManagementPieChart,
        #verifiedUsersPieChart,
        #concessionManagementPieChart,
        #systemLogsPieChart {
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
        <h2>User Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Owners</h5>
                <p>100</p>
            </div>
            <div class="section-item">
                <h5>Tenants</h5>
                <p>100</p>
            </div>
            <div class="section-item">
                <h5>Account</h5>
                <p>100</p>
            </div>
            <div class="pie-chart">
                <canvas id="userManagementPieChart"></canvas>
            </div>
        </div>
    </section>

    <section>
        <h2>Map Management</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Total Map Applications</h5>
                <p>20</p>
            </div>
            <div class="section-item">
                <h5>Total Verified Maps</h5>
                <p>80</p>
            </div>
            <div class="pie-chart">
                <canvas id="mapManagementPieChart"></canvas>
            </div>
        </div>
    </section>

    <section>
        <h2>Verified Users</h2>
        <div class="section-content">
            <div class="section-item">
                <h5>Total Users</h5>
                <p>150</p>
            </div>
            <div class="pie-chart">
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
                <h5>Total Concessions</h5>
                <p>50</p>
            </div>
            <div class="pie-chart">
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
                <h5>System Activities</h5>
                <p>Detailed logs go here</p>
            </div>
            <div class="section-item">
                <h5>Login/Logout History</h5>
                <p>Logs go here</p>
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

        const systemLogsPieData = {
            labels: ['Label 1', 'Label 2'],
            datasets: [{
                data: [60, 40],
                backgroundColor: ['#FF6384', '#36A2EB'],
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

        const systemLogsPieChart = new Chart(document.getElementById('systemLogsPieChart'), {
            type: 'pie',
            data: systemLogsPieData,
        });
    </script>
</body>
</html>