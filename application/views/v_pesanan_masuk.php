
  <div class="col-12 col-sm-12">
  <?php 
    if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success</h5>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
    }
    ?>
      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Daftar Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Dikemas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
               <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <th>No</th>
                      <th>No Order</th>
                      <th>Tanggal </th>
                      <th>Expedisi</th>
                      <th>Total Bayar</th>
                      <th>Action</th>
                    </thead>
                    <?php $no =1; foreach($pesanan as $blm => $value){?>
                    <tbody>
                      <td><?= $no++?></td>
                      <td><?= $value->no_order?></td> 
                      <td><?= $value->tgl_order?></td> 
                      <td>Expedisi : <?= $value->expedisi?>
                          <br>
                          Paket : <?= $value->paket?>
                          <br>
                          Ongkir : <?= $value->ongkir?> 
                        </td> 
                      <td>Rp. <?= number_format($value->total_bayar, 0)?>
                        <br>
                        <?php if($value->status_bayar == '0') { ?>
                          <span class="badge badge-warning">Belum Bayar</span>
                        <?php }else{?>
                          <span class="badge badge-success">Sudah Bayar</span><br>
                          <span class="badge badge-info">Menunggu Verifikasi</span>
                        <?php }?>
                      </td>  
                      <td>
                      <?php if($value->status_bayar == '1') { ?>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#cek<?= $value->id_transaksi ?>">Bukti Bayar</button>
                        <a href="<?= base_url('admin/proses/'.$value->id_transaksi)?>" class = "btn btn-sm btn-success ">Proses</a>
                      <?php }else{?>
                        <!-- <a href="#" class = "btn btn-sm btn-info btn-flat">Sudah Bayar</a> -->
                        <?php }?>
                      </td>
                    </tbody>
                    <?php } ?>
                   </table>
                </div>
               </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
            <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <th>No</th>
                      <th>No Order</th>
                      <th>Tanggal </th>
                      <th>Expedisi</th>
                      <th>Total Bayar</th>
                      <th>Action</th>
                    </thead>
                    <?php $no =1; foreach($pesanan_diproses as $blm => $value){?>
                    <tbody>
                      <td><?= $no++?></td>
                      <td><?= $value->no_order?></td> 
                      <td><?= $value->tgl_order?></td> 
                      <td>Expedisi : <?= $value->expedisi?>
                          <br>
                          Paket : <?= $value->paket?>
                          <br>
                          Ongkir : <?= $value->ongkir?> 
                        </td> 
                      <td>Rp. <?= number_format($value->total_bayar, 0)?>
                        <br>
                          <span class="badge badge-info">Dikemas/Dikirim</span>
                      </td>  
                      <td>
                      <?php if($value->status_bayar == '1') { ?>
                        <button class = "btn btn-sm btn-success" data-toggle="modal" data-target="#kirim<?= $value->id_transaksi ?>"><i class = "fa fa-paper-plane"></i> Dikirim</button>
                      <?php }else{?>
                        <!-- <a href="#" class = "btn btn-sm btn-info btn-flat">Sudah Bayar</a> -->
                        <?php }?>
                      </td>
                    </tbody>
                    <?php } ?>
                   </table>
                </div>
               </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
              <table class="table table-hover">
                <thead>
                  <th>No</th>
                  <th>No Order</th>
                  <th>Tanggal </th>
                  <th>Expedisi</th>
                  <th>Total Bayar</th>
                  <th>No Resi</th>
                </thead>
                <?php $no =1; foreach($pesanan_dikirim as $blm => $value){?>
                <tbody>
                  <td><?= $no++?></td>
                  <td><?= $value->no_order?></td> 
                  <td><?= $value->tgl_order?></td> 
                  <td>Expedisi : <?= $value->expedisi?>
                      <br>
                      Paket : <?= $value->paket?>
                      <br>
                      Ongkir : <?= $value->ongkir?> 
                    </td> 
                  <td>Rp. <?= number_format($value->total_bayar, 0)?>
                    <br>
                      <span class="badge badge-success">Sedang dikirim</span>
                  </td>  
                  <td>
                 <?= $value->no_resi?>
                  </td>
                </tbody>
                <?php } ?>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
            <table class="table table-hover">
                <thead>
                  <th>No</th>
                  <th>No Order</th>
                  <th>Tanggal </th>
                  <th>Expedisi</th>
                  <th>Total Bayar</th>
                  <th>No Resi</th>
                </thead>
                <?php $no =1; foreach($pesanan_selesai as $blm => $value){?>
                <tbody>
                  <td><?= $no++?></td>
                  <td><?= $value->no_order?></td> 
                  <td><?= $value->tgl_order?></td> 
                  <td>Expedisi : <?= $value->expedisi?>
                      <br>
                      Paket : <?= $value->paket?>
                      <br>
                      Ongkir : <?= $value->ongkir?> 
                    </td> 
                  <td>Rp. <?= number_format($value->total_bayar, 0)?>
                    <br>
                      <span class="badge badge-success">diterima</span>
                  </td>  
                  <td>
                 <?= $value->no_resi?>
                  </td>
                </tbody>
                <?php } ?>
                </table>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
</div>


<?php foreach($pesanan as $blm => $value){?>
<div class="modal fade" id="cek<?= $value->id_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= $value->no_order ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama bank</th>
            <td>:</td>
            <td><?= $value->nama_bank?></td>
          </tr>
          <tr>
            <th>No Rek</th>
            <td>:</td>
            <td><?= $value->no_rek?></td>
          </tr>
          <tr>
            <th>Atas Nama</th>
            <td>:</td>
            <td><?= $value->atas_nama?></td>
          </tr>
          <tr>
            <th>Total Bayar</th>
            <td>:</td>
            <td><?= number_format($value->total_bayar, 0)?></td>
          </tr>
        </table>
        <img class = "img-fluid pad" src="<?= base_url('assets/bukti_bayar/'.$value->bukti_bayar)?>" alt="">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>

<?php foreach($pesanan_diproses as $blm => $value){?>
<div class="modal fade" id="kirim<?= $value->id_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= $value->no_order ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/kirim/'. $value->id_transaksi) ?>" method = "post">
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Expedisi</th>
            <th>:</th>
            <th><?= $value->expedisi?></th>
          </tr>
          <tr>
            <th>Paket</th>
            <th>:</th>
            <th><?= $value->paket?></th>
          </tr>
          <tr>
            <th>Paket</th>
            <th>:</th>
            <th>Rp. <?= number_format($value->ongkir, 0)?></th>
          </tr>
          <tr>
            <th>No Resi</th>
            <th>:</th>
            <th><input type="text" name = "no_resi" class = "form-control" required placeholder = "Masukkan No resi"></th>
          </tr>
        </table>
      </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>

