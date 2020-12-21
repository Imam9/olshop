<div class="row">
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
                    <?php $no =1; foreach($belum_bayar as $blm => $value){?>
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
                      <?php if($value->status_bayar == '0') { ?>
                        <a href="<?= base_url('pesanan_saya/bayar/'.$value->id_transaksi)?>" class = "btn btn-sm btn-success btn-flat">Bayar</a>
                      <?php }else{?>
                        <a href="#" class = "badge badge-info badge-lg">Sudah Bayar</a>
                        <?php }?>
                      </td>
                    </tbody>
                    <?php } ?>
                   </table>
                </div>
               </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
              <table class="table table-hover">
              <thead>
                <th>No</th>
                <th>No Order</th>
                <th>Tanggal </th>
                <th>Expedisi</th>
                <th>Total Bayar</th>
              </thead>
              <?php $no =1; foreach($diproses as $blm => $value){?>
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
                    <span class="badge badge-info">Tereverifikasi</span><br>
                    <span class="badge badge-success">Dikemas / Dikirim</span>
                </td>  
              </tbody>
              <?php } ?>
              </table>
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
                <?php $no =1; foreach($dikirim as $blm => $value){?>
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
                    <h5><?= $value->no_resi?></h5>
                    <button class = "btn btn-sm btn-success" data-toggle="modal" data-target="#diterima<?= $value->id_transaksi ?>"> Diterima</button>
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
                  <?php $no =1; foreach($selesai as $blm => $value){?>
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
                        <span class="badge badge-success">Selesai</span>
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
  </div>
</div>

<?php foreach($dikirim as $blm => $value){?>
<div class="modal fade" id="diterima<?= $value->id_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pesanan Diterima</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <h5>Apakah anda yakin pesanan diterima??</h5>
      </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href = "<?= base_url('pesanan_saya/diterima/'.$value->id_transaksi)?>" class="btn btn-primary">iyaaa</a>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
