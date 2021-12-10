
<?php $this->load->view("admin/_partials/header.php") ?>
               <div class="container-fluid py-4">
                                       <div class="row">
                            <!-- form input kriteria anggota -->
                         <div class="col-4">
                              <div class="card mb-4">
                                   <div class="card-header pb-0">
                                        <h6>Form Input Nilai</h6>
                                   </div>
                                   <div class="card-body px-0 pt-0 pb-2">
                                        <div class="px-3 py-2">
                                             <form id="tambah" >
                                                       <div class="form-group row">
                                                            <label class="col-form-label">Nama Calon Anggota</label>
                                                            <div class="col-sm-12">
                                                                  <select class="form-control nama_calon_anggota" id="nama_calon_anggota" name="nama_calon_anggota" required>
                                                                 </select>
                                                            </div>
                                                           
                                                       </div>
                                                          <?php foreach ($dataKriteria as $k) { ?>
                                                        <div class="form-group row">
                                                            <label class="col-form-label"><?=$k['namaKriteria'];?></label>
                                                            <input type="text" class="id_kriteria" hidden id= "id_kriteria" value="<?=$k['id_kriteria'];?>" name='id_kriteria'>
                                                            <div class="col-sm-12">
                                                                 <select class="form-control id_nilaikriteria" name="id_nilaikriteria" required>
                                                                      <option selected="true" disabled="disabled"> Pilih <?=$k['namaKriteria'];?>
                                                                      </option>
                                                                      <?php $this->db->from('nilai_kriteria');
                                                                        $this->db->where('id_kriteria',$k['id_kriteria']);
                                                                        $this->db->order_by('nilai','desc');
                                                                      $query = $this->db->get();
                                                                      
                                                                      foreach ($query->result() as $row) { ?>
                                                                      <option value="<?=$row->id_nilaikriteria?>"><?=$row->keterangan?></option>
                                                                     <?php }
                                                                 ?>
                                                                      
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <?php } ?>
                                                       <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                 <button type="submit" class="btn btn-primary">Tambah</button>
                                                            </div>
                                                       </div>
                                             </form>
                                        </div>
                                        
                                         
                                       
                                   </div>
                              </div>
                         </div>

                          <!-- table kriteria anggota -->
                          <div class="col-8">
                              <div class="card mb-4">
                                   <div class="card-header pb-0">
                                        <h6>Data Nilai Calon Anggota</h6>
                                   </div>
                                    
                                   <div class="card-body px-0 pt-0 pb-2">
                                        <div class="px-3 py-2">
                                             <table id="dataNilai" class="table align-items-center mb-0" width="100%"></table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- Modal untuk edit data kriteria -->
                         <div class="modal fade" id="editKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Nama Kriteria</h5>
                                        </div>
                                        <div class="modal-body">
                                        <div id="formdataKriteria">

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
               </div>
<?php $this->load->view("admin/_partials/footer.php") ?>

<script>
      $(document).ready(function () {
           var dataNilai = $('#dataNilai').DataTable({
                "processing": true,
                "ajax": "<?=base_url("index.php/admin/kriteria/dataKriteria")?>",
                stateSave: true,
                columns: [
                    { title: "No" , "width": "10%" },
                    { title: "Nama", "width": "70%" },
                    { title: "Aksi", "width": "20%" },
               ],

               "iDisplayLength": 5
          })
     
      $('.nama_calon_anggota').select2({
                    theme: "classic",
                    ajax: {
                         dataType: 'json',
                         url: '<?=base_url("index.php/admin/calonAnggota/dropDown")?>',
                         delay: 250,
                         data: function (params) {
                         return {
                              q: params.term
                         }
                         },
                         processResults: function (data) {
                              var results =[];
                              $.each(data, function(index, item){
                                   results.push({
                                        id: item.id_calon_anggota,
                                        text: item.nama_calon_anggota
                                   })
                              });
                              
                         return {
                              results: results
                         };
                         },
                    }
          })
      })

       $('#tambah').on('submit', function () {
              var nilai = $('input:text.id_kriteria').serializeArray();
              console.log(nilai.value)
              
               var id_calon_anggota = $('#nama_calon_anggota').val();
                    //   $.ajax({
                    //      type: "post",
                    //      url: "<?=base_url('index.php/admin/penilaian/add')?>",
                    //      beforeSend :function () {
                    //      swal.fire({
                    //           title: 'Menunggu',
                    //           html: 'Memproses data',
                    //           didOpen: () => {
                    //                swal.showLoading()
                    //           }
                    //           })      
                    //      },
                    //      data: {
                    //           id_kriteria:tes,
                    //           id_calon_anggota:id_calon_anggota,
                    //           id_nilaikriteria: tes2
                    //      }, // ambil datanya dari form yang ada di variabel
                    //      dataType: "JSON",
                    //      success: function (data) {
                    //           if($i == nilai.length) {
                    //           dataNilai.ajax.reload(null,false);
                    //           Swal.fire(
                    //                     'Good job!',
                    //                     'Data Berhasil ditambahkan',
                    //                     'success'
                    //                     );
                    //           $('#namaKriteria').val('');
                    //           }
                    
                    //      } //      })
               return false;
          });
     </script>


<?php $this->load->view("admin/_partials/script.php") ?>