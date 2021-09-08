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

  ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <?php

        $pTitle = $pCat = $pImg = '';
        $pAuthor = "محمود أحمد";
        $errors = array('title' => '', 'cat' => '', 'image' => '', 'content' => '');

        if (isset($_POST['add'])) {

          $pTitle = $_POST['postTitle'];
          $pCat = $_POST['postCat'];
          $pContent = $_POST['postContent'];
          // Image Array
          $imageName = $_FILES['postImage']['name'];
          $imageTemp_Name = $_FILES['postImage']['tmp_name'];
          $upload_folder = "../upload/post/";

          if (empty($pTitle)) {
            $errors['title'] =  "عنوان المقال فارغ";
          } elseif (empty($pContent)) {
            $errors['content'] =  "محتوي المقال فارغ";
          } else {
            $postImage = $imageName;
            $moveFile = move_uploaded_file($imageTemp_Name, $upload_folder . $postImage);

            $query = "INSERT INTO posts( postTitle , postCat , postImage , postContent , postAuthor) VALUES(' $pTitle' , '$pCat' , '$postImage', '$pContent' , '$pAuthor')";

            $res = mysqli_query($conn, $query);

            if (isset($res)) {
              echo '<div class="alert alert-success text-center">' . ' تم أضافة المنشور بنجاح ' . '</div>';
              header("Location: posts.php");
            } else {
              echo '<div class="alert alert-danger text-center">' . 'يوجد خطا ما' . '</div>';
            }
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
                    <li class="breadcrumb-item active">اضافة مقالة جديدة
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
                    <h4 class="card-title">أضافة مقالة جديدة </h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">

                      <!-- Rander Code Here -->
                      <form class="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-12 col-12">
                              <div class="form-label-group">
                                <input type="text" id="first-name-column" class="form-control" placeholder="عنوان المقال" name="postTitle" value="<?php echo $pTitle  ?>">
                                <label for="first-name-column">عنوان المقال</label>
                                <div class="text-danger" role="alert">
                                  <?php echo $errors['title'] ?>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group" data-select2-id="175">
                                <select class="select2-theme form-control select2-hidden-accessible" name="postCat" id="select2-theme" data-select2-id="select2-theme" tabindex="-1" aria-hidden="true">
                                  <option>
                                    تصنيف المقال
                                  </option>
                                  <?php
                                  $query = "SELECT * FROM categories ORDER BY id DESC";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {

                                  ?>
                                    <option>
                                      <?php echo  $row['categoryName']; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <fieldset class="form-group">
                                <!-- <label for="basicInputFile">رفع ملف</label> -->
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile01" name="postImage">
                                  <label class="custom-file-label" for="inputGroupFile01">اختار صورة المقال</label>
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-12">
                              <fieldset class="form-label-group mb-0">
                                <textarea data-length="5000" name="postContent" class="form-control char-textarea active" id="textarea-counter" rows="3" placeholder="نص المقال" style="color: rgb(78, 81, 84);"></textarea>
                                <label for="textarea-counter">نص المقال</label>
                                <div class="text-danger" role="alert">
                                  <?php echo $errors['content'] ?>
                                </div>
                              </fieldset>
                              <small class="counter-value float-right" style="background-color: rgb(115, 103, 240);"><span class="char-count">0</span> / 5000 </small>
                            </div>
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" name="add">نشر المقال</button>
                              <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">إعادة تعيين</button>
                            </div>
                          </div>
                        </div>
                      </form>

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