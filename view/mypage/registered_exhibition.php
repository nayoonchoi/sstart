<!--마이페이지:등록한 작품-->
<!doctype>
<html>
<head>
  <?php
    require('../../include/head.php');
   ?>
</head>

<body style="height:1500px">

  <?php
    require('../../include/header.php');
  ?>
  <navbar >
    <?php
      require('../../include/navbar.php');
    ?>

  </navbar>
  <div class="container">
        <section class="content" >
          <div  id="banner-left">
            <?php require('./banner-left.php');?>
          </div>
            <main>
              <section class="content-row">
<div class="box">
               <ul class="nav nav-pills flex-column" style="font-weight:bolder; height:35px;">
                   <li class="nav-item" style="display:flex; align-items: center;">
                      <a class="nav-link " href="#"style="color:#282f3a;">등록된 전시 정보</a>
                <li>
                <ul>
            </div>

                  <div >
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
                    $sql = "SELECT * FROM exhibition where exhibit_adminid = '{$_SESSION['member_username']}'";

                    //쿼리실행
                    $result=mysqli_query($conn,$sql);


                    if(mysqli_num_rows($result) >0)
                    {
                        while($row2 = mysqli_fetch_assoc($result))
                        {


                          $image_dir="..\..\show_img\\";
                          $image_path=$image_dir.$row2['exhibit_image'];
                          echo "<div class=\"product-row\" >";
                          echo '<img src=';
                          echo $image_path;
                          echo ' , alt="이미지를 불러올 수 없습니다" ';
                          echo 'style= "width:250px; height:250px;">';
                          echo "<div class=\"product\">";
                          echo "<div class=\"product-box\">";
                          echo "<div class=\"product-description\">";
                          echo "<description1>";
                          echo "전시 제목: ".$row2['exhibit_title'];  echo "<br/>\n";
                          echo "전시 종류: ".$row2['exhibit_kinds'];  echo "<br/>\n";
                          echo "전시 시작 일자: ".$row2['exhibit_sdate'];  echo "<br/>\n";
                          echo "전시 종료 일자: ".$row2['exhibit_edate'];  echo "<br/>\n";
                          echo "전시 장소: ".$row2['exhibit_place'];  echo "<br/>\n";
                          echo "관리자: ".$row2['exhibit_adminnick'];  echo "<br/>\n";



                          echo "</description1>";
                          echo "<description2>";
                          echo "전시회 설명:";
                          echo "<br/>\n";
                          echo $row2['exhibit_details'];
                          echo "</description2>";

                          echo "</div>";//product-description 끝
                          echo "</div>";//product-box 끝




                          echo "<div class=\"buttonlayout-row\" >";
                        //echo '<div id="button"><a href="./alter_artwork.php" class="btn btn-info " role="button" >작품 수정하기</a></div>';
                        echo '<form method="post" action="alter_exhibition.php">';
                        echo '<input type="hidden" name="want_alter"';
                       echo ' value="';
                      echo $row2['exhibit_id'];
                       echo '">';
                       echo '<div id="button"><button type="submit" class="btn btn-info ">전시회 수정하기</button></div>';
                     echo '</form>';
                     echo '<form method="post" action="delete_exhibition_db.php">';
                      echo '<input type="hidden" name="want_delete"';
                     echo ' value="';
                      echo $row2['exhibit_id'];
                      echo '">';
                       echo '<div id="button"><button type="submit" class="btn btn-info ">전시회 삭제하기</button></div>';
                       echo '</form>';
                      echo "</div>";
                    echo "</div>";
                      echo "</div>";

                          }

                    }
                    else{
                      echo "<p>등록된 전시회가 없습니다.</p>";  echo "<br/>\n";
                    }
                    mysqli_close($conn);
                    ?>





                </div>
              </section>
              <div id="page">
              <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a class="active" href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
              </div>
            </div>
            </main>

        </section>

      </div>
      <div >
        <?php
          require('../../include/bottom.php');
        ?>
    </div>
</body>
</html>
