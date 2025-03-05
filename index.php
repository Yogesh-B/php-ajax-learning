<!DOCTYPE html>
<html>

<head>
    <title>PHP Ajax demo</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <table id="main" border="0" cellspacing="0">
        <tr>
            <td id="header">
                <h1>PHP with Ajax - Add/Delete data</h1>
            </td>
        </tr>
        <tr>
            <td>
                <form id="add-form">
                    <label for="first-name">First Name : </label><input type="text" id="first-name">
                    <label for="last-name">Last Name : </label><input type="text" id="last-name">
                    <input type="button" id="save-button" value="Save Data">
                </form>
            </td>
        </tr>
        <tr>
            <td id="table-data">
            </td>
        </tr>
    </table>
    <div id="error-message"></div>
    <div id="success-message"></div>


    <script type="text/javascript" src="./js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "ajax-load.php",
                    method: "POST",
                    success: function(data) {
                        $('#table-data').html(data);
                    },

                });
            }
            loadTable();

            $('#save-button').on('click', function(e) {
                e.preventDefault();
                let first_name = $('#first-name').val();
                let last_name = $('#last-name').val();

                if (first_name == "" || last_name == "") {
                    $('#error-message').html("All fields are required!!").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {
                            first_name,
                            last_name
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                                $('#add-form').trigger('reset');
                                $('#success-message').html("Record inserted successfully!").slideDown();
                                $("#error-message").slideUp();

                            } else {
                                $('#error-message').html("Couldn't Save Record!").slideDown();
                                $("#success-message").slideUp();
                            }
                        },
                    });
                }
            });

            $(document).on('click', '.delete-btn', function(e) {
                if(confirm(`Do you really want to delete record ${$(e.target).data("id")}?`)){
                    const id = $(e.target).data('id');
                    $.ajax({
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {
                            id
                        },
                        success: function(data) {
                            if (data == 1) {
                                $(e.target).closest('tr').fadeOut();
                            } else {
                                $('#error-message').html("Could not delete record!!").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }
            });
//#3 lectures completed
        });
    </script>
</body>

</html>