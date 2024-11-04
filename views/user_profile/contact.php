<?php require 'partials/header.php'; ?>
<h5>Recent Messages</h5>
<hr>

<div class="row">
    <section style="background-color: #FEFEFC;">
        <?php foreach ($contacts as $contact) : ?>
        <div class="container mb-5">
            <div class="card text-body mb-4" style="width: 1000px; margin: 0 auto;"> <!-- Added mb-4 for spacing -->
                <div class="card-body p-4">
                    <h4 class="mb-0">Recent Messages</h4>
                    <p class="fw-light">Latest messages by YOU</p>

                    <h6 class="fw-bold mb-1"><?php echo $contact['message']; ?></h6>

                    <div>
                        <p>
                            <?php
                            if ($contact['status'] == 'replied') {
                                echo " <span class='badge bg-primary'>".$contact['status']."</span>";
                                echo $contact['reply'];
                            } else {
                                echo " <span class='badge bg-danger'>".$contact['status']."</span>";
                            }
                            ?>

                        </p>
                    </div>

                    <p>

                    </p>

                    <hr />
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<hr>
<?php require 'partials/footer.php'; ?>
