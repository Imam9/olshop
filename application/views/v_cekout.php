  <!-- Main content -->
  <div class="invoice p-3 mb-3">
              <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fas fa-shopping-cart"></i> Cekout
        <small class="float-right">Date: 2/10/2014</small>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong>Admin, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (804) 123-5432<br>
        Email: info@almasaeedstudio.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <!-- To
      <address>
        <strong>John Doe</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (555) 539-1037<br>
        Email: john.doe@example.com
      </address> -->
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Invoice #007612</b><br>
      <br>
      <b>Order ID:</b> 4F3S8J<br>
      <b>Payment Due:</b> 2/22/2014<br>
      <b>Account:</b> 968-34567
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead >
        <tr>
          <th class = "text-center">No</th>
          <th class = "text-center">Barang</th>
          <th class = "text-center">Qty</th>
          <th class = "text-right">Harga</th>
          <th class = "text-right">Total Harga</th>
          <th class = "text-right">Berat</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; $total = 0;?>
          <?php foreach ($this->cart->contents() as $items){ 
          $barang = $this->m_home->detail_barang($items['id']);
          $berat = $items['qty'] * $barang->berat;
          $total += $berat;
          ?>
        <tr>
        <td class = "text-center"><?= $i++?></td>
        <td class = "text-center"><?php echo $items['name']; ?></td>
        <td class = "text-center"><?php echo $items['qty']; ?></td>
        <td style="text-align:right"><?php echo number_format($items['price'], 0); ?></td>
        <td style="text-align:right">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
        <td style="text-align:right"><?= $berat?> Gram</td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-7 invoice-col">
        Tujuan : 
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Provinsi</label>
                  <select name="provinsi" id="" class="form-control">
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <select name="kota" id="" class="form-control">
                </select>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Expedisi</label>
                  <select name="expedisi" id="" class="form-control">
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Paket</label>
                <select name="paket" id="" class="form-control">
                </select>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
                  <input type="text" name = "alamat" class = "form-control">
              </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-5">
      <p class="lead">Jumlah Total</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td class="text-right"><strong>Rp. <?php echo number_format($this->cart->total(), 0); ?></strong></td>
          </tr>
          <tr>
            <th>Total Berat</th>
            <th class="text-right"><?= $total?> Gram</th>
          </tr>
          <tr>
            <th>Ongkir</th>
            <td class="text-right"><label id="ongkir"></label></td>
          </tr>
          <tr>
            <th>Total Bayar:</th>
            <td class="text-right"><label id="total_bayar"></label></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="<?= base_url('belanja')?>" class="btn btn-default"><i class="fas fa-backward"></i> Kembali</a>
      <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
        Proses Checkout
      </button>
      <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
        <i class="fas fa-download"></i> Generate PDF
      </button> -->
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
    $("select[name=kota]").on("change", function(){
      $.ajax({
        type : "POST",
        url : "<?= base_url('rajaongkir/expedisi')?>",
        success : function(hasil_expedisi){
          // console.log(hasil_kota);
          $("select[name=expedisi]").html(hasil_expedisi);
        }
      });
    });
    $("select[name=expedisi]").on("change", function(){
     var expedisi_terpilih = $("select[name=expedisi]").val();
     var id_kota_tujuan = $("option:selected", "select[name=kota]").attr("id_kota");
     var total_berat = <?= $total?>;
    //  alert(total_berat);
      $.ajax({
        type : "POST",
        url : "<?= base_url('rajaongkir/paket')?>",
        data : 'expedisi=' + expedisi_terpilih + '&id_kota='+ id_kota_tujuan + '&berat='+ total_berat,
        success : function(hasil_paket){
          //  console.log(hasil_paket);
            $("select[name=paket]").html(hasil_paket);
        }
      });
    });

    $("select[name=paket]").on("change", function(){
      //menampilkan ongkir
      var data_ongkir = $("option:selected", this).attr('ongkir');
      var	reverse = data_ongkir.toString().split('').reverse().join(''),
          data_ongkir	= reverse.match(/\d{1,3}/g);
          dt_ongkir	= data_ongkir.join('.').split('').reverse().join('');

      $("#ongkir").html("Rp. " +dt_ongkir);
      //menghitung total bayar
      var ongkir = $("option:selected", this).attr('ongkir');
      var total_bayar = parseInt(ongkir) + parseInt(<?= $this->cart->total() ?>);
      var	reverse = total_bayar.toString().split('').reverse().join(''),
          total_bayar_format = reverse.match(/\d{1,3}/g);
          ttl_bayar	= total_bayar_format.join('.').split('').reverse().join('');

      $("#total_bayar").html("Rp. "+ttl_bayar);
    });
  });
</script>