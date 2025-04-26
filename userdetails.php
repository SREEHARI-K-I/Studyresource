<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Not logged in or not an admin
    header("Location: login.html");
    exit();
}

require 'Dbconnection.php'; // Make sure this sets up $conn as a PDO object

try {
    $stmt = $conn->prepare("SELECT * FROM users ORDER BY id ASC");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .admin {
            color: #e74c3c;
            font-weight: bold;
        }

        .user {
            color: #3498db;
        }
    </style>
</head>
<body>

<h2>Registered Users</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Register Number</th>
            <th>Role</th>
            <th>Admin ID</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($users): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['register_number']) ?></td>
                    <td class="<?= $user['role'] === 'admin' ? 'admin' : 'user' ?>">
                        <?= htmlspecialchars(ucfirst($user['role'])) ?>
                    </td>
                    <td><?= $user['admin_id'] ?? '—' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No users found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
