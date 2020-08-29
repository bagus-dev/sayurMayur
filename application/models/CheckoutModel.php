<?php
    class CheckoutModel extends CI_Model {
        // Mengambil data Keranjang
        function get_keranjang($ip_address) {
            $this->db->select("tbl_barang.barang_nama,tbl_keranjang.total_kuantitas,tbl_keranjang.total_harga,tbl_keranjang.id");
            $this->db->from("tbl_keranjang");
            $this->db->where(array("ip_address" => $ip_address));
            $this->db->join("tbl_barang","tbl_barang.barang_id = tbl_keranjang.barang_id");

            return $this->db->get();
        }

        // Mengambil total harga Keranjang
        function total_harga_cart($ip_address) {
            return $this->db->query("SELECT SUM(`total_harga`) AS total_harga FROM `tbl_keranjang` WHERE `ip_address` = '$ip_address'");
        }

        function delete_cart_date() {
            date_default_timezone_set("Asia/Jakarta");

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

        function cancel_invoice() {
            date_default_timezone_set("Asia/Jakarta");
            
            $get1 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 2 AND status = 1 AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
            
            if($get1->num_rows() > 0) {
                foreach($get1->result() as $g1) {
                    $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g1->no_invoice' AND jenis_kirim = 2 AND jenis_bayar = 2 AND status = 1 AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                }
    
                $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                if($get2->num_rows() > 0) {
                    foreach($get2->result() as $g2) {
                        $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g2->no_invoice' AND jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                    }
    
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                    if($get3->num_rows() > 0) {
                        foreach($get3->result() as $g3) {
                            $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g3->no_invoice' AND jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                        }
                    }
                }
                else {
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                    if($get3->num_rows() > 0) {
                        foreach($get3->result() as $g3) {
                            $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g3->no_invoice' AND jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                        }
                    }
                }
            }
            else {
                $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                if($get2->num_rows() > 0) {
                    foreach($get2->result() as $g2) {
                        $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g2->no_invoice' AND jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                    }
    
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                    if($get3->num_rows() > 0) {
                        foreach($get3->result() as $g3) {
                            $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g3->no_invoice' AND jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                        }
                    }
                }
                else {
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND status = 0 AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
    
                    if($get3->num_rows() > 0) {
                        foreach($get3->result() as $g3) {
                            $this->db->query("UPDATE tbl_invoice SET status = 2 WHERE no_invoice = '$g3->no_invoice' AND jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND DATEDIFF(CURDATE(), waktu_ditambahkan) >= 1");
                        }
                    }
                }
            }
        }
    }
?>