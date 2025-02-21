<!DOCTYPE html>
<html>
<head>
    <title>Students Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>

<h2>Students Data</h2>
<a href="index.php">add a new student</a>

<?php
$host = 'localhost';
$dbname = 'unvirsity'; // Make sure the database name is spelled correctly

$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT first_name, last_name, email, date_of_birth, gender, major, enrollment_year FROM students";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Date of Birth</th><th>Gender</th><th>Major</th><th>Enrollment Year</th><th>Actions</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['email']."</td><td>".$row['date_of_birth']."</td><td>".$row['gender']."</td><td>".$row['major']."</td><td>".$row['enrollment_year']."</td>";
            echo "<td>";
            echo "<form action='update.php' method='POST'>";
            echo "<input type='hidden' name='email' value='".$row['email']."'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "<form action='delete.php' method='POST'>";
            echo "<input type='hidden' name='email' value='".$row['email']."'>";
            echo "<input type='submit' value='Delete' onclick='return confirm(\"Are you sure?\");'>";
            echo "</form>";
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>
