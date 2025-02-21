<?php
$host = 'localhost';
$dbname = 'unvirsity'; // Make sure the database name is spelled correctly
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "test post server";

         $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $major = $_POST['major'];
        $enrollment_year = $_POST['enrollment_year'];

        $sql = "INSERT INTO students (first_name, last_name, email, date_of_birth, gender, major, enrollment_year) 
                VALUES (:first_name, :last_name, :email, :date_of_birth, :gender, :major, :enrollment_year)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':major', $major);
        $stmt->bindParam(':enrollment_year', $enrollment_year);

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