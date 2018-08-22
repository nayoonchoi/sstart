<?php
if(!isset($_SESSION))
{
  session_start();
}
//require_once('../file_func.php');
$conn=mysqli_connect('localhost','root','123456','art_platform');//디비 접속
if(mysqli_connect_errno())
{
  echo "Failed to connect to mysql:". mysqli_connect_errno();
}
if(empty($_REQUEST['search_word'])){ // 검색어가 empty일 때 예외처리를 해준다.

$search_word ="";

}else{

$search_word =$_REQUEST['search_word'];

}



$sql = "SELECT * FROM artwork where artwork_title LIKE '%$search_word%' ";
  $rs = mysqli_query($conn,$sql);

?>
<!doctype>
<html>
<head>
    <?php
    require('./head.php');
   ?>
</head>

<body style="height:1500px">

  <?php
    require('./header.php');
  ?>
  <navbar >
    <?php
      require('./navbar.php');
    ?>

  </navbar>


  <div class="container">

    <section class="content" >
      <div  id="banner-left">
      <?php require('./main_banner_left.php'); ?>
      </div>
      <main>
<?php
if(mysqli_num_rows($rs)==0)
{
  echo "일치하는 검색 결과가 없습니다. 띄어쓰기 및 맞춤법 확인해주세요";
}
else{
  echo '<table>';

while($info = mysqli_fetch_array($rs)){

            echo '<tr>';

            echo '<th>'.$info['artwork_title']."</th>";

            echo '<td>'.$info['artwork_price']."</td>";

            echo '<td>'.$info['artwork_kinds']."</td>";

            echo '<td>'.'<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="';
            echo  htmlspecialchars($info['artwork_id']);
            echo '">Simple collapsible</button>';

            echo '</tr>';
            echo '<div id="';
            echo htmlspecialchars($info['artwork_id']);
            echo '" class="collapse show">';
            echo "<div class=\"product-description\">";
            echo "<description1>";
            echo "작품 재질: ".htmlspecialchars($info['artwork_materials']);  echo "<br/>\n";
            echo "작품 크기: ".htmlspecialchars($info['artwork_size']);  echo "<br/>\n";
            echo "만든 날짜: ".htmlspecialchars($info['artwork_workdate']);  echo "<br/>\n";
            echo "등록 시기: ".htmlspecialchars($info['artwork_regTime']);  echo "<br/>\n";

            echo "판매 여부: ";
            if($info['artwork_issold']==0){
              echo "안팔림";  echo "<br/>\n";
            }else {
              echo "팔림";  echo "<br/>\n";
            }
            echo "</description1>";
            echo "<description2>";
            echo "작품 설명:";
            echo "<br/>\n";
            echo htmlspecialchars($info['artwork_description']);
            echo "</description2>";

            echo "</div>";//product-description 끝
            echo '</div>';

}
echo '</table>';
}
?>
</main>

</section>
</div>
<div >
<?php require('./bottom.php'); ?>
</div>
</body>
</html>