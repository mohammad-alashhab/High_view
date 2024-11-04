<?php require 'partials/header.php'; ?>

<h5>Profile Information</h5>
<hr>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($userP['first_name'] . " " . $userP['last_name']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($userP['email']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($userP['phone']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($userP['city'] . ", " . $userP['district'] . ", " . $userP['street'] . ", " . $userP['building_num']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-warning btn-custom mb-3" onclick="appear()">Edit Your Profile</button>
    </div>

    <div style="display:none;" id="edit" class="custom-card">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <form method="post" action="/user/edit" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12">
                                <h6 class="mb-2 text-warning">Personal Details</h6>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo htmlspecialchars($userP['first_name']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Enter last name" value="<?php echo htmlspecialchars($userP['last_name']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email ID" value="<?php echo htmlspecialchars($userP['email']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="newPassword">New Password (leave blank to keep current password)</label>
                                    <input type="password" class="form-control" name="newPassword" placeholder="Enter new password">
                                </div>
                            </div>


                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" value="<?php echo htmlspecialchars($userP['phone']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="image">Upload Image (Optional)</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>


                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12">
                                <h6 class="mt-3 mb-2 text-warning">Address</h6>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php echo htmlspecialchars($userP['city']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <input type="text" class="form-control" name="district" placeholder="Enter district" value="<?php echo htmlspecialchars($userP['district']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" name="street" placeholder="Enter Street" value="<?php echo htmlspecialchars($userP['street']); ?>">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="buildingNumber">Building Number</label>
                                    <input type="text" class="form-control" name="b_number" placeholder="Building number" value="<?php echo htmlspecialchars($userP['building_num']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12">
                                <div class="text-right">
                                    <button type="button" class="btn btn-secondary" onclick="hide()">Cancel</button>
                                    <button type="submit" id="submitBtn" class="btn btn-warning">Update</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</main>
<!-- page-content -->
</div>
<!-- page-wrapper -->
<?php require('partials/footer.php'); ?>

<?php


if (isset($_SESSION['status']) && isset($_SESSION['message'])):
    // Debug line to check status and message
    echo "<!-- Status: {$_SESSION['status']}, Message: {$_SESSION['message']} -->";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast('<?php echo $_SESSION['status']; ?>', '<?php echo $_SESSION['message']; ?>', 'submitBtn'); // Pass the button ID here
        });
    </script>
    <?php
    // Clear the message after displaying
    unset($_SESSION['status']);
    unset($_SESSION['message']);
endif;

// Check if there are validation errors
if (isset($_SESSION['errors'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const errors = <?php echo json_encode($_SESSION['errors']); ?>;
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: errors.map(err => `<p>${err}</p>`).join(''), // Display errors in a list
                confirmButtonText: 'OK'
            });
            // Clear the errors after displaying
            <?php unset($_SESSION['errors']); ?>
        });
    </script>
<?php endif; ?>
