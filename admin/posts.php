
<?php 
session_start();

if(!isset($_SESSION['id'])){
  header('REFRESH:.1;URL=../login.php');
}else{

  // Connection
  include('template/connection.php');
  // Header
  include('template/header.php');

  // Side Menu 
  include('template/sidemenu.php');


  ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
          <?php
                  if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $name = $_GET['name'];
                    $query = "DELETE FROM posts WHERE id='$id'";
                    $result = mysqli_query($conn, $query);
                    if (isset($result)) {
                        echo "<div class='alert alert-success text-center'>" . 'تم حذف  ( ' . $name  . " )</div>";
                    }
                    else {
                        echo "<div class='alert alert-success text-center'>" . 'عفوا حدث خطأ ما  '  . "</div>";
                    }
                  }

        ?>
        <div class="content-header row">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">المقالات</h2>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="categories.php">الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item active">المقالات
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- page users view start -->
      <section class="page-users-view">
        <div class="row">
            <div class="col-sm-12">
              <div class="card">
               
                <div class="card-content">
                  <div class="card-body">
                    <!-- Display Categories -->
                    <div class="row">
                        <div class="col-12">
                            <!-- basic buttons -->
                            <a type="button" class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light" href="new-post.php">انشاء مقال جديد</a>
                          </div>
                     </div>
                    <div class="table-responsive">
                        <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>رقم المقال</th>
                                    <th>أسم المقال</th>
                                    <th> الناشر</th>
                                    <th>الصورة</th>
                                    <th>تاريخ الاضافة</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                  $query = "SELECT * FROM posts ORDER BY id DESC";
                                  $result = mysqli_query($conn , $query);
                                  $num = 0;
                                  while( $row = mysqli_fetch_assoc($result) ){
                                    $num++;
                                ?>
                                  <tr>
                                    <td><?php echo $num;  ?></td>
                                    <td><?php echo $row['postTitle'];   ?></td>
                                    <td><?php echo $row['postAuthor'] ;  ?></td>
                                    <td><img width="70px" src="<?php echo "../upload/post/" . $row['postImage'] ;  ?>" alt=""></td>
                                    <td><?php
                                        //  echo $row['postDate'] ;  
                                        $date = date_create($row['postDate']);
                                      echo date_format($date, 'Y-m-d'); 

                                         ?></td>
                                    
                                    <td class="text-center">
                                      <a class="action-btn" href="posts.php?id=<?php  echo $row['id']; ?>">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                      </a>
                                      <a class="action-btn" href="posts.php?id=<?php  echo $row['id']; ?>&name=<?php  echo $row['postTitle']; ?>">
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
    <?php  include('template/footer.php');?>
<?php } ?>