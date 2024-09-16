<?php
$title = 'About';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<main id="contentContainer" class="flex-grow-1">
  <div class="container py-5 oxygen-regular">
    <div class="card rounded-4 p-2">
      <div class="card-body mx-2">
        <h1 class="oxygen-bold">About Us</h1>
        <p class="lead">DevSpot doesn't exist, not yet at least...</p>
        <div class="oxygen-light">
          <p>The purpose of the site is to serve as the SE265 (associate's degree) Capstone project for New England Tech.</p>
        </div>
      </div>
    </div>
    <div class="card rounded-4 p-2 mt-4">
      <div class="card-body mx-2">
        <h2 class="oxygen-bold">Our Team</h2>
        <div class="row oxygen-light">
          <p>AJ Saporito</p>
          <p>Tristen Jussaume</p>
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
              <a href="/se265-capstone/prototype" target="_blank">Prototype Document</a>
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
