<?php
    class CheckoutModel extends CI_Model {
        // Mengambil data Keranjang
        function get_keranjang() {
            function get_client_ip() {
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP']))
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_X_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }
            $ip_address = get_client_ip();

            $this->db->select("tbl_barang.barang_nama,tbl_keranjang.total_kuantitas,tbl_keranjang.total_harga,tbl_keranjang.id");
            $this->db->from("tbl_keranjang");
            $this->db->where(array("ip_address" => $ip_address));
            $this->db->join("tbl_barang","tbl_barang.barang_id = tbl_keranjang.barang_id");

            return $this->db->get();
        }

        // Mengambil total harga Keranjang
        function total_harga_cart() {
            $ip_address = get_client_ip();

            return $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'");
        }

        function delete_cart_date() {
            if($this->db->query("DELETE FROM tbl_keranjang WHERE DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1")) {
                return true;
            }
            else {
                return false;
            }
        }

        function get_user() {
            return $this->db->get_where("tbl_user", array("user_id" => $this->session->userdata("user_id")));
        }

        function get_ongkir() {
            $this->db->select("tbl_ongkir.ongkir_lokasi,tbl_ongkir.ongkir_harga");
            $this->db->from("tbl_user");
            $this->db->where(array("user_id" => $this->session->userdata("user_id")));
            $this->db->join("tbl_ongkir","tbl_ongkir.ongkir_id = tbl_user.ongkir_id");

            return $this->db->get();
        }
    }
?>