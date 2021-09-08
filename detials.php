<!-- Header -->
    <?php
          // Connection
          include('admin/template/connection.php');
          //  Header
          include('template/header.php'); 
          if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM posts WHERE  id='$id' ";
            $result = mysqli_query($conn , $query);
            $row = mysqli_fetch_assoc($result);
          }
    ?>
        <section class="section lb m3rem">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area">
                                <span class="color-yellow">
                                    <a href="" title="">
                                    <i class="fa fa-tags"></i>
                                        <?php echo $row['postCat']; ?>
                                    </a>
                                </span>

                                <h3><?php echo $row['postTitle']; ?></h3>

                                <div class="blog-meta big-meta">
                                <small><span title="">
                                    <i class="fa fa-user"></i>
                                    <?php echo $row['postAuthor']; ?></span></small>
                                    <small><span title="">
                                    <i class="fa fa-calendar-o"></i>
                                    <?php $date = date_create($row['postDate']);
                                            echo date_format($date, 'Y-m-d'); ?>
                                    </span></small>
                                </div><!-- end meta -->

                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="upload/post/<?php echo $row['postImage']; ?>" alt="" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                                    <p><?php echo $row['postContent']; ?></p>
                                </div><!-- end pp -->
                            </div><!-- end content -->
                            <hr>
                            <div class="blog-title-area">
                               
                            <div class="post-sharing text-center">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">فيسبوك</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">تويتر</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i> <span class="down-mobile"> جوجل بلس  </span></a></li>
                                    </ul>
                                </div>
                            </div><!-- end title -->

                          

                            
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="sidebar">
                    <div class="widget">
                            <h2 class="widget-title"><i class="fa fa-tags"></i>
                                التصنيفات</h2>
                            <div class="link-widget">
                            <?php
                                  $query = "SELECT * FROM categories ORDER BY id DESC";
                                  $result = mysqli_query($conn , $query);
                                  $row_num = mysqli_num_rows($result); 
                                  while( $row = mysqli_fetch_assoc($result) ){
                                   
                                ?>
                                <ul>
                                    <li>
                                        <a href="category.php?category=<?php echo $row['categoryName'];?>">
                                           <?php echo $row['categoryName'];?>
                                        <span>(<?php echo $row_num;?>)</span>
                                    </a>
                                </li>
                                <?php  }  ?>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                        <div class="widget">
                        <h2 class="widget-title"><i class="fa fa-flag"></i>    أحدث المنشورات</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                <?php
                                  $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 6";
                                  $result = mysqli_query($conn , $query);
                                  while( $row = mysqli_fetch_assoc($result) ){
                                   
                                ?>
                                    <a href="detials.php?id=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="<?php echo "upload/post/" . $row['postImage'] ;  ?>" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1"><?php echo $row['postTitle'] ?></h5>
                                            <small><?php echo $row['postAuthor'] ?></small>
                                        </div>
                                    </a>
                                    <?php  }  ?>
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->

                        
                    </div><!-- end sidebar -->
                </div><!-- end col -->
                

                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <!-- Footer -->
        <?php include('template/footer.php'); ?>
       
        

