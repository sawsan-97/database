<?php
$host = 'localhost';
$dbname = 'unvirsity'; // Ensure the database name is correct
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $major = $_POST['major'];
        $enrollment_year = $_POST['enrollment_year'];
        $address = $_POST['address']; // New field
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO students (first_name, last_name, email, date_of_birth, gender, major, enrollment_year, address, created_at, updated_at) 
                VALUES (:first_name, :last_name, :email, :date_of_birth, :gender, :major, :enrollment_year, :address, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':major', $major);
        $stmt->bindParam(':enrollment_year', $enrollment_year);
        $stmt->bindParam(':address', $address); // New field
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);

        if ($stmt->execute()) {
            echo "Student information inserted successfully.";
        } else {
            echo "Error inserting student information.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>

<h2>Create Student</h2>

<form action="" method="POST">
    First Name: <input type="text" name="first_name" required><br>
    Last Name: <input type="text" name="last_name" required><br>
    Email: <input type="email" name="email" required><br>
    Date of Birth: <input type="date" name="date_of_birth" required><br>
    Gender: <input type="text" name="gender" required><br>
    Major: <input type="text" name="major" required><br>
    Enrollment Year: <input type="text" name="enrollment_year" required><br>
    Address: <input type="text" name="address" required><br> <!-- New field -->
    <input type="submit" value="Create">
</form>

</body>
</html>
