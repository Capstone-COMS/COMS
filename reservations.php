<?php
   session_name("user_session");
   session_start();
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   require('includes/dbconnection.php');

   include('includes/header.php');
   include('includes/nav.php');
?>

<style>
        body {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        section {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 75px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Add relative positioning */
        }
        h2{
            color: #c19f90;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #9b593c;
            color: white;
        }

        .btn {
            padding: 10px;
            background-color: #9b593c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .btn:hover {
            background-color: #c19f90;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Owner Reservations Page</h1>
    </header>
    <section>
        <h2>Reservation List</h2>
        <table id="reservationTable">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Tenant Name</th>
                    <th>Reserved Space</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New table header for actions -->
                </tr>
            </thead>
            <tbody>
                <!-- Reservation data will be dynamically populated here -->
            </tbody>
        </table>
    </section>
    <script>
        // Sample reservation data (replace with actual data)
        const reservations = [
            { id: 1, tenant: 'John Doe', space: 'Space A', startDate: '2023-01-01', endDate: '2023-01-07', status: 'Pending' },
            { id: 2, tenant: 'Jane Smith', space: 'Space B', startDate: '2023-02-01', endDate: '2023-02-14', status: 'Confirmed' },
            // Add more reservation objects as needed
        ];
        // Function to populate the reservation table
        function populateReservationTable() {
            const tableBody = document.querySelector('#reservationTable tbody');
            // Clear previous data
            tableBody.innerHTML = '';
            // Populate the table with reservation data
            reservations.forEach(reservation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${reservation.id}</td>
                    <td>${reservation.tenant}</td>
                    <td>${reservation.space}</td>
                    <td>${reservation.startDate}</td>
                    <td>${reservation.endDate}</td>
                    <td>${reservation.status}</td>
                    <td>
                        <button class="btn" onclick="approveReservation(${reservation.id})">Approve</button>
                        <button class="btn" onclick="denyReservation(${reservation.id})">Deny</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        // Initial population of the table
        populateReservationTable();
        // Function to approve a reservation
        function approveReservation(reservationId) {
            // Implement logic to approve the selected reservation
            alert(`Reservation ${reservationId} approved!`);
            // Refresh the table after the action
            populateReservationTable();
        }
        // Function to deny a reservation
        function denyReservation(reservationId) {
            // Implement logic to deny the selected reservation
            alert(`Reservation ${reservationId} denied!`);
            // Refresh the table after the action
            populateReservationTable();
        }
    </script>

<?php 
    include('includes/footer.php'); 
?>