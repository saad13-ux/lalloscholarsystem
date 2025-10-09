<div class="container">
        <!-- Display requirements here -->
        <?php
        require '../../includes/pdo_conn.php';
        require '../../includes/functions.php';

        $params = allowOnly($_POST, ['id']);
        $query = $pdo->prepare("SELECT requirement_name, requirement_id FROM requirement_data WHERE scholarship_id = :id");
        $query->execute($params);

        $count = 1; // Initialize the requirement count

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $requirementName = $row['requirement_name'];
        ?>
        <div class="requirement-container">
            <div class="form-group row mb-2">
                <label class="control-label col-md-4 col-sm-3 col-xs-12">Requirement <?php echo $count; ?>:</label>
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <input class="form-control" type="text" id="file_name" name="requirement_name[]" value="<?= $requirementName ?>">
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <button type="button" class="btn btn-danger remove-btn" data-requirement-id="<?= $row['requirement_id']; ?>"><i class="fas fa-minus"></i> REMOVE</button>
            </div>
        </div>
        <?php
            $count++; // Increment the requirement count for the next iteration
        }
        ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // Event listener for remove buttons
            $('.remove-btn').on('click', function() {
                var requirementId = $(this).data('requirement-id'); // Get the requirement ID
                var requirementContainer = $(this).closest('.requirement-container'); // Find the common parent container

                // Send an AJAX request to delete the requirement
                $.ajax({
                    url: 'actions/delete_requirement.php',
                    type: 'POST',
                    data: {
                        id: requirementId,
                    },
                    success: function(response) {
                        if (response === 'success') {
                            // Display a success notification
                            var notification = $('<div class="alert alert-success">Requirement removed successfully.</div>');
                            $('.container').prepend(notification);

                            // Optionally, you can automatically hide the notification after a few seconds
                            setTimeout(function() {
                                notification.fadeOut('slow');
                            }, 3000);

                             // Remove the corresponding HTML elements after the notification is displayed
                             requirementContainer.remove(); // Remove the entire requirement container
                        } else {
                            // Display an error notification
                            var notification = $('<div class="alert alert-danger">Failed to remove requirement.</div>');
                            $('.container').prepend(notification);

                            // Optionally, you can automatically hide the notification after a few seconds
                            setTimeout(function() {
                                notification.fadeOut('slow');
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
