<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="billing.css">
    <style>
                .logout button {
    position: relative;
    left: 800px; /* Moves the element 20 pixels to the left */
}
.navbar .logout button {
    background-color: white;
    color: black;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.navbar .logout button:hover {
    background-color: #552bf0;
    text-decoration:underline;
}
    </style>
</head>
<body>
<header>
    <nav class="navbar">
            <div class="logout">
                <a href="login.php"><button>Logout</button></a>
            </div>
        </nav>
        <h1 class="header-title">Hello, Mike!</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
    </header>

    <aside class="sidebar">
        <a href="#leaderboard-section"><button>Search</button></a>
        <a href="#npcc-report-section"><button>Report</button></a>
        <a href="#create-report-section"><button>Generate invoices</button></a>
        <a href="#review-status-section"><button>Analytics & Reporting</button></a>
    </aside>

    <main>
    <div class="gap" id="leaderboard-section"></div>
        <h2 class="npcc-report-title">Report from Financial Team</h2>
        <section class="npcc-report">
            <div class="field-row">
                <div class="field">
                    <label for="power-type">Power Type:</label>
                    <input type="text" id="power-type">
                </div>
                <div class="field">
                    <label for="power-producer">Power Producer:</label>
                    <input type="text" id="power-producer">
                </div>
                <div class="field">
                    <label for="reviewer-id">Reviewer ID:</label>
                    <input type="text" id="reviewer-id">
                </div>
                <div class="field">
                    <label for="review-date">Review Date:</label>
                    <input type="date" id="review-date">
                </div>
                <div class="field">
                    <label for="audit-id">Audit ID:</label>
                    <input type="text" id="audit-id">
                </div>
                <div class="field">
                    <label for="total-cost">Total Cost:</label>
                    <input type="text" id="total-cost">
                </div>
                <div class="field">
                    <label for="variance">Variance:</label>
                    <input type="text" id="variance">
                </div>
                <div class="field">
                    <label for="comments">Comments by Technical Team:</label>
                    <input type="text" id="comments">
                </div>
            </div>
            <div class="buttons">
                <button class="light-green">Search</button>
                <button class="light-green">Clear All</button>
            </div>
        </section>
        <div class="gap" id="npcc-report-section"></div>
        <h2 class="npcc-report-title">Report:</h2>
        <section class="report">
        <table id="npccReportingTable">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Power Policy</th>
                    <th>Power Type</th>
                    <th>Power Producer</th>
                    <th>Portal Transaction Number</th>
                    <th>Transfer to AP</th>
                    <th>IPP Number</th>
                    <th>Dispute Letter</th>
                    <th>Generation Period From</th>
                    <th>Generation Period To</th>
                    <th>Demand Number</th>
                    <th>Due Date</th>
                    <th>Reviewer ID</th>
                    <th>Review Date</th>
                    <th>Status</th>
                    <th>Approval Date</th>
                    <th>Auditor ID</th>
                    <th>Auditor Name</th>
                    <th>Budgeted Cost</th>
                    <th>Total Cost</th>
                    <th>Variance</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'dbconnect.php';

                try {
                    // Prepare and execute query to fetch data from the database
                    $query = "SELECT 
                                npcc.report_id,
                                npcc.power_policy,
                                npcc.power_type,
                                npcc.power_producer,
                                npcc.portal_transaction_number,
                                npcc.transfer_to_ap,
                                npcc.ipp_number,
                                npcc.dispute_letter,
                                npcc.generation_period_from,
                                npcc.generation_period_to,
                                npcc.demand_number,
                                npcc.due_date,
                                COALESCE(tr.reviewed_by_id, '-') AS reviewed_by_id,
                                COALESCE(tr.review_date, '-') AS review_date,
                                COALESCE(tr.status, '-') AS status,
                                COALESCE(tr.approval_date, '-') AS approval_date,
                                COALESCE(tr.auditor_id, '-') AS auditor_id,
                                COALESCE(tr.auditor_name, '-') AS auditor_name,
                                COALESCE(tr.budgeted_cost, '-') AS budgeted_cost,
                                COALESCE(tr.total_cost, '-') AS total_cost,
                                COALESCE(tr.variance, '-') AS variance
                            FROM 
                                npcc_reporting npcc
                            LEFT JOIN 
                                reports tr 
                            ON 
                                npcc.demand_number = tr.demand_number";

                    $stmt = $pdo->query($query);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display search results
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "<tr>
                                <td>{$row['report_id']}</td>
                                <td>{$row['power_policy']}</td>
                                <td>{$row['power_type']}</td>
                                <td>{$row['power_producer']}</td>
                                <td>{$row['portal_transaction_number']}</td>
                                <td>{$row['transfer_to_ap']}</td>
                                <td>{$row['ipp_number']}</td>
                                <td>{$row['dispute_letter']}</td>
                                <td>{$row['generation_period_from']}</td>
                                <td>{$row['generation_period_to']}</td>
                                <td>{$row['demand_number']}</td>
                                <td>{$row['due_date']}</td>
                                <td>{$row['reviewed_by_id']}</td>
                                <td>{$row['review_date']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['approval_date']}</td>
                                <td>{$row['auditor_id']}</td>
                                <td>{$row['auditor_name']}</td>
                                <td>{$row['budgeted_cost']}</td>
                                <td>{$row['total_cost']}</td>
                                <td>{$row['variance']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='21'>No records found</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='21'>Error: " . $e->getMessage() . "</td></tr>";
                }
            ?>
            </tbody>
        </table>
        </section>

        <div class="gap" id="create-report-section"></div>
        <section class="create-report">
            <h2 class="create-report-title">Generate Invoice:</h2>
            <form method="post" action="technical.php">
        <div class="field-row">
            <div class="field">
                <label for="invoice-id">Invoice ID:</label>
                <input type="text" id="invoice-id" name="invoice-id">
            </div>
            <div class="field">
                <label for="disco-id">DISCO ID:</label>
                <input type="text" id="disco-id" name="disco-id">
            </div>
            <div class="field">
                <label for="bill-issue-date">Bill Issue Date:</label>
                <input type="date" id="bill-issue-date" name="bill-issue-date">
            </div>
            <div class="field">
                <label for="due-date">Due Date:</label>
                <input type="date" id="due-date" name="due-date">
            </div>
            <div class="field">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount">
            </div>
            <div class="field">
                <label for="amount-paid">Amount Paid:</label>
                <input type="text" id="amount-paid" name="amount-paid">
            </div>
            <div class="field">
                <label for="payment-date">Payment Date:</label>
                <input type="date" id="payment-date" name="payment-date">
            </div>
            <div class="field">
                <label for="charges">Charges:</label>
                <input type="text" id="charges" name="charges">
            </div>
            <div class="field">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="field">
                <label for="last-updated">Last Updated:</label>
                <input type="date" id="last-updated" name="last-updated">
            </div>
            <div class="field">
                <label for="revised-by">Revised By:</label>
                <input type="text" id="revised-by" name="revised-by">
            </div>
            <div class="field">
                <label for="comments">Comments:</label>
                <input type="text" id="comments" name="comments">
            </div>
        </div>
        <div class="buttons">
            <button class="light-green" type="submit">Submit</button>
            <button class="light-green" type="reset">Clear All</button>
        </div>
    </form>
            <?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice-id'];
    $disco_id = $_POST['disco-id'];
    $bill_issue_date = $_POST['bill-issue-date'];
    $due_date = $_POST['due-date'];
    $amount = $_POST['amount'];
    $amount_paid = $_POST['amount-paid'];
    $payment_date = $_POST['payment-date'];
    $charges = $_POST['charges'];
    $status = $_POST['status'];
    $last_updated = $_POST['last-updated'];
    $revised_by = $_POST['revised-by'];
    $comments = $_POST['comments'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO invoices (invoice_id, disco_id, bill_issue_date, due_date, amount, amount_paid, payment_date, charges, status, last_updated, revised_by, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $invoice_id, $disco_id, $bill_issue_date, $due_date, $amount, $amount_paid, $payment_date, $charges, $status, $last_updated, $revised_by, $comments);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New invoice record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
        </section>

        <div class="gap"  id="review-status-section"></div>
        <section class="review-status">
            <h2 class="review-status-title">Review Status:</h2>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Invoice ID</th>
                        <th>DISCO Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section> 
    </main>
</body>
</html>