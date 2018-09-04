<div class="nav2" style="background:#282f3a; ">
      <div class="container2">
        <ul style="display:flex; flex-direction: row; margin-bottom:2px; padding:0px;">
          <li class="nav-item" style="flex-shrink:0" >
            <a class="nav-link" href="/HI_ART/view/navbar/exing_info.php"style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">전시정보</a>
          </li>
          <?php if(!isset($_SESSION['member_username']) || !isset($_SESSION['member_name'])) { ?>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif;  ">회화</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">공예</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">디자인</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">아트상품</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">사진</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">판화</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/manage/denial_access.php" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">기타</a>
            </li>
          <?php } else { ?>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=회화" style="color:#f4f5f7; font-family: 'Jua', sans-serif;  ">회화</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=공예" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">공예</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=디자인" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">디자인</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=아트상품" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">아트상품</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=사진" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">사진</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=판화" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">판화</a>
            </li>
            <li class="nav-item"style="flex-shrink:0">
              <a class="nav-link" href="/HI_ART/view/navbar/artwork_kinds.php?kind=기타" style="color:#f4f5f7; font-family: 'Jua', sans-serif; ">기타</a>
            </li>
          <?php } ?>
        </ul>
        <?php if(!isset($_SESSION['member_username']) || !isset($_SESSION['member_name'])) { ?>
        <div id="box" >
          <div class="search-container" style="padding:3px; height:44px">
            <form class="form-inline" action="/HI_ART/view/manage/denial_access.php"style="margin-left:100px;display:block;" method="get">
              <input class="form-control mr-sm-2" name="search_word"type="text" placeholder="Search">
              <button class="btn btn-success" type="submit">Search</button>
            </form>
          </div>
        </div>
         <?php } else { ?>
         <div id="box" >
          <div class="search-container" style="padding:3px; height:44px">
            <form class="form-inline" action="/HI_ART/include/search_db.php"style="margin-left:100px;display:block;" method="get">
              <input class="form-control mr-sm-2" name="search_word"type="text" placeholder="Search">
              <button class="btn btn-success" type="submit">Search</button>
            </form>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>