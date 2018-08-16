<!doctype>
<html>
<head>
  <?php
    require('../../include/head.php');
   ?>
</head>

<body style="height:1500px">

  <?php
    require('../../include/header.php');
  ?>
  <navbar >
    <?php
      require('../../include/navbar.php');
    ?>

  </navbar>
  <div class="container">
    <section class="content" >
      <div  id="banner-left">
	      <?php require('./banner-left.php');?>
      </div>
     <main>

              <p>전시회를 등록해주세요^^</p>


<form method="post" action="set_exhibition_db.php"enctype="multipart/form-data">
<!--
<input type='hidden' name='csrfmiddlewaretoken' value='Pn20lp836djTca8BkJJVfv7JDQkw6E2a09Hbzw6a16lndRNcNO4NYIsvUpCYCrwj' />
-->
<div class="contain">
  <div id=form-box>
    <p>우선 전시회의 메인 사진을 등록해주세요! </p>
<!--
  <img src="" alt="이미지를 등록해 주세요" width="150px" height="200px">
-->
  <div class="form-group">
    <input type="file" class="form-control-file border" name="image" >
  </div>


</div>
<div id="form-box">

<div>
  <label for="id_title">전시회 제목:</label>
  <input class="form-control" type="text" name="title" maxlength="150" autofocus required id="id_title" />
</div>
<div>
  <label for="id_startexhibitdate">시작 날짜:</label>
  <input class="form-control"type="date" name="startexhibitdate" required id="id_stratexhibitdate" />
</div>
<div>
  <label for="id_endexhibitdate">종료 날짜:</label>
  <input class="form-control"type="date" name="endexhibitdate" required id="id_endexhibitdate" />
</div>

<p></br> 전시회 종류: </p>

<div class="form-check">
  <label class="form-check-label">
    <input type="radio" name="kind" class="form-check-input" value="회화">회화
  </label>
</div>
<div class="form-check ">
  <label class="form-check-label">
    <input type="radio" name="kind" class="form-check-input" value="공예">공예
  </label>
</div>
<div class="form-check ">
  <label class="form-check-label">
    <input type="radio" name="kind" class="form-check-input" value="디자인">디자인
  </label>
</div>
<div class="form-check ">
  <label class="form-check-label">
    <input type="radio" name="kind" class="form-check-input" value="아트상품">아트상품
  </label>
</div>
<div class="form-check ">
  <label class="form-check-label">
    <input type="radio"name="kind" class="form-check-input" value="사진">사진
  </label>
</div>
<div class="form-check ">
  <label class="form-check-label">
    <input type="radio" name="kind"class="form-check-input" value="판화">판화
  </label>
</div>

<div class="form-check ">
  <label class="form-check-label">
    <input type="radio"name="kind" class="form-check-input" value="기타">기타
  </label>
</div>

</div>
<div id="form-box">

<div>
  <label for="id_place">전시 장소:</label>
  <input  class="form-control"type="text" name="place" required id="id_place" />
</div>
<div class="form-group">
  <label for="id_comment">전시회 설명:</label>
  <textarea class="form-control" rows="8" name="description" id="id_comment"></textarea>
</div>

</br >

<div>다 입력했으면 이거 -> <button type="submit"class="btn btn-primary">전시 등록</button>클릭!!</div>

</div>
</div>
</form>
            </main>

        </section>



          </div>
        </section>
      </div>
      <div >
        <?php require('../../include/bottom.php');  ?>
    </div>
</body>
</html>