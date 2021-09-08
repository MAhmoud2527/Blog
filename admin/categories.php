<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('REFRESH:.1;URL=../login.php');
} else {

  // Connection
  include('template/connection.php');
  // Header
  include('template/header.php');

  // Side Menu 
  include('template/sidemenu.php');
  $categoryName = '';

  $errors = array('error' => '');
  $sucess = array('secess' => '');

  if (isset($_POST['add'])) {
    $categoryName = $_POST['name'];
    if (empty($categoryName)) {
      $errors['error'] = 'حقل التصنيف فارغ';
    } else {
      $query = "INSERT INTO categories(categoryName) VALUES('$categoryName')";
      mysqli_query($conn, $query);
      $sucess['secess'] =  "تم أضافة ( " . $categoryName . " ) بنجاح";
      $categoryName = '';
    }
  }

?>




  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-wrapper">
      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $_GET['categoryName'];
        $query = "DELETE FROM categories WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if (isset($result)) {
          echo "<div class='alert alert-success text-center'>" . 'تم حذف  ( ' . $name  . " )</div>";
        } else {
          echo "<div class='alert alert-success text-center'>" . 'عفوا حدث خطأ ما  '  . "</div>";
        }
      }
      ?>
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">التصنيفات</h2>
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="categories.php">الرئيسية</a>
                  </li>
                  <li class="breadcrumb-item active">اضافة تصنيف جديد
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">أضافة تصنيف جديد</h4>
                </div>

                <div class="card-content">
                  <div class="card-body">

                    <!-- Rander Code Here -->
                    <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              <input type="text" accept-charset="utf-8" class="form-control" placeholder="أسم التصنيف" name="name" value="<?php echo $categoryName ?>">
                              <label for="first-name-column">أسم التصنيف</label>
                              <div class="text-danger" role="alert">
                                <?php echo $errors['error'] ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <button class="btn btn-primary mr-1 mb-1 waves-effect waves-light" name="add">حفظ</button>
                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">إعادة تعيين</button>
                          </div>
                          <div class="col-12">
                            <div class="text-center" role="alert" style="margin: 0 20px; padding: 10px 0;color: #28C76F">
                              <?php echo  $sucess['secess'] ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>


                    <!-- Display Categories -->
                    <div class="table-responsive">
                      <table class="table zero-configuration">
                        <thead>
                          <tr>
                            <th>رقم الفئة</th>
                            <th>أسم الفئة</th>
                            <th>تاريخ الاضافة</th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM categories ORDER BY id DESC";
                          $result = mysqli_query($conn, $query);
                          $num = 0;
                          while ($row = mysqli_fetch_assoc($result)) {
                            $num++;
                          ?>
                            <tr>
                              <td><?php echo $num;  ?></td>
                              <td><?php echo $row['categoryName'];   ?></td>
                              <td><?php
                                  // echo $row['categoryDate'] ; 
                                  $date = date_create($row['categoryDate']);
                                  echo date_format($date, 'Y-m-d');

                                  ?></td>
                              <td class="text-center">
                                <a class="action-btn" href="categories.php?id=<?php echo $row['id']; ?>">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a class="action-btn" href="categories.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['categoryName']; ?>">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                              </td>
                            </tr>

                          <?php  }  ?>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>


          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- END: Content-->



  <!-- Footer -->
  <?php include('template/footer.php'); ?>

<?php } ?>