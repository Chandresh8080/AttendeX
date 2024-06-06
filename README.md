# AttendeX

AttendeX is a comprehensive attendance management system designed for both faculty and students. This system includes a Custom API, a Faculty Dashboard, and a Student Application.
Working video : https://youtu.be/xRAUWUPKdy8

## Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Directory Structure](#directory-structure)
- [Contributing](#contributing)

## Overview

AttendeX aims to streamline the process of attendance tracking and management, providing a seamless experience for educational institutions.

## Features

- **Faculty Dashboard**: Allows faculty members to manage and view attendance statistics.
- **Student Application**: Enables students to view their attendance records.
- **Custom API**: Facilitates integration with Google Maps and other services.

## Installation

### Prerequisites

- Python 3.x
- PHP 7.x or higher
- Flutter SDK
- Google Cloud credentials (for Custom API)

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/AttendeX.git
   cd AttendeX
   ```

2. **Setup Custom API:**

   Navigate to the `CustomAPI` directory and install the required Python packages:

   ```bash
   cd CustomAPI
   pip install -r requirements.txt
   ```

3. **Setup Faculty Dashboard:**

   Deploy the PHP files located in the `FacultyDashboard` directory to your web server.

4. **Setup Student Application:**

   Navigate to the `StudentApplication` directory and run the Flutter app:

   ```bash
   cd StudentApplication/AttendeX
   flutter pub get
   flutter run
   ```

## Usage

### Faculty Dashboard

- Access the dashboard through your web browser.
- Login using your credentials.
- Manage and view attendance statistics.

### Student Application

- Download and install the application on your mobile device.
- Login to view your attendance records.

## Directory Structure

```
AttendeX-main/
├── CustomAPI/
│   ├── g-maps-route-api-4a6aac3d364c.json
│   ├── main.py
│   ├── ok.py
│   ├── sheets_functions.py
│   └── template/
│       ├── app.js
│       ├── index.html
│       └── script.js
├── FacultyDashboard/
│   ├── Student_statistics.css
│   ├── add.css
│   ├── add.php
│   ├── demo.php
│   ├── faculty.css
│   ├── faculty_statistics.php
│   ├── home.css
│   ├── home.php
│   ├── index.php
│   ├── index2.php
│   ├── index_style.css
│   ├── login.php
│   ├── login_style.css
│   ├── logout.php
│   ├── qr.css
│   ├── reg_style.css
│   └── regis_style.css
└── StudentApplication/
    └── AttendeX/
        ├── android/
        ├── assets/
        ├── build/
        ├── ios/
        ├── lib/
        │   ├── firebase_options.dart
        │   └── main.dart
        ├── test/
        │   └── widget_test.dart
        └── pubspec.yaml
```

## Contributing

We welcome contributions to improve AttendeX. Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

