<?php

class Penilaian extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('Penilaian_model');
        $this->load->model('nilaikriteria_model');
        $this->load->model('kriteria_model');
		
	}

   public function index()
	{
        $data['dataKriteria'] = $this->kriteria_model->getDataKriteria();
       $this->load->view('admin/penilaian', $data);
	}

   public function dataBobot()
    {
        
        $dataKriteria = $this->Penilaian_model->getDataBobot();
        $no =1;
        foreach ($dataKriteria as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['namaKriteria'];
            $tbody[] = $value['bobot'] * 100 .'%';
            $tbody[] = $value['bobot'];
            $aksi= "<button class='btn btn-primary ubah-nilai-bobot' data-toggle='modal' data-id=".$value['id_bobotkriteria'].">Ubah</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataKriteria) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function add()
    {
        $id_kriteria = $this->input->post('id_kriteria');

        // $tambahKriteria = array (
        //     'id_calon_anggota'=>$this->input->post('id_calon_anggota'),
        //     'id_kriteria' => $this->input->post('id_kriteria'),
        //     'id_nilaikriteria' => $this->input->post('id_nilaikriteria')
        // );

        echo $id_kriteria;

        // $data = $this->kriteria_model->save($tambahKriteria);
        // $insertId = $this->db->insert_id();

        //  $tambahBobot = array (
        //     'id_kriteria'=>$insertId,
        //     'bobot' => 0
        //  );

        //  $saveBobot = $this->bobot_model->save($tambahBobot);


        // echo json_encode($data);
    }

   public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['dataBobot'] = $this->Penilaian_model->dataBobotedit($id);
        $this->load->view('admin/formEditBobot',$data);
    }

	public function ubahDataBobot()
    {
       $bobot = $this->input->post('bobot') / 100;
        $objdata = array(
            'bobot'=> $bobot,
        );

        $id = $this->input->post('id');
        $data = $this->Penilaian_model->ubahDataBobot($objdata,$id);

        echo json_encode($data);
    }

	public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');

         $data = $this->Penilaian_model->hapusDataKriteria($id);
         echo json_encode($data);
    }

}

?>