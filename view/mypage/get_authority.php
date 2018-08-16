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

              <p>판매자 권한 얻기!^^</p>


<form method="post" action="../account/authority_ok.php">


<button type="submit"class="btn btn-primary">권한 얻기</button>클릭!!


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