<?php
session_start();
// Sample data - replace with your database query
$cycles = [
    [
        'id' => 1,
        'period_start_date' => '2024-06-26',
        'next_period_start_date' => '2024-07-20',
        'added_at' => '2024-07-20 10:30:00',
        'updated_at' => '2024-07-20 10:30:00'
    ],
    [
        'id' => 2,
        'period_start_date' => '2024-07-20',
        'next_period_start_date' => '2024-08-16',
        'added_at' => '2024-08-16 09:15:00',
        'updated_at' => '2024-08-16 09:15:00'
    ],
    [
        'id' => 3,
        'period_start_date' => '2024-08-16',
        'next_period_start_date' => '2024-09-15',
        'added_at' => '2024-09-15 14:45:00',
        'updated_at' => '2024-09-15 14:45:00'
    ],
    [
        'id' => 4,
        'period_start_date' => '2024-09-15',
        'next_period_start_date' => '2024-10-14',
        'added_at' => '2024-10-14 11:20:00',
        'updated_at' => '2024-10-14 11:20:00'
    ],
    [
        'id' => 5,
        'period_start_date' => '2024-10-14',
        'next_period_start_date' => '2024-11-09',
        'added_at' => '2024-11-09 08:00:00',
        'updated_at' => '2024-11-09 08:00:00'
    ],
    [
        'id' => 6,
        'period_start_date' => '2024-11-09',
        'next_period_start_date' => '2024-12-04',
        'added_at' => '2024-12-04 16:30:00',
        'updated_at' => '2024-12-04 16:30:00'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cycles - Safe Days Tracker</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    <style>
        .card-header {
            background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%);
            color: white;
        }
        
        .card-header h5 {
            color: white;
            font-weight: 600;
        }
        
        .btn-dark {
            background: linear-gradient(135deg, #333 0%, #555 100%);
            border: none;
        }
        
        .btn-dark:hover {
            background: linear-gradient(135deg, #555 0%, #777 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .table thead th {
            background-color: #fef5f8;
            color: #EC407A;
            font-weight: 600;
            border-bottom: 2px solid #EC407A;
        }
        
        .table tbody tr:hover {
            background-color: #fff5f8;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #64b5f6 0%, #42a5f5 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #42a5f5 0%, #2196f3 100%);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
            border: none;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #e53935 0%, #d32f2f 100%);
        }
        
        /* DataTables styling */
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #ffe0eb;
            border-radius: 20px;
            padding: 5px 15px;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #EC407A;
            outline: none;
            box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.1);
        }
        
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #ffe0eb;
            border-radius: 5px;
            padding: 3px 10px;
        }
        
        .page-item.active .page-link {
            background-color: #EC407A;
            border-color: #EC407A;
        }
        
        .page-link {
            color: #EC407A;
        }
        
        .page-link:hover {
            color: #ff6b9d;
            background-color: #fff5f8;
            border-color: #ffe0eb;
        }
        
        .dataTables_info {
            color: #666;
        }
        
        /* Export buttons */
        .dt-buttons .btn {
            background: linear-gradient(135deg, #a8e6cf 0%, #7bd3b0 100%);
            border: none;
            color: white;
            margin-right: 5px;
            border-radius: 5px;
        }
        
        .dt-buttons .btn:hover {
            background: linear-gradient(135deg, #7bd3b0 0%, #5cc99c 100%);
        }
    </style>
</head>
<body>

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
                                        <th>Next Period Start Date</th>
                                        <th>Cycle Length</th>
                                        <th>Added At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cycles as $cycle): 
                                        // Calculate cycle length
                                        $start = new DateTime($cycle['period_start_date']);
                                        $end = new DateTime($cycle['next_period_start_date']);
                                        $cycleLength = $start->diff($end)->days;
                                    ?>
                                        <tr>
                                            <td><?php echo $cycle['id']; ?></td>
                                            <td><?php echo date('M d, Y', strtotime($cycle['period_start_date'])); ?></td>
                                            <td><?php echo date('M d, Y', strtotime($cycle['next_period_start_date'])); ?></td>
                                            <td>
                                                <span class="badge" style="background: <?php 
                                                    if ($cycleLength < 24) echo '#ef5350';
                                                    elseif ($cycleLength > 32) echo '#ff6b9d';
                                                    else echo '#7bd3b0';
                                                ?>; color: white; padding: 5px 12px; border-radius: 15px;">
                                                    <?php echo $cycleLength; ?> days
                                                </span>
                                            </td>
                                            <td><?php echo date('M d, Y H:i', strtotime($cycle['added_at'])); ?></td>
                                            <td><?php echo date('M d, Y H:i', strtotime($cycle['updated_at'])); ?></td>
                                            <td>
                                                <a href="edit-cycle.php?id=<?php echo $cycle['id']; ?>" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="delete-cycle.php?id=<?php echo $cycle['id']; ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this cycle?')">
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

    <footer class="py-4 mt-auto border-top" style="min-height: 74px; background: #fef5f8;">
        <div class="container-xl px-5">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
                <div class="me-sm-2" style="color: #666;">Copyright © safedaystracker.com <?php echo date('Y'); ?></div>
                <div class="d-flex ms-sm-2">
                    <a class="text-decoration-none" href="#!" style="color: #EC407A;">Privacy Policy</a>
                    <div class="mx-1" style="color: #999;">·</div>
                    <a class="text-decoration-none" href="#!" style="color: #EC407A;">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Export buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#cyclesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[0, 'desc']], // Sort by ID descending (newest first)
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>Brtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="bi bi-clipboard"></i> Copy',
                className: 'btn-sm'
            },
            {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                className: 'btn-sm',
                title: 'Safe Days Cycles Export'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                className: 'btn-sm',
                title: 'Safe Days Cycles Export'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Print',
                className: 'btn-sm'
            }
        ],
        language: {
            search: "Search cycles:",
            lengthMenu: "Show _MENU_ cycles per page",
            info: "Showing _START_ to _END_ of _TOTAL_ cycles",
            infoEmpty: "No cycles available",
            infoFiltered: "(filtered from _MAX_ total cycles)",
            zeroRecords: "No matching cycles found",
            emptyTable: "No cycles recorded yet. Click 'Add New Cycle' to get started!"
        }
    });
});
</script>

</body>
</html>