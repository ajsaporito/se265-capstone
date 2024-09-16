<?php
$title = 'Add Review';
include PARTIAL_PATH . 'header.php';
include PARTIAL_PATH . 'navbar.php';
?>
<style>
  .star {
    cursor: pointer;
  }
</style>
<main id="contentContainer" class="flex-grow-1 mx-2 p-2">
  <div class="py-5 mx-4 oxygen-regular">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
        <div class="card border-0 shadow-sm rounded-4 p-3">
          <div class="card-body p-3 p-md-4">
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <h1 class="oxygen-bold pb-1">Add a Review</h1>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Review your job experience or choose to skip</h3>
                </div>
              </div>
            </div>
            <form id="addReviewForm" method="post">
              <div class="row gy-3 overflow-hidden">
                <div class="star-row col-12 d-flex flex-column align-items-center mb-2">
                  <label class="form-label">Professionalism</label>
                  <div class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <label class="star" data-index="<?= $i ?>">
                        <input type="radio" name="professionalism" value="<?= $i ?>" class="d-none">
                        <img src="assets/svgs/star.svg" class="m-1" height="25" alt="Star Icon">
                      </label>
                    <?php endfor; ?>
                  </div>
                </div>
                <div class="star-row col-12 d-flex flex-column align-items-center mb-2">
                  <label class="form-label">Time Management</label>
                  <div class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <label class="star" data-index="<?= $i ?>">
                        <input type="radio" name="timeManagement" value="<?= $i ?>" class="d-none">
                        <img src="assets/svgs/star.svg" class="m-1" height="25" alt="Star Icon">
                      </label>
                    <?php endfor; ?>
                  </div>
                </div>
                <div class="star-row col-12 d-flex flex-column align-items-center mb-2">
                  <label class="form-label">Communication</label>
                  <div class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <label class="star" data-index="<?= $i ?>">
                        <input type="radio" name="communication" value="<?= $i ?>" class="d-none">
                        <img src="assets/svgs/star.svg" class="m-1" height="25" alt="Star Icon">
                      </label>
                    <?php endfor; ?>
                  </div>
                </div>
                <div class="star-row col-12 d-flex flex-column align-items-center mb-2">
                  <label class="form-label">Quality</label>
                  <div class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <label class="star" data-index="<?= $i ?>">
                        <input type="radio" name="quality" value="<?= $i ?>" class="d-none">
                        <img src="assets/svgs/star.svg" class="m-1" height="25" alt="Star Icon">
                      </label>
                    <?php endfor; ?>
                  </div>
                </div>
                <div>
                  <?php if (isset($errorMsg) && !empty($errorMsg)): ?>
                    <div class="alert alert-danger" role="alert">
                      <?= $errorMsg ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none main-form-input" name="comments" id="comments" placeholder="Optional Comments" autocomplete="">
                    <label for="notes" class="form-label text-muted">Optional Comments</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row mx-1">
                    <button style="background-color: #6643b5;" class="btn rounded-4 text-white" type="submit" name="addReviewBtn" onmouseover="this.style.background='#714bc9'" onmouseout="this.style.background='#6643b5'">Submit Review</button>
                  </div>
                </div>
                <div class="row oxygen-light">
                  <div class="col-12">
                    <span class="nav justify-content-center border-bottom mt-2 pb-3 mb-3"></span>
                    <p class="m-0 text-secondary text-center">Don't want to review? Click
                      <a style="color: #6643b5;" class="text-decoration-none" href="/se265-capstone"><b>here</b></a>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    $('.star').on('click', function () {
      let index = $(this).data('index');
      let starRow = $(this).closest('.star-row');

      starRow.find('.star img').attr('src', 'assets/svgs/star.svg');

      for (let i = 1; i <= index; i++) {
        starRow.find('.star[data-index="' + i + '"] img').attr('src', 'assets/svgs/star-fill.svg');
      }

      $(this).find('input').prop('checked', true);
    });
  });
</script>
<?php include PARTIAL_PATH . 'footer.php'; ?>
