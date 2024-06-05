<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendeX</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="Faculty_statistics1">
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
          <div class="welcome">
            <h1>Welcome to AttendeX</h1>
            <p><?php 
            session_start();
            echo $_SESSION['username']; ?></p>
          </div>
          <div class="container">         
            <div class="about-section">
              <div class="name">
              
              <div style="text-align: justify;">
                <h2>Know AttendeX...</h2>
                <p>Our team <b>Casual Coders</b>, developed an Attendance Management System for college lectures. This system helps track attendance using various technologies such as PHP, HTML, CSS, JavaScript, Flutter, Python, Flask, and MongoDB.

                  The system consists of different modules. One module involves using Google Spreadsheet, a tool for managing and storing attendance data efficiently.
                  
                  For faculty members, we created a web application where they can input basic details about the subjects they teach. This includes information like the course name, date, and time of lectures.
                  
                  The system generates QR codes based on the information provided by faculty members. These QR codes act as identifiers for each lecture session.
                  
                  Students use a mobile application to scan the QR codes displayed during the lectures. This mobile app serves a dual purpose: it scans the QR codes and collects data about attended lectures.
                  
                  Overall, our system streamlines attendance management for colleges by providing a user-friendly interface for faculty members and students alike. It simplifies the process of recording attendance, reducing paperwork, and ensuring accuracy.
                  
                  Stay connected with us for the latest updates. Thank you for visiting!</p>
                <br> </br>
                <p>- Team AttendeX</p>
            </div>
            
        </div>
</body>
</html>