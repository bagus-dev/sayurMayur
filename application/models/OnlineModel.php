<?php
    class OnlineModel extends CI_Model {
        function get_detail_invoice_selesai() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("status" => 3));
            $this->db->order_by("waktu_ditambahkan", "DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");

            return $this->db->get();
        }

        function get_detail_invoice_valid() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("status" => 1));
            $this->db->order_by("waktu_ditambahkan", "DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");
            
            return $this->db->get();
        }

        function get_detail_invoice_invalid() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("status" => 0));
            $this->db->order_by("waktu_ditambahkan", "DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");
            
            return $this->db->get();
        }

        function get_detail_invoice_belum_bayar() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("status" => 0, "jenis_bayar" => 1, "bukti_transfer" => ""));
            $this->db->order_by("waktu_ditambahkan", "DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");
            
            return $this->db->get();
        }

        function get_detail_invoice_batal() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("status" => 2));
            $this->db->order_by("waktu_ditambahkan", "DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");
            
            return $this->db->get();
        }

        function get_detail_invoice($no_invoice) {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->where(array("no_invoice" => $no_invoice));
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");

            return $this->db->get();
        }

        function get_checkout($no_invoice) {
            $this->db->select("tbl_checkout.barang_id,tbl_checkout.kuantitas,tbl_checkout.subtotal,tbl_barang.barang_nama,tbl_barang.barang_harjul");
            $this->db->from("tbl_checkout");
            $this->db->where(array("no_invoice" => $no_invoice));
            $this->db->join("tbl_barang","tbl_barang.barang_id = tbl_checkout.barang_id");

            return $this->db->get();
        }

        function get_user_invoice($no_invoice) {
            $get_invoice = $this->db->get_where("tbl_invoice",array("no_invoice" => $no_invoice))->row();

            $this->db->select("tbl_user.user_nama,tbl_user.user_alamat,tbl_user.user_nohp,tbl_user.user_email,tbl_ongkir.ongkir_lokasi,tbl_ongkir.ongkir_harga");
            $this->db->from("tbl_user");
            $this->db->where(array("user_id" => $get_invoice->user_id));
            $this->db->join("tbl_ongkir","tbl_ongkir.ongkir_id = tbl_user.ongkir_id");

            return $this->db->get();
        }

        function cek_status() {
            $get_invoice = $this->db->get_where("tbl_invoice",array("no_invoice" => $this->input->post("no_invoice",true)))->row();
            $status = $this->input->post("status",true);

            if($get_invoice->status == $status) {
                return false;
            }
            else {
                return true;
            }
        }

        function change_status() {
            $status = $this->input->post("status",true);
            $dibayar = $this->input->post("dibayar",true);

            if(isset($_POST["dibayar"])) {
                $data = array(
                    "status" => $status,
                    "dibayar" => $dibayar
                );
            }
            else {
                $data = array(
                    "status" => $status
                );
            }

            if($this->db->update("tbl_invoice",$data,array("no_invoice" => $this->input->post("no_invoice",true)))) {
                return true;
            }
            else {
                return false;
            }
        }

        function get_invoice() {
            $this->db->select("*");
            $this->db->from("tbl_invoice");
            $this->db->order_by("waktu_ditambahkan","DESC");
            $this->db->join("tbl_user","tbl_user.user_id = tbl_invoice.user_id");

            return $this->db->get();
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