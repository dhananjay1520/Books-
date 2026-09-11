<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    public function get_items($user_id)
    {
        $sql = "
            SELECT c.id, p.pr_name AS name, p.image AS image,
                   p.pr_price AS price, c.quantity,
                   NULL AS start_date, NULL AS end_date, 'cart' AS item_type
            FROM add_to_cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?

            UNION ALL

            SELECT r.id, r.book_name AS name, r.book_image AS image,
                   r.total_rent AS price, 1 AS quantity,
                   r.start_date, r.end_date, 'rent' AS item_type
            FROM rent r
            WHERE r.user_id = ?

            ORDER BY name ASC
        ";

        return $this->db->query($sql, array($user_id, $user_id))->result_array();
    }

    public function get_cart_count($user_id)
    {
        $normal = $this->db->select_sum('quantity')
            ->where('user_id', $user_id)
            ->get('add_to_cart')->row();
        $normal_count = $normal && $normal->quantity ? (int)$normal->quantity : 0;

        $rent_count = $this->db->where('user_id', $user_id)
            ->count_all_results('rent');

        return $normal_count + (int)$rent_count;
    }

    public function add_item($user_id, $product_id, $quantity = 1)
    {
        $quantity = max(1, (int)$quantity);
        $existing = $this->db->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->get('add_to_cart')->row_array();

        if ($existing) {
            return $this->db->where('id', $existing['id'])
                ->where('user_id', $user_id)
                ->update('add_to_cart', array(
                    'quantity' => (int)$existing['quantity'] + $quantity
                ));
        }

        return $this->db->insert('add_to_cart', array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ));
    }

    public function update_quantity($user_id, $id, $quantity)
    {
        return $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->update('add_to_cart', array('quantity' => max(1, (int)$quantity)));
    }

    public function clear_items($user_id)
    {
        $this->db->where('user_id', $user_id)->delete('add_to_cart');
        $this->db->where('user_id', $user_id)->delete('rent');
        return true;
    }

    public function remove_item($user_id, $id, $type)
    {
        if ($type === 'rent') {
            return $this->db->where('id', $id)->where('user_id', $user_id)->delete('rent');
        }

        return $this->db->where('id', $id)->where('user_id', $user_id)->delete('add_to_cart');
    }
}
