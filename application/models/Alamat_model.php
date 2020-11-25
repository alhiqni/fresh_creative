<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat_model extends CI_model
{
    public function getDataProv()
    {
        return $this->db->get('wilayah_provinsi')->result_array();
    }
    public function getDataKabupaten($id)
    {
        return $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $id])->result();
    }
    public function getDataKecamatan($id)
    {
        return $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $id])->result();
    }
    public function getDataDesa($id)
    {
        return $this->db->get_where('wilayah_desa', ['kecamatan_id' => $id])->result();
    }
    public function getDataAlamat($user_id)
    {
        $query = "SELECT * from user_address where user_address.user_id = $user_id";
        $result = $this->db->query($query)->row_array();
        if (isset($result)) {
            $tmp = $this->db->get_where('wilayah_provinsi', ['id' => $result['provinsi_id']])->row_array();
            $result['provinsi_id'] = $tmp['nama'];
            $tmp = $this->db->get_where('wilayah_kabupaten', ['id' => $result['kabupaten_id']])->row_array();
            $result['kabupaten_id'] = $tmp['nama'];
            $tmp = $this->db->get_where('wilayah_kecamatan', ['id' => $result['kecamatan_id']])->row_array();
            $result['kecamatan_id'] = $tmp['nama'];
            $tmp = $this->db->get_where('wilayah_desa', ['id' => $result['desa_id']])->row_array();
            $result['desa_id'] = $tmp['nama'];
            return $result;
        } else {
            return $this->db->get_where('user_address', ['id' => 1])->row_array();
        }
    }
    public function getDataPengalaman($user_id)
    {
        return $this->db->get_where('job_experience', ['user_id' => $user_id])->result_array();
    }
    public function getDataBidangMember($id)
    {
        $query = 'SELECT bidang.bidang from user_job, bidang WHERE user_job.bidang_id = bidang.id and user_job.user_id =' . $id;
        $result = $this->db->query($query)->result_array();
        return $result;
    }
}
