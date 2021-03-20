<?php


function is_logged_in()
{
    $ci = get_instance();
    
    if (!$ci->session->has_userdata('id')) {
        redirect('auth');
    } else {
        $menu = $ci->uri->segment(1);
        $role_id = $ci->session->userdata('menu_id');
        
        $queryMenu = $ci->db->get_where('user_menu', ['controller' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        
        if($userAccess->num_rows() < 1){
            redirect('auth/error404');
        }
    }
}