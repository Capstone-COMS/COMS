<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Bill Input Page</title>
    <style>
        /* Styles for the Click Me Page */
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
            text-align: center;
        }

        button {
            background-color: #333;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        .modal-content {
            cursor: auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button.save-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>Accountant Bill Input Page</h1>
    </header>

    <section>
        <button id="clickMeButton">Click Me</button>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <h2>Billing Information</h2>
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>

                <label for="rent">Rent:</label>
                <input type="number" id="rent" name="rent" required>

                <label for="utilities">Utilities:</label>
                <input type="number" id="utilities" name="utilities" required>

                <label for="maintenance">Maintenance:</label>
                <input type="number" id="maintenance" name="maintenance" required>

                <label for="otherCharges">Other Charges:</label>
                <input type="number" id="otherCharges" name="otherCharges" required>

                <label>Total Amount:</label>
                <input type="text" id="totalAmount" name="totalAmount" readonly>

                <label for="paymentStatus">Payment Status:</label>
                <select id="paymentStatus" name="paymentStatus" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="overdue">Overdue</option>
                </select>

                <label for="notes">Notes or Comments:</label>
                <textarea id="notes" name="notes" rows="4"></textarea>

                <label>Invoice Number:</label>
                <input type="text" id="invoiceNumber" name="invoiceNumber" readonly>

                <button class="save-button" onclick="saveBillingInfo()">Save</button>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clickMeButton = document.getElementById('clickMeButton');
            const modal = document.getElementById('myModal');

            clickMeButton.addEventListener('click', function () {
                modal.style.display = 'flex';
            });

            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        function saveBillingInfo() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const rent = parseFloat(document.getElementById('rent').value) || 0;
            const utilities = parseFloat(document.getElementById('utilities').value) || 0;
            const maintenance = parseFloat(document.getElementById('maintenance').value) || 0;
            const otherCharges = parseFloat(document.getElementById('otherCharges').value) || 0;
            const totalAmount = rent + utilities + maintenance + otherCharges;
            const paymentStatus = document.getElementById('paymentStatus').value;
            const notes = document.getElementById('notes').value;
            const invoiceNumber = generateInvoiceNumber();

            // Display the calculated total amount and generated invoice number
            document.getElementById('totalAmount').value = totalAmount.toFixed(2);
            document.getElementById('invoiceNumber').value = invoiceNumber;

            // You can now proceed to save these values to your database or perform other actions.
        }

        function generateInvoiceNumber() {
            // Generate a unique invoice number (you can implement a more sophisticated logic)
            return 'INV' + Math.floor(Math.random() * 1000000);
        }
    </script>
</body>

</html>
