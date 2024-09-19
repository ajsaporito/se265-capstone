<?php
$title = 'About';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div class="card rounded-4 p-2">
      <div class="card-body mx-2">
        <h1 class="oxygen-bold">About This Site</h1>
        <p class="lead">DevSpot doesn't exist, not yet at least...</p>
        <div class="oxygen-light">
          <p>The purpose of the site is to serve as the SE265 (associate's degree) Capstone project for New England Tech.</p>
        </div>
      </div>
    </div>
    <div class="card rounded-4 p-2 mt-4">
      <div class="card-body mx-2">
        <h2 class="oxygen-bold">Credits</h2>
        <div class="row oxygen-light">
          <p><strong>AJ Saporito</strong></p>
          <ul style="margin-left: 1rem;">
            <li>Technical design</li>
            <li>Navbar/footer</li>
            <li>Login/signup</li>
            <li>Edit user settings</li>
            <li>Delete profile</li>
            <li>Adding reviews</li>
            <li>Adding jobs</li>
            <li>Searching for users/jobs</li>
          </ul>
          <p><strong>Tristen Jussaume</strong></p>
          <ul style="margin-left: 1rem;">
            <li>Dashboard</li>
            <li>Datebase relationships</li>
            <li>Requesting jobs</li>
            <li>Accepting job requests</li>
            <li>Calculating/storing reviews</li>
            <li>Moving job to in progress when accepted</li>
            <li>Moving job to completed when done</li>
            <li>Open job/public profile view</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card rounded-4 p-2 mt-4">
      <div class="card-body mx-2">
        <h2 class="oxygen-bold pb-2">Resources</h2>
        <div class="oxygen-light">
          <ul>
            <li class="pb-2">
              <a href="/se265-capstone/docs/pdfs/project-proposal.pdf" target="_blank">Proposal Document</a>
            </li>
            <li class="pb-2">
              <a href="/se265-capstone/prototype" target="_blank">Prototype</a>
            </li>
            <li class="pb-2">
              <a href="/se265-capstone/docs/pdfs/technical-design.pdf" target="_blank">Technical Design Document</a>
            </li>
            <li class="pb-2">
              <a href="/se265-capstone/docs/pdfs/erd.pdf" target="_blank">Normalized Database Diagram</a>
            </li>
            <li class="pb-2">
              <a href="" target="_blank">Screenshots</a>
            </li>
            <li class="pb-2">
              <a href="" target="_blank">PowerPoint</a>
            </li>
        </div>
      </div>
  </div>
</main>
<?php include PARTIAL_PATH . 'footer.php'; ?>
