<?php
$host = 'localhost';
$dbname = 'unvirsity'; // Ensure the database name is correct
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $original_email = $_POST['original_email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $major = $_POST['major'];
        $enrollment_year = $_POST['enrollment_year'];

        $sql = "UPDATE students SET first_name = :first_name, last_name = :last_name, email = :email, date_of_birth = :date_of_birth, gender = :gender, major = :major, enrollment_year = :enrollment_year WHERE email = :original_email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':major', $major);
        $stmt->bindParam(':enrollment_year', $enrollment_year);
        $stmt->bindParam(':original_email', $original_email);

        if ($stmt->execute()) {
            echo "Student information updated successfully.";
        } else {
            echo "Error updating student information.";
        }
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
