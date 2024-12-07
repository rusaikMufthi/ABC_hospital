<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - ABC Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="./css/doctor_dashboard.css"rel="stylesheet">

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Doctor Dashboard</h2>
        <a href="#overview">Overview</a>
        <a href="#appointments">My Appointments</a>
        <a href="#patients">Patient Details</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome, Doctor! </h1>

        <!-- Overview Cards -->
        <div id="overview" class="cards">
            <div class="card">
                <h3>Total Patients</h3>
                <p><?php echo htmlspecialchars($total_patients); ?></p>
            </div>
            <div class="card">
                <h3>Upcoming Appointments</h3>
                <p><?php echo htmlspecialchars($upcoming_appointments); ?></p>
            </div>
            <div class="card">
                <h3>Completed Appointments</h3>
                <p><?php echo htmlspecialchars($completed_appointments); ?></p>
            </div>
        </div>

        <!-- Appointments Table -->
        <div class="table-container" id="appointments">
            <h2>My Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Replace placeholders with dynamic data
                    if (!empty($appointments)) {
                        foreach ($appointments as $appointment) {
                            echo "<tr>
                                    <td>{$appointment['id']}</td>
                                    <td>{$appointment['patient_name']}</td>
                                    <td>{$appointment['date']}</td>
                                    <td>{$appointment['time']}</td>
                                    <td>{$appointment['status']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No appointments found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Patient Details Section -->
        <div class="table-container" id="patients">
            <h2>Patient Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Reason</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($patients)) {
                        foreach ($patients as $patient) {
                            echo "<tr>
                                    <td>{$patient['name']}</td>
                                    <td>{$patient['age']}</td>
                                    <td>{$patient['gender']}</td>
                                    <td>{$patient['contact']}</td>
                                    <td>{$patient['reason']}</td>
                                    <td>{$patient['date']}</td>
                                    <td>{$patient['time']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No patient details available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
