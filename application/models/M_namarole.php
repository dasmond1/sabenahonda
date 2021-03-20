<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_namarole extends CI_Model 
{
    public function getnamaRole()
    {
        $query = "SELECT `admin`.*, `user_menu`.`menu`
        FROM `admin` JOIN `user_menu`
        ON `admin`.`menu_id` = `user_menu`.`id`
        ORDER BY status DESC";
        
        return $this->db->query($query)->result_array();
    }
    public function getnamaMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ORDER BY `menu_id` ASC";
        return $this->db->query($query)->result_array();
    }
    public function getAccessMenu()
    {
        $query = "SELECT `user_access_menu`.*, `user_menu`.`menu`
        FROM `user_access_menu` JOIN `user_menu`
        ON `user_access_menu`.`role_id` = `user_menu`.`id`
        ORDER BY `menu_id` ASC";
        return $this->db->query($query)->result_array();
    }
    
}