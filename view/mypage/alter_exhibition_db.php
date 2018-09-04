<?php
if(!isset($_SESSION))//세션변수 사용을위해 session_start()함수 호출
{
  session_start();
}

require_once('../file_func.php');//파일이름 중복 방지 이름생성 함수 삽입


$conn=mysqli_connect('localhost','root','123456','art_platform');//디비 접속
if(mysqli_connect_errno())
{
  echo "Failed to connect to mysql:". mysqli_connect_errno();
}
$exhibit_id = $_POST["want_alter"];//$artwork_id 변경을 원하는 작품id

//1.원래 있던 이미지를 서버에서 삭제하기
//원래 이미지파일 이름은 db에 저장되어있으므로 db에서 해당 파일의 이름을 찾아오고
//경로를 붙여서 unlink 해줘야함

//원래 이미지 정보를 가져오기 위해 삭제하려는 artwork 정보 db에서 가져옴
$sql = "SELECT * FROM exhibition where exhibit_id='$exhibit_id'";//쿼리문작성
mysqli_query($conn,$sql);//쿼리실행
$result=mysqli_query($conn,$sql);//쿼리결과테이블을 result에 저장함
$row = mysqli_fetch_assoc($result);//row에 해당 artwork 행 정보 저장
$exhibit_name=$row['exhibit_image'];//이미지 이름을 artwork_name 변수에 저장
//이미지가 저장된 경로 가져오기
$exhibit_path="..\..\show_img\\";//이미지 경로를 $artwork_path에 저장
//이미지를 삭제 할 경로 저장
$image_delete_path=$exhibit_path.$exhibit_name;
//unlink시킴
//echo $image_delete_path;
unlink($image_delete_path);

//2.넘겨받은 이미지를 서버에 저장하고 DB에 반영시키기


//$imagename=preg_replace($_FILES['image']['name']);
//$artwork_image=$row2["member_enrollnum"].$imagename;//이미지 이름
$tmp_name=$_FILES['image']['tmp_name'];//이미지가 임시로 저장되는 경로

$path="..\..\show_img\\";
$imagename=preg_replace("/\s+/","",$_FILES['image']['name']);
$target=$path.$imagename;
$tmp_name=$_FILES['image']['tmp_name'];//이미지가 임시로 저장되는 경로

if($imagename) // 업로드할 화일이 있는지 확인
{
  $FileName = GetUniqFileName($imagename, $path); // 같은 화일 이름이 있는지 검사
  $target1=$path.$FileName;
  move_uploaded_file($tmp_name,$target1); // 화일을 업로드 위치에 저장
}


//입력값 필터링(SQL문 주입공격 예방)
 $filtered = array(

   'title'=>mysqli_real_escape_string($conn, $_POST['title']),
   'sdate'=>mysqli_real_escape_string($conn, $_POST['sdate']),
   'edate'=>mysqli_real_escape_string($conn, $_POST['edate']),
   'kind'=>mysqli_real_escape_string($conn, $_POST['kind']),
   'place'=>mysqli_real_escape_string($conn, $_POST['place']),
   'description'=>mysqli_real_escape_string($conn, $_POST['description'])

 );

 $sql = "
   UPDATE exhibition
     SET
      exhibit_title ='{$filtered['title']}',
      exhibit_sdate = '{$filtered['sdate']}',
      exhibit_edate = '{$filtered['edate']}',
      exhibit_kinds = '{$filtered['kind']}',
      exhibit_place = '{$filtered['place']}',
      exhibit_details = '{$filtered['description']}',
      exhibit_image ='{$FileName}'
     WHERE
      exhibit_id='$exhibit_id'
 ";


 if(mysqli_query($conn,$sql))
 {

   echo "<script>alert('전시회 정보수정 완료.');";
   echo "window.location.replace('./registered_exhibition.php');</script>";
 }else{
   echo "<script>alert('전시회 정보수정 실패.');";
   echo "window.location.replace('./registered_exhibition.php');</script>";;
 }

 mysqli_close($conn);


exit;

?>