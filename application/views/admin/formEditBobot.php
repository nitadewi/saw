<form id="formeditbobot" method="post">
    <div class="form-group row">
        <label class="col-form-label">Kriteria</label>
        <div class="col-sm-12">
        <input type="text" value="<?=$dataBobot['namaKriteria']?>" id="editnama" class="form-control" name="nama" placeholder="nama calon anggota" readonly>
        <!-- id calon anggota -->
        <input type="hidden" name="id" id="idKriteria" value="<?=$dataBobot['id_kriteria']?>"> 
        <input type="hidden" name="id" id="idBobot" value="<?=$dataBobot['id_bobotkriteria']?>">    
    </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label">Bobot <span class="text-xs text-secondary mb-0">1 - 100</span></label>
        
        <div class="col-sm-12">
        <input type="number" value="<?=$dataBobot['bobot'] * 100?>" id="editbobot" class="form-control" name="editBobot" onchange="maxInput(this)" required>
        </div>
    </div>
    </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
</form>

<script>
    function maxInput(val)
  {
    if (Number(val.value) > 100)
    {
      val.value = 100
    } else if (Number(val.value) < 1) {
          val.value = 1
    }
  }
</script>