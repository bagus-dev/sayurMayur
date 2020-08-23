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
    }
?>