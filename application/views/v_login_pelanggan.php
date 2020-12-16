<div class="row mb-5">
  <div class="col-md-4 offset-4">
    <div class="register-box">
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
        
        <?php 
        
        echo validation_errors('<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Gagal</h5>','</div>');

        if ($this->session->flashdata('error')) {
          echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
          echo $this->session->flashdata('error');
          echo '</div>';
        }

        if ($this->session->flashdata('pesan')) {
          echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
          echo $this->session->flashdata('pesan');
          echo '</div>';
        }
        
        ?>

        <form action="<?= base_url('pelanggan/login')?>" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name = "email" placeholder="Email" value = <?= set_value('email')?>>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name = "password" class="form-control" placeholder="Password" value = <?= set_value('password')?>>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4 offset-4">
            
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
           
            <!-- /.col -->
          </div>
        </form>
        <a href="<?= base_url('pelanggan/register')?>" class="text-center">belum punya akun?</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>