<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Viewer</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;  
            padding: 0;
            background-color: #b0e0e6;
        }
        .container {
            width: 85%;
            margin: 90px auto;
            display: flex;
            justify-content: space-between;
            background-color:#dcdcdc;
            padding: 90px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .data-container {
            flex: 1;
            margin-right: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 110%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
            background-color: #ffffff;
        }
        th {
            background-color: #b76e79;
        }
        tr:nth-child(even) {
            background-color: #f0ffff;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .form-container {
            flex: 1;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container form {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #b76e79;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .form-container input[type="submit"]:hover {
            background-color:#b76e79;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="data-container">
            <h2>Student Database</h2>
            <table>
                <tr>
                    <th>Student id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>CGPA</th>
                    <th>Additional Data</th>
                </tr>
                <?php
                // Include the database connection file
                include_once 'dbh.inc.php';

                try {
                    // Prepare and execute the query
                    $stmt = $pdo->query("SELECT * FROM students");
                    
                    // Fetch the results and display them in a table
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['student_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['cgpa']}</td>
                                <td>{$row['additional_data']}</td>
                              </tr>";
                    }
                } catch(PDOException $e) {
                    // Display an error message if query fails
                    echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </table>
        </div>
        
        <div class="form-container">
            <h2>Add New Student</h2>
            <form action="insert.php" method="POST">
                <input type="number" name="student_id" placeholder="ID" required>
                <input type="text" name="name" placeholder="Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <input type="number" step="0.01" name="cgpa" placeholder="CGPA" required>
                <input type="text" name="additional_data" placeholder="Additional Data">
                <input type="submit" value="Add Student">
            </form>
        </div>
    </div>
</body>
</html>         