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

    <div id="edit-modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpadding="10px" width="100%">
            <tr>
                <td></td>
                <td><input type='text' id='edit-id' hidden></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type='text' id='edit-fname' ></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type='text' id='edit-lname' ></td>
            </tr>
            <tr>
                <td></td>
                <td><input type='submit' id='edit-submit' value='Update'></td>
            </tr>

            </table>
            <div id="close-btn">X</div>
        </div>
    </div>

    <script type="text/javascript" src="./js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //load table data
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

            //save data
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

            //delete data
            $(document).on('click', '.delete-btn', function(e) {
                if (confirm(`Do you really want to delete record ${$(e.target).data("id")}?`)) {
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

            //show edit modal, and update the data
            $(document).on('click', '.edit-btn', function(e) {
                $("#edit-modal").show();
                const id = $(this).data('id');
                // $.ajax({  //in tutorial used ajax, but we will get from DOM. Saving network a bit.
                //     url: "ajax-load-update.php",
                //     type:"POST",
                //     data: {
                    //         id,
                    //     },
                    //     success: function(data){
                        //         $('#modal-form table').html(data);
                        //         console.log(data);
                        //     },
                        // });
                const fname = $(this).closest('tr').find('.fname').text();
                const lname = $(this).closest('tr').find('.lname').text();
                
                $('#edit-id').val(id);
                $('#edit-fname').val(fname);
                $('#edit-lname').val(lname);
                saveEdit();

            });



            //close edit modal
            function closeEditModal() {
                $('#edit-modal').hide();
                $('#edit-id').val('');
                $('#edit-fname').val('');
                $('#edit-lname').val('');

            }
            $('#close-btn').on('click', function() {
                closeEditModal();
            });
            $(document).keydown(function(event) {
                if (event.key == "Escape") {
                    closeEditModal();
                }
            });


            function saveEdit(){
                $('#edit-submit').on('click', function(e) {
                e.preventDefault();
                let id = $('#edit-id').val();
                let first_name = $('#edit-fname').val();
                let last_name = $('#edit-lname').val();

                if (first_name == "" || last_name == "") {
                    $('#error-message').html("All fields are required!!").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "ajax-update.php",
                        type: "POST",
                        data: {
                            id,
                            first_name,
                            last_name
                        },
                        success: function(data) {
                            closeEditModal();
                            if (data == 1) {
                                loadTable();
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
            }
        });
    </script>
</body>

</html>