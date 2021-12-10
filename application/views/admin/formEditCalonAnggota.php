<form id="formubahdatamhs" method="post">
    <div class="form-group row">
        <label class="col-form-label">Nama</label>
        <div class="col-sm-12">
        <input type="text" value="<?=$datapermahasiswa['nama_calon_anggota']?>" id="editnama" class="form-control" name="nama" placeholder="nama calon anggota" required>
        <!-- id calon anggota -->
        <input type="hidden" name="id" id="idCalonAnggota" value="<?=$datapermahasiswa['id_calon_anggota']?>">    
    </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label">NIM</label>
        <div class="col-sm-12">
        <input type="number" value="<?=$datapermahasiswa['nim']?>" id="editnim" class="form-control" name="nim" placeholder="nim" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label">Jurusan</label>
        <div class="col-sm-12">
            <select class="form-control" id="editjurusan" name="jurusan" style="z-index: 10; position: relative;" required>
                <optgroup label="D3">
                <option <?php $datapermahasiswa['jurusan_calon_anggota'] == 'Sistem Informasi Akuntansi' ? 'selected': ''  ?>  >Sistem Informasi Akuntansi</option>
                <option <?php $datapermahasiswa['jurusan_calon_anggota'] == 'Teknologi Komputer' ? 'selected': ''  ?> >Teknologi Komputer</option>
                <option <?php $datapermahasiswa['jurusan_calon_anggota'] == 'Rekayasa Perangkat Lunak Aplikasi' ? 'selected': ''  ?>>Rekayasa Perangkat Lunak Aplikasi</option>
                <optgroup label="S1">
                <option <?php $datapermahasiswa['jurusan_calon_anggota'] == 'Informatika' ? 'selected': ''  ?> >Informatika</option>
                <option <?php $datapermahasiswa['jurusan_calon_anggota'] == 'Sistem Informasi' ? 'selected': ''  ?>>Sistem Informasi</option>
            </select>
        </div>
    </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
</form>