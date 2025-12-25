<section id="record-cycles" style="padding: 40px 20px; background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);">
  <div style="max-width: 850px; margin: 0 auto;">
    
  <!-- Section Header -->
  <div style="text-align: center; margin-bottom: 20px;">
  <h2 style="color: #EC407A; font-size: 1.8em; font-weight: 700; margin-bottom: 5px; font-family: 'Poppins', sans-serif;">
     Add your cycles to preddict safe days
  </h2>
  <p style="color: #666; font-size: 0.9em; margin: 0;"> 
    Save at least 6 cycles up to <strong><?= $currentMonthYear; ?></strong>.
  </p>
  </div>
    <!-- Form Card -->
    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 8px 30px rgba(236, 64, 122, 0.1);">
      
      <form method="post" action="submissions.php" id="cycleForm">
        
        <!-- Cycles Container -->
        <div id="cyclesContainer" style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
            <thead>
              <tr>
                <th style="text-align: center; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em; width: 50px;">#</th>
                <th style="text-align: left; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em;">Period Start Date</th>
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
            name="save_cycles"
            style="background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%); color: white; border: none; padding: 12px 40px; font-size: 0.95em; font-weight: 600; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(236, 64, 122, 0.3); font-family: 'Poppins', sans-serif;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(236, 64, 122, 0.4)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(236, 64, 122, 0.3)'"
          >
            Save
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
        name="period_dates[]" 
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
