<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Billings Page</title>
    <!-- Include any additional libraries or stylesheets as needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        section {
            max-width: 950px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            background-color: #333;
            color: white;
        }
        .modal {
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
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .close-modal {
            cursor: pointer;
            margin-top: 10px;
            color: #333;
        }

        tbody tr:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Owner Billings Page</h1>
    </header>

    <section>
        <h2>Overview</h2>
        <div>
            <p>Total Revenue Generated: $5000</p>
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
                <!-- Rows dynamically populated with JavaScript -->
            </tbody>
        </table>
    </section>

    <div id="chargeBreakdownModal" class="modal">
        <div class="modal-content">
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
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch billing data from the server using AJAX
            // For now, using static data
            const billingData = [
                { tenantName: 'Tenant 1', space: 'Space A', totalCharges: 1000, paymentsMade: 800, outstandingBalance: 200, dueDate: '2023-06-30', paymentStatus: 'Pending' },
                { tenantName: 'Tenant 2', space: 'Space B', totalCharges: 1500, paymentsMade: 1200, outstandingBalance: 300, dueDate: '2023-06-30', paymentStatus: 'Paid' },
                // Add more billing data as needed
            ];

            // Populate billing table with data
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
                tr.addEventListener('click', () => showChargeBreakdown(billing));
                tbody.appendChild(tr);
            });
            const modalOverlay = document.querySelector('.modal');
            modalOverlay.addEventListener('click', function (event) {
                if (event.target === modalOverlay) {
                    closeChargeBreakdownModal();
                }
            });
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
            const modal = document.getElementById('chargeBreakdownModal');
            modal.style.display = 'flex';
        }

        function closeChargeBreakdownModal() {
            // Close the charge breakdown modal
            const modal = document.getElementById('chargeBreakdownModal');
            modal.style.display = 'none';
        }
    </script>

</body>
</html>
