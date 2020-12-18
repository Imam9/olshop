<div class="card card-solid">
  <div class="card-body pb-0">
      <div class="row">
        <div class="col-md-12">
        <?php 
          if($this->session->flashdata('pesan')){
            echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>';
            echo $this->session->flashdata('pesan');
            echo '</h5></div>';
          }
      
      ?>
          <?php echo form_open('belanja/update'); ?>
          <table class = "table table-hover " width = "100%">
            <thead>
              <tr>
                <th width = "90px">Jumlah Barang</th>
                <th class = "text-center">Nama Barang</th>
                <th style="text-align:right">Harga</th>
                <th style="text-align:right">Sub Total</th>
                <th style="text-align:right">Berat Barang</th>
                <th style="text-align:center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; $total = 0;?>
              <?php foreach ($this->cart->contents() as $items): 
                  $barang = $this->m_home->detail_barang($items['id']);
                  $berat = $items['qty'] * $barang->berat;
                  $total += $berat 
                ?>
                <tr>
                  <td><?php echo form_input(array(
                    'name' => $i.'[qty]', 
                    'value' => $items['qty'], 
                    'maxlength' => '3',
                    'min' => '0',  
                    'size' => '5', 
                    'type' => 'number' , 
                    'class' => 'form-control')); ?></td>
                  <td class = "text-center"><?php echo $items['name']; ?></td>
                  <td style="text-align:right"><?php echo number_format($items['price'], 0); ?></td>
                  <td style="text-align:right">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
                  <td style="text-align:right"><?= $berat?> Gram</td>
                  <td class = "text-center"><a href="<?= base_url('belanja/delete/'.$items['rowid'])?>" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></a></td>
                </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>    
                <td colspan="2"> </td>
                <td class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp. <?php echo number_format($this->cart->total(), 0); ?></strong></td>
                <th class="text-right"><?= $total?> Gram</th>
                <td></td>
              </tr>
            </tfoot>
        
          </table>
          <div class="row">
            <div class="col-md-8">
              <button type = "submit" class = "btn btn-sm btn-warning mb-3"><i class="fa fa-edit"></i> Update Keranjang</button>
              <a href = "<?= base_url('belanja/clear')?>" class = "btn btn-sm btn-danger mb-3"><i class="fa fa-recycle"></i> Clear Keranjang</a>
              <a href = "<?= base_url('belanja/cekout')?>" class = "btn btn-sm btn-info mb-3"><i class="fa fa-save"></i> Check Out</a>
            </div>
            <?php echo form_close();?>         
          </div>
        </div>
      </div>
  </div>
</div>