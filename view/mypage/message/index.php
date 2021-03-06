<?php
	require_once("./messagedb.php");
 $subString = '';
 $searchColumn = '';
  /* 페이징 시작 */

//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.

if(isset($_GET['page'])) {

  $page = $_GET['page'];

} else {

  $page = 1;

}



/* 검색 시작 */



	if(isset($_GET['searchColumn'])) {

		$searchColumn = $_GET['searchColumn'];

		$subString .= '&amp;searchColumn=' . $searchColumn;

	}

	if(isset($_GET['searchText'])) {

		$searchText = $_GET['searchText'];

		$subString .= '&amp;searchText=' . $searchText;

	}



	if(isset($searchColumn) && isset($searchText)) {

		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';

	} else {

		$searchSql = '';

	}



	/* 검색 끝 */



$sql = 'select count(*) as cnt from message' . $searchSql;
$result = $db->query($sql);

$row = $result->fetch_assoc();



$allPost = $row['cnt']; //전체 게시글의 수
if(empty($allPost)) {

		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

	} else {


$onePage = 10; // 한 페이지에 보여줄 게시글의 수.

$allPage = ceil($allPost / $onePage); //전체 페이지의 수



if($page < 1 || ($allPage && $page > $allPage)) {

?>

  <script>

    alert("존재하지 않는 페이지입니다.");

    history.back();

  </script>

<?php

  exit;

}



$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

$currentSection = ceil($page / $oneSection); //현재 섹션

$allSection = ceil($allPage / $oneSection); //전체 섹션의 수



$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지



if($currentSection == $allSection) {

  $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

} else {

  $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

}



$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.



$paging = '<ul>'; // 페이징을 저장할 변수



//첫 페이지가 아니라면 처음 버튼을 생성

if($page != 1) {
$paging .= '<li class="page page_start"><a href="./message.php?page=1' . $subString . '">처음</a></li>';
}

//첫 섹션이 아니라면 이전 버튼을 생성

if($currentSection != 1) {
$paging .= '<li class="page page_prev"><a href="./message.php?page=' . $prevPage . $subString . '">이전</a></li>';
}



for($i = $firstPage; $i <= $lastPage; $i++) {

  if($i == $page) {

    $paging .= '<li class="page current"></li>';

  } else {

$paging .= '<li class="page"><a href="./message.php?page=' . $i . $subString . '">' . $i . '</a></li>';
  }

}



//마지막 섹션이 아니라면 다음 버튼을 생성

if($currentSection != $allSection) {
$paging .= '<li class="page page_next"><a href="./message.php?page=' . $nextPage . $subString . '">다음</a></li>';
}



//마지막 페이지가 아니라면 끝 버튼을 생성

if($page != $allPage) {

	$paging .= '<li class="page page_end"><a href="./message.php?page=' . $allPage . $subString . '">끝</a></li>';
}

$paging .= '</ul>';



/* 페이징 끝 */

$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

$sql = 'select * from message ' . $searchSql . ' order by id desc ' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
$result = $db->query($sql);
}
?>


<!DOCTYPE html>

<html>
<head>
    <?php
    require('../../../include/head.php');
   ?>
   </head>

<body style="height:1500px">

  <?php
    require('../../../include/header.php');
  ?>
  <navbar >
    <?php
      require('../../../include/navbar.php');
    ?>

  </navbar>


  <div class="container">

    <section class="content" >
			<div  id="banner-left">
					<?php require_once('banner-left.php');?>
			</div>
			 <main>
         	<meta charset="utf-8" />
         	<title>쪽지함 | MESSAGE WRITE</title>
         	<link rel="stylesheet" href="./normalize.css" />
         	<link rel="stylesheet" href="./board.css" />

         <body>

         	<article class="boardArticle">

         		<h3>받은 쪽지함</h3>

         		<table>

         			<caption class="readHide">받은 쪽지함</caption>

         			<thead>

         				<tr>
         					<th scope="col" class="no">번호</th>
         					<th scope="col" class="title">내용</th>
         					<th scope="col" class="author">보낸이</th>
         					<th scope="col" class="date">작성일</th>
         				  <th scope="col" class="hit">답장</th>
									<th scope="col" class="hit">삭제</th>
         				</tr>

         			</thead>

         			<tbody>
                 <?php
                 if(isset($emptyData)) {

                 							echo $emptyData;

                 						} else {
                 							while($row = $result->fetch_assoc())

                 							{

                 								$datetime = explode(' ', $row['created']);

                 								$date = $datetime[0];

                 								$time = $datetime[1];

                 								if($date == Date('Y-m-d'))

                 									$row['created'] = $time;

                 								else

                 									$row['created'] = $date;

                 						?>
         					<?php
         /*          if(isset($emptyData)) {

                                 echo $emptyData;

                               } else {

         						$sql = 'select * from message order by id desc';

         						$result = $db->query($sql);
         //mysqli_query($conn, $sql);
         						while($row = $result->fetch_assoc())
         						{
         							$datetime = explode(' ', $row['created']);
         							$date = $datetime[0];
         							$time = $datetime[1];
         							if($date == Date('Y-m-d'))
         								$row['created'] = $time;
         							else
         								$row['created'] = $date;
         */				?>

         				<tr>
         					<td class="no"><?php echo $row['id']?></td>
         					<td class="title"><?php echo $row['title']?></a></td>
         					<td class="author"><?php echo $row['author']?></td>
         					<td class="date"><?php echo $row['created']?></td>
         					<td class="reply">
								 <form action="./messagewrite.php" method="get">
										<?php $searchColumn = ''; ?>

									 <button type="submit">답장</button>

								 </form>
								 <td class="delete">
								<form action="./messagedelsave.php" method="get">
									 <?php $searchColumn = ''; ?>

									<button type="submit">삭제</button>

								</form>

         				</tr>

         					<?php
         						}
                   }
         					?>

         			</tbody>

         		</table>
             <div class="btnSet">

             				<a href="./messagewrite.php" class="btnWrite btn">쪽지 보내기</a>

             			</div>

             			<div class="paging">

             				<?php echo $paging ?>

             			</div>
                   <div class="searchBox">

           				<form action="./index.php" method="get">
                     <?php $searchColumn = ''; ?>
           					<select name="searchColumn">

           						<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>

           						<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>

           						<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>

           					</select>

           					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">

           					<button type="submit">검색</button>

           				</form>

           			</div>
         	</article>

         </body>


       </main>
    </section>
  </div>
  <div >
      <?php require('../../../include/bottom.php'); ?>
  </div>
</body>
</html>
