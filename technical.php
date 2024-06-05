<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="dbms.css">
    <style>
        .logout button {
    position: relative;
    left: 1650px; /* Moves the element 20 pixels to the left */
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
.highlight
 {
            background-color: red;
            color: white;
        }



        .sidebar {
    background-color: #gray;
    width: 200px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0; 
    padding: 20px;
}

.sidebar button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    background-color: rgb(225, 230, 231);
    border: none;
    border-radius: 5px;
    cursor: pointer;
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
        <h2 class="npcc-report-title">Search a Report:</h2>
        <form method="POST" action="" id="searchForm" onsubmit="searchTable(event)">
        <section class="npcc-report">
            <div class="field-row">
                <div class="field">
                    <label for="power-type">Power Type:</label>
                    <input type="text" id="power-type" name="power-type">
                </div>
                <div class="field">
                    <label for="power-producer">Power Producer:</label>
                    <input type="text" id="power-producer" name="power-producer">
                </div>
                <div class="field">
                    <label for="transfer-to-ap">Transfer to AP:</label>
                    <input type="text" id="transfer-to-ap" name="transfer-to-ap">
                </div>
                <div class="field">
                    <label for="dispute-letter">Dispute Letter:</label>
                    <input type="text" id="dispute-letter" name="dispute-letter">
                </div>
            </div>
            <div class="field-row">
                <div class="field">
                    <label for="ipp-invoice-number">IPP Invoice Number:</label>
                    <input type="text" id="ipp-invoice-number" name="ipp-invoice-number">
                </div>
                <div class="field">
                    <label for="demand-number">Demand Number:</label>
                    <input type="text" id="demand-number" name="demand-number">
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="search" class="light-green">Search</button>
                <button type="reset" class="light-green">Clear All</button>
            </div>
            </form>
        </section>
        <div class="gap" id="npcc-report-section"></div>
        <h2 class="create-report-title">NPCC Report:</h2>
        <div class="gap"></div>
        <section class="report">
            <table id="npccReportingTable" border="1">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include ("dbconnect.php");

                    $query = "SELECT * FROM npcc_reporting";
                    $stmt = $pdo->query($query);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <div class="gap" id="create-report-section"></div>
<section class="create-report">
    <h2 class="create-report-title">Create Report:</h2>
    <form method="post" action="">
        <div class="field-row">
            <div class="field">
                <label for="report-id">Report ID:</label>
                <input type="text" id="report-id" name="report-id">
            </div>
            <div class="field">
                    <label for="demand-number">Demand Number:</label>
                    <input type="text" id="demand-number" name="demand-number">
                </div>
            <div class="field">
                <label for="source">Source:</label>
                <input type="text" id="source" name="source">
            </div>
            <div class="field">
                <label for="reviewer-id">Reviewer ID:</label>
                <input type="text" id="reviewer-id" name="reviewer-id">
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
                <label for="submission-date">Submission Date:</label>
                <input type="date" id="submission-date" name="submission-date">
            </div>
            <div class="field">
                <label for="comments">Comments:</label>
                <input type="text" id="comments" name="comments">
            </div>
        </div>
        <div class="buttons">
            <button type="submit" class="light-green">Submit</button>
            <button type="reset" class="light-green">Clear All</button>
        </div>
    </form>
    <?php
include ("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = ['demand-number','source', 'reviewer-id', 'review-date', 'status', 'submission-date', 'comments'];
    $missingFields = array_diff($requiredFields, array_keys($_POST));
    
    if (!empty($missingFields)) {
        echo "Missing fields: " . implode(', ', $missingFields);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO technicalreport (demand_number,source, reviewer_id, review_date, status, submission_date, comments) VALUES (?,?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss",$demand_number, $source, $reviewer_id, $review_date, $status, $submission_date, $comments);

    $demand_number = $_POST['demand-number'];
    $source = $_POST['source'];
    $reviewer_id = $_POST['reviewer-id'];
    $review_date = $_POST['review-date'];
    $status = $_POST['status'];
    $submission_date = $_POST['submission-date'];
    $comments = $_POST['comments'];

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
                                    FROM technicalreport
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