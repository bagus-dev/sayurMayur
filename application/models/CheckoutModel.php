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

            $get_keranjang = $this->db->get("tbl_keranjang");
            $date2 = date_create();

            foreach($get_keranjang->result() as $k) {
                $date1 = date_create($k->waktu_ditambahkan);
                $diff = date_diff($date1,$date2);

                if($diff->format("%a") >= 1) {
                    $this->db->delete("tbl_keranjang", array("id" => $k->id));
                }
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
            
            $get1 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 2 AND status = 1");

            if ($get1->num_rows() > 0) {
                $date2_get1 = date_create();
                foreach ($get1->result() as $g1) {
                    $date1_get1 = date_create($g1->waktu_ditambahkan);
                    $diff_1 = date_diff($date1_get1,$date2_get1);

                    if($diff_1->format("%a") >= 1) {
                        $data1 = array(
                            "status" => 2
                        );

                        $this->db->update('tbl_invoice',$data1,array("no_invoice" => $g1->no_invoice));
                    }
                }

                $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = ''");

                if ($get2->num_rows() > 0) {
                    $date2_get2 = date_create();
                    foreach ($get2->result() as $g2) {
                        $date1_get2 = date_create($g2->waktu_ditambahkan);
                        $diff_2 = date_diff($date1_get2,$date2_get2);

                        if($diff_2->format("%a") >= 1) {
                            $data2 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data2,array("no_invoice" => $g2->no_invoice));
                        }
                    }

                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                    if ($get3->num_rows() > 0) {
                        $date2_get3 = date_create();
                        foreach ($get3->result() as $g3) {
                            $date1_get3 = date_create($g3->waktu_ditambahkan);
                            $diff_3 = date_diff($date1_get3,$date2_get3);

                            if($diff_3->format("%a") >= 1) {
                                $data3 = array(
                                    "status" => 2
                                );

                                $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                            }
                        }
                    }
                } else {
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                    if ($get3->num_rows() > 0) {
                        $date2_get3 = date_create();
                        foreach ($get3->result() as $g3) {
                            $date1_get3 = date_create($g3->waktu_ditambahkan);
                            $diff_3 = date_diff($date1_get3,$date2_get3);

                            if($diff_3->format("%a") >= 1) {
                                $data3 = array(
                                    "status" => 2
                                );

                                $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                            }
                        }
                    }
                }
            } else {
                $get2 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 2 AND jenis_bayar = 1 AND bukti_transfer = ''");

                if ($get2->num_rows() > 0) {
                    $date2_get2 = date_create();
                    foreach ($get2->result() as $g2) {
                        $date1_get2 = date_create($g2->waktu_ditambahkan);
                        $diff_2 = date_diff($date1_get2,$date2_get2);

                        if($diff_2->format("%a") >= 1) {
                            $data2 = array(
                                "status" => 2
                            );

                            $this->db->update('tbl_invoice',$data2,array("no_invoice" => $g2->no_invoice));
                        }
                    }

                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = ''");

                    if ($get3->num_rows() > 0) {
                        $date2_get3 = date_create();
                        foreach ($get3->result() as $g3) {
                            $date1_get3 = date_create($g3->waktu_ditambahkan);
                            $diff_3 = date_diff($date1_get3,$date2_get3);

                            if($diff_3->format("%a") >= 1) {
                                $data3 = array(
                                    "status" => 2
                                );

                                $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                            }
                        }
                    }
                } else {
                    $get3 = $this->db->query("SELECT * FROM tbl_invoice WHERE jenis_kirim = 1 AND jenis_bayar = 1 AND bukti_transfer = '' AND status = 0");

                    if ($get3->num_rows() > 0) {
                        $date2_get3 = date_create();
                        foreach ($get3->result() as $g3) {
                            $date1_get3 = date_create($g3->waktu_ditambahkan);
                            $diff_3 = date_diff($date1_get3,$date2_get3);

                            if($diff_3->format("%a") >= 1) {
                                $data3 = array(
                                    "status" => 2
                                );

                                $this->db->update('tbl_invoice',$data3,array("no_invoice" => $g3->no_invoice));
                            }
                        }
                    }
                }
            }
        }
    }
?>