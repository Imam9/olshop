<div class="row">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Bukti Pembayaran</h3>
      </div>
    <div class="card-body">
      <div class="form-group">
        <p>Silahkan transfer ke salah satu daftar rekening yang tertera dibawah ini sebesar :</p>
        <br>
         <h2 class = "text-danger">RP. <?= number_format($bayar->total_bayar, 0) ?>.-</h2>
      </div>
      <table class="table">
        <thead class = "text-center">
            <tr>
              <th>No</th>
              <th>No Rek</th>
              <th>Nama Bank</th>
              <th>Atas Nama</th>
            </tr>
        </thead>
        <tbody class = "text-center">
          <?php $no =1 ;foreach($rekening as $rek => $value){?>
          <tr>
            <td><?= $no++?></td>
            <td><?= $value->no_rek?></td>
            <td><?= $value->nama_bank?></td>
            <td><?= $value->atas_nama?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <div class="col-md-6 ">
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
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Quick Example</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method ="post" action = "<?= base_url('pesanan_saya/bayar/'.$bayar->id_transaksi)?>" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label for="">Atas Nama</label>
            <input type="text" class="form-control" name = "atas_nama" placeholder="Atas Nama ..">
          </div>
          <div class="form-group">
            <label for="">Nama Bank</label>
            <input type="text" class="form-control" name = "nama_bank" placeholder="Nama Bank">
          </div>
          <div class="form-group">
            <label for="">No Rek</label>
            <input type="text" class="form-control" name = "no_rek" placeholder="No_rekening">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Bukti Bayar</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name = "bukti_bayar" class="form-control" id="exampleInputFile">
            </div>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
        </div>
        <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    <!-- /.card -->


    </div>

</div>