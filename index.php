<!doctype>
<html>
<head>
    <?php
    require('./include/head.php');
   ?>
</head>

<body style="height:1500px">

  <?php
    require('./include/header.php');
  ?>
  <navbar >
    <?php
      require('./include/navbar.php');
    ?>

  </navbar>


<div class="container">

  <section class="content" >
    <div  id="banner-left">
       <?php require('./include/main_banner_left.php'); ?>
      </div>
    <main>
      <div class="flexbox-row">
      <main-img>
      <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
          <div class="carousel-item active" style="width:660px; height:400px;">
            <img src="./image/20160101_153946.jpg" alt="" width="650px" height="400px">
            <div class="carousel-caption">
              <h3></h3>
              <p></p>
            </div>
          </div>
          <div class="carousel-item" style="width:660px; height:400px; ">
            <img src="./image/badam_07.jpg" alt="Chicago" width="650px" height="400px">
            <div class="carousel-caption">
              <h3></h3>
              <p></p>
            </div>
          </div>
          <div class="carousel-item"style="width:660px; height:400px;">
            <img src="./image/PabloFuentesGomez_EX-_01.jpg?raw=true" alt="New York" width="650px" height="400px">
            <div class="carousel-caption">
              <h3></h3>
              <p></p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </main-img>
      <aside>
        <ul class="nav nav-pills flex-column" style="font-weight:bolder;">
          <li class="nav-item">
            <a class="nav-link " href="#"style="color:#282f3a;">이번주 전시정보</a>
            <div>
                <?php
                    if(!isset($_SESSION))
                    {
                      session_start();
                    }
                    $conn=mysqli_connect('localhost','root','123456','art_platform');//디비 접속
                    if(mysqli_connect_errno())
                    {
                      echo "Failed to connect to mysql:". mysqli_connect_errno();
                    }

                    //전시정보 테이블에서 가져오는 쿼리문 작성
                    $sql = "SELECT * FROM exhibition WHERE exhibit_sdate <= date(now()) AND exhibit_edate >= date(now()) LIMIT 1";
                    $result=mysqli_query($conn,$sql);
                    $row2 = mysqli_fetch_assoc($result);
                    $image_dir=".\show_img\\";
                    $image_path=$image_dir.$row2['exhibit_image'];

                    echo '<img src=';
                    echo $image_path;
                    echo ' , alt="이미지를 불러올 수 없습니다" ';
                    echo 'style= "width:320px; height:357px;">';
                ?>
            </div>
          </li>
        </ul>
      </aside>
    </div>
  </section>
  <section class="content-row">

    <div class="box">
      <ul class="nav nav-pills flex-column" style="font-weight:bolder; height:35px;">
            <li class="nav-item" style="display:flex; align-items: center;">
               <a class="nav-link "  href="./view/mainpage/all_art.php" style="color:#282f3a;">새로 등록된 작품</a>
        </li>
        <li>

</li>
      </ul>
    </div>

    <div class="wrap">
    <div class="content">

    <?php
                  // 테이블에서 새로등록된 작품 가져오는 쿼리문 작성
                    $sql = "SELECT * FROM artwork_with_stid ORDER BY artwork_id DESC LIMIT 6";
                    $result=mysqli_query($conn,$sql);
                    while($row2 = mysqli_fetch_assoc($result)){
                    $image_dir=".\\view\account\memberimg\\".$row2['member_stid']."\\img\\";
                    $image_path=$image_dir.$row2['artwork_image'];

                    echo '<div class="product"><a href=./artwork_detail.php?id=';
                    echo $row2['artwork_id'];
                    echo '>';
                    echo '<img src=';
                    echo $image_path;
                    echo ' , alt="이미지를 불러올 수 없습니다" ';
                    echo 'style="height:250px;"></a>';
                    echo '<div class="box-row">';
                    echo '<h6 style="display:block;float:left;">';
                    echo $row2['artwork_title'];
                    echo '</h6>';
                    echo '<p style="display:block; float:right;">₩ ';
                    echo $row2['artwork_price'];
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
      }
      ?>
    </div>
    </div>
  </section>
  <section class="content-row">

    <div class="box">
      <ul class="nav nav-pills flex-column" style="font-weight:bolder; height:35px;">
            <li class="nav-item" style="display:flex; align-items: center;">
               <a class="nav-link " href="#"style="color:#282f3a;">사람들이 많이 본 작품</a>
        </li>
      </ul>
    </div>
    <div class="wrap">
    <div class="content">

    <?php
                  // 테이블에서 새로등록된 작품 가져오는 쿼리문 작성
                    $sql = "SELECT * FROM artwork_with_stid ORDER BY artwork_hit DESC LIMIT 6";
                    $result=mysqli_query($conn,$sql);
                    while($row2 = mysqli_fetch_assoc($result)){
                    $image_dir=".\\view\account\memberimg\\".$row2['member_stid']."\\img\\";
                    $image_path=$image_dir.$row2['artwork_image'];

                    echo '<div class="product"><a href=./artwork_detail.php?id=';
                    echo $row2['artwork_id'];
                    echo '>';
                    echo '<img src=';
                    echo $image_path;
                    echo ' , alt="이미지를 불러올 수 없습니다" ';
                    echo 'style="height:250px;"></a>';
                    echo '<div class="box-row">';
                    echo '<h6 style="display:block;float:left;">';
                    echo $row2['artwork_title'];
                    echo '</h6>';
                    echo '<p style="display:block; float:right;">₩ ';
                    echo $row2['artwork_price'];
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
      }
      ?>
    </div>
    </div>
  </section>
</div>
<div >
  <?php require('./include/bottom.php'); ?>
</div>
</body>
</html>
