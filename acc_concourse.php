<?php
session_name("user_session");
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('includes/dbconnection.php');

if (!isset($_SESSION['act_id'])) {
    header('Location: acc_login.php');
    exit();
}

include('includes/header.php');
include('includes/nav.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submission, handle the insertion into the 'bill' table
    $spaceId = $_POST['space_id'];
    $concourseId = $_POST['concourse_id'];
    $tenantName = $_POST['tenant_name'];
    $spaceBill = $_POST['space_bill'];
    $electric = $_POST['electric'];
    $water = $_POST['water'];
    $total = $_POST['total'];
    $dueDate = $_POST['due_date'];

    // Insert into the 'bill' table
    $insertQuery = "INSERT INTO bill (space_id, tenant_name, tenant_email, electric, water, space_bill, total, due_date, notified, status)
                    VALUES ('$spaceId', '$tenantName', 'example@email.com', '$electric', '$water', '$spaceBill', '$total', '$dueDate', 'not notified', 'unpaid')";
    
    if (mysqli_query($con, $insertQuery)) {
        echo "Bill added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<style>
    section {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        margin-top: 150px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    h2, h3 {
        color: #c19f90;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #9b593c;
        color: white;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 90%; /* Increased width */
        max-width: 1200px; /* Maximum width */
        height: 90%; /* Increased height */
        max-height: 260px; /* Maximum height */
        margin-top: 176px; /* Adjusted margin */
        text-align: center;
        overflow: auto; /* Add scrollbar if content overflows */
    }

    .close-modal {
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
    }

    .close-modal:hover, .close-modal:focus {
        color: black;
        text-decoration: none;
    }

    table#spaceTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table#spaceTable th, table#spaceTable td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    table#spaceTable th {
        background-color: #9b593c;
        color: white;
    }

    #spaceModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .form-column {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px; /* Adjusted margin */
    }

    .form-column label {
        flex: 1;
        text-align: left;
        margin-right: 10px; /* Adjusted margin */
        margin-left: 10px;
    }

    .form-column input {
        flex: 2;
    }
</style>

<section>
    <h2>Space Information</h2>
    <table id="spaceTable">
        <thead>
            <tr>
                <th>Space ID</th>
                <th>Concourse ID</th>
                <th>Space Name</th>
                <th>Space Bill</th>
                <th>Status</th>
                <th>Space Tenant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Fetch data from the database and populate the table rows
                $query = "SELECT * FROM space WHERE status = 'occupied'";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='space-row'>";
                    echo "<td>{$row['space_id']}</td>";
                    echo "<td>{$row['concourse_id']}</td>";
                    echo "<td>{$row['space_name']}</td>";
                    echo "<td>{$row['space_bill']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>{$row['space_tenant']}</td>";
                    echo "<td><button class='add-bill-btn'>Add Bill</button></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div id="spaceModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Add Bill</h3>
        <form action="" method="post">
            <div class="form-column">
                <label for="spaceIdInput">Space ID:</label>
                <input type="text" id="spaceIdInput" name="space_id" readonly>

                <label for="concourseIdInput">Concourse ID:</label>
                <input type="text" id="concourseIdInput" name="concourse_id" readonly>

                <label for="tenantNameInput">Tenant Name:</label>
                <input type="text" id="tenantNameInput" name="tenant_name" readonly>

                <label for="spaceBillInput">Space Bill:</label>
                <input type="text" id="spaceBillInput" name="space_bill" readonly>
            </div>

            <div class="form-column">
                <label for="electricInput">Electric Bill:</label>
                <input type="text" id="electricInput" name="electric" required>

                <label for="waterInput">Water Bill:</label>
                <input type="text" id="waterInput" name="water" required>

                <label for="totalInput">Total:</label>
                <input type="text" id="totalInput" name="total" readonly>

                <label for="dueDateInput">Due Date:</label>
                <input type="date" id="dueDateInput" name="due_date" required>
            </div>

            <button type="submit">Add Bill</button>
        </form>
    </div>
</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const spaceTable = document.getElementById('spaceTable');
        const spaceModal = document.getElementById('spaceModal');
        const closeModalBtn = document.querySelector('.close-modal');

        spaceTable.addEventListener('click', function (event) {
            const target = event.target.closest('.add-bill-btn');
            if (target) {
                spaceModal.style.display = 'block';
                const row = target.closest('tr');
                const rowCells = row.getElementsByTagName('td');
                const spaceId = rowCells[0].innerText;
                const concourseId = rowCells[1].innerText;
                const tenantName = rowCells[5].innerText; // Adjust this index if needed
                const spaceBill = rowCells[3].innerText;

                document.getElementById('spaceIdInput').value = spaceId;
                document.getElementById('concourseIdInput').value = concourseId;
                document.getElementById('tenantNameInput').value = tenantName;
                document.getElementById('spaceBillInput').value = spaceBill;
            }
        });

        closeModalBtn.addEventListener('click', function () {
            spaceModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === spaceModal) {
                spaceModal.style.display = 'none';
            }
        });

        const electricInput = document.getElementById('electricInput');
        const waterInput = document.getElementById('waterInput');
        const spaceBillInput = document.getElementById('spaceBillInput');
        const totalInput = document.getElementById('totalInput');

        [electricInput, waterInput, spaceBillInput].forEach(function (input) {
            input.addEventListener('input', function () {
                const electric = parseFloat(electricInput.value) || 0;
                const water = parseFloat(waterInput.value) || 0;
                const spaceBill = parseFloat(spaceBillInput.value) || 0;
                const total = electric + water + spaceBill;
                totalInput.value = total.toFixed(2);
            });
        });
    });
</script>

<?php include('includes/footer.php'); ?>