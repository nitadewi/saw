<?php

class Penilaian extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        	$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
		$this->load->model('penilaian_model');
        $this->load->model('nilaikriteria_model');
        $this->load->model('kriteria_model');
        $this->load->model('ca_model');
		
	}

   public function index()
	{
        $data['dataKriteria'] = $this->kriteria_model->getDataKriteria();
        $data['current_user'] = $this->auth_model->current_user();
       $this->load->view('admin/penilaian', $data);
	}

   public function dataNilai()
    {
        
        $dataNilai = $this->penilaian_model->getDataNilai();
        $no =1;
        foreach ($dataNilai as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_calon_anggota'];
            $aksi= "<button class='btn btn-primary ubah-nilai' data-toggle='modal' data-id=".$value['id_calon_anggota'].">Ubah</button>".' '."<button class='btn btn-danger hapus-nilai' id='id' data-toggle='modal' data-id=".$value['id_calon_anggota'].">Hapus</button>";;
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataNilai) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function add()
    {
      

        $tambahKriteria = array (
            'id_calon_anggota'=>$this->input->post('id_calon_anggota'),
            'id_kriteria' => $this->input->post('id_kriteria'),
            'id_nilaikriteria' => $this->input->post('id_nilaikriteria')
        );

       

        $data = $this->penilaian_model->save($tambahKriteria);

        echo json_encode($data);
    }

   public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['dataNilai'] = $this->penilaian_model->dataNilaiEdit($id);
        $data['dataAnggota'] = $this->ca_model->dataCalonAnggotaedit($id);
        $data['dataKriteria'] = $this->kriteria_model->getDataKriteria();
        $this->load->view('admin/formEditNilaiCalonAnggota',$data);
    }

	public function ubahDataNilai()
    {
         $updateData = array (
            'id_calon_anggota'=>$this->input->post('id_calon_anggota'),
            'id_kriteria' => $this->input->post('id_kriteria'),
            'id_nilaikriteria' => $this->input->post('id_nilaikriteria')
        );

        $id = $this->input->post('id_calon_anggota');
        $id_kriteria = $this->input->post('id_kriteria');
        $data = $this->penilaian_model->ubahDataNilai($updateData,$id, $id_kriteria);

        echo json_encode($data);
    }

	public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');

         $data = $this->penilaian_model->hapusDataKriteria($id);
         echo json_encode($data);
    }

}

?>