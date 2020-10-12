<?php
    $id = $this->session->userdata("id");
    $data["cari"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND id_karyawan = '$id' AND date(tgl) >= '$dari' AND date(tgl) <= '$sampai' AND transaksi_status = 1")->result();

    $responsistem = array();
    $responsistem["data"] = array();
    foreach($data["cari"] as $c){
        $data["tgl"] = $c->tgl;
        $data["customer"] = $c->nama;
        $data["mobil"] = $c->merk;
        $data["tgl_pinjam"] = $c->tgl_pinjam;
        $data["tgl_kembali"] = $c->tgl_kembali;
        $data["harga"] = $c->harga;
        $data["denda"] = $c->denda;
        $data["tgl_dikembalikan"] = $c->tgl_dikembalikan;
        $data["total_denda"] = $c->total_denda;
        $data["total_bayar"] = $c->total_bayar;

        array_push($responsistem["data"], $data);
    }
    $json = json_encode($responsistem);

    file_put_contents("data.json",$json);
?>