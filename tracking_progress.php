<div class="tracking-progress">
    <?php
    $i = 1;
    $stmt = $pdo->query(
        "SELECT * FROM user_application AS ua INNER JOIN scholarship AS s ON ua.scholarship_id = s.scholarship_id INNER JOIN user AS u ON ua.user_id = u.user_id  
        WHERE u.user_id = '$_SESSION[$session_user_id]'"
    );
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $datetimeValuestart = $row['date_applied'];
        $timestampstart = strtotime($datetimeValuestart);
        $startformattedDate = date('F d, Y h:i A', $timestampstart);

        $datetimeValueupdate = $row['dt_updated'];
        $timestampupdate = strtotime($datetimeValueupdate);
        $updateformattedDate = date('F d, Y h:i A', $timestampupdate);
    ?>
        <h6><strong><span class='badge badge-info'><i class="fas fa-calendar"></i></span>&nbsp;Date Applied:</strong><br><?= $startformattedDate ?></h6>
        <article class="card" style="border-radius: 1px solid black;">
            <div class="card-body row">
                <div class="col-md-12">
                    <span class='badge badge-info'><i class="fas fa-check"></i></span>
                    <p>&nbsp;Congratulation,&nbsp;<strong><?= $row['first_name'] ?>&nbsp;<?= $row['middle_name'] ?>&nbsp;<?= $row['last_name'] ?></strong>&nbsp;
                        We are pleased to inform you that your <?= $row['scholarship_type'] ?> application for scholarship assistance has been submitted.
                    </p>
                </div>
            </div>
        </article>
        <h6><strong><span class='badge badge-info'><i class="fas fa-calendar"></i></span>&nbsp;Updated:</strong><br><?= $updateformattedDate ?></h6>
        <article class="card">
            <div class="card-body row">
                <div class="col-md-12">
                    <?php if ($row['approved'] == '0') { ?>
                        <span class='badge badge-warning'><i class="fa fa-hourglass" aria-hidden='true'></i></span>
                        <p>&nbsp;Hello <strong> <?= $row['first_name'] ?>&nbsp;<?= $row['middle_name'] ?>&nbsp;<?= $row['last_name'] ?>,</strong>
                            We are pleased to inform you that your <?= $row['scholarship_type'] ?> application for scholarship assistance has been processed.<br>
                            Thank you for understanding!.
                        </p>
                    <?php } else if ($row['approved'] == '1') { ?>
                        <span class='badge badge-success'><i class='fa fa-thumbs-up' aria-hidden='true'></i></span>
                        <p>&nbsp;Hello <strong> <?= $row['first_name'] ?>&nbsp;<?= $row['middle_name'] ?>&nbsp;<?= $row['last_name'] ?>,</strong>
                            We are pleased to inform you that your <?= $row['scholarship_type'] ?> application for scholarship assistance has been accepted.<br>
                            Scholarship committee has selected you as one of the scholarship recipients based on the qualifications attached to your profile.<br>
                            Congratulations and wish you all the best on your journey!.
                        </p>
                    <?php } else { ?>
                        <span class='badge badge-danger'><i class='fa fa-thumbs-down' aria-hidden='true'></i></span>
                        <p>&nbsp;Hello <strong> <?= $row['first_name'] ?>&nbsp;<?= $row['middle_name'] ?>&nbsp;<?= $row['last_name'] ?>,</strong>
                            Once again, we thank you for your time and interest in applying with us.<br>
                            Unfortunately, we have decided not to move forward with your <?= $row['scholarship_type'] ?> application at this time. However, we have a great suggestion on how you can still apply. Try reading other scholarship programs and apply now.<br>
                            You can learn more about it on our website.<br>
                            All the best,<br>
                            Lal-lo Shines Even Brighter!.
                        </p>
                    <?php }; ?>
                </div>
            </div>
        </article>
        <article class="card">
            <div class="card-body row">
                <div class="col">
                    <?php if ($row['claimed'] == '1') { ?>
                        <span class='badge badge-success'><i class="fa-solid fa-person-circle-check" aria-hidden='true'></i></span>
                        <p>&nbsp;Hello <strong> <?= $row['first_name'] ?>&nbsp;<?= $row['middle_name'] ?>&nbsp;<?= $row['last_name'] ?>,</strong>
                            We are pleased to inform you that your <?= $row['scholarship_type'] ?> application for scholarship assistance has been claimed.<br>
                            Lal-lo Shines Even Brighter!.
                        <?php }; ?>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
