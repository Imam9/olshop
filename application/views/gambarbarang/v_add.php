<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Gambar Barang : <?= $barang->nama_barang?></h3>

      <div class="card-tools">
    
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
    <?php 
        echo validation_errors('<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i>', '</h5></div>');

        if($this->session->flashdata('pesan')){
          echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i>';
          echo $this->session->flashdata('pesan');
          echo '</h5></div>';
        }
        

        if(isset($error_upload)){
          echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i>';
          echo $error_upload;
          echo '</h5></div>';
        }
      ?>
      
      <form method = "POST" action = "<?= base_url('gambarbarang/add/'.$barang->id_barang) ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label>Keterangan Barang</label>
          <input type="text" name = "ket" class="form-control" placeholder="Keterangan Gambar" value = "<?= set_value('ket')?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name = "gambar" class="form-control" id="preview_gambar" value = "<?= set_value('gambar')?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mt-3">
              <label>priview</label>
              <br>
              <img src="<?= base_url('assets/gambar/no_foto.jpg')?>" id="gambar_load" alt="no_foto" width = "20%">
            </div>
          </div>
        </div>
        <div class="form-group text-right">
          <button type = "submit" class = "btn btn-primary">Simpan</button>
          <a href="<?= base_url('gambarbarang')?>" class = "btn btn-danger">Kembali</a>
        </div>
      </form>

      <hr>
      <div class="row">
        <?php foreach ($gambar as $key => $value) {?>
        <div class="col-md-3 mt-2">
          <div class="form-group">
            <img src="<?= base_url('assets/gambarbarang/'.$value->gambar)?>" class = "ml-4 " id="gambar_load" alt="no_foto" width = "260px" height = "250px">
            <label class = "ml-1">ket : <?= $value->ket?></label>
          </div>
          <button data-toggle="modal" data-target="#delete<?=$value->id_gambar?>" class = "btn btn-danger btn-block"><i class = "fas fa-trash fa-sm"></i> Delete</button>

          
        </div>
        <?php }?>
      </div>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<?php $no = 1; foreach($gambar as $key => $value){ ?>
<div class="modal fade" id="delete<?=$value->id_gambar?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete <?= $value->ket?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="<?= base_url('assets/gambarbarang/'.$value->gambar)?>" class = "ml-4 " id="gambar_load" alt="no_foto" width = "260px" height = "250px">
        <h4>Apakah Anda Ingin Menghapus Gambar ini..?</h4>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?= base_url('gambarbarang/delete/'.$value->id_barang.'/'.$value->id_gambar)?>" class="btn btn-primary">Delete</a>
      </div>
   
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>

<script type="text/javascript">
  function bacaGambar(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#preview_gambar").change(function(){
    bacaGambar(this);
  });

</script>