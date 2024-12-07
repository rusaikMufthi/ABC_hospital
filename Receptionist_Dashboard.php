<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard - ABC Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar styling */
        .sidebar {
            width: 220px;
            background: #ff9790;
            height: 100vh;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ff3d02;
        }

        .sidebar .logout {
            margin-top: auto;
            background-color: #d9534f;
            text-align: center;
            margin-bottom: 3rem;
        }

        /* Main content styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .main-content h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            margin: 0;
            font-size: 20px;
            color: #ff6f61;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        /* Table styling */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .table-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #ff6f61;
            color: white;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .cards {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Receptionist Dashboard</h2>
        <a href="#overview">Overview</a>
        <a href="#appointments">Manage Appointments</a>
        <a href="#patients">Patient Details</a>
        <a href="#messages">Messages</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome, <?php echo htmlspecialchars($receptionist_name); ?>!</h1>

        <!-- Overview Cards -->
        <div id="overview" class="cards">
            <div class="card">
                <h3>Total Patients</h3>
                <p><?php echo htmlspecialchars($total_patients); ?></p>
            </div>
            <div class="card">
                <h3>Today's Appointments</h3>
                <p><?php echo htmlspecialchars($todays_appointments); ?></p>
            </div>
            <div class="card">
                <h3>Pending Appointments</h3>
                <p><?php echo htmlspecialchars($pending_appointments); ?></p>
            </div>
        </div>

        <!-- Appointments Table -->
        <div class="table-container" id="appointments">
            <h2>Manage Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($appointments)) {
                        foreach ($appointments as $appointment) {
                            echo "<tr>
                                    <td>{$appointment['id']}</td>
                                    <td>{$appointment['patient_name']}</td>
                                    <td>{$appointment['doctor_name']}</td>
                                    <td>{$appointment['date']}</td>
                                    <td>{$appointment['time']}</td>
                                    <td>{$appointment['status']}</td>
                                    <td>
                                        <a href='edit_appointment.php?id={$appointment['id']}' style='color: blue;'>Edit</a> | 
                                        <a href='delete_appointment.php?id={$appointment['id']}' style='color: red;'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No appointments found</td></tr>";
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
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Reason</th>
                        <th>Doctor</th>
                        <th>Appointment Date</th>
                        <th>Time</th>
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
                                    <td>{$patient['doctor_name']}</td>
                                    <td>{$patient['date']}</td>
                                    <td>{$patient['time']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No patient details available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Messages Section -->
        <div class="table-container" id="messages">
            <h2>Messages</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Service</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($messages)) {
                        foreach ($messages as $message) {
                            echo "<tr>
                                    <td>{$message['id']}</td>
                                    <td>{$message['patient_name']}</td>
                                    <td>{$message['service']}</td>
                                    <td>{$message['message']}</td>
                                    <td>{$message['date']}</td>
                                    <td>
                                        <a href='resolve_message.php?id={$message['id']}' style='color: green;'>Resolve</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No messages found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
