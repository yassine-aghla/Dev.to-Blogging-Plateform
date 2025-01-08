<?php
require_once __DIR__.'/../model/user.php';

class UsersController {
    public static function signup($data) {
        $existingUser = User::findUserByEmail($data['email']);
        if ($existingUser) {
            return "Email already exists!";
        }

        $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
        unset($data['password']);

        return User::createUser($data) ? "User created successfully!" : "Error creating user.";
    }

    public static function login($email, $password) {
        $user = User::findUserByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            return true;
        }
        return false;
    }

    public static function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    public static function getAllUsers() {
        return User::getAllUsers();
    }
    public static function updateRole($userId, $newRole) {
        return User::updateRole($userId, $newRole);
    }
    
    public static function banUser($userId) {
        return User::banUser($userId);
    }
}
?>
