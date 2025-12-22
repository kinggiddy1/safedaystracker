<?php
require_once('perlConfig.php');

$currentMonthYear = date('F Y');
$pastMonthYear = date('F Y', strtotime('-6 months'));


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home - fertility</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="assets/img/logo/logo.jpg" rel="icon">
  <link href="assets/img/logo/logo.jpg" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>

<body class="index-page">

 <?php
    require_once('index-header.php');
  ?>

  <main class="main">
    
<!-- Carousel Section -->
<section id="carousel" class="carousel-section" style="padding: 0; margin: 0;">
  <div class="container-fluid" style="padding: 0;">
    <div id="honeyCarousel" class="carousel slide" data-bs-ride="carousel">
      
      <!-- Carousel Indicators -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#honeyCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#honeyCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#honeyCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <!-- Carousel Inner -->
      <div class="carousel-inner">
        
        <!-- Slide 1 -->
        <div class="carousel-item active" style="position: relative;">
          <img src="assets/img/products/back.png" class="d-block w-100" alt="Pure Honey" style="height: 600px; object-fit: cover;">
          <div style="position: absolute; top: 50%; left: 10%; transform: translateY(-50%); max-width: 500px; z-index: 10;">
            <h1 style="color: #EC407A; font-size: 3rem; font-weight: 700; line-height: 1.2; margin-bottom: 20px;">Understand Your Cycle</h1>
            <p style="color: #EC407A; font-size: 1.1rem; margin-bottom: 30px;">Track your past cycles and discover days with higher or lower chances of pregnancy.</p>
            <a href="#about" class="btn btn-primary" style="background-color: #EC407A; border: none; padding: 12px 30px; font-size: 1rem;">Learn More About Us</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="position: relative;">
          <img src="assets/img/products/back.png" class="d-block w-100" alt="Organic Honey" style="height: 600px; object-fit: cover;">
          <div style="position: absolute; top: 50%; left: 10%; transform: translateY(-50%); max-width: 500px; z-index: 10;">
            <h1 style="color: #EC407A; font-size: 3rem; font-weight: 700; line-height: 1.2; margin-bottom: 20px;">How It Works  Based on Your History</h1>
            <p style="color: #EC407A; font-size: 1.1rem; margin-bottom: 30px;">Enter up to 6 consecutive months of period start dates for a more realistic prediction.</p>
            <a href="#products" class="btn btn-primary" style="background-color: #EC407A; border: none; padding: 12px 30px; font-size: 1rem;">Shop Now</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="position: relative;">
          <img src="assets/img/products/back.png" class="d-block w-100" alt="Honey Comb" style="height: 600px; object-fit: cover;">
          <div style="position: absolute; top: 50%; left: 10%; transform: translateY(-50%); max-width: 500px; z-index: 10;">
            <h1 style="color: #EC407A; font-size: 3rem; font-weight: 700; line-height: 1.2; margin-bottom: 20px;">Important to Know</h1>
            <p style="color: #EC407A; font-size: 1.1rem; margin-bottom: 30px;">Predictions are estimates and should not replace medical advice or contraception.</p>
            <a href="#products" class="btn btn-primary" style="background-color: #EC407A; border: none; padding: 12px 30px; font-size: 1rem;">Explore Products</a>
          </div>
        </div>
      </div>

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#honeyCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#honeyCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

    
<section id="record-cycles" style="padding: 40px 20px; background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);">
  <div style="max-width: 850px; margin: 0 auto;">
    
  <!-- Section Header -->
  <div style="text-align: center; margin-bottom: 20px;">
  <h2 style="color: #EC407A; font-size: 1.8em; font-weight: 700; margin-bottom: 5px; font-family: 'Poppins', sans-serif;">
     A <strong>quick</strong> way to predict fertility: No account required. 
  </h2>
  <p style="color: #666; font-size: 0.9em; margin: 0;"> 
    Enter your cycle dates from <strong><?= $pastMonthYear; ?></strong> to <strong><?= $currentMonthYear; ?></strong>.
  </p>
  </div>
    <!-- Form Card -->
    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 8px 30px rgba(236, 64, 122, 0.1);">
      
      <form method="post" action="calculate.php" id="cycleForm">
        
        <!-- Cycles Container -->
        <div id="cyclesContainer" style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
            <thead>
              <tr>
                <th style="text-align: center; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em; width: 50px;">#</th>
                <th style="text-align: left; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em;">Period Start Date</th>
                <th style="text-align: left; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em;">Next Period Start Date</th>
                <th style="text-align: center; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em; width: 60px;">Action</th>
              </tr>
            </thead>
            <tbody id="cycleRows">
              <!-- Initial row will be added by JavaScript -->
            </tbody>
          </table>
        </div>

        <!-- Add Cycle Button -->
        <div style="text-align: center; margin-top: 15px; margin-bottom: 20px;">
          <button 
            type="button" 
            id="addCycleBtn"
            style="background: linear-gradient(135deg, #a8e6cf 0%, #7bd3b0 100%); color: white; border: none; padding: 10px 30px; font-size: 0.9em; font-weight: 600; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 3px 10px rgba(123, 211, 176, 0.3); font-family: 'Poppins', sans-serif;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(123, 211, 176, 0.4)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 10px rgba(123, 211, 176, 0.3)'"
          >
            + Add Another Cycle
          </button>
          <p style="font-size: 0.8em; color: #999; margin-top: 8px;">
            <span id="cycleCount">1</span> of 6 cycles added
          </p>
        </div>

        <!-- Submit Button -->
        <div style="text-align: center; margin-top: 20px;">
          <button 
            type="submit" 
            style="background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%); color: white; border: none; padding: 12px 40px; font-size: 0.95em; font-weight: 600; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(236, 64, 122, 0.3); font-family: 'Poppins', sans-serif;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(236, 64, 122, 0.4)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(236, 64, 122, 0.3)'"
          >
            Predict Fertility Days
          </button>
        </div>

      </form>

    </div>

  </div>
</section>

<style>
  .cycle-row {
    background: #fff5f8;
    transition: all 0.3s ease;
  }

  .cycle-row.removing {
    opacity: 0;
    transform: translateX(-20px);
  }

  .remove-btn {
    background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
    color: white;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2em;
    font-weight: bold;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .remove-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 10px rgba(239, 83, 80, 0.4);
  }

  @media (max-width: 768px) {
    section table thead {
      display: none;
    }
    
    section table tbody tr {
      display: block;
      margin-bottom: 15px;
      border-radius: 8px !important;
    }
    
    section table tbody tr td {
      display: block;
      width: 100% !important;
      border-radius: 0 !important;
      padding: 8px 12px !important;
    }
    
    section table tbody tr td:first-child {
      border-radius: 8px 8px 0 0 !important;
    }
    
    section table tbody tr td:last-child {
      border-radius: 0 0 8px 8px !important;
      text-align: center !important;
    }
    
    section h2 {
      font-size: 1.5em !important;
    }
  }
</style>

<script>
let cycleCount = 0;
const maxCycles = 6;

// Generate month placeholder
function getMonthPlaceholder(index) {
  const date = new Date();
  date.setMonth(date.getMonth() - (5 - index));
  return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
}

// Add a new cycle row
function addCycle() {
  if (cycleCount >= maxCycles) {
    alert('Maximum 6 cycles can be added.');
    return;
  }

  cycleCount++;
  const monthPlaceholder = getMonthPlaceholder(cycleCount - 1);
  
  const row = document.createElement('tr');
  row.className = 'cycle-row';
  row.innerHTML = `
    <td style="padding: 10px; text-align: center; border-radius: 8px 0 0 8px;">
      <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%); border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.9em;">
        ${cycleCount}
      </div>
    </td>
    <td style="padding: 10px;">
      <input 
        type="date" 
        name="start[]" 
        placeholder="${monthPlaceholder}"
        style="width: 100%; padding: 8px 12px; border: 2px solid #ffe0eb; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 0.85em; outline: none;"
        onfocus="this.style.borderColor='#EC407A'"
        onblur="this.style.borderColor='#ffe0eb'"
        required
      >
    </td>
    <td style="padding: 10px;">
      <input 
        type="date" 
        name="end[]" 
        placeholder="${monthPlaceholder}"
        style="width: 100%; padding: 8px 12px; border: 2px solid #ffe0eb; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 0.85em; outline: none;"
        onfocus="this.style.borderColor='#EC407A'"
        onblur="this.style.borderColor='#ffe0eb'"
        required
      >
    </td>
    <td style="padding: 10px; text-align: center; border-radius: 0 8px 8px 0;">
      <button type="button" class="remove-btn" onclick="removeCycle(this)" title="Remove cycle">
        ×
      </button>
    </td>
  `;
  
  document.getElementById('cycleRows').appendChild(row);
  updateUI();
}

// Remove a cycle row
function removeCycle(button) {
  if (cycleCount <= 1) {
    alert('At least 1 cycle is required.');
    return;
  }

  const row = button.closest('tr');
  row.classList.add('removing');
  
  setTimeout(() => {
    row.remove();
    cycleCount--;
    renumberCycles();
    updateUI();
  }, 300);
}

// Renumber cycles after removal
function renumberCycles() {
  const rows = document.querySelectorAll('#cycleRows tr');
  rows.forEach((row, index) => {
    const numberDiv = row.querySelector('td:first-child div');
    if (numberDiv) {
      numberDiv.textContent = index + 1;
    }
  });
}

// Update UI elements
function updateUI() {
  document.getElementById('cycleCount').textContent = cycleCount;
  const addBtn = document.getElementById('addCycleBtn');
  
  if (cycleCount >= maxCycles) {
    addBtn.disabled = true;
    addBtn.style.opacity = '0.5';
    addBtn.style.cursor = 'not-allowed';
  } else {
    addBtn.disabled = false;
    addBtn.style.opacity = '1';
    addBtn.style.cursor = 'pointer';
  }
}

// Add event listener for Add Cycle button
document.getElementById('addCycleBtn').addEventListener('click', addCycle);

// Initialize with one cycle
addCycle();
</script>



<section id="about" class="about section"
  style="background-color: #fdfdfdff; ">
  
  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="about-content" data-aos="fade-right" data-aos-delay="200">
          
          <h2 style="color: #EC407A; font-weight: 700;">
            WHY USE OUR FERTILITY TRACKER?
          </h2>

          <p class="lead" style="color: #666;">
            Our fertility tracker helps women understand their menstrual cycle,
            predict fertile days, and make informed reproductive health decisions
            using real cycle data — not guesswork.
          </p>

          <ul class="about-features list-unstyled mt-4">
            <li data-aos="fade-up" data-aos-delay="300">
              <div>
                <h5 style="color: #EC407A;">
                  <i class="bi bi-check-circle-fill"></i> Cycle-Based Predictions
                </h5>
                <p style="color: #666;">
                  Fertility and ovulation estimates are calculated from your personal
                  cycle history for better accuracy.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <div>
                <h5 style="color: #EC407A;">
                  <i class="bi bi-check-circle-fill"></i> Fertile & Safe Day Insights
                </h5>
                <p style="color: #666;">
                  Easily identify fertile windows, ovulation peaks, and lower-fertility
                  days on a clear calendar.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <div>
                <h5 style="color: #EC407A;">
                  <i class="bi bi-check-circle-fill"></i> Designed for Women’s Health
                </h5>
                <p style="color: #666;">
                  Built using medically accepted cycle-tracking methods to support
                  family planning and cycle awareness.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="600">
              <div>
                <h5 style="color: #EC407A;">
                  <i class="bi bi-check-circle-fill"></i> Simple, Private & Secure
                </h5>
                <p style="color: #666;">
                  Your cycle data stays private while you gain meaningful insights
                  into your reproductive health.
                </p>
              </div>
            </li>
          </ul>

          <div class="cta-container mt-5" data-aos="fade-up" data-aos-delay="800">
            <a href="<?php echo URLROOT; ?>about"
               class="btn"
               style="
                 background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%);
                 color: #fff;
                 border: none;
                 padding: 12px 32px;
                 border-radius: 50px;
                 font-weight: 600;
                 box-shadow: 0 6px 20px rgba(236, 64, 122, 0.3);
               ">
              Learn More About the Tracker
            </a>
          </div>

        </div>
      </div>

      <div class="col-lg-6">
        <div class="about-image position-relative" data-aos="fade-left" data-aos-delay="200">
          <img
            src="assets/img/products/woman.png"
            alt="Fertility Tracker Preview"
            class="img-fluid main-image rounded"
            style="box-shadow: 0 10px 40px rgba(236, 64, 122, 0.15);"
          >
        </div>
      </div>
    </div>

  </div>
</section>


</main>
  <?php
    require_once('index-footer.php');
  ?>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php require_once('loader.php'); ?>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>