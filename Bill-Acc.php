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
            padding: 5px;
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
            display: block;
            margin: 20px auto; /* Center the button */
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
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            height: 90%;
            margin: 0 auto;
            text-align: left;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .modal-header {
            grid-column: span 4;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 5px;
            text-align: left;
        }

        input, textarea, select {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            margin-bottom: 5px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .notes-comments {
            grid-column: span 4;
        }

        button.save-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
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
                <div class="modal-header">
                    <h1 >Billing Information</h1>
                </div>
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>

                <label for="paymentStatus">Payment Status:</label>
                <select id="paymentStatus" name="paymentStatus" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="overdue">Overdue</option>
                </select>

                <label for="invoiceNumber">Invoice Number:</label>
                <input type="text" id="invoiceNumber" name="invoiceNumber" readonly>

                <label for="rent">Rent:</label>
                <input type="number" id="rent" name="rent" required>

                <label for="utilities">Utilities:</label>
                <input type="number" id="utilities" name="utilities" required>

                <label for="maintenance">Maintenance:</label>
                <input type="number" id="maintenance" name="maintenance" required>

                <label for="otherCharges">Other Charges:</label>
                <input type="number" id="otherCharges" name="otherCharges" required>

                <label for="totalAmount">Total Amount:</label>
                <input type="text" id="totalAmount" name="totalAmount" readonly>

                <label for="notes" class="notes-comments">Notes or Comments:</label>
                <textarea id="notes" name="notes" rows="4" class="notes-comments"></textarea>
                <div class="modal-header">
                    <button class="save-button" onclick="saveBillingInfo()">Save and Submit</button>
                </div>
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
            const paymentStatus = document.getElementById('paymentStatus').value;
            const invoiceNumber = generateInvoiceNumber();
            const rent = parseFloat(document.getElementById('rent').value) || 0;
            const utilities = parseFloat(document.getElementById('utilities').value) || 0;
            const maintenance = parseFloat(document.getElementById('maintenance').value) || 0;
            const otherCharges = parseFloat(document.getElementById('otherCharges').value) || 0;
            const totalAmount = rent + utilities + maintenance + otherCharges;
            const notes = document.getElementById('notes').value;

            // Display the calculated total amount and generated invoice number
            document.getElementById('totalAmount').value = totalAmount.toFixed(2);
            document.getElementById('invoiceNumber').value = invoiceNumber;

            // TODO: Add logic to submit data to the database (use dummy data for now)

            // You can now proceed to save these values to your database or perform other actions.
        }

        function generateInvoiceNumber() {
            // Generate a unique invoice number (you can implement a more sophisticated logic)
            return 'INV' + Math.floor(Math.random() * 1000000);
        }
    </script>
</body>

</html>
