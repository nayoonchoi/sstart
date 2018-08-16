<?php
if(!isset($_SESSION))
  {
    session_start();
  }

$conn=mysqli_connect('localhost','root','123456','art_platform');
if(mysqli_connect_errno())
{
  echo "Failed to connect to mysql:". mysqli_connect_errno();
}

  $user_id = $_SESSION['member_username'];
  //DB로 부터 맴버의 아이디와 패스워드 테이블 가져옴
 $sql = "UPDATE member SET member_authority=1 WHERE member_username='$user_id'";

  if(mysqli_query($conn,$sql) && (substr(trim($_SESSION['member_stid']), 2, 2) == '12' || substr(trim($_SESSION['member_stid']), 2, 2) == '40'
  || substr(trim($_SESSION['member_stid']), 2, 2) == '41' || substr(trim($_SESSION['member_stid']), 2, 2) == '42' || substr(trim($_SESSION['member_stid']), 2, 2) == '43'
  || substr(trim($_SESSION['member_stid']), 2, 2) == '44' || substr(trim($_SESSION['member_stid']), 2, 2) == '45' || substr(trim($_SESSION['member_stid']), 2, 2) == '46'
  || substr(trim($_SESSION['member_stid']), 2, 2) == '48' || substr(trim($_SESSION['member_stid']), 2, 2) == '49' || substr(trim($_SESSION['member_stid']), 2, 2) == '50'
  || substr(trim($_SESSION['member_stid']), 2, 2) == '52' || substr(trim($_SESSION['member_stid']), 2, 2) == '47'))
 {
   $_SESSION['authorized'] = 1;
   header("Content-Type: text/html; charset=UTF-8");
   echo "<script>alert('판매자 권한 얻기 성공!!');";
   echo "window.location.replace('../../index.php');</script>";

  }
  else{
   header("Content-Type: text/html; charset=UTF-8");
   echo "<script>alert('판매자 권한 얻기 실패!!');";
   echo "window.location.replace('../mypage/get_authority.php');</script>";
  }
  mysqli_close($conn);

 // header('Location: ../../index.php');
  exit;

?>
