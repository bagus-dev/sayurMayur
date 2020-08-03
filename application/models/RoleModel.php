<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends CI_Model
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

    public function getRole($role_id = null)
    {
        if ($role_id === null) {
            $hsl = $this->db->query("SELECT * FROM tbl_role WHERE role_id != 4");
        } else {
            $hsl = $this->db->query("SELECT * FROM tbl_role WHERE role_id = '$role_id'");
        }

        return $hsl;
    }
}
