<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
function ratingCheck($user_id)
{
    $ci = get_instance();
    $data =  $ci->db->get_where('history', ['user_id' => $user_id])->result_array();
    $row =  $ci->db->get_where('history', ['user_id' => $user_id, 'active' => 1])->num_rows();
    $result = 0;
    foreach ($data as $dt) {
        $angka = $dt['rating'] * 1;
        $result = $result + $angka;
    }
    if ($row == 0) {
        $result = 0;
    } else {
        $result = $result / $row;
    }

    return number_format($result, 1);
}
function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = ($ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->num_rows() > 0) ? "checked = 'checked '" : '';
    return $result;
}
function check_bidang($user_id, $bidang_id)
{
    $ci = get_instance();
    $result = ($ci->db->get_where('user_job', ['user_id' => $user_id, 'bidang_id' => $bidang_id])->num_rows() > 0) ? "checked = 'checked '" : '';
    return $result;
}
function check_bidang_kosong($user_id)
{
    $ci = get_instance();
    $result = ($ci->db->get_where('user_job', ['user_id' => $user_id])->num_rows() > 0) ? "" : 'd-none';
    return $result;
}
function check_project($user_id, $project_id)
{
    // perlu diperbaiki, dengan true dan false agar bisa digunakan berkali-kali
    $ci = get_instance();
    if ($ci->db->get_where('freelance_project', ['user_id' => $user_id, 'project_id' => $project_id])->num_rows() > 0) {
        $result = '<button type="button" class="btn btn-success" onclick="return confirm(\'Kamu ingin bergabung dengan project ini?\')" disabled>Terdaftar</button>';
    } else {
        $result = '<button type="submit" class="btn btn-success" onclick="return confirm(\'Kamu ingin bergabung dengan project ini?\')">Daftar sekarang</button>';
    }
    return $result;
}
function registrant($project_id)
{
    $ci = get_instance();
    $result = $ci->db->get_where('freelance_project', ['project_id' => $project_id])->num_rows();
    return $result;
}
function expired_check($id)
{
    $ci = get_instance();
    $process = $ci->db->get_where('freelance_project', ['project_id' => $id, 'is_active' => 1])->num_rows();
    $result = $ci->db->get_where('desc_project', ['id' => $id])->row_array();
    if ($result['is_active'] == 2) {
        return '<a href="' . base_url('job/finish/') . $id . '" class="ml-3 badge badge-success ">Finish</a>';
    } elseif ($result['expire'] <= time()) {
        if ($result['is_active'] == 1 || $process == 0) {
            $object = [
                'is_active' => 0
            ];
            $ci->db->where('id', $id);
            $ci->db->update('desc_project', $object);
            return '<small class=" ml-3 text-warning">expired</small>';
        } else {
            return '<small class=" ml-3 text-warning">on process</small>';
        }
    } else {
        if ($result['is_active'] == 0) {
            return '<small class=" ml-3 text-info">on process</small>';
        } else {
            return '<small class=" ml-3 text-info">active</small>';
        }
    }
}
function greeting()
{
    $time = date("H");
    if ($time < "12") {
        return "Selamat Pagi";
    } elseif ($time >= "12" && $time < "16") {
        return "Selamat Siang";
    } elseif ($time >= "16" && $time < "19") {
        return "Selamat Sore";
    } elseif ($time >= "19") {
        return "Selamat Malam";
    }
}
