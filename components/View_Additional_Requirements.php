<?php
require '../includes/pdo_conn.php';

require '../includes/functions.php';
        
        $params = allowOnly($_POST, ['scholarship_id']);
        $query = $pdo->prepare("SELECT requirement_name  FROM requirement_data  WHERE scholarship_id = :scholarship_id");
        $query->execute($params);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            
        ?>
        <div class="col-md-6 mb-3">
        <label for="indigency"><?= $row['requirement_name'] ?></label>
        <input type="hidden" id="file_name" name="file_name[]" value="<?= $row['requirement_name'] ?>">
        <input type="file" id="file_file" name="file_file[]" required accept=".doc,.docx,.pdf,.jpeg,.jpg,.png">
        </div>
        <?php } ?>


    