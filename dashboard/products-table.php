<div id="layoutDrawer_content">
                <main>
                    <!-- Main dashboard content-->
                    <div class="container-xl p-5">
                          
                         
                    <div class="row gx-5"> 
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               <div class="row align-items-center"> <div class="col"> <h5 class="card-title mb-0">Product Table</h5> </div> <div class="col text-end"> <button class="btn btn-dark">Add Product</button> </div> </div>
                                
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($productList as $product): ?>
                                            <tr>
                                                <td><?php echo $product['pid']; ?></td>
                                                <td><?php echo $product['name']; ?></td>
                                                <td><?php echo $product['price']; ?></td>
                                                <td><?php echo $product['status']; ?></td>
                                                <td><?php echo $product['createdAt']; ?></td>
                                                <td>
                                                    <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="submissions.php?id=<?php echo $product['id']; ?>" name="deleteProduct" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </main>
                <!-- Footer-->
                <!-- Min-height is set inline to match the height of the drawer footer-->
                <footer class="py-4 mt-auto border-top" style="min-height: 74px">
                    <div class="container-xl px-5">
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
                            <div class="me-sm-2">Copyright © Your Website 2023</div>
                            <div class="d-flex ms-sm-2">
                                <a class="text-decoration-none" href="#!">Privacy Policy</a>
                                <div class="mx-1">·</div>
                                <a class="text-decoration-none" href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>