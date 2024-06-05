<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgetpass.css">
</head>
<body>
<div class="background">
    <div class="container">
        <div class="forgot-password-box">
            <h2>Forgot Password</h2>
            <p>Let us help you</p>
            <p>Please enter your employee ID in the field below. We will send a new password to your official email.</p>
            <form id="forgot-password-form">
                <label for="employee-id">Employee ID:</label>
                <input type="text" id="employee-id" name="employee-id" required>
                <div class="buttons">
                    <button type="button" onclick="submitForm()">Submit</button>
                    <button type="button" onclick="sendAgain()">Send Me Again</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        function submitForm() {
            var employeeId = document.getElementById('employee-id').value;
            if (!employeeId) {
                alert('Please enter your employee ID.');
            } else {
                document.getElementById('forgot-password-form').submit();
            }
        }

        function sendAgain() {
            alert('A new password will be sent to your official email again.');
        }
    </script>
</body>
</html>