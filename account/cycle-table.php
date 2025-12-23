<div id="layoutDrawer_content">
    <main>
        <div class="container-xl p-5">                         
            <div class="row gx-5"> 
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title mb-0">Cycles Table</h5>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-dark" onclick="window.location.href='add-cycle.php'">
                                        <i class="bi bi-plus-circle"></i> Add New Cycle
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="cyclesTable" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Period Start Date</th>
                                        <th>Cycle Length</th>
                                        <th>Added At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Sort cycles by period_start_date to ensure proper order
                                    usort($cycles, function($a, $b) {
                                        return strtotime($a['period_start_date']) - strtotime($b['period_start_date']);
                                    });
                                    
                                    $totalCycles = count($cycles);
                                    
                                    foreach ($cycles as $index => $cycle): 
                                        // Calculate cycle length from next cycle's start date
                                        $cycleLength = null;
                                        if ($index < $totalCycles - 1) {
                                            $currentStart = new DateTime($cycle['period_start_date']);
                                            $nextStart = new DateTime($cycles[$index + 1]['period_start_date']);
                                            $cycleLength = $currentStart->diff($nextStart)->days;
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $cycle['cycle_id']; ?></td>
                                            <td><?php echo date('M d, Y', strtotime($cycle['period_start_date'])); ?></td>
                                            <td>
                                                <?php if ($cycleLength !== null): ?>
                                                    <span class="badge" style="background: <?php 
                                                        if ($cycleLength < 24) echo '#ef5350';
                                                        elseif ($cycleLength > 32) echo '#ff6b9d';
                                                        else echo '#7bd3b0';
                                                    ?>; color: white; padding: 5px 12px; border-radius: 15px;">
                                                        <?php echo $cycleLength; ?> days
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Current Cycle</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date('M d, Y H:i', strtotime($cycle['cycle_created_at'])); ?></td>
                                            <td><?php echo date('M d, Y H:i', strtotime($cycle['cycle_updated_at'])); ?></td>
                                            <td>
                                                <a href="edit-cycle.php?id=<?php echo $cycle['cycle_id']; ?>" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="delete-cycle.php?id=<?php echo $cycle['cycle_id']; ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this cycle?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
               
    <footer class="py-4 mt-auto border-top" style="min-height: 74px">
        <div class="container-xl px-5">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
                <div class="me-sm-2">Copyright © safedaystracker.com <?php echo date("Y"); ?></div>
                <div class="d-flex ms-sm-2">
                    <a class="text-decoration-none" href="#!">Privacy Policy</a>
                    <div class="mx-1">·</div>
                    <a class="text-decoration-none" href="#!">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>