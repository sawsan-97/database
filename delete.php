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

        $sql = "DELETE FROM students WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Student record deleted successfully.";
        } else {
            echo "Error deleting student record.";
        }
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
