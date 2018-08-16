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


if(mysqli_query($conn,$sql))

$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
//print_r($row); 확인용 출력
$seller_id=$row['member_id'];//seller_id 변수에  등록한 놈의 member_id를 저장
//echo $seller_id;
//seller_id를 알아 냈으니깐 그 seller_id로 등록된 작품이 있는지 뭔지 꺼내와야함
$sql = "SELECT * FROM artwork ";
$result=mysqli_query($conn,$sql);
//$row1 = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) >0)
{
    while($row2 = mysqli_fetch_assoc($result))
    {
      $image_dir="..\..\artwork_img\\";
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
      echo "작품 제목: ".$row2['artwork_title'];  echo "<br/>\n";
      echo "작품 종류: ".$row2['artwork_kinds'];  echo "<br/>\n";
      echo "작품 재질: ".$row2['artwork_materials'];  echo "<br/>\n";
      echo "작품 크기: ".$row2['artwork_size'];  echo "<br/>\n";
      echo "작품 가격: ".$row2['artwork_price'];  echo "<br/>\n";
      echo "만든 날짜: ".$row2['artwork_workdate'];  echo "<br/>\n";
      echo "등록 시기: ".$row2['artwork_regTime'];  echo "<br/>\n";

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
      echo $row2['artwork_description'];
      echo "</description2>";

      echo "</div>";//product-description 끝
      echo "</div>";//product-box 끝

      echo "<div class=\"buttonlayout-row\" >";
        //echo '<div id="button"><a href="./alter_artwork.php" class="btn btn-info " role="button" >작품 수정하기</a></div>';


        echo '<form method="post" action="put_in_cart.php">';
        echo '<input type="hidden" name="cart_title"';
        echo ' value="';
        echo $row2['artwork_title'];
        echo '">';
        echo '<div id="button"><button type="submit" class="btn btn-info ">장바구니에 넣기</button></div>';
        echo '</form>';
      echo "</div>";
      echo "</div>";
      echo "</div>";

    }
}else{
  echo "<p>등록한 작품이 없습니다.</p>";  echo "<br/>\n";
}
mysqli_close($conn);
?>