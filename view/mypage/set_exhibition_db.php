<?php
//seller_id 값으로 DB에 넣을떄 세션변수 필요해서 세션 start
if(!isset($_SESSION))
{
  session_start();
}
$exhibit_image=$_FILES['image']['name'];//이미지 이름
$target='..\..\show_img\\'.$exhibit_image;//이미지를 저장할 경로

$tmp_name=$_FILES['image']['tmp_name'];//이미지가 임시로 저장되는 경로

move_uploaded_file($tmp_name,$target);//임시 경로에 잇는 파일을 지정한 위치로 이동
//이미지가 해당 파일에 저장됨 $target에는 진짜 저장된 이미지 경로가 저장됨

//DB 접속
$conn=mysqli_connect('localhost','root','123456','art_platform');
if(mysqli_connect_errno())
{
  echo "Failed to connect to mysql:". mysqli_connect_errno();
}
//$image=$_POST['image'];
$title=$_POST['title'];
$startexhibitdate=$_POST['startexhibitdate'];
$endexhibitdate=$_POST['endexhibitdate'];
$kind=$_POST['kind'];
$place=$_POST['place'];

$description=$_POST['description'];
//세션에 저장되어있는 member_username을 가져옴
$admin_username=$_SESSION['member_username'];
//해당 사용자의 member_id를 $seller_id에 저장
$sql = "SELECT member_id FROM member where member_username='$admin_username'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$admin_id=$row["member_id"];

/*
echo $_POST['image']; echo "<br/>\n";
echo $_POST['title']; echo "<br/>\n";
echo $_POST['price']; echo "<br/>\n";
echo $_POST['kind']; echo "<br/>\n";
echo $_POST['material']; echo "<br/>\n";
echo $_POST['size']; echo "<br/>\n";
echo $_POST['workdate']; echo "<br/>\n";
echo $_POST['exhibition']; echo "<br/>\n";
echo $_POST['description']; echo "<br/>\n";
*/

$sql = "insert into exhibition(exhibit_image,exhibit_title,exhibit_sdate,exhibit_edate,exhibit_kinds,exhibit_place,exhibit_details)";
$sql = $sql. "values('$exhibit_image','$title','$startexhibitdate','$endexhibitdate','$kind','$place','$description')";

if(mysqli_query($conn,$sql))
{
  echo "<script>alert('전시 등록 완료.');";
  echo "window.location.replace('../navbar/ex_info.php');</script>";
}else{
  echo "<script>alert('전시 등록 실패.');";
  echo "window.location.replace('set_exhibition.php');</script>";;
}

mysqli_close($conn);
exit;
//header('Location: ./registered.php');
?>
