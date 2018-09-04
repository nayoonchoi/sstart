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
$artwork_title=$_POST['delete_title'];

//테이블에서 삭제하는 쿼리문 작성
$sql = "DELETE FROM cart where artwork_title= '{$artwork_title}'";



if(mysqli_query($conn,$sql))
{
  echo "<script>alert('장바구니에서 해당 작품 삭제 완료.');";
  echo "window.location.replace('cart.php');</script>";
}else{
  echo "<script>alert('장바구니에서 해당 작품 삭제 실패.');";
  echo "window.location.replace('cart.php');</script>";;
}

//
mysqli_close($conn);
exit;
//header('Location: ./registered.php'

?>
