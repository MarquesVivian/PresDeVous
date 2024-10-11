<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "presdevous"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["user"];
//$id = 1;  // ID fixe pour l'exemple

$sql = "SELECT Nom FROM Utilisateur WHERE IdUtilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(array("Nom" => $row["Nom"]));
} else {
    echo json_encode(array("error" => "Utilisateur non trouvé"));
}

$stmt->close();
$conn->close();
?>
