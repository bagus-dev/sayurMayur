<?php
    if(defined("BASEPATH") OR exit("No direct script allowed"));

    class Admin extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->helper("security");
            if($this->session->userdata("status") != "login"){
                redirect(base_url()."welcome?pesan=belumlogin");
            }
        }

        function index(){
            $data["transaksi"] = $this->db->query("SELECT * FROM transaksi ORDER BY transaksi_id DESC LIMIT 10")->result();
            $data["customer"] = $this->db->query("SELECT * FROM customer ORDER BY customer_id DESC LIMIT 10")->result();
            $data["mobil"] = $this->db->query("SELECT * FROM mobil ORDER BY mobil_id DESC LIMIT 10")->result();
            $data["active"] = "dashboard";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/index",$data);
            $this->load->view("admin/footer");
        }

        function logout(){
            $this->session->sess_destroy();
            if(isset($_GET["pesan"])){
                if($_GET["pesan"] == "berhasil"){
                    redirect(base_url()."welcome?pesan=berhasil");
                }
                elseif($_GET["pesan"] == "berhasil_pass"){
                    redirect(base_url()."welcome?pesan=berhasil_pass");
                }
            }
            else{
                redirect(base_url().'welcome?pesan=logout');
            }
        }

        function profil($id){
            $where = array(
                "admin_id" => $id
            );
            $data["admin"] = $this->m_rental->edit_data($where,"admin")->result();

            $this->load->view("admin/header");
            $this->load->view("admin/profil",$data);
            $this->load->view("admin/footer");
        }

        function edit_profil(){
            $id = $this->input->post("id");
            $nama = $this->input->post("nama");
            $username = $this->input->post("username");

            $id_xss = $this->security->xss_clean($id);
            $nama_xss = $this->security->xss_clean($nama);
            $username_xss = $this->security->xss_clean($username);

            $this->form_validation->set_rules("nama","Nama","required|trim");
            $this->form_validation->set_rules("username","Username","required|trim");

            if($this->form_validation->run() != false){
                $where = array(
                    "admin_id" => $id
                );
                $data = array(
                    "nama" => $nama_xss,
                    "username" => $username_xss
                );
                $this->m_rental->update_data($where,$data,"admin");
                redirect(base_url()."admin/logout?pesan=berhasil");
            }
            else{
                $where = array(
                    "admin_id" => $id
                );
                $data["admin"] = $this->m_rental->edit_data($where,"admin")->result();

                $this->load->view("admin/header");
                $this->load->view("admin/profil",$data);
                $this->load->view("admin/footer");
            }
        }

        function ganti_password(){
            $data["active"] = "dashboard";
            $this->load->view("admin/header",$data);
            $this->load->view("admin/ganti_password");
            $this->load->view("admin/footer");
        }

        function ganti_password_act(){
            $pass_sekarang = $this->input->post("pass_sekarang");
            $pass_baru = $this->input->post("pass_baru");
            $ulang_pass = $this->input->post("ulang_pass");

            $pass_sekarang_xss = $this->security->xss_clean($pass_sekarang);
            $pass_baru_xss = $this->security->xss_clean($pass_baru);
            $ulang_pass_xss = $this->security->xss_clean($ulang_pass);

            $this->form_validation->set_rules("pass_sekarang","Password Sekarang","required|trim");
            $this->form_validation->set_rules("pass_baru","Password Baru","required|matches[ulang_pass]|trim");
            $this->form_validation->set_rules("ulang_pass","Ulangi Password Baru","required|trim");

            if($this->form_validation->run() != false){
                $where = array(
                    "admin_id" => $this->session->userdata("id"),
                    "password" => sha1($pass_sekarang_xss)
                );

                $data_login = $this->m_rental->edit_data($where,"admin")->num_rows();

                if($data_login > 0){
                    $data = array(
                        "password" => sha1($pass_baru_xss)
                    );
                    $w = array(
                        "admin_id" => $this->session->userdata("id")
                    );
                    $this->m_rental->update_data($w,$data,"admin");

                    redirect(base_url()."admin/logout?pesan=berhasil_pass");
                }
                else{
                    redirect(base_url()."admin/ganti_password?pesan=gagal");
                }
            }
            else{
                $data["active"] = "dashboard";
                $data["password"] = array(
                    "pass_sekarang" => $pass_sekarang_xss,
                    "pass_baru" => $pass_baru_xss,
                    "ulang_pass" => $ulang_pass_xss
                );

                $this->load->view("admin/header",$data);
                $this->load->view("admin/ganti_password",$data);
                $this->load->view("admin/footer");
            }
        }

        function mobil(){
            $data["mobil"] = $this->db->query("SELECT * FROM mobil ORDER BY merk")->result();
            $data["active"] = "mobil";
            $this->load->view("admin/header",$data);
            $this->load->view("admin/mobil",$data);
            $this->load->view("admin/footer");
        }

        function mobil_add(){
            $data["active"] = "mobil_add";
            $data["mobil"] = array(
                "merk" => "",
                "plat" => "",
                "warna" => "",
                "tahun" => ""
            );
            $this->load->view("admin/header",$data);
            $this->load->view("admin/mobil_add",$data);
            $this->load->view("admin/footer");
        }

        function mobil_add_act(){
            $merk = $this->input->post("merk");
            $plat = $this->input->post("plat");
            $warna = $this->input->post("warna");
            $tahun = $this->input->post("tahun");
            $status = $this->input->post("status");

            $merk_xss = $this->security->xss_clean($merk);
            $plat_xss = $this->security->xss_clean($plat);
            $warna_xss = $this->security->xss_clean($warna);
            $tahun_xss = $this->security->xss_clean($tahun);
            $status_xss = $this->security->xss_clean($status);

            $this->form_validation->set_rules("merk","Merk Mobil","required|trim");
            $this->form_validation->set_rules("plat","Plat Kendaraan","required|trim");
            $this->form_validation->set_rules("warna","Warna","required|trim");
            $this->form_validation->set_rules("tahun","Tahun Kendaraan","required|trim");
            $this->form_validation->set_rules("status","Status Mobil","required|trim");

            if($this->form_validation->run() != false){
                $where = array(
                    "merk" => $merk_xss
                );
                $cek_merk = $this->m_rental->edit_data($where,"mobil")->num_rows();

                if($cek_merk == 0){
                    $where = array(
                        "plat" => $plat_xss
                    );
                    $cek_plat = $this->m_rental->edit_data($where,"mobil")->num_rows();

                    if($cek_plat == 0){
                        $data = array(
                            "merk" => $merk_xss,
                            "plat" => $plat_xss,
                            "warna" => $warna_xss,
                            "tahun" => $tahun_xss,
                            "status" => $status_xss
                        );
                        $this->m_rental->insert_data($data,"mobil");

                        $data["active"] = "mobil_add";
                        $data["error"] = "";
                        $data["mobil"] = array(
                            "merk" => $merk_xss,
                            "plat" => $plat_xss,
                            "warna" => $warna_xss,
                            "tahun" => $tahun_xss,
                            "status" => $status_xss
                        );

                        $this->load->view("admin/header",$data);
                        $this->load->view("admin/tambah_gambar",$data);
                        $this->load->view("admin/footer");
                    }
                    else{
                        redirect(base_url()."admin/mobil_add?pesan=plat_gagal");
                    }
                }
                else{
                    redirect(base_url()."admin/mobil_add?pesan=gagal");
                }
            }
            else{
                $data["active"] = "mobil_add";
                $data["mobil"] = array(
                    "merk" => $merk_xss,
                    "plat" => $plat_xss,
                    "warna" => $warna_xss,
                    "tahun" => $tahun_xss,
                    "status" => $status_xss
                );
                $this->load->view("admin/header",$data);
                $this->load->view("admin/mobil_add",$data);
                $this->load->view("admin/footer");
            }
        }

        function tambah_gambar_mobil(){
            $merk = $this->input->post("merk");

                $config["upload_path"] = "./assets/images/mobil/";
                $config["allowed_types"] = "gif|jpg|png|jpeg";
                $config["max_size"] = 500;
                $config["max_width"] = 1266;
                $config["max_height"] = 1280;
                $config["min_height"] = 500;
                $config["min_width"] = 500;

                $this->load->library("upload",$config);

                if(!$this->upload->do_upload("gambar_mobil")){
                    $data["mobil"] = array(
                        "merk" => $merk
                    );
                    $error = array("error" => $this->upload->display_errors());
                    $data["error"] = implode($error);
                    $data["active"] = "mobil_add";

                    $this->load->view("admin/header",$data);
                    $this->load->view("admin/tambah_gambar",$data);
                    $this->load->view("admin/footer");
                }
                else{
                    $gambar_mobil = $this->upload->data("file_name");

                    $where = array(
                        "merk" => $merk
                    );
                    $data = array(
                        "gambar_mobil" => $gambar_mobil
                    );

                    $this->m_rental->update_data($where,$data,"mobil");
                    redirect(base_url()."admin/mobil?pesan=berhasil&nama=$merk");
                }
        }

        function mobil_edit($id){
            $where = array(
                "mobil_id" => $id
            );
            $data["mobil"] = $this->m_rental->edit_data($where,"mobil")->result();
            $data["active"] = "mobil";
            $this->load->view("admin/header",$data);
            $this->load->view("admin/mobil_edit",$data);
            $this->load->view("admin/footer");
        }

        function mobil_update(){
            $id = $this->input->post("id");
            $merk = $this->input->post("merk");
            $plat = $this->input->post("plat");
            $warna = $this->input->post("warna");
            $tahun = $this->input->post("tahun");
            $status = $this->input->post("status");
            
            $id_xss = $this->security->xss_clean($id);
            $merk_xss = $this->security->xss_clean($merk);
            $plat_xss = $this->security->xss_clean($plat);
            $warna_xss = $this->security->xss_clean($warna);
            $tahun_xss = $this->security->xss_clean($tahun);
            $status_xss = $this->security->xss_clean($status);

            $this->form_validation->set_rules("merk","Merk Mobil","required|trim");
            $this->form_validation->set_rules("status","Status Mobil","required");
            $this->form_validation->set_rules("plat","No.Plat Kendaraan","required|trim");
            $this->form_validation->set_rules("warna","Warna","required|trim");
            $this->form_validation->set_rules("tahun","Tahun Kendaraan","required|trim");
            
            if($this->form_validation->run() != false){
                $where = array(
                    "mobil_id" => $id
                );
                $data = array(
                    "merk" => $merk_xss,
                    "plat" => $plat_xss,
                    "warna" => $warna_xss,
                    "tahun" => $tahun_xss,
                    "status" => $status
                );

                $this->m_rental->update_data($where,$data,"mobil");
                redirect(base_url()."admin/mobil?edit=berhasil&nama=$merk_xss");
            }
            else{
                $where = array(
                    "mobil_id" => $id
                );
                $data["mobil"] = $this->m_rental->edit_data($where,"mobil")->result();
                $data["active"] = "mobil";
                $this->load->view("admin/header",$data);
                $this->load->view("admin/mobil_edit",$data);
                $this->load->view("admin/footer");
            }
        }

        function gambar_mobil($id){
            $data["mobil"] = $this->db->query("SELECT mobil_id,merk,gambar_mobil FROM mobil WHERE mobil_id='$id'")->result();
            $data["active"] = "mobil";
            $data["error"] = "";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/gambar_mobil",$data);
            $this->load->view("admin/footer");
        }

        function gambar_mobil_edit(){
            $id = $this->input->post("mobil_id");
            $merk = $this->input->post("merk");

                $config["upload_path"] = "./assets/images/mobil/";
                $config["allowed_types"] = "gif|jpg|png|jpeg";
                $config["max_size"] = 500;
                $config["max_width"] = 1266;
                $config["max_height"] = 1280;
                $config["min_height"] = 500;
                $config["min_width"] = 500;

                $this->load->library("upload",$config);

                if(!$this->upload->do_upload("gambar_mobil")){
                    $where = array(
                        "mobil_id" => $id
                    );

                    $data["mobil"] = $this->m_rental->edit_data($where,"mobil")->result();
                    $error = array("error" => $this->upload->display_errors());
                    $data["error"] = implode($error);
                    $data["active"] = "mobil";

                    $this->load->view("admin/header",$data);
                    $this->load->view("admin/gambar_mobil",$data);
                    $this->load->view("admin/footer");
                }
                else{
                    $gambar_mobil = $this->upload->data("file_name");

                    $where = array(
                        "mobil_id" => $id
                    );
                    $data = array(
                        "gambar_mobil" => $gambar_mobil
                    );

                    $this->m_rental->update_data($where,$data,"mobil");
                    redirect(base_url()."admin/mobil?edit_gambar=berhasil&nama=$merk");
                }

        }

        function mobil_hapus($id){
            $where = array(
                "mobil_id" => $id
            );

            $this->m_rental->delete_data($where,"mobil");
            redirect(base_url()."admin/mobil?hapus=berhasil");
        }

        function customer(){
            $data["customer"] = $this->db->query("SELECT * FROM customer ORDER BY nama")->result();
            $data["active"] = "customer";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/customer",$data);
            $this->load->view("admin/footer");
        }

        function customer_add(){
            $data["active"] = "customer_add";
            $this->load->view("admin/header",$data);
            $this->load->view("admin/customer_add");
            $this->load->view("admin/footer");
        }

        function customer_add_act(){
            $nama = $this->input->post("nama");
            $pass = $this->input->post("pass");
            $pass_ulang = $this->input->post("pass_ulang");
            $alamat = $this->input->post("alamat");
            $jk = $this->input->post("jk");
            $hp = $this->input->post("hp");
            $ktp = $this->input->post("ktp");

            $nama_xss = $this->security->xss_clean($nama);
            $pass_xss = $this->security->xss_clean($pass);
            $pass_ulang_xss = $this->security->xss_clean($pass_ulang);
            $alamat_xss = $this->security->xss_clean($alamat);
            $jk_xss = $this->security->xss_clean($jk);
            $hp_xss = $this->security->xss_clean($hp);
            $ktp_xss = $this->security->xss_clean($ktp);

            $this->form_validation->set_rules("nama","Nama Customer","required|trim");
            $this->form_validation->set_rules("pass","Password","required|trim|matches[pass_ulang]|min_length[5]");
            $this->form_validation->set_rules("pass_ulang","Ulangi Password","required|trim|matches[pass]|min_length[5]");
            $this->form_validation->set_rules("alamat","Alamat","required|trim");
            $this->form_validation->set_rules("jk","Jenis Kelamin","required");
            $this->form_validation->set_rules("hp","HP","required|trim");
            $this->form_validation->set_rules("ktp","No.KTP","required|trim");

            if($this->form_validation->run() != false){
                $where = array(
                    "hp" => $hp_xss
                );
                $cek_hp = $this->m_rental->edit_data($where,"customer")->num_rows();

                if($cek_hp == 0){
                    $where = array(
                        "ktp" => $ktp_xss
                    );
                    $cek_ktp = $this->m_rental->edit_data($where,"customer")->num_rows();

                    if($cek_ktp == 0){
                        $data = array(
                            "nama" => $nama_xss,
                            "password" => sha1($pass_xss),
                            "alamat" => $alamat_xss,
                            "jk" => $jk_xss,
                            "hp" => $hp_xss,
                            "ktp" => $ktp_xss
                        );

                        $this->m_rental->insert_data($data,"customer");
                        
                        $data["active"] = "customer_add";
                        $data["error"] = "";
                        $data["customer"] = array(
                            "nama" => $nama_xss,
                            "password" => sha1($pass_xss),
                            "alamat" => $alamat_xss,
                            "jk" => $jk_xss,
                            "hp" => $hp_xss,
                            "ktp" => $ktp_xss
                        );

                        $this->load->view("admin/header",$data);
                        $this->load->view("admin/customer_gambar",$data);
                        $this->load->view("admin/footer");
                    }
                    else{
                        redirect(base_url()."admin/customer_add?pesan=ktp_gagal");
                    }
                }
                else{
                    redirect(base_url()."admin/customer_add?pesan=gagal");
                }
            }
            else{
                $data["active"] = "customer_add";
                $data["customer"] = array(
                    "nama" => $nama_xss,
                    "pass" => $pass_xss,
                    "pass_ulang" => $pass_ulang_xss,
                    "alamat" => $alamat_xss,
                    "hp" => $hp_xss,
                    "ktp" => $ktp_xss
                );
                $this->load->view("admin/header",$data);
                $this->load->view("admin/customer_add",$data);
                $this->load->view("admin/footer");
            }
        }

        function tambah_gambar_customer(){
            $nama = $this->input->post("nama");
            $jk = $this->input->post("jk");
            $hp = $this->input->post("hp");

                $config["upload_path"] = "./assets/images/customer/";
                $config["allowed_types"] = "gif|jpg|png|jpeg";
                $config["max_size"] = 500;
                $config["max_width"] = 1266;
                $config["max_height"] = 1280;
                $config["min_height"] = 500;
                $config["min_width"] = 500;

                $this->load->library("upload",$config);

                if(!$this->upload->do_upload("gambar_customer")){
                    $data["customer"] = array(
                        "nama" => $nama,
                        "jk" => $jk,
                        "hp" => $hp
                    );
                    $error = array("error" => $this->upload->display_errors());
                    $data["error"] = implode($error);
                    $data["active"] = "customer_add";

                    $this->load->view("admin/header",$data);
                    $this->load->view("admin/customer_gambar",$data);
                    $this->load->view("admin/footer");
                }
                else{
                    $gambar_customer = $this->upload->data("file_name");

                    $where = array(
                        "nama" => $nama,
                        "jk" => $jk,
                        "hp" => $hp
                    );
                    $data = array(
                        "gambar_customer" => $gambar_customer
                    );

                    $this->m_rental->update_data($where,$data,"customer");
                    redirect(base_url()."admin/customer?pesan=berhasil&nama=".$nama);
                }
        }

        function customer_edit($id){
            $where = array(
                "customer_id" => $id
            );
            $data["customer"] = $this->m_rental->edit_data($where,"customer")->result();
            $data["active"] = "customer";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/customer_edit",$data);
            $this->load->view("admin/footer");
        }

        function customer_update(){
            $id = $this->input->post("id");
            $nama = $this->input->post("nama");
            $alamat = $this->input->post("alamat");
            $jk = $this->input->post("jk");
            $hp = $this->input->post("hp");
            $ktp = $this->input->post("ktp");

            $nama_xss = $this->security->xss_clean($nama);
            $alamat_xss = $this->security->xss_clean($alamat);
            $jk_xss = $this->security->xss_clean($jk);
            $hp_xss = $this->security->xss_clean($hp);
            $ktp_xss = $this->security->xss_clean($ktp);

            $this->form_validation->set_rules("nama","Nama Customer","required|trim");
            $this->form_validation->set_rules("alamat","Alamat","required|trim");
            $this->form_validation->set_rules("jk","Jenis Kelamin","required");
            $this->form_validation->set_rules("hp","HP","required|trim");
            $this->form_validation->set_rules("ktp","No.KTP","required|trim");

            if($this->form_validation->run() != false){
                $where = array(
                    "customer_id" => $id
                );
                $data = array(
                    "nama" => $nama_xss,
                    "alamat" => $alamat_xss,
                    "jk" => $jk_xss,
                    "hp" => $hp_xss,
                    "ktp" => $ktp_xss
                );

                $this->m_rental->update_data($where,$data,"customer");
                redirect(base_url()."admin/customer");
            }
            else{
                $where = array(
                    "customer_id" => $id
                );
                $data["customer"] = $this->m_rental->edit_data($where,"customer")->result();
                $data["active"] = "customer";
                
                $this->load->view("admin/header",$data);
                $this->load->view("admin/customer_edit",$data);
                $this->load->view("admin/footer");
            }
        }

        function customer_edit_gambar($id){
            $data["customer"] = $this->db->query("SELECT customer_id,nama,jk,gambar_customer FROM customer WHERE customer_id='$id'")->result();
            $data["active"] = "customer";
            $data["error"] = "";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/gambar_customer",$data);
            $this->load->view("admin/footer");
        }

        function gambar_customer_edit(){
            $id = $this->input->post("customer_id");
            $nama = $this->input->post("nama");

                $config["upload_path"] = "./assets/images/customer/";
                $config["allowed_types"] = "gif|jpg|png|jpeg";
                $config["max_size"] = 500;
                $config["max_width"] = 1266;
                $config["max_height"] = 1280;
                $config["min_height"] = 500;
                $config["min_width"] = 500;

                $this->load->library("upload",$config);

                if(!$this->upload->do_upload("gambar_customer")){
                    $where = array(
                        "customer_id" => $id
                    );

                    $data["customer"] = $this->m_rental->edit_data($where,"customer")->result();
                    $error = array("error" => $this->upload->display_errors());
                    $data["error"] = implode($error);
                    $data["active"] = "customer";

                    $this->load->view("admin/header",$data);
                    $this->load->view("admin/gambar_customer",$data);
                    $this->load->view("admin/footer");
                }
                else{
                    $gambar_customer = $this->upload->data("file_name");

                    $where = array(
                        "customer_id" => $id
                    );
                    $data = array(
                        "gambar_customer" => $gambar_customer
                    );

                    $this->m_rental->update_data($where,$data,"customer");
                    redirect(base_url()."admin/customer?edit_gambar=berhasil&nama=$nama");
                }

        }

        function ganti_password_customer($id){
            $where = array(
                "customer_id" => $id
            );
            $data["customer"] = $this->m_rental->edit_data($where,"customer")->result();
            $data["active"] = "customer";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/ganti_password_customer",$data);
            $this->load->view("admin/footer");
        }

        function password_customer_update(){
            $customer_id = $this->input->post("id");
            $nama = $this->input->post("nama");
            $pass_sekarang = $this->input->post("pass");
            $pass_baru = $this->input->post("pass_baru");
            $ulang_pass = $this->input->post("ulang_pass");

            $pass_sekarang_xss = $this->security->xss_clean($pass_sekarang);
            $nama_xss = $this->security->xss_clean($nama);
            $pass_baru_xss = $this->security->xss_clean($pass_baru);
            $ulang_pass_xss = $this->security->xss_clean($ulang_pass);

            $this->form_validation->set_rules("pass","Password Sekarang","required|trim|min_length[5]");
            $this->form_validation->set_rules("pass_baru","Password Baru","required|matches[ulang_pass]|trim|min_length[5]");
            $this->form_validation->set_rules("ulang_pass","Ulangi Password Baru","required|trim|matches[pass_baru]|min_length[5]");

            if($this->form_validation->run() != false){
                $where = array(
                    "customer_id" => $customer_id,
                    "password" => sha1($pass_sekarang_xss)
                );

                $data_customer = $this->m_rental->edit_data($where,"customer")->num_rows();

                if($data_customer > 0){
                    $data = array(
                        "password" => sha1($pass_baru_xss)
                    );
                    $w = array(
                        "customer_id" => $customer_id
                    );
                    $this->m_rental->update_data($w,$data,"customer");

                    redirect(base_url()."admin/customer?pesan=berhasil_pass&nama=".$nama_xss);
                }
                else{
                    redirect(base_url()."admin/ganti_password_customer/".$customer_id."?pesan=gagal");
                }
            }
            else{
                $where = array(
                    "customer_id" => $customer_id
                );
                $data["active"] = "customer";
                $data["password"] = array(
                    "pass_sekarang" => $pass_sekarang_xss,
                    "pass_baru" => $pass_baru_xss,
                    "ulang_pass" => $ulang_pass_xss
                );
                $data["customer"] = $this->m_rental->edit_data($where,"customer")->result();

                $this->load->view("admin/header",$data);
                $this->load->view("admin/ganti_password_customer",$data);
                $this->load->view("admin/footer");
            }
        }

        function customer_hapus($id){
            $where = array(
                "customer_id" => $id
            );

            $this->m_rental->delete_data($where,"customer");
            redirect(base_url()."admin/customer?hapus=berhasil");
        }

        function transaksi(){
            $data["transaksi"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id ORDER BY transaksi_id DESC")->result();
            $data["active"] = "transaksi";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/transaksi",$data);
            $this->load->view("admin/footer");
        }

        function transaksi_add(){
            date_default_timezone_set("Asia/Jakarta");
            $w = array(
                "status" => "1"
            );
            $data["mobil"] = $this->m_rental->edit_data($w,"mobil")->result();
            $data["customer"] = $this->m_rental->get_data("customer")->result();
            $data["transaksi"] = array(
                "customer" => "",
                "mobil" => "",
                "tgl_pinjam" => "",
                "jam_pinjam" => "",
                "tgl_kembali" => ""
            );
            $data["active"] = "transaksi_add";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/transaksi_add",$data);
            $this->load->view("admin/footer");
        }

        function transaksi_add_act(){
            date_default_timezone_set("Asia/Jakarta");
            $customer = $this->input->post("customer");
            $mobil = $this->input->post("mobil");
            $tgl_pinjam = $this->input->post("tgl_pinjam");
            $jam_pinjam = $this->input->post("jam_pinjam");
            $tgl_kembali = $this->input->post("tgl_kembali");

            $tgl_pinjam = date("Y-m-d",strtotime($tgl_pinjam));
            $jam_pinjam = date("H:i:s",strtotime($jam_pinjam));
            $tgl_kembali = date("Y-m-d",strtotime($tgl_kembali));

            $this->form_validation->set_rules("customer","Customer","required|trim|xss_clean");
            $this->form_validation->set_rules("mobil","Mobil","required|trim|xss_clean");
            $this->form_validation->set_rules("tgl_pinjam","Tanggal Pinjam","required|trim|xss_clean");
            $this->form_validation->set_rules("jam_pinjam","Jam Mulai Meminjam","required|trim|xss_clean");
            $this->form_validation->set_rules("tgl_kembali","Tanggal Kembali","required|trim|xss_clean");

            if($this->form_validation->run() != false){
                $diff = strtotime($tgl_pinjam) - strtotime($tgl_kembali);

                if($diff < 0){
                    $tgl_sekarang = date("Y-m-d");
                    $diff2 = strtotime($tgl_sekarang) - strtotime($tgl_pinjam);

                        if($diff2 <= 0){
                            $date_diff1 = date_create($tgl_pinjam);
                            $date_diff2 = date_create($tgl_kembali);
                            $date_diff = date_diff($date_diff1,$date_diff2);

                            $where = array(
                                "mobil_id" => $mobil
                            );
                            $d = $this->m_rental->edit_data($where,"mobil")->row();

                            if((int)$date_diff->format("%R%a") > 1){
                                $total_bayar = $d->harga * (int)$date_diff->format("%R%a");
                            }
                            else{
                                $total_bayar = $d->harga;
                            }
                            
                            if($d){
                                $sub_jam = substr($jam_pinjam,0,2);

                                if((int)$sub_jam <= 15 && (int)$sub_jam >= 10){
                                    $fix_pinjam = $tgl_pinjam." ".$jam_pinjam;
                                    $fix_kembali = $tgl_kembali." ".$jam_pinjam;

                                    $data = array(
                                        "id_karyawan" => $this->session->userdata("id"),
                                        "id_customer" => $customer,
                                        "id_mobil" => $mobil,
                                        "tgl_pinjam" => $fix_pinjam,
                                        "tgl_kembali" => $fix_kembali,
                                        "harga" => $d->harga,
                                        "denda" => $d->denda,
                                        "total_bayar" => $total_bayar,
                                        "tgl" => date("Y-m-d H:i:s")
                                    );

                                    $this->m_rental->insert_data($data,"transaksi");

                                    $d2 = array(
                                        "status" => "2"
                                    );

                                    $w = array(
                                        "mobil_id" => $mobil
                                    );

                                    $this->m_rental->update_data($w,$d2,"mobil");

                                    $w2 = array(
                                        "customer_id" => $customer
                                    );
                                    $d3 = $this->m_rental->edit_data($w2,"customer")->row();

                                    if($d3){
                                        redirect(base_url()."admin/transaksi?pesan=berhasil&nama=".$d3->nama);
                                    }
                                }
                                else{
                                    redirect(base_url()."admin/transaksi_add?pesan=gagal3");
                                }
                            }
                        }
                        else{
                            redirect(base_url()."admin/transaksi_add?pesan=gagal2");
                        }
                }
                else{
                    redirect(base_url()."admin/transaksi_add?pesan=gagal");
                }
            }
            else{
                $w = array("status" => "1");
                $data["mobil"] = $this->m_rental->edit_data($w,"mobil")->result();
                $data["customer"] = $this->m_rental->get_data("customer")->result();
                $data["transaksi"] = array(
                    "customer" => $customer,
                    "mobil" => $mobil,
                    "tgl_pinjam" => $tgl_pinjam,
                    "jam_pinjam" => $jam_pinjam,
                    "tgl_kembali" => $tgl_kembali
                );
                $data["active"] = "transaksi_add";

                $this->load->view("admin/header",$data);
                $this->load->view("admin/transaksi_add",$data);
                $this->load->view("admin/footer");
            }
        }

        function lihat_transaksi($id){
            $data["mobil"] = $this->m_rental->get_data("mobil")->result();
            $data["customer"] = $this->m_rental->get_data("customer")->result();
            $data["transaksi"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND transaksi_id = '$id'")->result();
            $data["active"] = "transaksi";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/lihat_transaksi",$data);
            $this->load->view("admin/footer");
        }

        function transaksi_batal($id){
            $w = array(
                "transaksi_id" => $id
            );

            $data["transaksi"] = $this->m_rental->edit_data($w,"transaksi")->result();
            $data["active"] = "transaksi";

            $this->load->view("admin/header",$data);
            $this->load->view("admin/transaksi_batal",$data);
            $this->load->view("admin/footer");
        }

        function transaksi_batal_act(){
            date_default_timezone_set("Asia/Jakarta");
            $id = $this->input->post("id");
            $alasan = $this->input->post("alasan");

            $alasan_xss = $this->security->xss_clean($alasan);

            $this->form_validation->set_rules("alasan","Alasan Membatalkan Transaksi","required|trim|min_length[5]");

            if($this->form_validation->run() != false){
                $where = array(
                    "transaksi_id" => $id
                );
                $data = $this->m_rental->edit_data($where,"transaksi")->row();

                $pindah = array(
                    "transaksi_id" => $data->transaksi_id,
                    "id_karyawan" => $this->session->userdata("id"),
                    "id_customer" => $data->id_customer,
                    "id_mobil" => $data->id_mobil,
                    "tgl_pinjam" => $data->tgl_pinjam,
                    "tgl_kembali" => $data->tgl_kembali,
                    "harga" => $data->harga,
                    "denda" => $data->denda,
                    "tgl_batal" => date("Y-m-d H:i:s"),
                    "tgl_transaksi" => $data->tgl,
                    "alasan" => $alasan_xss
                );
                $pindah_transaksi = $this->m_rental->insert_data($pindah,"transaksi_batal");

                $mobil = array(
                    "mobil_id" => $data->id_mobil
                );
                $ganti = array(
                    "status" => "1"
                );
                $this->m_rental->update_data($mobil,$ganti,"mobil");

                $this->m_rental->delete_data($where,"transaksi");

                redirect(base_url()."admin/transaksi?pesan=batal_berhasil");
            }
            else{
                $where = array(
                    "transaksi_id" => $id
                );
                $data["transaksi"] = $this->m_rental->edit_data($where,"transaksi")->result();
                $data["alasan"] = array(
                    "alasan" => $alasan_xss
                );
                $data["active"] = "transaksi";

                $this->load->view("admin/header",$data);
                $this->load->view("admin/transaksi_batal",$data);
                $this->load->view("admin/footer");
            }
        }

        function transaksi_selesai($id){
            $data["mobil"] = $this->m_rental->get_data("mobil")->result();
            $data["customer"] = $this->m_rental->get_data("customer")->result();
            $data["transaksi"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND transaksi_id = '$id'")->result();
            $data["active"] = "transaksi";
            
            $this->load->view("admin/header",$data);
            $this->load->view("admin/transaksi_selesai",$data);
            $this->load->view("admin/footer");
        }

        function transaksi_selesai_act(){
            date_default_timezone_set("Asia/Jakarta");
            $id = $this->input->post("id");
            $tgl_dikembalikan = $this->input->post("tgl_dikembalikan");
            $tgl_kembali = $this->input->post("tgl_kembali");
            $mobil = $this->input->post("mobil");
            $denda = $this->input->post("denda");
            $total_bayar = $this->input->post("total_bayar");

            $tgl_dikembalikan = date("Y-m-d",strtotime($tgl_dikembalikan));

            $tgl_dikembalikan_xss = $this->security->xss_clean($tgl_dikembalikan);
            $jam = date("H:i:s");
            $fix = $tgl_dikembalikan_xss." ".$jam;

            $this->form_validation->set_rules("tgl_dikembalikan","Tanggal Di Kembalikan","required");

            if($this->form_validation->run() != false){
                $diff = strtotime($fix) - strtotime($tgl_kembali);

                if($diff >= 0){
                    $where = array(
                        "transaksi_id" => $id
                    );
                    $cari = $this->m_rental->edit_data($where,"transaksi")->row();

                    $batas_kembali = strtotime($tgl_kembali);
                    $dikembalikan = strtotime($fix);
                    $selisih = abs(($batas_kembali - $dikembalikan)/(60*60*24));
                    $total_denda = $denda*$selisih;

                    $total_bayar_db = $total_bayar + $total_denda;

                    $data = array(
                        "tgl_dikembalikan" => $fix,
                        "id_karyawan" => $this->session->userdata("id"),
                        "total_denda" => $total_denda,
                        "total_bayar" => $total_bayar_db,
                        "tgl" => $cari->tgl,
                        "tgl_selesai" => date("Y-m-d H:i:s"),
                        "transaksi_status" => "1"
                    );

                    $w = array(
                        "transaksi_id" => $id
                    );

                    $this->m_rental->update_data($w,$data,"transaksi");

                    $data2 = array(
                        "status" => "1"
                    );

                    $w2 = array(
                        "mobil_id" => $mobil
                    );

                    $this->m_rental->update_data($w2,$data2,"mobil");

                    $w3 = array(
                        "transaksi_id" => $id
                    );

                    $data3 = $this->m_rental->edit_data($w3,"transaksi")->row();

                    $w4 = array(
                        "customer_id" => $data3->id_customer
                    );

                    $data4 = $this->m_rental->edit_data($w4,"customer")->row();
                    redirect(base_url()."admin/transaksi?pesan=transaksi_berhasil&nama=".$data4->nama);
                }
                else{
                    redirect(base_url()."admin/transaksi_selesai/".$id."?pesan=gagal");
                }
            }
            else{
                $data["mobil"] = $this->m_rental->get_data("mobil")->result();
                $data["customer"] = $this->m_rental->get_data("customer")->result();
                $data["transaksi"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND transaksi_id = '$id'")->result();
                $data["active"] = "transaksi";

                $this->load->view("admin/header",$data);
                $this->load->view("admin/transaksi_selesai",$data);
                $this->load->view("admin/footer");
            }
        }

        function lihat_transaksi_batal(){
            $data["active"] = "transaksi_batal";
            $data["transaksi_batal"] = $this->db->query("SELECT * FROM transaksi_batal,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id ORDER BY batal_id DESC")->result();

            $this->load->view("admin/header",$data);
            $this->load->view("admin/lihat_transaksi_batal",$data);
            $this->load->view("admin/footer");
        }

        function lihat_batal($id){
            $data["active"] = "transaksi_batal";
            $data["mobil"] = $this->m_rental->get_data("mobil")->result();
            $data["customer"] = $this->m_rental->get_data("customer")->result();
            $data["transaksi"] = $this->db->query("SELECT * FROM transaksi_batal,mobil,customer,admin WHERE id_mobil = mobil_id AND id_customer = customer_id AND id_karyawan = admin_id AND batal_id = '$id'")->result();

            $this->load->view("admin/header",$data);
            $this->load->view("admin/lihat_batal",$data);
            $this->load->view("admin/footer");
        }

        function laporan(){
            $dari = $this->input->post("dari");
            $sampai = $this->input->post("sampai");
            
            $dari_xss = $this->security->xss_clean($dari);
            $sampai_xss = $this->security->xss_clean($sampai);

            $this->form_validation->set_rules("dari","Dari Tanggal","required|trim");
            $this->form_validation->set_rules("sampai","Sampai Tanggal","required|trim");

            if($this->form_validation->run() != false){
                $id = $this->session->userdata("id");
                $jam_dari = date("H:i:s",strtotime("00:00:00"));
                $jam_sampai = date("H:i:s",strtotime("00:00:00"));
                $fix_dari = date("Y-m-d",strtotime($dari_xss))." ".$jam_dari;
                $fix_sampai = date("Y-m-d",strtotime($sampai_xss))." ".$jam_sampai;

                $data["laporan"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND id_karyawan = '$id' AND date(tgl) >= '$fix_dari' AND date(tgl) <= '$fix_sampai' AND transaksi_status = 1")->result();
                $cek_batal = $this->db->query("SELECT * FROM transaksi_batal WHERE id_karyawan = '$id'")->num_rows();
                
                if($cek_batal >= 1){
                    $data["batal"] = $this->db->query("SELECT * FROM transaksi_batal,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND id_karyawan = '$id' AND date(tgl_batal) >= '$fix_dari' AND date(tgl_batal) <= '$fix_sampai'")->result();
                }
                $data["active"] = "laporan";
                $data["dari"] = $fix_dari;
                $data["sampai"] = $fix_sampai;

                $this->load->view("admin/header",$data);
                $this->load->view("admin/laporan_filter",$data);
                $this->load->view("admin/footer");
            }
            else{
                $data["active"] = "laporan";
                $this->load->view("admin/header",$data);
                $this->load->view("admin/laporan");
                $this->load->view("admin/footer");
            }
        }

        function laporan_print(){
            $dari = $this->input->get("dari");
            $sampai = $this->input->get("sampai");

            if($dari != "" && $sampai != ""){
                $data["laporan"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND date(tgl) >= '$dari' AND date(tgl) <= '$sampai'")->result();

                $this->load->view("admin/laporan_print",$data);
            }
            else{
                redirect(base_url()."admin/laporan");
            }
        }

        function laporan_pdf(){
            $dompdf = new Dompdf\Dompdf();
            $dari = $this->input->get("dari");
            $sampai = $this->input->get("sampai");

            $data["laporan"] = $this->db->query("SELECT * FROM transaksi,mobil,customer WHERE id_mobil = mobil_id AND id_customer = customer_id AND date(tgl) >= '$dari' AND date(tgl) <= '$sampai'")->result();

            $this->load->view("admin/laporan_pdf",$data);
            
            $paper_size = "A4";
            $orientation = "potrait";
            $html = $this->output->get_output();

            $dompdf->set_paper($paper_size,$orientation);

            $dompdf->load_html($html);
            $dompdf->render();
            $dompdf->stream("laporan.pdf",array("Attachment"=>0));
        }
    }
?>