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

//접속한 놈의 member_id부터 알아낸다.
//db artwork 테이블에 등록한 사람을 seller_id에 그 인간의 member_id로 저장해놔서 알아내야됨
$sql = "SELECT * FROM member where member_username='{$_SESSION['member_username']}'";


if(mysqli_query($conn,$sql))

$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
//print_r($row); 확인용 출력
$user_id=$row['member_id'];//seller_id 변수에  등록한 놈의 member_id를 저장
//echo $seller_id;
//seller_id를 알아 냈으니깐 그 seller_id로 등록된 작품이 있는지 뭔지 꺼내와야함
$sql = "SELECT * FROM cart where like_user='{$user_id}'";
$result=mysqli_query($conn,$sql);
$num= mysqli_num_rows($result);//상품 총 갯수

if(isset($_GET['page']))
                    {
                      $page = ($_GET['page']);
                    }
                    else {
                      $page=1;
                    }

                    $list = 5;

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

$sql = "SELECT * FROM cart where like_user='{$user_id}' LIMIT $s_point,$list";
$result=mysqli_query($conn,$sql);
//$row1 = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) >0)
{//

    while($row2 = mysqli_fetch_assoc($result))
    {

      $like_title = $row2['artwork_title'];
      $sql = "SELECT * FROM artwork_with_stid where artwork_title='{$like_title}'";

      $result2=mysqli_query($conn,$sql);
      $row3 = mysqli_fetch_assoc($result2);
      $image_dir="..\account\memberimg\\".$row3['member_stid']."\\img\\";
      $image_path=$image_dir.$row3['artwork_image'];
      echo "<div class=\"product-row\" >";
      echo '<img src=';
      echo $image_path;
      echo ' , alt="이미지를 등록해 주세요" ';
      echo 'style= "width:250px; height:250px;">';
      echo "<div class=\"product\">";
      echo "<div class=\"product-box\">";
      echo "<div class=\"product-description\">";
      echo "<description1>";
      echo "작품 제목: ".$row3['artwork_title'];  echo "<br/>\n";
      echo "작품 종류: ".$row3['artwork_kinds'];  echo "<br/>\n";
      echo "작품 재질: ".$row3['artwork_materials'];  echo "<br/>\n";
      echo "작품 크기: ".$row3['artwork_size'];  echo "<br/>\n";
      echo "작품 가격: ".$row3['artwork_price'];  echo "<br/>\n";
      echo "만든 날짜: ".$row3['artwork_workdate'];  echo "<br/>\n";
      echo "등록 시기: ".$row3['artwork_regTime'];  echo "<br/>\n";

      echo "판매 여부: ";
      if($row3['artwork_issold']==0){
        echo "안팔림";  echo "<br/>\n";
      }else {
        echo "팔림";  echo "<br/>\n";
      }
      echo "</description1>";
      echo "<description2>";
      echo "작품 설명:";
      echo "<br/>\n";
      echo $row3['artwork_description'];
      echo "</description2>";

      echo "</div>";//product-description 끝
      echo "</div>";//product-box 끝

      echo "<div class=\"buttonlayout-row\" >";
        //echo '<div id="button"><a href="./alter_artwork.php" class="btn btn-info " role="button" >작품 수정하기</a></div>';


        echo '<form method="post" action="delete_cart_db.php">';
        echo '<input type="hidden" name="delete_title"';
        echo ' value="';
        echo $row2['artwork_title'];
        echo '">';
        echo '<div id="button"><button type="submit" class="btn btn-info ">장바구니에서 제거</button></div>';
        echo '</form>';
      echo "</div>";
      echo "</div>";
      echo "</div>";

    }
}else{
  echo "<p>등록한 작품이 없습니다.</p>";  echo "<br/>\n";
}
?>
<div id="page">
              <div class="pagination">
                <?php
                                for ($p=$s_page; $p<=$e_page; $p++) {
                                ?>

                                    <a href="<?="http://localhost/HI_ART/view/mypage/cart.php"?>?page=<?=$p?>"><?=$p?></a>

                                <?php
                                }
                                ?>
              </div>
            </div>
