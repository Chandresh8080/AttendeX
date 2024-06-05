<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="regis_style.css">
</head>
<body>
  <h1 class="h1">Registration</h1>
  <div class="form-container">
    <form id="registrationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div>
        <label for="regEmail">Email</label>
        <input type="email" id="regEmail" name="regEmail" required>
      </div>
      <div>
        <label for="regName">Name</label>
        <input type="text" id="regName" name="regName" required>
      </div>
      <div>
        <label for="regPassword">Password</label>
        <input type="password" id="regPassword" name="regPassword" required>
      </div>
      <div>
        <label for="regConfirmPassword">Confirm Password</label>
        <input type="password" id="regConfirmPassword" name="regConfirmPassword" required>
      </div>
      <input type="hidden" name="action" value="register">
      <button type="submit" id="registerBtn">Register</button>
      <div id="message"><?php echo $message ?? ''; ?></div> <!-- Container to display the insertion status -->
    </form>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("registrationForm").addEventListener("submit", function (event) {
      var regEmail = document.getElementById("regEmail").value;
      var regName = document.getElementById("regName").value;
      var regPassword = document.getElementById("regPassword").value;
      var regConfirmPassword = document.getElementById("regConfirmPassword").value;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var nameRegex = /^[a-zA-Z]+$/; // Regex to ensure only alphabetic characters in name

      if (!emailRegex.test(regEmail)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
      }

      if (regName.length < 5 || !nameRegex.test(regName)) {
        alert("Name must be at least 5 characters long and contain only alphabetic characters.");
        event.preventDefault();
        return false;
      }

      if (regPassword.length < 8) {
        alert("Password must be at least 8 characters long.");
        event.preventDefault();
        return false;
      }

      if (regPassword !== regConfirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
        return false;
      }
    });
  });
</script>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register') {
    // Server-side validation
    $regUsername = $_POST['regName'];
    $regEmail = $_POST['regEmail'];
    $regPassword = $_POST['regPassword'];

    // Define regular expressions for username and password validation
    $usernamePattern = '/^[a-zA-Z]{5,}$/'; // Username must be at least 5 characters long and contain only letters
    $passwordPattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'; // Password must be at least 8 characters long, contain at least one digit, one lowercase letter, and one uppercase letter

    if (!preg_match($usernamePattern, $regUsername)) {
        $message = "Error: Username must be at least 5 characters long and contain only letters.";
        // $message;
        echo $message;
        exit;
    }

    if (!preg_match($passwordPattern, $regPassword)) {
        $message = "Error: Password must be at least 8 characters long and contain at least one digit, one lowercase letter, and one uppercase letter.";
        // $message;
        echo $message;
        exit;
    }

    // Continue with MongoDB insertion
    require 'C:\Users\ADMIN\vendor\autoload.php'; // Include the Composer autoloader

    // MongoDB connection string
    $uri = 'mongodb+srv://patelyagnik0303:<password>@cluster0.qqm8qvs.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

    try {
        // Create a new MongoDB client
        $client = new MongoDB\Client($uri);

        // Select the database and collection
        $database = $client->selectDatabase('Attendex');
        $collection = $database->selectCollection('faculty');

        // Insert the data into the collection
        $result = $collection->insertOne([
            'name' => $regUsername,
            '_id' => $regEmail,
            'password' => $regPassword
        ]);

        // Set message based on insertion result
        if ($result->getInsertedCount() > 0) {
            $message = "Data inserted successfully!";
            $_SESSION['username'] = $regUsername;
            $_SESSION['_id'] = $regEmail;
            header("Location:index.php");
        } else {
            $message = "Error: Data insertion failed!";
            echo $message;
        }
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
        // Handle duplicate key error gracefully
        $message = "Error: Email already exists!";
        echo $message;
    } catch (Exception $e) {
        // Handle other exceptions
        $message = "Error: " . $e->getMessage();
        echo $message;
    }
}
?>


</body>
</html>
