<?php

require_once "config/database.php";

$sql = "INSERT INTO messages (name, email, message)
VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "Sam",
    "sam@test.com",
    "Hello from PHP"
]);

echo "Message Saved Successfully";