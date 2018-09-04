<!--네비게이션바:회화-->
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
              <section class="content-row">


                                <div class="box">
                                   <ul class="nav nav-pills flex-column" style="font-weight:bolder; height:35px;">
                              			<li class="nav-item" style="display:flex; align-items: center;">
                              				<a class="nav-link " href="#"style="color:#282f3a;">작품 상세</a>
                                    <li>
                                    <ul>
                                </div>



                  <div >
                    <?php
                    if(!isset($_SESSION))
                    {
                      session_start();
                    }
                    require_once('./view/file_func.php');
                    $conn=mysqli_connect('localhost','root','123456','art_platform');//디비 접속
                    if(mysqli_connect_errno())
                    {
                      echo "Failed to connect to mysql:". mysqli_connect_errno();
                    }







                    $sql="SELECT * FROM artwork_with_stid where artwork_id='{$_GET['id']}' ";


                    $real_data = mysqli_query($conn,$sql);

                    for ($i=1; $i<=mysqli_num_rows($real_data);$i++) {

                                  $row2 = mysqli_fetch_assoc($real_data);

                                  $image_dir=".\\view\account\memberimg\\".$row2['member_stid']."\\img\\";
                                  $image_path=$image_dir.$row2['artwork_image'];
                                  echo "<div class=\"product-row\" >";
                                  echo '<img src=';
                                  echo $image_path;
                                  echo ' , alt="이미지를 등록해 주세요" ';
                                  echo 'style= "width:250px; height:250px;">';
                                  echo "<div class=\"product\">";
                                  echo "<div class=\"product-box\">";
                                  echo "<div class=\"product-description\">";
                                  echo "<description1>";
                                  echo "작품 제목: ".htmlspecialchars($row2['artwork_title']);  echo "<br/>\n";
                                  echo "작품 종류: ".htmlspecialchars($row2['artwork_kinds']);  echo "<br/>\n";
                                  echo "작품 재질: ".htmlspecialchars($row2['artwork_materials']);  echo "<br/>\n";
                                  echo "작품 크기: ".htmlspecialchars($row2['artwork_size']);  echo "<br/>\n";
                                  echo "작품 가격: ".htmlspecialchars($row2['artwork_price']);  echo "<br/>\n";
                                  echo "만든 날짜: ".htmlspecialchars($row2['artwork_workdate']);  echo "<br/>\n";
                                  echo "등록 시기: ".htmlspecialchars($row2['artwork_regTime']);  echo "<br/>\n";

                                  echo "판매 여부: ";
                                  if($row2['artwork_issold']==0){
                                    echo "안팔림";  echo "<br/>\n";
                                  }else {
                                    echo "팔림";  echo "<br/>\n";
                                  }
                                  echo "</description1>";
                                  echo "<description2>";
                                  echo "작품 설명:";
                                  echo "<br/>\n";
                                  echo htmlspecialchars($row2['artwork_description']);
                                  echo "</description2>";

                                  echo "</div>";//product-description 끝
                                  echo "</div>";//product-box 끝

                                  echo "<div class=\"buttonlayout-row\" >";
                                    //echo '<div id="button"><a href="./alter_artwork.php" class="btn btn-info " role="button" >장바구니에 담기</a></div>';
                                    echo '<form method="post" action="./view/mainpage/put_in_cart.php">';
                                    echo '<input type="hidden" name="cart_title"';
                                    echo ' value="';
                                    echo $row2['artwork_title'];
                                    echo '">';
                                    echo '<div id="button"><button type="submit" class="btn btn-info ">장바구니에 담기</button></div>';
                                    echo '</form>';
                                    echo '<form method="post" action="want_further.php">';
                                    echo '<input type="hidden" name="seller_id"';
                                    echo ' value="';
                                    echo $row2['seller_id'];
                                    echo '">';
                                   echo '<div id="button"><button type="submit" class="btn btn-info ">해당 판매자의 작품 더보기</button></div>';
                                    echo '</form>';
                                  echo "</div>";
                                  echo "</div>";
                                  echo "</div>";
                                    $sql="UPDATE artwork SET artwork_hit=artwork_hit+1  where artwork_id='{$_GET['id']}' ";
                                    mysqli_query($conn,$sql);

                                if ($row2== false) {
                                    echo "작품 불러오기 실패";
                                }
                              }
                              ?>


            </main>

        </section>

      </div>
      <div >
        <?php
          require('./include/bottom.php');
        ?>
    </div>
</body>
</html>
