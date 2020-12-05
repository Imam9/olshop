<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data Kategori</h3>

      <div class="card-tools">
        <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm"><i class="fas fa-plus" ></i>Add</button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <?php 
      if($this->session->flashdata('pesan')){
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('pesan');
        echo '</h5></div>';
      }
      
      ?>
      <table class = "table table-bordered" id = "example1">
        <thead class = "text-center">
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach($kategori as $key => $value){ ?>
          <tr class = "text-center">
            <td><?= $no++?></td>
            <td><?= $value->nama_kategori ?></td>
            <td>
              <button data-toggle="modal" data-target="#edit<?=$value->id_kategori?>" class = "btn btn-warning btn-sm"><i class ="fas fa-edit"></i></button>
              <button data-toggle="modal" data-target="#delete<?=$value->id_kategori?>" class = "btn btn-danger btn-sm"><i class ="fas fa-trash"></i></button>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('kategori/add')?>" method = "POST">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name = "nama_kategori" placeholder="Nama Kategori" required>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
        
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php $no = 1; foreach($kategori as $key => $value){ ?>
<div class="modal fade" id="edit<?=$value->id_kategori?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('kategori/edit/'.$value->id_kategori)?>" method = "POST">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" value = "<?= $value->nama_kategori?>" name = "nama_kategori" placeholder="Nama User" required>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
        
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>

<?php $no = 1; foreach($kategori as $key => $value){ ?>
<div class="modal fade" id="delete<?=$value->id_kategori?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete <?= $value->nama_kategori?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Apakah Anda Ingin Menghapus Data ini?</h4>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?= base_url('kategori/delete/'.$value->id_kategori)?>" class="btn btn-primary">Delete</a>
      </div>
   
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>