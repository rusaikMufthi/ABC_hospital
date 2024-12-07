<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ABC Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="./css/admin_dashboard.css"rel="stylesheet">

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="#overview">Overview</a>
        <a href="#doctors">Manage Doctors</a>
        <a href="#receptionists">Manage Receptionists</a>
        <a href="#appointments">View Appointments</a>
        <a href="#settings">Settings</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <center><h1>Welcome, Admin!</h1></center>

        <!-- Overview Section -->
        <div id="overview">
            <h2>Overview</h2>
            <div class="cards">
                <div class="card">
                    <h3>Total Doctors</h3>
                    <p>15</p>
                </div>
                <div class="card">
                    <h3>Total Receptionists</h3>
                    <p>5</p>
                </div>
                <div class="card">
                    <h3>Pending Appointments</h3>
                    <p>25</p>
                </div>
            </div>
        </div>

        <!-- Doctors Table -->
        <div class="table-container" id="doctors">
            <h2>Manage Doctors</h2>
            <a href="add_doctor.php" style="margin-bottom: 10px; display: inline-block; background-color: #ff6f61; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Add Doctor</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder rows, replace with PHP dynamic content -->
                    <tr>
                        <td>1</td>
                        <td>Dr. John Smith</td>
                        <td>General Physician</td>
                        <td>9876543210</td>
                        <td>dr.smith@example.com</td>
                        <td>
                            <a href="edit_doctor.php?id=1" style="color: blue;">Edit</a> | 
                            <a href="delete_doctor.php?id=1" style="color: red;">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Dr. Alice Brown</td>
                        <td>Cardiologist</td>
                        <td>8765432109</td>
                        <td>alice.brown@example.com</td>
                        <td>
                            <a href="edit_doctor.php?id=2" style="color: blue;">Edit</a> | 
                            <a href="delete_doctor.php?id=2" style="color: red;">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>

        <!-- Receptionists Table -->
        <div class="table-container" id="receptionists">
            <h2>Manage Receptionists</h2>
            <a href="add_receptionist.php" style="margin-bottom: 10px; display: inline-block; background-color: #ff6f61; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Add Receptionist</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder rows, replace with PHP dynamic content -->
                    <tr>
                        <td>1</td>
                        <td>Jane</td>
                        <td>Doe</td>
                        <td>9876543210</td>
                        <td>jane.doe@example.com</td>
                        <td>
                            <a href="edit_receptionist.php?id=1" style="color: blue;">Edit</a> | 
                            <a href="delete_receptionist.php?id=1" style="color: red;">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mark</td>
                        <td>Smith</td>
                        <td>8765432109</td>
                        <td>mark.smith@example.com</td>
                        <td>
                            <a href="edit_receptionist.php?id=2" style="color: blue;">Edit</a> | 
                            <a href="delete_receptionist.php?id=2" style="color: red;">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>

        <div class="table-container" id="appointments">
            <h2>Manage Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Contact</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder rows, replace with PHP dynamic content -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>9876543210</td>
                        <td>Dr. Smith</td>
                        <td>2024-11-30</td>
                        <td>10:30 AM</td>
                        <td>Pending</td>
                        <td>
                            <a href="edit_appointment.php?id=1" style="color: blue;">Edit</a> | 
                            <a href="delete_appointment.php?id=1" style="color: red;">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Doe</td>
                        <td>8765432109</td>
                        <td>Dr. Alice Brown</td>
                        <td>2024-12-01</td>
                        <td>02:00 PM</td>
                        <td>Confirmed</td>
                        <td>
                            <a href="edit_appointment.php?id=2" style="color: blue;">Edit</a> | 
                            <a href="delete_appointment.php?id=2" style="color: red;">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>
        
        <!-- Settings Section -->
        <div class="settings-container" id="settings">
            <h2>Settings</h2>
            <form action="update_settings.php" method="POST" class="settings-form">
                <div class="form-group">
                    <label for="admin_email">Admin Email:</label>
                    <input type="email" id="admin_email" name="admin_email" placeholder="admin@example.com" required>
                </div>

                <div class="form-group">
                    <label for="admin_password">Change Password:</label>
                    <input type="password" id="admin_password" name="admin_password" placeholder="New Password">
                </div>

                <div class="form-group">
                    <label for="contact_number">Hospital Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" placeholder="1234567890" required>
                </div>

                <div class="form-group">
                    <label for="notifications">Notification Preferences:</label>
                    <select id="notifications" name="notifications" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>

                <button type="submit" class="btn-update">Update Settings</button>
            </form>
        </div>

            

    </div>
</body>
</html>