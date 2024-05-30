<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "ccs"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["fullname"];
    $message = $_POST["messagebox"];

    // para mag check yung fields if empty
    if(empty($email) || empty($name) || empty($message)) {
        $errors[] = "All fields are required!";
    }

    // if no errors mag pproceed sya sa insert
    if(empty($errors)) {
        $sql = "INSERT INTO contact (email, fullname, messagebox) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $email, $name, $message);
            $stmt->execute();
             //javascript-alert-code-tas redirect-sa-contact
             echo "<script>alert('Data inserted successfully!'); window.location.href='http://localhost/project/landingpage/landingpage.html';</script>";
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
       //javascript-alert
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    }
}

$conn->close();
?>
