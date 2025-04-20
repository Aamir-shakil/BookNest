<?php

class CartModel extends Model
{
    public function getCartItemsByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
