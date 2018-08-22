<?php
//seller_id 값으로 DB에 넣을떄 세션변수 필요해서 세션 start
if(!isset($_SESSION))
{
  session_start();
}


//DB 접속
$conn=mysqli_connect('localhost','root','123456','art_platform');
if(mysqli_connect_errno())
{
  echo "Failed to connect to mysql:". mysqli_connect_errno();
}

//삭제하려는 작품 artwork_id 넘겨받음
$delete_id=$_POST['want_delete'];

//테이블에서 삭제하는 쿼리문 작성
$sql = "delete from exhibition where exhibit_id=$delete_id";


if(mysqli_query($conn,$sql))
{
  echo "<script>alert('전시회 삭제 완료.');";
  echo "window.location.replace('registered_exhibition.php');</script>";
}else{
  echo "<script>alert('전시회 삭제 실패. 작품이 남아 있습니다.');";
  echo "window.location.replace('registered_exhibition.php');</script>";;
}

//
mysqli_close($conn);
exit;
//header('Location: ./registered.php');

?>
