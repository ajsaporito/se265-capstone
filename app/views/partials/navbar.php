<?php
$isLoggedIn = isset($_SESSION['user_id']);
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

function activePage($page) {
  $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  return $currentPage === $page ? 'active' : '';
}
?>
<nav style="background-color: #3c4245;" class="navbar navbar-expand-lg navbar-dark oxygen-regular">
  <div class="container">
    <a class="navbar-brand fs-4" href="/se265-capstone">DevSpot
      <img src="assets/svgs/logo.svg" alt="Logo" width="40" height="40" class="px-2">
    </a>
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div style="background-color: #3c4245;" class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offCanvasNavbarLabel">
      <div class="offcanvas-header border-bottom">
        <a href="/se265-capstone" class="text-decoration-none text-white d-flex">
          <h4 class="offcanvas-title" id="offCanvasNavbarLabel">DevSpot</h4>
          <img src="assets/svgs/logo.svg" alt="Logo" width="40" height="40" class="px-2">
        </a>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div style="background-color: #3c4245;" class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
        <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
          <li class="nav-item mx-2">
            <a class="nav-link <?= activePage('/se265-capstone/jobs'); ?>" href="/se265-capstone/jobs">Find Jobs</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?= activePage('/se265-capstone/find-people'); ?>" href="/se265-capstone/find-people">Find People</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?= activePage('/se265-capstone/edit-profile'); ?>" href="/se265-capstone/edit-profile?id=<?= $userId; ?>">Edit Profile</a>
          </li>
        </ul>
        <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
          <form method="post" id="searchForm" class="mx-3">
            <div class="input-group rounded-4 overflow-hidden search-container">
              <input id="searchBox" type="text" class="form-control border-0 shadow-none py-1 px-2" placeholder="Search for jobs...">
              <div id="searchIcon" class="border-0 bg-white shadow-none py-1 px-2">
                <img src="assets/svgs/magnifying-glass.svg" alt="Search" width="20" height="20" class="m-1">
              </div>
              <span id="searchBtnBorder" class="border border-2"></span>
              <button style="background-color: #ebebeb;" type="button" class="border-0 shadow-none py-1 px-2" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" onmouseover="this.style.background='#dcdcdc'" onmouseout="this.style.background='#ebebeb'">
                <img src="assets/svgs/caret-down.svg" alt="Drop Down Toggle" width="20" height="20" class="m-1">
              </button>
              <div class="bg-white dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item active" href="">Search for Jobs</a>
                <a class="dropdown-item" href="">Search for People</a>
              </div>
            </div>
            <?php if ($isLoggedIn): ?>
              <div id="searchResults" class="d-none position-absolute rounded-4 bg-white p-2 overflow-hidden"></div>
            <?php endif; ?>
          </form>
          <?php if ($isLoggedIn): ?>
            <a style="background-color: #6643b5;" class="text-white text-decoration-none px-4 py-1 rounded-4 nav-btn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'" href="/se265-capstone/logout">Logout</a>
          <?php else: ?>
            <a style="background-color: #838383;" class="text-white text-decoration-none px-4 py-1 rounded-4 nav-btn" onmouseover="this.style.background='#8f8f8f'" onmouseout="this.style.background='#838383'" href="/se265-capstone/login">Login</a>
            <a style="background-color: #6643b5;" class="text-white text-decoration-none hover px-3 py-1 rounded-4 nav-btn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'" href="/se265-capstone/signup">Sign Up</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</nav>
