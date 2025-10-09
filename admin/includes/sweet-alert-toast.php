<script>
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });


    <?php
    if ($_SESSION['success'] ?? false) {
    ?>
        Toast.fire({
            icon: "success",
            title: "<?= $_SESSION['success'] ?>",
        });
    <?php
    } else if ($_SESSION['error'] ?? false) {
    ?>
        Toast.fire({
            icon: "error",
            title: "<?= $_SESSION['error'] ?>",
        });
    <?php
    }
    unset($_SESSION['success']);
    unset($_SESSION['error']);
    ?>
</script>