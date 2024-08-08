<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE userEmail='$email' AND userPassword='$password' AND status=1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['userName'] = $user['userName'];
        
        // Obtener roles y permisos
        $userID = $user['userID'];
        $roles_sql = "SELECT r.rolName, p.permissionName 
                      FROM users_roles ur 
                      JOIN roles r ON ur.roleID = r.rolID 
                      JOIN roles_permissions rp ON r.rolID = rp.roleID 
                      JOIN permissions p ON rp.permissionID = p.permissionID 
                      WHERE ur.userID = $userID";
        $roles_result = $conn->query($roles_sql);

        $roles_permissions = [];
        while ($row = $roles_result->fetch_assoc()) {
            $roles_permissions[] = $row;
        }

        $_SESSION['roles_permissions'] = $roles_permissions;
        
        echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method!']);
}
$conn->close();
?>
