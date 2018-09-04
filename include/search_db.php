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



$sql = "SELECT * FROM artwork_with_stid where artwork_title LIKE '%$search_word%' ";
$rs = mysqli_query($conn,$sql);
$num= mysqli_num_rows($rs);//상품 총 갯수

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

$sql = "SELECT * FROM artwork_with_stid where artwork_title LIKE '%$search_word%'  LIMIT $s_point,$list";
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

 for ($i=1; $i<=mysqli_num_rows($rs);$i++) {
            $info = mysqli_fetch_array($rs);
            //echo '<tr>';
            echo '<product>';

            echo "작품 이름: ".$info['artwork_title'];  echo "<br/>\n";

            echo "작품 가격: ".$info['artwork_price'];  echo "<br/>\n";

            echo "작품 종류: ".$info['artwork_kinds'];  echo "<br/>\n";

            echo '<div><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#' ;
            echo  htmlspecialchars($info['artwork_id']);
            echo '"style =" width:130px">작품 상세보기</button></div>';
            echo '</product>';

           // echo '</tr>';

            echo '<div id="';
            echo htmlspecialchars($info['artwork_id']);
            echo '" class="collapse">';
            $image_dir="..\\view\account\memberimg\\".$info['member_stid']."\\img\\";
              $image_path=$image_dir.$info['artwork_image'];
              echo "<div class=\"product-row\" >";
              echo '<img src=';
              echo $image_path;
              echo ' , alt="이미지를 등록해 주세요" ';
              echo 'style= "width:250px; height:250px;">';
              echo "<div class=\"product\">";
              echo "<div class=\"product-box\">";
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
            echo '</div>';
            echo '</div>';
            echo '</div>';

}
echo '</product>';
}
?>
<div id="page">
              <div class="pagination">
                <?php
                                for ($p=$s_page; $p<=$e_page; $p++) {
                                ?>

                                    <a href="<?="http://localhost/HI_ART/include/search_db.php"?>?search_word=<?=$search_word?>&page=<?=$p?>"><?=$p?></a>

                                <?php
                                }
                                ?>
              </div>
            </div>
</main>

</section>
</div>
<div >
<?php require('./bottom.php'); ?>
</div>
</body>
</html>
