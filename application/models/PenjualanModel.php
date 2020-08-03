<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanModel extends CI_Model
{
    protected function _alert($message, $type = 'success')
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible show" role="alert">'
            . $message .
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }

    public function getPenjualan($jual_nofak = null)
    {
        if ($jual_nofak === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_jual JOIN tbl_user ON jual_user_id=user_id ORDER BY jual_nofak ASC");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_jual JOIN tbl_user ON jual_user_id=user_id WHERE jual_nofak='$jual_nofak' ORDER BY jual_nofak ASC");
        }

        return $hsl;
    }
}
