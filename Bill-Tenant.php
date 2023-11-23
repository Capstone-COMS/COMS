<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Billings Page</title>
    <!-- Include any additional libraries or stylesheets as needed -->
    <style>
        /* Styles for the Tenant Billings Page */
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
            max-width: 800px;
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

        /* Add this style to change cursor to pointer on hover */
        tbody tr:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tenant Billings Page</h1>
    </header>

    <section>
        <h2>Billing Information</h2>

        <table id="billingTable">
            <thead>
                <tr>
                    <th>Space</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Pay Now</th>
                </tr>
            </thead>
            <tbody>
                <tr data-spaceid="101" class="billing-row">
                    <td>Space 101</td>
                    <td>2023-06-30</td>
                    <td>$500.00</td>
                    <td>Pending</td>
                    <td><button class="pay-now-button" data-link="https://your-payment-link.com">Pay Now</button></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

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
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const billingTable = document.getElementById('billingTable');
    const chargeBreakdownModal = document.getElementById('chargeBreakdownModal');

    billingTable.addEventListener('click', function (event) {
        const target = event.target.closest('.billing-row');
        if (target) {
            // Clear previous charge breakdown data
            clearChargeBreakdownTable();

            // Example: Fetch charge breakdown data from the server using AJAX
            // For now, we'll use static data
            const chargeBreakdownData = getChargeBreakdownData(target.dataset.spaceid);

            // Populate the charge breakdown table
            populateChargeBreakdownTable(chargeBreakdownData);

            // Show the charge breakdown modal
            chargeBreakdownModal.style.display = 'flex';
        }
    });

    // Handle the click event on the "Pay Now" button
    billingTable.addEventListener('click', function (event) {
        const payNowButton = event.target.closest('.pay-now-button');
        if (payNowButton) {
            // Retrieve the payment link from the button's data attribute (dynamic link)
            const paymentLink = payNowButton.dataset.link;

            // Redirect the tenant to the payment link
            window.location.href = paymentLink;
        }
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === chargeBreakdownModal) {
            // Hide the charge breakdown modal
            chargeBreakdownModal.style.display = 'none';
        }
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === chargeBreakdownModal) {
            // Hide the charge breakdown modal
            chargeBreakdownModal.style.display = 'none';
        }
    });

            function clearChargeBreakdownTable() {
                // Clear previous charge breakdown data
                const tbody = document.getElementById('chargeBreakdownTable').querySelector('tbody');
                tbody.innerHTML = '';
            }

            function populateChargeBreakdownTable(data) {
                // Populate charge breakdown table with data
                const tbody = document.getElementById('chargeBreakdownTable').querySelector('tbody');
                data.forEach(charge => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${charge.chargeType}</td>
                        <td>${charge.amount}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function getChargeBreakdownData(spaceId) {
                // Example function to get charge breakdown data for a space from the server
                // In a real application, you would fetch this data using AJAX
                // For now, using static data
                if (spaceId === '101') {
                    return [
                        { chargeType: 'Rent', amount: '$500.00' },
                        { chargeType: 'Utilities', amount: '$50.00' },
                    ];
                }
                // Add more conditions or fetch data from the server
                return [];
            }
        });
    </script>
</body>
</html>
