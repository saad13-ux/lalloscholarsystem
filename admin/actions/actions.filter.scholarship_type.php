<?php

if (isset($_POST['filter_scholarship_type'])) {
    header("location: ../scholarships.php?scholarship_type=" . $_POST['scholarship_type']);
} else {
    header("location: ../scholarships.php");
}
