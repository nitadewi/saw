<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model {
    private $_table = "nilai_calon_anggota";

    public function getdatanilai()
    {
            $this->db->select('*');
            $this->db->from('nilai_calon_anggota');
            $this->db->join('kriteria','kriteria.id_kriteria = nilai_calon_anggota.id_kriteria');
            $this->db->join('calon_anggota','calon_anggota.id_calon_anggota = nilai_calon_anggota.id_calon_anggota');      
            $query = $this->db->get();
            return $query->result_array();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function dataedit($id)
    {
        $this->db->select('*');
        $this->db->from('nilai_calon_anggota');
        $this->db->join('kriteria','kriteria.id_kriteria = nilai_calon_anggota.id_kriteria');
        $this->db->join('calon_anggota','calon_anggota.id_calon_anggota = nilai_calon_anggota.id_calon_anggota');      
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahdata($data,$id)
    {
        $this->db->where('id_nilaikriteria',$id);
        return $this->db->update($this->_table,$data);

    }

    public function hapusdata($id)
    {
        $this->db->where('id_nilaiKriteria',$id);
        return $this->db->delete($this->_table);
        
    }

    
}

