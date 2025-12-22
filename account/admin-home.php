<div id="layoutDrawer_content">
                <main>
                    <div class="container-xl p-5">
                        <div class="row justify-content-between align-items-center mb-5">
                            <div class="col flex-shrink-0 mb-5 mb-md-0">
                                <h1 class="display-4 mb-0">Dashboard</h1>
                            </div>
                        </div>
                        <!-- Colored status cards-->
                        <div class="row gx-5">
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5"><h1>10</h1></div>
                                                <div class="card-text">Total months</div>
                                            </div>
                                            <div class="icon-circle bg-primary text-white"><i class="material-icons">download</i></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5"><h1>10</h1></div>
                                                <div class="card-text">Total months</div>
                                            </div>
                                            <div class="icon-circle bg-primary text-white"><i class="material-icons">download</i></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5"><h1>10</h1></div>
                                                <div class="card-text">Total months</div>
                                            </div>
                                            <div class="icon-circle bg-primary text-white"><i class="material-icons">download</i></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5"><h1>10</h1></div>
                                                <div class="card-text">Total months</div>
                                            </div>
                                            <div class="icon-circle bg-primary text-white"><i class="material-icons">download</i></div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-5">
                            <div class="col-lg-12 mb-5">
                                <div class="card card-raised h-100">                                   
                                    <div class="card-body p-4">
                                        


                                            <div class="header-section">
                                                <div class="logo-title">
                                                    <div class="logo">🌸</div>
                                                    <h1>Your Cycle Calendar</h1>
                                                </div>
                                                <p class="month-title"><?= date('F Y') ?></p>
                                            </div>

                                            <div class="calendar-card">
                                                <div class="legend">
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-menstruation"></div>
                                                        <span><strong>Menstruation</strong><br>Period days</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-follicular"></div>
                                                        <span><strong>Follicular Phase</strong><br>Pre-ovulation</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-fertile"></div>
                                                        <span><strong>Fertile Window</strong><br>High chance</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-ovulation"></div>
                                                        <span><strong>Ovulation Peak</strong><br>Highest fertility</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-luteal"></div>
                                                        <span><strong>Luteal Phase</strong><br>Post-ovulation</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-box legend-safe"></div>
                                                        <span><strong>Safe Days</strong><br>Less fertile</span>
                                                    </div>
                                                </div>

                                                <div class="calendar">
                                                    <!-- Weekday headers -->
                                                    <div class="header">Sun</div>
                                                    <div class="header">Mon</div>
                                                    <div class="header">Tue</div>
                                                    <div class="header">Wed</div>
                                                    <div class="header">Thu</div>
                                                    <div class="header">Fri</div>
                                                    <div class="header">Sat</div>

                                                    <!-- Empty slots for days before the first day -->
                                                    <?php for ($i = 0; $i < $startDayOfWeek; $i++): ?>
                                                        <div class="empty"></div>
                                                    <?php endfor; ?>

                                                    <!-- Days of the month -->
                                                    <?php 
                                                    for ($day = 1; $day <= $daysInMonth; $day++):
                                                        // Create timestamp for current calendar day
                                                        $currentDayTimestamp = mktime(0, 0, 0, $month, $day, $year);
                                                        $lastPeriodFullTimestamp = mktime(0, 0, 0, $lastPeriodMonth, $lastPeriodDay, $lastPeriodYear);
                                                        
                                                        // Calculate days since last period started
                                                        $daysSinceLastPeriod = floor(($currentDayTimestamp - $lastPeriodFullTimestamp) / (60 * 60 * 24));
                                                        
                                                        // Calculate cycle day (1-based)
                                                        $dayOfCycle = ($daysSinceLastPeriod % $cycleLength) + 1;
                                                        if ($daysSinceLastPeriod < 0) {
                                                            // Before last period - calculate from previous cycle
                                                            $dayOfCycle = $cycleLength + $daysSinceLastPeriod + 1;
                                                        }
                                                        
                                                        // Determine phase and class based on cycle day
                                                        if ($dayOfCycle >= 1 && $dayOfCycle <= $periodLength) {
                                                            $class = 'menstruation';
                                                            $phase = 'Period';
                                                        } elseif ($dayOfCycle > $periodLength && $dayOfCycle < $displayFertileStart) {
                                                            // Follicular phase: after period but before fertile window
                                                            $class = 'follicular';
                                                            $phase = 'Follicular';
                                                        } elseif ($dayOfCycle >= $ovulationDay && $dayOfCycle <= $ovulationDayEnd) {
                                                            // Peak ovulation days (2 days in middle of fertile window)
                                                            $class = 'ovulation';
                                                            $phase = 'Ovulation';
                                                        } elseif ($dayOfCycle >= $displayFertileStart && $dayOfCycle <= $fertileEnd) {
                                                            // Fertile window (includes days around ovulation)
                                                            $class = 'fertile';
                                                            $phase = 'Fertile';
                                                        } elseif ($dayOfCycle > $fertileEnd && $dayOfCycle <= $cycleLength) {
                                                            $class = 'luteal';
                                                            $phase = 'Luteal';
                                                        } else {
                                                            $class = 'safe';
                                                            $phase = 'Safe';
                                                        }
                                                    ?>
                                                        <div class="day <?= $class ?>">
                                                            <?= $day ?>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="stats-grid">
                                                <div class="stat-box">
                                                    <div class="stat-number"><?= $shortest ?></div>
                                                    <div class="stat-label">Shortest Cycle</div>
                                                </div>
                                                <div class="stat-box">
                                                    <div class="stat-number"><?= $average ?></div>
                                                    <div class="stat-label">Average Cycle</div>
                                                </div>
                                                <div class="stat-box">
                                                    <div class="stat-number"><?= $longest ?></div>
                                                    <div class="stat-label">Longest Cycle</div>
                                                </div>
                                                <div class="stat-box">
                                                    <div class="stat-number"><?= ($fertileEnd - $displayFertileStart + 1) ?></div>
                                                    <div class="stat-label">Fertile Days</div>
                                                </div>
                                            </div>

                                            <div class="info-card">
                                                <h3><span class="warning-icon">⚠️</span> Important Information</h3>
                                                <p>
                                                    This calendar shows your menstrual cycle phases for <?= date('F Y') ?> based on your cycle data.
                                                    <br><strong>Menstruation</strong> is your period (days 1-<?= $periodLength ?>). 
                                                    <br><strong>Follicular Phase</strong> is when your body prepares for ovulation. 
                                                    <br><strong>Fertile Window</strong> (light pink) is when pregnancy is possible (days <?= $displayFertileStart ?>-<?= $fertileEnd ?>). 
                                                    <br><strong>Ovulation Peak</strong> (dark pink) is when you're MOST fertile - typically days <?= $ovulationDay ?>-<?= $ovulationDayEnd ?>. 
                                                    <br><strong>Luteal Phase</strong> is after ovulation. 
                                                    <strong>Safe Days</strong> have lower fertility. 
                                                    
                                                </p>
                                            </div>



                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">                            
                        </div>                      
                    </div>
                </main>
                <footer class="py-4 mt-auto border-top" style="min-height: 74px">
                    <div class="container-xl px-5">
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
                            <div class="me-sm-2 align-items-center justify-content-sm-center">Copyright © safedaystracker.com <?php echo date("Y"); ?></div>
                        </div>
                    </div>
                </footer>
            </div>