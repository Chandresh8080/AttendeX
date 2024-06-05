<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_Style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="app.js"></script>
    <title>Faculty</title>
</head>
<body>
    <div class="container">
        <h2>Attendance By QR</h2>
        <form id="attendanceForm">
            <label for="date">Date:</label>
            <input type="date" id="date" required>

            <label for="subject">Subject:</label>
            <select id="subject" required>
                <option value="DSA">DSA</option>
                <option value="PROGRAMMING_WITH_JAVA">Programming with Java</option>
                <option value="PYTHON_WITH_DATA_SCIENCE">Python with Data Science</option>
                <option value="PROGRAMMING_WITH_C">Programming with C</option>
                <option value="LAB_CPP">Lab C++</option>
            </select>

            <button type="button" id="generateQR">Generate QR Code</button>
        </form>
        <div id="qrcode"></div>
    </div>
</body>
</html>
