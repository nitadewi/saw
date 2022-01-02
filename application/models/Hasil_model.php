<?php defined('BASEPATH') OR exit('No direct script access allowed');$valueMinMax=array(); $kriteriaArray=array(); $CalonAnggotaArray=array(); $forminmax=array(); $simpanNormalisasi=array(); $bobotArray=array();

class Hasil_model extends CI_Model
{
   

    public function getDataKriteria() {
           $query = $this->db->query("SELECT kriteria.namaKriteria, bobot_kriteria.bobot FROM bobot_kriteria
            inner join kriteria
            on bobot_kriteria.id_kriteria = kriteria.id_kriteria");
            return $query->result_array();
            
         
    }

    public function dataCalonAnggota() {
        $queryAlternative = $this->db->query("select calon_anggota.nama_calon_anggota AS nama_calon_anggota,id_calon_anggota from nilai_calon_anggota INNER JOIN calon_anggota USING(id_calon_anggota) GROUP BY id_calon_anggota ORDER BY  nama_calon_anggota ASC");
        return $queryAlternative->result_array();

    }

    public function Bobot() {
        $queryBobot="SELECT id_kriteria,bobot FROM bobot_kriteria";
        $executeBobot=$this->db->query($queryBobot);
        return $executeBobot->result_array();
            
    }


   public function simpanHasil($id_calon_anggota,$hasil){
        $queryCek="SELECT hasil FROM hasil WHERE id_calon_anggota='$id_calon_anggota'";
        $execute=$this->db->query($queryCek)->result_array();
        if (count($execute) > 0) {
            $querySimpan="UPDATE hasil SET hasil='$hasil' WHERE id_calon_anggota='$id_calon_anggota'";
        }else{
            $querySimpan="INSERT INTO hasil(hasil,id_calon_anggota) VALUES ('$hasil','$id_calon_anggota')";
        }
        $execute=$this->db->query($querySimpan);

    }

    public function urutNilaiAnggota() {
        $queryAlternative = $this->db->query("select * from calon_anggota inner join hasil on calon_anggota.id_calon_anggota=hasil.id_calon_anggota order by hasil.hasil desc");
        return $queryAlternative->result_array();


    }

   



}

?>