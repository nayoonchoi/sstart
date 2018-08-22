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
//$image=$_POST['image'];
$title=$_POST['cart_title'];

$seller_username=$_SESSION['member_username'];
//해당 사용자의 member_id를 $like_id에 저장
$sql = "SELECT member_id FROM member where member_username='$seller_username'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$like_id=$row["member_id"];



$sql = "insert into cart(artwork_title, like_user)";
$sql = $sql. "values('$title','$like_id')";

if(mysqli_query($conn,$sql))
{
  echo "<script>alert('장바구니등록 완료.');";
  echo "window.location.replace('all_art.php');</script>";
}else{
  echo "<script>alert('장바구니등록 실패.');";
  echo "window.location.replace('all_art.php');</script>";;
}

mysqli_close($conn);
exit;
//header('Location: ./registered.php');
?>
