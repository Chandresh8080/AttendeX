<?php
session_start();

// Include Composer autoloader
require 'C:\Users\ADMIN\vendor\autoload.php';

// MongoDB connection string
$uri = 'mongodb+srv://patelyagnik0303:<password>@cluster0.qqm8qvs.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

// Create a new MongoDB client
$client = new MongoDB\Client($uri);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginBtn'])) {
    // Get form data
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Select the database and collection
        $database = $client->selectDatabase('Attendex');
        $collection = $database->selectCollection('faculty');

        // Find user by username
        $user = $collection->findOne(['_id' => $username]);

        // Check if user exists and password matches
        if ($user !== null && isset($user['password']) && $user['password'] === $password) {
            $_SESSION['username'] = $username;
            // Not sure where $regEmail is defined, assuming it's part of $user
            $_SESSION['user_id'] = $user['_id'];
            header("location:index.php");
            exit(); // Stop script execution after redirect
        } else {

            // Username or password is incorrect
            $errorMessage = "Incorrect username or password".$user."----";
        }
    } else {
        // Username or password not provided
        $errorMessage = "Please provide both username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>HTML Login Page with Bootstrap Example</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Muli'>
  <link rel="stylesheet" href="login_style.css">
</head>

<body>
  <div class="pt-5">
    <h1 class="text-center">AttendeX</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-5 mx-auto">
          <div class="card card-body">
            <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group required">
                <label for="username">Email</label>
                <input type="text" class="form-control text-lowercase" id="username" required="" name="username" value="">
              </div>
              <div class="form-group required">
                <label class="d-flex flex-row align-items-center" for="password">Password
                  <a class="ml-auto border-link small-xl" href="/forget-password">Forget?</a>
                </label>
                <input type="password" class="form-control" required="" id="password" name="password" value="">
              </div>
              <div class="form-group mt-4 mb-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="remember-me" name="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember me?</label>
                </div>
              </div>
              <div class="form-group pt-1">
                <button class="btn btn-primary btn-block" type="submit" name="loginBtn">Log In</button>
              </div>
            </form>
            <p class="small-xl pt-3 text-center">
              <span class="text-muted">Not a member?</span>
              <a href="register.php">Sign up</a>
            </p>
            <?php if(isset($errorMessage)): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>