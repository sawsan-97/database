<?php
$host = 'localhost';
$dbname = 'unvirsity'; // Ensure the database name is correct
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];

        $sql = "SELECT * FROM students WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Display a form to update student details
            echo "<form action='process_update.php' method='POST'>";
            echo "<input type='hidden' name='original_email' value='".$row['email']."'>";
            echo "First Name: <input type='text' name='first_name' value='".$row['first_name']."'><br>";
            echo "Last Name: <input type='text' name='last_name' value='".$row['last_name']."'><br>";
            echo "Email: <input type='email' name='email' value='".$row['email']."'><br>";
            echo "Date of Birth: <input type='date' name='date_of_birth' value='".$row['date_of_birth']."'><br>";
            echo "Gender: <input type='text' name='gender' value='".$row['gender']."'><br>";
            echo "Major: <input type='text' name='major' value='".$row['major']."'><br>";
            echo "Enrollment Year: <input type='text' name='enrollment_year' value='".$row['enrollment_year']."'><br>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Student not found.";
        }
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
