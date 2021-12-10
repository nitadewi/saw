<?php

class CalonAnggota extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('ca_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
       $this->load->view('admin/calon_anggota');
	}

	public function add()
    {
        $nama = $this->input->post('nama'); 
        $nim = $this->input->post('nim');
        $jurusan = $this->input->post('jurusan');

        $tambahmhs = array (
            'nama_calon_anggota'=>$nama,
            'nim'        => $nim,
            'jurusan_calon_anggota' => $jurusan
        );

        $data = $this->ca_model->save($tambahmhs);

        echo json_encode($data);
    }

    public function dataCalonAnggota()
    {
        
        $dataCalonAnggota = $this->ca_model->getdataCalonAnggota();
        $no =1;
        foreach ($dataCalonAnggota as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_calon_anggota'];
            $tbody[] = $value['nim'];
            $tbody[] = $value['jurusan_calon_anggota'];
            $aksi= "<button class='btn btn-primary ubah-mahasiswa' data-toggle='modal' data-id=".$value['id_calon_anggota'].">Ubah</button>".' '."<button class='btn btn-danger hapus-mahasiswa' id='id' data-toggle='modal' data-id=".$value['id_calon_anggota'].">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($dataCalonAnggota) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

     //dropdown 
    public function dropDown()
    {
        $cari = $this->input->get('q');
        $query = $this->ca_model->dropdDownCA($cari, 'nama_calon_anggota');
       
		echo json_encode($query);
    }

    public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['datapermahasiswa'] = $this->ca_model->dataCalonAnggotaedit($id);
        $this->load->view('admin/formEditCalonAnggota',$data);
    }

     public function ubahDataCalonAnggota()
    {
        $objdata = array(
            'nama_calon_anggota'=>$this->input->post('editnama'),
            'nim'=>$this->input->post('editnim'),
            'jurusan_calon_anggota'=>$this->input->post('editjurusan'),
        );

        $id = $this->input->post('id');
        $data = $this->ca_model->ubahDataCalonAnggota($objdata,$id);

        echo json_encode($data);
    }

    public function hapus()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');

         $data = $this->ca_model->hapusDataCalonAnggota($id);
         echo json_encode($data);
    }

}