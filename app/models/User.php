<?php


class User extends Model
{
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function getUserById(string $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function login($email, $password)
    {
        $user = $this->findUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function register($name, $email, $password)
    {
        // Check if user already exists
        if ($this->findUserByEmail($email)) {
            return false; // Email already taken
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        return $stmt->execute();
    }
    public function setActiveStatus($id, $status)
{
    $stmt = $this->db->prepare("UPDATE users SET is_active = :status WHERE id = :id");
    $stmt->execute([
        'status' => $status,
        'id' => $id
    ]);
}
}
