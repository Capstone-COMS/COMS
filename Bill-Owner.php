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
    section {
        max-width: 1000px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        margin-top: 150px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative; /* Add relative positioning */
    }
    h2, h3{
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

    button:hover{
      background-color: #c19f90 !important;
   }

   button{
      background-color: #9b593c;
   }

    .leases-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .leases-table th,
    .leases-table td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .leases-table th {
        background-color: #9b593c;
        color: white;
    }

    .hidden {
        display: none;
    }

    .tenant-row {
        cursor: pointer;
    }
    .tenant-row:hover {
        background-color: #c19f90;
        color: white;
    }

    #leaseModal {
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

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 600px;
        /* margin: 0 auto; */
        text-align: center;
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

    .close-modal:hover,
    .close-modal:focus {
        color: black;
        text-decoration: none;
    }
    #paymentButton {
            background-color: #9b593c;
            color: white;
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #paymentModal {
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

        #paymentModal .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
        }
</style>
</head>
<body style="margin-top: 150px;">
    <section>
        <h2>Overview</h2>
        <div>
            <p>Total Revenue Generated: $5000</p>
            <button id="paymentButton" onclick="openPaymentModal()">Payment</button>
        </div>

        
        <h2>Billing Information</h2>
        <table id="billingTable">
            <thead>
                <tr>
                <th>Tenant Name</th>
                    <th>Space</th>
                    <th>Total Charges</th>
                    <th>Payments Made</th>
                    <th>Outstanding Balance</th>
                    <th>Due Date</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>

    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closePaymentModal()">&times;</span>
            <h3>Upload Payment Link</h3>
            <!-- Add your form or input elements for uploading the link or QR code -->
            <input type="text" placeholder="Paste payment link here">
            <button onclick="submitPayment()">Submit</button>
        </div>
    </div>

    <div id="chargeBreakdownModal" class="modal">
        <div class="modal-content">
        <span class="close-modal" id="tenantClose">&times;</span>
            <h3>Charge Breakdown</h3>
            <table id="chargeBreakdownTable">
                <thead>
                    <tr>
                        <th>Charge Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows dynamically populated with JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function openPaymentModal() {
            const paymentModal = document.getElementById('paymentModal');
            paymentModal.style.display = 'flex';
        }

        function closePaymentModal() {
            const paymentModal = document.getElementById('paymentModal');
            paymentModal.style.display = 'none';
        }

        function submitPayment() {
            // Add logic to handle the submission of payment link or QR code
            // You may use AJAX to send the data to the server
            alert('Payment submitted!');
            closePaymentModal();
        }
    document.addEventListener('DOMContentLoaded', function () {
        const billingData = [
            { tenantName: 'Tenant 1', space: 'Space A', totalCharges: 1000, paymentsMade: 800, outstandingBalance: 200, dueDate: '2023-06-30', paymentStatus: 'Pending' },
            { tenantName: 'Tenant 2', space: 'Space B', totalCharges: 1500, paymentsMade: 1200, outstandingBalance: 300, dueDate: '2023-06-30', paymentStatus: 'Paid' },
            // Add more billing data as needed
        ];

        const billingTable = document.getElementById('billingTable');
        const tbody = billingTable.querySelector('tbody');

        billingData.forEach((billing, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${billing.tenantName}</td>
                <td>${billing.space}</td>
                <td>${billing.totalCharges}</td>
                <td>${billing.paymentsMade}</td>
                <td>${billing.outstandingBalance}</td>
                <td>${billing.dueDate}</td>
                <td>${billing.paymentStatus}</td>
            `;
            tr.classList.add('tenant-row'); // Add the tenant-row class for styling
            tr.addEventListener('click', () => showChargeBreakdown(billing));
            tbody.appendChild(tr);
        });

        const chargeBreakdownModal = document.getElementById('chargeBreakdownModal');
        const closeChargeBreakdownBtn = document.querySelector('.close-modal');

        closeChargeBreakdownBtn.addEventListener('click', function () {
            // Close the charge breakdown modal
            chargeBreakdownModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            // Close the charge breakdown modal if clicked outside the modal content
            if (event.target === chargeBreakdownModal) {
                chargeBreakdownModal.style.display = 'none';
            }
        });

        function showChargeBreakdown(billing) {
            // Fetch charge breakdown data from the server using AJAX
            // For now, using static data
            const chargeBreakdownData = [
                { chargeType: 'Rent', amount: 800 },
                { chargeType: 'Utilities', amount: 150 },
                // Add more charge breakdown data as needed
            ];

            // Populate charge breakdown table with data
            const chargeBreakdownTable = document.getElementById('chargeBreakdownTable');
            const tbody = chargeBreakdownTable.querySelector('tbody');
            tbody.innerHTML = '';
            chargeBreakdownData.forEach(charge => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${charge.chargeType}</td>
                    <td>${charge.amount}</td>
                `;
                tbody.appendChild(tr);
            });

            // Show the charge breakdown modal
            chargeBreakdownModal.style.display = 'flex';
        }
    });
</script>

<?php include('includes/footer.php'); ?>