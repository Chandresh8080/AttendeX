<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendeX</title>
    <link rel="stylesheet" href="update.css">
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
    <!-- <h2>Update Subject</h2> -->
    <div class="table-container">

        <?php
        // Include Composer autoloader
        require 'C:\Users\ADMIN\vendor\autoload.php';

        session_start();
        if(!isset($_SESSION["username"])){
            header("location:login.php");
        }

        // MongoDB connection string
        $uri = 'mongodb+srv://patelyagnik0303:<password>@cluster0.qqm8qvs.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

        // Create a new MongoDB client
        $client = new MongoDB\Client($uri);

        // Select your database and collection
        $databaseName = "Attendex";
        $collectionName = "subjects";

        $database = $client->$databaseName;
        $collection = $database->$collectionName;

        // Retrieve parameters from POST request
        if (isset($_POST['updateSubjectBtn'])) {
            // error_reporting(0);
            $subjectId = $_SESSION['username']."".$_POST['s_code'];
            $subjectName = $_POST['s_subject'];
            $subjectCode = $_POST['s_code'];
            $subjectSheet = $_POST['s_sheet'];
            $branch = $_POST['s_branch'];

            // echo($subjectId);

            // Delete the document with the specified _id
            $deleteResult = $collection->deleteOne(['_id' => $subjectId]);

            // Check if the deletion was successful
            if ($deleteResult->getDeletedCount() > 0) {
                // Insert a new document with the updated values
                $document = [
                    '_id' => $subjectId,
                    'branch' => $branch,
                    'faculty' => $_SESSION["username"],
                    'subject_name' => $subjectName,
                    'subject_code' => $subjectCode,
                    'sheet' => $subjectSheet
                ];

                // Insert document into MongoDB
                $insertResult = $collection->insertOne($document);

                // Check if the insertion was successful
                if ($insertResult->getInsertedCount() > 0) {
                    // echo 'Subject updated successfully.';
                } else {
                    echo 'Critical ' . $deleteResult->getError();
                }
            } else {
                echo 'Failed to delete existing subject. Error: '.$deleteResult->getError();;
            }
        }

        // Fetch all subjects
        $subjects = $collection->find(['faculty' => $_SESSION["username"]]);
        ?>
        <table>
            <tr>
                <th>Subject Code</th>
                <th>Branch</th>
                <th>Subject Name</th>
                <th>Google Sheet</th>
                <th>Action</th>
            </tr>
            <?php foreach ($subjects as $subject) : ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <tr>
                        <td>
                            <input type="text" value="<?php echo isset($subject['subject_code']) ? $subject['subject_code'] : ''; ?>" name="s_code" readonly>
                        </td>

                        <td>
                            <input type="text" value="<?php echo isset($subject['branch']) ? $subject['branch'] : ''; ?>" name="s_branch">
                        </td>

                        <td>
                            <input type="text" value="<?php echo isset($subject['subject_name']) ? $subject['subject_name'] : ''; ?>" name="s_subject">
                        </td>
                        <td>
                            <input type="text" value="<?php echo isset($subject['sheet']) ? $subject['sheet'] : ''; ?>" name="s_sheet">
                        </td>

                        <td>
                            <input type="hidden" name="subjectId" value="<?php echo $subject['_id']; ?>">
                            <input type="submit" name="updateSubjectBtn" value="Update">
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>