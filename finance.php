<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="finance.css">
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
        .highlight {
            background-color: red;
            color: white;
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
        <a href="#npcc-report-section"><button>NPCC Report</button></a>
        <a href="#create-report-section"><button>Create Report</button></a>
        <a href="#review-status-section"><button>Analytics & Reporting</button></a>
    </aside>

    <main>
    <div class="gap" id="leaderboard-section"></div>
        <h2 class="npcc-report-title">Search a Report from Technical Team</h2>
        <form method="POST" action="" id="searchForm" onsubmit="searchTable(event)">
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
                    <label for="ipp-invoice-number">IPP Invoice Number:</label>
                    <input type="text" id="ipp-invoice-number">
                </div>
                <div class="field">
                    <label for="comments">Comments by Technical Team:</label>
                    <input type="text" id="comments">
                </div>
            </div>
            </div>
            <div class="buttons">
            <button type="submit" name="search" class="light-green">Search</button>
                <button class="light-green">Clear All</button>
            </div>
            </form>
        </section>

        <div class="gap" id="npcc-report-section"></div>
        <section class="report">
        <h2 class="npcc-report-title">Report:</h2>
        <table id="npccReportingTable" border="1">
                <thead>
                    <tr>
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
                        <th>Source</th>
                        <th>Reviewer ID</th>
                        <th>Review Date</th>
                        <th>Status</th>
                        <th>Submission Date</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'dbconnect.php';

                    // Prepare and execute query to fetch data from the database
                    $query = " SELECT 
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
                            COALESCE(tr.source, '-') AS source,
                            COALESCE(tr.reviewer_id, '-') AS reviewer_id,
                            COALESCE(tr.review_date, '-') AS review_date,
                            COALESCE(tr.status, '-') AS status,
                            COALESCE(tr.submission_date, '-') AS submission_date,
                            COALESCE(tr.comments, '-') AS comments
                        FROM 
                            npcc_reporting npcc
                        LEFT JOIN 
                            technicalreport tr 
                        ON 
                            npcc.demand_number = tr.demand_number";

                    $stmt = $pdo->query($query);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display search results
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "<tr>
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
                                <td>{$row['source']}</td>
                                <td>{$row['reviewer_id']}</td>
                                <td>{$row['review_date']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['submission_date']}</td>
                                <td>{$row['comments']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='16'>No records found</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </section>
        <div class="gap" id="create-report-section"></div>
        <section class="create-report">
            <br>
            <h2 class="create-report-title">Create Report:</h2><br>
            <form method="post" action="finance.php">
            <div class="field">
                    <label for="demand-number">Demand Number:</label>
                    <input type="text" id="demand-number" name="demand-number">
                </div>
  <div class="field">
    <label for="report-id">Report ID:</label>
    <input type="text" id="report-id" name="report-id">
  </div>
  <div class="field">
    <label for="reviewed-by-id">Reviewed by ID:</label>
    <input type="text" id="reviewed-by-id" name="reviewed-by-id">
  </div>
  <div class="field">
    <label for="review-date">Review Date:</label>
    <input type="date" id="review-date" name="review-date">
  </div>
  <div class="field">
    <label for="status">Status:</label>
    <input type="text" id="status" name="status">
  </div>
  <div class="field">
    <label for="approval-date">Approval Date:</label>
    <input type="date" id="approval-date" name="approval-date">
  </div>
  <div class="field">
    <label for="auditor-id">Auditor ID:</label>
    <input type="text" id="auditor-id" name="auditor-id">
  </div>
  <div class="field">
    <label for="auditor-name">Auditor Name:</label>
    <input type="text" id="auditor-name" name="auditor-name">
  </div>
  <div class="field">
    <label for="budgeted-cost">Budgeted Cost:</label>
    <input type="text" id="budgeted-cost" name="budgeted-cost">
  </div>
  <div class="field">
    <label for="total-cost">Total Cost:</label>
    <input type="text" id="total-cost" name="total-cost">
  </div>
  <div class="field">
    <label for="variance">Variance:</label>
    <input type="text" id="variance" name="variance">
  </div>
  <div class="buttons">
    <button type="submit" class="light-green">Submit</button>
    <button type="reset" class="light-green">Clear All</button>
  </div>
</form>
<?php
include 'dbconnect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Define required fields
     $requiredFields = ['demand-number','report-id', 'reviewed-by-id', 'review-date', 'status', 'approval-date', 'auditor-id', 'auditor-name', 'budgeted-cost', 'total-cost', 'variance'];

     // Check for missing fields
     $missingFields = array_diff($requiredFields, array_keys($_POST));
     
     if (!empty($missingFields)) {
         echo "Missing fields: " . implode(', ', $missingFields);
         // Handle missing fields appropriately, such as displaying an error message and stopping further execution
         exit();
     }
    // Prepare and bind
    $stmt = $pdo->prepare("INSERT INTO reports (demand_number,report_id, reviewed_by_id, review_date, status, approval_date, auditor_id, auditor_name, budgeted_cost, total_cost, variance) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssissss", $demand_number,$report_id, $reviewed_by_id, $review_date, $status, $approval_date, $auditor_id, $auditor_name, $budgeted_cost, $total_cost, $variance);

    // Set parameters and execute
    $demand_number = $_POST['demand-number'];
    $report_id = $_POST['report-id'];
    $reviewed_by_id = $_POST['reviewed-by-id'];
    $review_date = $_POST['review-date'];
    $status = $_POST['status'];
    $approval_date = $_POST['approval-date'];
    $auditor_id = $_POST['auditor-id'];
    $auditor_name = $_POST['auditor-name'];
    $budgeted_cost = $_POST['budgeted-cost'];
    $total_cost = $_POST['total-cost'];
    $variance = $_POST['variance'];

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
        </section>

        <div class="gap"  id="review-status-section"></div>
        <section class="review-status"><br>
            <h2 class="review-status-title">Review Status:</h2><br>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Demand Number</th>
                        <th>Pending</th>
                        <th>Approved</th>
                        <th>Rejected</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'dbconnect.php';

                    // Retrieve all demand numbers from npcc_reporting
                    $demandNumbersQuery = "SELECT demand_number FROM npcc_reporting";
                    $demandNumbersStmt = $pdo->query($demandNumbersQuery);
                    $demandNumbers = $demandNumbersStmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($demandNumbers) > 0) {
                        foreach ($demandNumbers as $demand) {
                            $demandNumber = $demand['demand_number'];

                            // Query to get the status counts from technicalreport
                            $statusQuery = "SELECT 
                                                SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending,
                                                SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved,
                                                SUM(CASE WHEN status = 'Rejected' THEN 1 ELSE 0 END) as rejected
                                            FROM reports
                                            WHERE demand_number = :demand_number";

                            $statusStmt = $pdo->prepare($statusQuery);
                            $statusStmt->execute(['demand_number' => $demandNumber]);
                            $statusResult = $statusStmt->fetch(PDO::FETCH_ASSOC);

                            // Check if the demand number has any records in technicalreport
                            if ($statusResult) {
                                $pending = $statusResult['pending'] > 0 ? $statusResult['pending'] : '-';
                                $approved = $statusResult['approved'] > 0 ? $statusResult['approved'] : '-';
                                $rejected = $statusResult['rejected'] > 0 ? $statusResult['rejected'] : '-';

                                // If there are no approved or rejected records, mark as pending
                                if ($pending === '-' && $approved === '-' && $rejected === '-') {
                                    $pending = 1;
                                    $approved = '-';
                                    $rejected = '-';
                                }
                            } else {
                                // If no records found, mark as pending
                                $pending = 1;
                                $approved = '-';
                                $rejected = '-';
                            }

                            echo "<tr>
                                <td>{$demandNumber}</td>
                                <td>{$pending}</td>
                                <td>{$approved}</td>
                                <td>{$rejected}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </section> 
    </main>
    <script>
        function searchTable(event) {
            event.preventDefault();
            const powerType = document.getElementById('power-type').value.toLowerCase();
            const powerProducer = document.getElementById('power-producer').value.toLowerCase();
            const transferToAP = document.getElementById('transfer-to-ap').value.toLowerCase();
            const disputeLetter = document.getElementById('dispute-letter').value.toLowerCase();
            const ippInvoiceNumber = document.getElementById('ipp-invoice-number').value.toLowerCase();
            const demandNumber = document.getElementById('demand-number').value.toLowerCase();
            
            const table = document.getElementById('npccReportingTable');
            const rows = table.getElementsByTagName('tr');
        
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let rowContainsSearchInput = false;

                rows[i].classList.remove('highlight');

                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toLowerCase();
                    
                    if (powerType && cellValue.includes(powerType)) rowContainsSearchInput = true;
                    if (powerProducer && cellValue.includes(powerProducer)) rowContainsSearchInput = true;
                    if (transferToAP && cellValue.includes(transferToAP)) rowContainsSearchInput = true;
                    if (disputeLetter && cellValue.includes(disputeLetter)) rowContainsSearchInput = true;
                    if (ippInvoiceNumber && cellValue.includes(ippInvoiceNumber)) rowContainsSearchInput = true;
                    if (demandNumber && cellValue.includes(demandNumber)) rowContainsSearchInput = true;
                }

                if (rowContainsSearchInput) {
                    rows[i].classList.add('highlight');
                }
            }
        }
    </script>
</body>
</html>