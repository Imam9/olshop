<div class="col-md-12">
            <!-- general form elements disabled -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Input Add Barang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php 
        echo validation_errors('<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i>', '</h5></div>');


        if(isset($error_upload)){
          echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i>';
          echo $error_upload;
          echo '</h5></div>';
        }

        if($this->session->flashdata('pesan')){
          echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i>';
          echo $this->session->flashdata('pesan');
          echo '</h5></div>';
        }
      
      ?>
      <form method = "POST" action = "<?= base_url('admin/setting') ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Provinsi</label>
                  <select name="provinsi" id="" class="form-control">
                    <option value="<?= $setting->lokasi?>"><?= $setting->lokasi?></option>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kota </label>
                <select name="kota" id="" class="form-control">
                  <option value="><?= $setting->lokasi?>"><?= $setting->lokasi?></option>
                </select>
              </div>
            </div>
        </div>
        <div class="row"> 
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Toko</label>
              <input type="text" name = "nama_toko" class="form-control" placeholder="Nama Toko" value = "<?= $setting->nama_toko?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" name = "no_telpon" class="form-control" placeholder="Nomor Telepon" value = "<?= $setting->no_telpon?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Alamat Toko</label>
              <textarea name="alamat" class = "form-control" id="" cols="30" rows="3"><?= $setting->alamat_toko?></textarea>
            </div>
            <div class="form-group text-right">
              <button type = "submit" class = "btn btn-primary">Simpan</button>
              <a href="<?= base_url('barang')?>" class = "btn btn-danger">Kembali</a>
            </div>
          </div>
          
          <div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    //memasukkan data ke provensi
    $.ajax({
      type : "POST",
      url : "<?= base_url('rajaongkir/provensi')?>",
      success : function(hasil_provensi){
        // console.log(hasil_provensi);
        $("select[name=provinsi]").html(hasil_provensi);
      }
    });
    //memasukkan data ke kota
    $("select[name=provinsi]").on("change", function(){
      var id_provensi_terpilih = $("option:selected", this).attr("id_provinsi");
      $.ajax({
        type : "POST",
        url : "<?= base_url('rajaongkir/kota')?>",
        data : 'id_provinsi='+ id_provensi_terpilih,
        success : function(hasil_kota){
          // console.log(hasil_kota);
          $("select[name=kota]").html(hasil_kota);
        }
      });
    });
  });
</script>