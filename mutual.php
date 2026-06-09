<?php
$host = 'localhost';
$db   = 'messenger_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function getMutualFriends($pdo, $user1_id, $user2_id) {
    $sql = "SELECT u.id, u.email
            FROM friends AS f1
            JOIN friends AS f2 ON f1.friend_id = f2.friend_id
            JOIN users AS u ON f1.friend_id = u.id
            WHERE f1.user_id = ? AND f2.user_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user1_id, $user2_id]);
    $mutualFriends = $stmt->fetchAll();

    return $mutualFriends;
}

$user1_id = 1;  // Example user ID
$user2_id = 2;  // Example user ID

$mutualFriends = getMutualFriends($pdo, $user1_id, $user2_id);

echo "Mutual Friends between User $user1_id and User $user2_id: <br>";
foreach ($mutualFriends as $friend) {
    echo $friend['email'] . "<br>";
}
?>

