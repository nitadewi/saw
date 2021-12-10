
<?php $this->load->view("admin/_partials/header.php") ?>
               <div class="container-fluid py-4">
                 
                    <div class="row">
                            <!-- form input calon anggota -->
                         <div class="col-4">
                              <div class="card mb-4">
                                   <div class="card-header pb-0">
                                        <h6>Form Input Data Calon Anggota</h6>
                                   </div>
                                   <div class="card-body px-0 pt-0 pb-2">
                                        <div class="px-3 py-2">
                                                  <form id="tambahCalonAnggota" >
                                                  <div class="form-group row">
                                                  <label class="col-form-label">Nama</label>
                                                  <div class="col-sm-12">
                                                       <input type="text" id="nama" class="form-control" name="nama" placeholder="nama calon anggota" required>
                                                      
                                                  </div>
                                                  </div>
                                                  <div class="form-group row">
                                                  <label class="col-form-label">NIM</label>
                                                  <div class="col-sm-12">
                                                       <input type="number" id="nim" class="form-control" name="nim" placeholder="nim" required>
                                                  </div>
                                                  </div>
                                                 
                                                  <div class="form-group row">
                                                       <label class="col-form-label">Jurusan</label>
                                                       <div class="col-sm-12">
                                                            <select class="form-control" id="jurusan" name="jurusan" style="z-index: 10; position: relative;" required>
                                                                 <option selected disabled>Choose...</option>
                                                                 <optgroup label="D3">
                                                                 <option>Sistem Informasi Akuntansi</option>
                                                                 <option>Teknologi Komputer</option>
                                                                 <option>Rekayasa Perangkat Lunak Aplikasi</option>
                                                                <optgroup label="S1">
                                                                 <option>Informatika</option>
                                                                 <option>Sistem Informasi</option>
                                                            </select>
                                                       </div>
                                                  </div>
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

                          <!-- table calon anggota -->
                          <div class="col-8">
                              <div class="card mb-4">
                                   <div class="card-header pb-0">
                                        <h6>Data Calon Anggota</h6>
                                   </div>
                                    
                                   <div class="card-body px-0 pt-0 pb-2">
                                        <div class="px-3 py-2">
                                             <table id="dataCalonAnggota" class="table align-items-center mb-0" width="100%"></table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                     <!-- Modal untuk edit data mahasiswa-->
                    <div class="modal fade" id="editmahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                   <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
                                   </div>
                                   <div class="modal-body">
                                   <div id="formdataCalonAnggota">

                                   </div>
                              </div>
                         </div>
                    </div>

                   
                   
               </div>
               
<?php $this->load->view("admin/_partials/footer.php") ?>

<script>
      $(document).ready(function () {
           var dataCalonAnggota = $('#dataCalonAnggota').DataTable({
                "processing": true,
                "ajax": "<?=base_url("index.php/admin/calonAnggota/dataCalonAnggota")?>",
                stateSave: true,
                columns: [
                         { title: "No" },
                         { title: "Nama" },
                         { title: "Nim" },
                         { title: "Jurusan" },
                         { title: "Aksi" }
                    ],
                    
          })

                   
          //tambah data
          $('#tambahCalonAnggota').on('submit', function () {
               var nama = $('#nama').val(); // diambil dari id nama yang ada diform modal
               var nim = $('#nim').val(); // diambil dari id alamat yanag ada di form modal 
               var jurusan = $('#jurusan').val(); // diambil dari id jurusan yanag ada di form modal 

               $.ajax({
               type: "post",
               url: "<?=base_url('index.php/admin/calonAnggota/add')?>",
               beforeSend :function () {
               swal.fire({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    didOpen: () => {
                         swal.showLoading()
                    }
                    })      
               },
               data: {nama:nama,
                    nim:nim,
                    jurusan: jurusan}, // ambil datanya dari form yang ada di variabel
               dataType: "JSON",
               success: function (data) {
               dataCalonAnggota.ajax.reload(null,false);
               Swal.fire(
                         'Good job!',
                         'Data Berhasil ditambahkan',
                         'success'
                         )
               }
               })
               return false;
          });
         

          //edit data
          $('#dataCalonAnggota').on('click','.ubah-mahasiswa', function () {
               // ambil element id pada saat klik ubah
               var id =  $(this).data('id');
               console.log(id);
               
               $.ajax({
               type: "post",
               url: "<?=base_url('index.php/admin/calonAnggota/formedit')?>",
               beforeSend :function () {
                    swal.fire({
                         title: 'Menunggu',
                         html: 'Memproses data',
                         didOpen: () => {
                         swal.showLoading()
                         }
                    })      
                    },
               data: {id:id},
               success: function (data) {
                    swal.close();
                    $('#editmahasiswa').modal('show');
                    $('#formdataCalonAnggota').html(data);


                     // proses untuk mengubah data
                     $('#formubahdatamhs').on('submit', function () {
                    var editnama = $('#editnama').val(); // diambil dari id nama yang ada diform modal
                    var editnim = $('#editnim').val(); // diambil dari id alamat yanag ada di form modal 
                    var editjurusan = $('#editjurusan').val(); // diambil dari id alamat yanag ada di form modal 
                    var id = $('#idCalonAnggota').val(); //diambil dari id yang ada di form modal
                    $.ajax({
                      type: "post",
                      url: "<?=base_url('index.php/admin/calonAnggota/ubahDataCalonAnggota')?>",
                      beforeSend :function () {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            didOpen: () => {
                              swal.showLoading()
                            }
                          })      
                        },
                      data: {editnama:editnama,
                         editnim:editnim,
                         editjurusan: editjurusan,
                         id:id}, // ambil datanya dari form yang ada di variabel
                    success: function (data) {
                    dataCalonAnggota.ajax.reload(null,false);
                     Swal.fire(
                         'Success!',
                         'Data Berhasil diupdate',
                         'success'
                         )
                          // tutup form pada modal
                          $('#editmahasiswa').modal('hide');
                      }
                    })
                    return false;
                  });
                    
               }
               });

               
          });

          // fungsi untuk hapus data
          //pilih selector dari table id dataCalonAnggota dengan class .hapus-mahasiswa
          $('#dataCalonAnggota').on('click','.hapus-mahasiswa', function () {
            var id =  $(this).data('id');
            swal.fire({
               title: 'Anda Yakin?',
               text: "Data yang terhapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Iya',
               cancelButtonText: 'Tidak',
               confirmButtonColor: '#cb0c9f',
               cancelButtonColor: '#6c757d',
               reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('index.php/admin/calonAnggota/hapus')?>",  
                    method:"post",
                    beforeSend :function () {
                    swal.fire({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        didOpen: () => {
                          swal.showLoading()
                        }
                      })      
                    },    
                    data:{id:id},
                    success:function(data){
                      swal.fire(
                        'Hapus',
                        'Berhasil Terhapus',
                        'success'
                      )
                      dataCalonAnggota.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal.fire(
                    'Batal',
                    'Anda membatalkan penghapusan',
                    'error'
                  )
                }
              })
            });
     });      
          
</script>

<?php $this->load->view("admin/_partials/script.php") ?>

