<?php
class AdminUserModel extends Model
{
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function deactivateUser($id)
    {
        $stmt = $this->db->prepare("UPDATE users SET is_active = 0 WHERE id=?");
        $stmt->execute([$id]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>