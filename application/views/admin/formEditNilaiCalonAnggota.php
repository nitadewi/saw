 <form id="formEditNilaiCalonAnggota" >
    <div class="form-group row">
        <label class="col-form-label">Nama Calon Anggota</label>
        <div class="col-sm-12">
                <input type="text" value="<?=$dataAnggota['nama_calon_anggota'] ?>" class="form-control" readonly>
                <input type="hidden" name="id" id="edit_id_calon_anggota" value="<?=$dataAnggota['id_calon_anggota']?>"> 
        </div>
         <?php foreach ($dataNilai as $dn) { ?>
            <div class="form-group row">
                <label class="col-form-label"><?=$dn['namaKriteria'];?></label>
                <input type="text" class="id_kriteria" hidden id="edit_id_kriteria" value="<?=$dn['id_kriteria'];?>" name='edit_id_kriteria[]'>
                <div class="col-sm-12">
                    <select class="form-control edit_id_nilaikriteria" name="edit_id_nilaikriteria[]" required>
                        <?php $this->db->from('nilai_kriteria');
                            $this->db->where('id_kriteria',$dn['id_kriteria']);
                            $this->db->order_by('nilai','desc');
                        $query = $this->db->get();
                        
                        foreach ($query->result() as $row) { 
                            ?>
                            <option value="<?=$row->id_nilaikriteria?>" <?=$dn['id_nilaikriteria'] == $row->id_nilaikriteria ? 'selected' : '' ?> > <?=$row->keterangan?></option>
                            <?php 
                            
                            } 
                    ?>
                    </select>
                </div>
            </div>
        <?php } ?>
    </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
