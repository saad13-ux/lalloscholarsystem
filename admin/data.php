<?php
// data.php
require "../includes/pdo_conn.php";

if (isset($_POST["action"])) {
    $filter = isset($_POST["filter"]) ? $_POST["filter"] : 'all';

    // -----------------------------
    // 1. TOTAL APPLICATION STATUS
    // -----------------------------
    if ($_POST["action"] == 'fetch') {
        $query = "
            SELECT approved, COUNT(application_id) AS Total 
            FROM user_application 
            INNER JOIN scholarship ON user_application.scholarship_id=scholarship.scholarship_id
        ";
        if ($filter !== 'all') {
            $query .= " WHERE scholarship_type = :filter";
        }
        $query .= " GROUP BY approved";

        $stmt = $pdo->prepare($query);
        if ($filter !== 'all') {
            $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($result as $row) {
            if ($row["approved"] == 0) $status = "PENDING";
            else if ($row["approved"] == 1) $status = "APPROVED";
            else if ($row["approved"] == 3) $status = "ONGOING";
            else $status = "DECLINED";

            $data[] = [
                'approved' => $status,
                'total' => $row["Total"],
                'color' => sprintf("#%06X", mt_rand(0, 0xFFFFFF))
            ];
        }
        echo json_encode($data);
    }

    // -----------------------------
    // 2. TOTAL SCHOLARSHIP GENDER
    // -----------------------------
    if ($_POST["action"] == 'fetch2') {
        $query = "
            SELECT b_gender, COUNT(application_id) AS Total 
            FROM user_application 
            INNER JOIN scholarship ON user_application.scholarship_id=scholarship.scholarship_id
        ";
        if ($filter !== 'all') {
            $query .= " WHERE scholarship_type = :filter";
        }
        $query .= " GROUP BY b_gender";

        $stmt = $pdo->prepare($query);
        if ($filter !== 'all') {
            $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'gender' => $row["b_gender"],
                'total' => $row["Total"],
                'color' => sprintf("#%06X", mt_rand(0, 0xFFFFFF))
            ];
        }
        echo json_encode($data);
    }

    // -----------------------------
    // 3. TOTAL SCHOLARSHIP PROGRAM APPLICANTS
    // -----------------------------
    if ($_POST["action"] == 'fetch4') {
        $query = "
            SELECT scholarship_type, COUNT(application_id) AS Total 
            FROM user_application 
            INNER JOIN scholarship ON user_application.scholarship_id=scholarship.scholarship_id
        ";
        if ($filter !== 'all') {
            $query .= " WHERE scholarship_type = :filter";
        }
        $query .= " GROUP BY scholarship_type";

        $stmt = $pdo->prepare($query);
        if ($filter !== 'all') {
            $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'type' => $row["scholarship_type"],
                'total' => $row["Total"],
                'color' => sprintf("#%06X", mt_rand(0, 0xFFFFFF))
            ];
        }
        echo json_encode($data);
    }

// -----------------------------
// 4. TOTAL BARANGAY (Approved) with Scholarship Type
// -----------------------------
if ($_POST["action"] == 'fetch3') {
    $query = "
        SELECT ua.barangay, s.scholarship_type, COUNT(ua.application_id) AS total
        FROM user_application ua
        INNER JOIN scholarship s ON ua.scholarship_id = s.scholarship_id
        WHERE ua.approved = 1
    ";
    if ($filter !== 'all') {
        $query .= " AND s.scholarship_type = :filter";
    }
    $query .= " GROUP BY ua.barangay, s.scholarship_type
                ORDER BY ua.barangay, s.scholarship_type";

    $stmt = $pdo->prepare($query);
    if ($filter !== 'all') {
        $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return raw data; JS will handle colors
    echo json_encode($result);
    exit();
}


}
