
<?php
include "conn.php";

if(isset($_POST['zip'])){
    $zipcode = $_POST['zip'];

    $zipcode = mysqli_query($conn, "SELECT municipality_name FROM table_municipality WHERE municipality_zipcode='$zipcode'");
    while ($zipresult = mysqli_fetch_array($zipcode)) {
        echo $result1 = "<option value=" . $zipresult['municipality_name'] . ">" . $zipresult['municipality_name'] . "</option>";
    }
}
if(isset($_POST['zipp'])){
    $zipcode = $_POST['zipp'];
    
    $result1 = "<option>Select Barangay</option>";
    $statement = mysqli_query($conn,"SELECT barangay_name FROM table_barangay inner join table_municipality on table_barangay.municipality_id=table_municipality.municipality_id WHERE table_municipality.municipality_zipcode='$zipcode'");

    while ($result = mysqli_fetch_array($statement)) {
        $result1 .= "<option value=" . $result['barangay_name'] . ">" . $result['barangay_name'] . "</option>";
    }
    echo $result1;
}
if(isset($_POST['zip1'])){
    $zipcode = $_POST['zip1'];

    $zipcode = mysqli_query($conn, "SELECT province_name FROM table_municipality inner join table_province on table_municipality.province_id=table_province.province_id WHERE table_municipality.municipality_zipcode='$zipcode'");
    while ($zipresult = mysqli_fetch_array($zipcode)) {
        echo $result1 = "<option value=" . $zipresult['province_name'] . ">" . $zipresult['province_name'] . "</option>";
    }
}
if(isset($_POST['zip2'])){
    $zipcode = $_POST['zip2'];

    $zipcode = mysqli_query($conn, "SELECT * FROM table_municipality inner join table_province on table_municipality.province_id=table_province.province_id inner join table_region on table_province.region_id=table_region.region_id WHERE table_municipality.municipality_zipcode='$zipcode'");
    while ($zipresult = mysqli_fetch_array($zipcode)) {
        echo $result1 = "<option value=" . $zipresult['region_description'] . ">" . $zipresult['region_description'] . "</option>";
    }
}

$regionId = isset($_POST['regionId']) ? $_POST['regionId'] : 0;
$provinceId = isset($_POST['provinceId']) ? $_POST['provinceId'] : 0;
$municipalityId = isset($_POST['municipalityId']) ? $_POST['municipalityId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "region":
        $sql = "SELECT region_id,region_description FROM table_region";
        $dt = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['region_id'] . ">" . $result['region_description'] . "</option>";
        }
        break;
    case "province":
        $result1 = "<option>Select Province</option>";
        $statement = "SELECT province_id,province_name FROM table_province WHERE region_id=" . $regionId;
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['province_id'] . ">" . $result['province_name'] . "</option>";
        }
        echo $result1;
        break;
    case "municipality":
        $result1 = "<option>Select Municipality</option>";
        $statement = "SELECT municipality_id,municipality_name FROM table_municipality WHERE province_id=" . $provinceId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['municipality_id'] . ">" . $result['municipality_name'] . "</option>";
        }
        echo $result1;
        break;

    case "barangay":
        $result1 = "<option>Select Barangay</option>";
        $statement = "SELECT barangay_id, barangay_name FROM table_barangay WHERE municipality_id=" . $municipalityId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['barangay_id'] . ">" . $result['barangay_name'] . "</option>";
        }
        echo $result1;
        break;

}

exit();
?>