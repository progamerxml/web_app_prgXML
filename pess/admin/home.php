<h1 class="">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<style>
  #cover_img_dash{
    width:100%;
    max-height:50vh;
    object-fit:cover;
    object-position:bottom center;
  }
</style>
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Department</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM department_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Positions</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM position_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Employees</span>
                <span class="info-box-number">
                  <?php 
                    $mechanics = $conn->query("SELECT sum(id) as total FROM `employee_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($mechanics);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-money-check-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payroll</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT sum(id) as total FROM `payroll_list` ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <hr>
    <div class="text-center">
      <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover" class="w-100 img-fluid img-thumnail border" id="cover_img_dash">
    </div>
