<!--판매자 작품정보 더보기페이지-->
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
            <?php require('./include/main_banner_left.php');?>
          </div>

          <main>
              <section class="content-row">
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
                                      $sql = "SELECT * FROM member where member_id='{$_POST['seller_id']}'";
                                      $result=mysqli_query($conn,$sql);
                                      $num= mysqli_num_rows($result);//상품 총 갯수 num에 저장
                                      $row = mysqli_fetch_assoc($result);
                                       ?>

                                <div class="box">
                                   <ul class="nav nav-pills flex-column" style="font-weight:bolder; height:35px;">
                              			<li class="nav-item" style="display:flex; align-items: center;">
                              				<a class="nav-link " href="#"style="color:#282f3a;">판매자 <?=$row['member_username']?>님의 작품</a>
                                    <li>
                                    <ul>
                                </div>
                                <div id="align_right">
                                  <a href='<?="http://localhost/HI_ART/view/navbar/artwork_kinds.php"?>?<?php  $ordertype='asc';?>&ordertype=<?='asc' ?>'>[낮은 가격순]</a>
                                  <a href='<?="http://localhost/HI_ART/view/navbar/artwork_kinds.php"?>?<?php  $ordertype='desc';?>&ordertype=<?='desc' ?>'>[높은 가격순]</a>

                                </div>
                                <contentbox>


                    <?php


                    if(isset($_GET['page']))
                    {
                      $page = ($_GET['page']);
                    }
                    else {
                      $page=1;
                    }
                    if(isset($_GET['ordertype']))
                    {
                      $ordertype = ($_GET['ordertype']);
                    }
                    else {
                      $ordertype='asc';
                      $_GET['ordertype']='asc';
                    }


                    $list = 8;

                    $block = ceil($page/5);
                    $total_page = ceil($num/$list); // 총 페이지
                    $blockNum = ceil($total_page/$block); // 총 블록
                    $nowBlock = ceil($page/$block);

                    //$s_page = ($nowBlock * $block) - 2;
                    $s_page=( ($block - 1) *5) + 1;
                    if ($s_page <= 1) {
                        $s_page = 1;
                    }
                    $e_page = $s_page+5-1;
                    if ($total_page <= $e_page) {
                        $e_page = $total_page;
                    }


                    //$row1 = mysqli_fetch_assoc($result);
                    /*
                    echo "현재 페이지는".$page."<br/>";
                    echo "현재 블록은".$nowBlock."<br/>";

                    echo "현재 블록의 시작 페이지는".$s_page."<br/>";
                    echo "현재 블록의 끝 페이지는".$e_page."<br/>";

                    echo "총 페이지는".$total_page."<br/>";
                    echo "총 블록은".$blockNum."<br/>";
                    */

                    $s_point = ($page-1) * $list;
                    if($_GET['ordertype']=="asc")
                    {
                    $sql="SELECT * FROM artwork_with_stid where seller_id='{$_POST['seller_id']}' ORDER BY artwork_price ASC LIMIT $s_point,$list";
                    }
                    else
                    {
                        $sql="SELECT * FROM artwork_with_stid where seller_id='{$_POST['seller_id']}' ORDER BY artwork_price DESC LIMIT $s_point,$list";
                    }
                    $real_data = mysqli_query($conn,$sql);

                    for ($i=1; $i<=mysqli_num_rows($real_data);$i++) {

                                  $row2 = mysqli_fetch_assoc($real_data);

                                  $image_dir=".\\view\account\memberimg\\".$row2['member_stid']."\\img\\";
                                  $image_path=$image_dir.$row2['artwork_image'];
                                    echo "<div class=\"product3\"><a href=artwork_detail.php?id=";
                                    echo $row2['artwork_id'];
                                    echo '>';
                                  echo '<img src=';
                                  echo $image_path;
                                  echo ' , alt="이미지를 등록해 주세요" ';
                                  echo '></a>';

                                  echo "<div class=\"product-box\">";

                                  echo "<div class=\"des\">";
                                  echo htmlspecialchars($row2['artwork_title']);  echo "<br/>\n";
                                  echo "₩".htmlspecialchars($row2['artwork_price']);  echo "<br/>\n";
                                 echo "</div>";
                                 echo "</div>";
                                  echo "</div>";//product-box 끝





                                if ($row2== false) {
                                    echo "작품 불러오기 실패";
                                }
                              }
                              ?>
                            </contentbox>
                              <div id="page">
                              <div class="pagination">
                                <?php
                                for ($p=$s_page; $p<=$e_page; $p++) {
                                ?>

                                    <a href="<?="http://localhost/HI_ART/view/navbar/artwork_kinds.php"?>?&page=<?=$p?>"><?=$p?></a>

                                <?php
                                }
                                ?>
                              </div>
                            </div>

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
