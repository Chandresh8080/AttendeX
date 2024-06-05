<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendeX</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>

<?php
session_start(); // Initialize session

require 'C:\Users\ADMIN\vendor\autoload.php';

// Function to handle form submission
function handleFormSubmission() {
    // MongoDB Atlas connection parameters
    $uri = 'mongodb+srv://patelyagnik0303:<password>@cluster0.qqm8qvs.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

    // Create a MongoDB client
    $client = new MongoDB\Client($uri);

    // Select your database and collection
    $databaseName = "Attendex";
    $collectionName = "subjects";

    $database = $client->$databaseName;
    $collection = $database->$collectionName;

    // Retrieve form data
    $branch = $_POST['Branch'];
    $subjectName = $_POST['subject_name'];
    $subjectCode = $_POST['subject_code'];


    // Create a document to insert into the collection
    $document = [
        '_id' =>$_SESSION["username"]."".$subjectCode,
        'branch' => $branch,
        'faculty' => $_SESSION["username"],
        'subject_name' => $subjectName,
        'subject_code' => $subjectCode,
        'sheet' => $_POST['subject_sheet']
    ];

    // Insert document into MongoDB
    try{
    $result = $collection->insertOne($document);
    if ($result->getInsertedCount() > 0) {
        ?>
        <script>
        alert("Subjected Added sucesfully!");
        </script>
        <?php
    } else {
        ?>
        <script>
        alert("Unable to Add Subject!");
        </script>
        <?php
    }
    }catch(Exception $e){
        ?>
        <script>
        alert("Exception: <?php echo $e->getMessage(); ?>");
        </script>
        <?php
    }
    
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addSubjectBtn'])) {
    handleFormSubmission();
}
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="add1">
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
    </div>

    <div class="center-class">
        <div class="addbox">
            <div class="branch1">
                <label for="Branch">Select Branch:</label>
                <select name="Branch" id="Branch">
                    <option>Select an option</option>
                    <option value="IT">IT</option>
                    <option value="CP">CP</option>
                    <option value="IOT">IOT</option>
                    <option value="CSD">CSD</option>
                </select>
            </div>

            <label for="subject_name">Subject Name</label>
            <input type="text" id="subject_name" name="subject_name" required>

            <label for="subject_code">Subject Code</label>
            <input type="text" id="subject_code" name="subject_code" required>

            <label for="subject_sheet">Google Sheet</label>
            <input type="text" id="subject_sheet" name="subject_sheet" required>

            <div class="form-group pt-1">
                <button class="btn btn-primary btn-block" type="submit" name="addSubjectBtn">Add Subject</button>
            </div>
        </div>
    </div>
    </form>
</body>
</html>