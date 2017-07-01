<?php
    class user_model extends CI_Model{

        function getCarouselPhotos() {            
            $this->db->select('source');
            $this->db->from('project_products');
            $this->db->order_by('RAND()');
            $this->db->limit(3);
            $result = $this->db->get();
            return $result->result();
        }

        public function create_user($username, $email, $password, $usertype) { 
            $data = array(
                'username' => $username,
                'email' => $email,
                'created_at' => date('Y-m-j H:i:s'),
                'password_digest' => MD5($password),
                'admin' => $usertype,
            );
            return $this->db->insert('project_users', $data);
        }

        public function is_user($useremail, $password) {
            $hash = MD5($password);
            $sql = "SELECT id FROM project_users WHERE email = '$useremail' AND password_digest = '$hash'";
            $result = $this->db->query($sql);

            if ($result->num_rows() == 0) {
                return FALSE;
            }
            else {
                return TRUE;
            }
        }

        public function get_user($useremail, $password) {
            $this->db->select('username');
            $this->db->from('project_users');
            $this->db->where('email', $useremail);
            $this->db->where('password_digest', MD5($password));
            return $this->db->get()->row('username');
        }

        public function get_userPermissions($useremail, $password) {
            $this->db->select('admin');
            $this->db->from('project_users');
            $this->db->where('email', $useremail);
            $this->db->where('password_digest', MD5($password));
            return $this->db->get()->row('admin');
        }

        public function get_categories() {
            $this->db->select('name');
            $this->db->select('source');
            $this->db->from('project_categories');
            $result = $this->db->get();
            return $result->result();
        }

        public function get_random_categories() {
            $this->db->select('name');
            $this->db->select('source');
            $this->db->from('project_categories');
            $this->db->order_by('RAND()');
            $result = $this->db->get();
            return $result->result();
        }

        public function get_images_from_category($category_name) {
            $this->db->from('project_products');
            $this->db->where('category', $category_name);
            $result = $this->db->get();
            return $result->result();
        }

        public function get_product_data($product_id) {
            $this->db->from('project_products');
            $this->db->where('id', $product_id);
            $result = $this->db->get();
            return $result->result();
        }

        public function get_category_data($category_name) {
            $this->db->from('project_categories');
            $this->db->where('name', $category_name);
            $result = $this->db->get();
            return $result->result();
        }

        public function update_product($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('project_products', $data);
        }

        public function delete_product($id) {
            $this->db->where('id', $id);
            return $this->db->delete('project_products');
        }

        public function delete_category($id) {
            $this->db->where('id', $id);
            return $this->db->delete('project_categories');
        }

        public function get_products() {
            $this->db->from('project_products');
            $result = $this->db->get();
            return $result->result();
        }

        public function add_category($data) {
           return $this->db->insert('project_categories', $data);
        }

         public function update_category($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('project_categories', $data);
        }

        public function add_product($data) {
             return $this->db->insert('project_products', $data);
        }

        public function get_users() {
            $this->db->from('project_users');
            $result = $this->db->get();
            return $result->result();
        }

        public function get_user_data($id) {
            $this->db->where('id', $id);
            $this->db->from('project_users');
            $result = $this->db->get();
            return $result->result();
        }

        public function update_user_data($id, $username, $email, $password) {
           if (strlen($password) >= 6) {
               $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password_digest' => MD5($password),
                );
                $this->db->where('id', $id);
                return $this->db->update('project_users', $data);
           }
           else {
               $data = array(
                    'username' => $username,
                    'email' => $email,
                );
                $this->db->where('id', $id);
                return $this->db->update('project_users', $data);
           }
        }

        public function delete_user($id) {
            $this->db->where('id', $id);
            return $this->db->delete('project_users');
        }

        public function get_n_cart_items($id) {
            $this->db->where('userID', $id);
            $this->db->where('purchased', 0);
            $result = $this->db->get('project_cart');
            return $result->num_rows();
        }

        public function get_user_id($username) {
            $this->db->select('id');
            $this->db->from('project_users');
            $this->db->where('username', $this->session->userdata('username'));
            return $this->db->get()->row('id');
        }

        public function add_product_to_cart($productID, $userID) {
            $data = array(
                'userID' => $userID,
                'productID' => $productID,
                'purchased' => '0'
            );
            return $this->db->insert('project_cart', $data);
        }

        public function get_user_cart($userID) {
            $this->db->where('userID', $userID);
            $this->db->where('purchased', '0');
            $this->db->order_by('id');
            $result = $this->db->get('project_cart')->result();
            $items = array();
            foreach ($result as $var) {
                array_push($items, $this->get_item($var->productID)[0]);
            }
            return $items;
        }

         public function get_user_orders($userID) {
            $this->db->where('userID', $userID);
            $this->db->where('purchased', 1);
            $this->db->order_by('id');
            $result = $this->db->get('project_cart')->result();
            $items = array();
            foreach ($result as $var) {
                array_push($items, $this->get_item($var->productID)[0]);
            }
            return $items;
        }

        public function get_item($productID) {
            $this->db->where('id', $productID);
            $result = $this->db->get('project_products');
            return $result->result();
        }

        public function get_product_price($productID) {
           $this->db->select('price');
           $this->db->where('id', $productID);
           $this->db->from('project_products');
           return $this->db->get()->row('price');
        }

        public function get_total($userID) {
            $this->db->where('userID', $userID);
            $this->db->where('purchased', '0');
            $result = $this->db->get('project_cart')->result();
            $total = 0;
            foreach ($result as $value) {
                $total += $this->get_product_price($value->productID);
            }
            return $total;
        }

        public function delete_product_from_cart($productID, $userID) {
            $this->db->where('userID', $userID);
            $this->db->where('productID', $productID);
            return $this->db->delete('project_cart');
        }

        public function finalize_order($id) {
           $this->db->where('userID', $id);
           $this->db->set('purchased', 1);
           return $this->db->update('project_cart');
        }

    }
?>