<?php
require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';
?>


        <?php
        $params = allowOnly($_POST, ['application_id']);
        $query = $pdo->prepare("SELECT *, DATE_FORMAT(dob, '%M %d, %Y') as bdate FROM beneficiary_family_comp as f WHERE application_id = :application_id");
        $query->execute($params);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td style="font-size:12px; "><label><?= $row['last_name'] ?></label></td>
                <td colspan="2" style="font-size: 12px;"><label><?= $row['first_name'] ?></label></td>
                <td colspan="2" style="font-size: 12px; "><label><?= $row['middle_name'] ?></label></td>
                <td  style="font-size: 12px; "><label><?= $row['gender'] ?></label></td>
                <td  style="font-size: 12px;"><label><?= $row['bdate'] ?></label></td>
                <td  style="font-size: 12px;"><label><?= $row['civil_status'] ?></label></td>
                <td  style=" font-size: 12px; "><label><?= $row['relationship'] ?></label></td>
                <td colspan="2"style=" font-size: 12px; ;"><label><?= $row['highest_education'] ?></label></td>
                <td colspan="2"style=" font-size: 12px; "><label><?= $row['skill_occupation'] ?></label></td>
                <td colspan="2"style=" font-size: 12px; f"><label><?= $row['est_monthly_income'] ?></label></td>

            </tr>
        <?php } ?>
