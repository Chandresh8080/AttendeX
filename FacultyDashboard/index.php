<?php
session_start();
if(!isset($_SESSION["username"])){
    header("location:login.php");
}

// Include Composer autoloader
require 'C:\Users\ADMIN\vendor\autoload.php';

// MongoDB connection string
$uri = 'mongodb+srv://patelyagnik0303:<password>@cluster0.qqm8qvs.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

// Create a new MongoDB client
$client = new MongoDB\Client($uri);

// Select your database and collection
$databaseName = "Attendex";
$collectionName = "subjects";

$database = $client->$databaseName;
$collection = $database->$collectionName;

// Fetch all subjects
// Fetch subjects only if the faculty matches the currently logged-in user
$subjects = $collection->find(['faculty' => $_SESSION["username"]]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_Style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="app.js"></script>
    <title>AttendeX</title>
</head>
<body>
<nav id="sidebar">
    <div class="title">AttendeX</div>
    <ul class="list-items">
              <li><a href="home.php" class="active"><i class="faculty-1"></i>Home</a></li>
              <li><a href="add.php" class="active"><i class="add-1"></i>Add Subject</a></li>
              <li><a href="Update.php" class="active"><i class="update-1"></i>Update Subject</a></li>
              <li><a href="index.php" class="active1"><i class="qr-1"></i>Generate QR</a></li>
              <li><a href="student_statistics.php" class="active"><i class="Student-1"></i>Student Logs</li>
              <li><a href="faculty_statistics.php" class="active"><i class="faculty-1"></i>Faculty Statistics</a></li>
              <li><a href="logout.php" class="active"><i class="faculty-1"></i>Logout</a></li>
            </ul>
</nav>
<div class="container">
    <form id="attendanceForm" action="index.php" method="post"> <!-- Add form action and method -->
        <label for="subject">Subject:</label>
        <select id="subject" name="subject" required>
            <option value="">Select a subject</option>
            <?php foreach ($subjects as $subject) : ?>
                <option value="<?php echo $subject['sheet']; ?>"><?php echo $subject['subject_code']."-".$subject['subject_name']."-".$subject['branch']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" id="generateQR">Generate QR Code</button> <!-- Change button type to submit -->
    </form>
    <div id="qrcode"></div>
</div>

<script>
    // JavaScript code for generating QR code
    $(document).ready(function() {
        var refVal = 7500;
        // Function to generate QR code
        function generateQRCode(subjectCode) {
            var currentTimestamp = Math.floor((Date.now() + refVal) / 1000);

            // If subject code is not selected, show an alert
            if (!subjectCode) {
                alert('Please select a subject.');
                return;
            }

            var data = subjectCode + "~" + currentTimestamp;

            // Clear the previous QR code
            $('#qrcode').empty();

            // Generate QR code using the selected subject code
            var qr = new QRCode(document.getElementById('qrcode'), {
                text: data,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            // Schedule the refresh after 5 seconds
            setTimeout(function() {
                // Call the function again to generate a new QR code with updated timestamp
                generateQRCode(subjectCode);
            }, refVal);
        }

        // Bind form submission event to generate QR code
        $('#attendanceForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var subjectCode = $('#subject').val();
            generateQRCode(subjectCode); // Generate QR code with the selected subject code
        });
        
        // Call the function to generate QR code initially
        var initialSubjectCode = $('#subject').val(); // Get initial selected subject code
        generateQRCode(initialSubjectCode);
    });
</script>

</body>
</html>
