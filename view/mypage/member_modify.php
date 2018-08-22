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

              <p>어서 회원수정을 진행하시죠!!</p>


<form method="post" action="alter_member_db.php">

<input type='hidden' name='' value='' />
<div class="contain">
  <div id=form-box>
  <form action="/action_page.php">
    <?php

    //DB접속
    $conn=mysqli_connect('localhost','root','123456','art_platform');
    if(mysqli_connect_errno())
    {
      echo "Failed to connect to mysql:". mysqli_connect_errno();
    }

    $user_id = $_SESSION['member_username'];

    //DB로 부터 맴버의 아이디와 패스워드 테이블 가져옴
    $sql = "SELECT * FROM member where member_username='$user_id'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $image_dir="../account/memberimg/";
    $image_path=$image_dir.$row['member_image'];

    ?>
   <img src="<?php echo $image_path;?>" alt="이미지를 등록해 주세요" width="150px" height="200px">
  <div class="form-group">
    <input type="file" class="form-control-file border" name="file">
  </div>
  <button type="submit" class="btn btn-secondary">사진 수정</button>
</form>
</div>
<div id="form-box">

<div>
  <label for="id_username">사용자 이름:</label>
  <input class="form-control" type="text" name="username" maxlength="150" autofocus required id="id_username" />
</div>
  <p>150자 이하 문자, 숫자 그리고 @/./+/-/_만 가능합니다.</p></br >

<div>
  <label for="id_password1">비밀번호:</label>
  <input class="form-control" type="password" name="password1" required id="id_password1" />
</div>


  <p>다른 개인정보와 비슷한 비밀번호는 사용할 수 없습니다.</p></br >
  <p>비밀번호는 최소 8자 이상이어야 합니다.</p></br >
  <p>비밀번호는 일상적으로 사용되는 비밀번호일 수 없습니다.</p></br >
  <p>비밀번호는 전부 숫자로 할 수 없습니다.</p></br >
<div>
  <label for="id_password2">비밀번호 확인:</label>
  <input  class="form-control"type="password" name="password2" required id="id_password2" />
</div>
<p>확인을 위해 이전과 동일한 비밀번호를 입력하세요.</p>

</div>
<div id="form-box">
<div>
  <label for="id_name">Name:</label>
  <input  class="form-control"type="text" name="name" required id="id_name"/>
</div>
<div>
  <label for="id_nickname">Nickname:</label>
  <input class="form-control" type="text" name="nickname" required id="id_nickname"/>
</div>
<div>
  <label for="id_phone">Phone:</label>
  <input  class="form-control"type="text" name="phone" required id="id_phone"/>
</div>
<div>
  <label for="id_stid">학번:</label>
  <input  class="form-control"type="text" name="stid" required id="id_stid"/>
</div>
<div>
  <label for="id_gender">성별:  </label>
  <div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" value="">남자
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" value="">여자
  </label>
</div>
<div>
  <label for="id_email">Email:</label>
  <input  class="form-control"type="email" name="email" required id="id_email"/>
</div>
</br >

<div>다 수정했으면 이거 -> <button type="submit"class="btn btn-primary">수정완료</button>클릭!!</div>

</div>
</div>
</form>
            </main>

        </section>



          </div>
      </div>
      <div >
        <?php require('../../include/bottom.php');  ?>
    </div>
</body>
</html>
