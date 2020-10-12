<?php
require_once 'config.php';
$sql = "SELECT * FROM formdata order by id desc";
$res = mysqli_query($conn , $sql);
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insert and load records without refreshing page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            .error{
                color:red;
                font-size:13px;
            }
            .message-wrap{
                background: #e6ecf0;
                color: #000;
                padding: 15px;
                margin-top:10px;
                margin-bottom: 10px;
            }
            .dn{
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container" style="max-width:800px;margin:0 auto;margin-top:50px;">  
            <div>
                <h2 style="margin-bottom:50px;">Insert and load records without refreshing page using Jquery,Ajax and Php </h2>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    <!--<textarea name="message" class="form-control" id="message"></textarea>-->
                    
                </div>
                <div class="form-group">
                    <label for="">City</label>
                    <input type="text" name="city" id="city" class="form-control">
                    <!--<textarea name="message" class="form-control" id="message"></textarea>-->
                    
                </div>
                <div class="form-group">
                    <label for="">Occupation</label>
                    <input type="text" id="occupation" name="occupation" class="form-control">
                    <!--<textarea name="message" class="form-control" id="message"></textarea>-->
                    <div class="error" id="error_message"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" id="save">Submit</button>
                </div>

                <div class="display-content">
                    <table class="table table-bordered all_data">
                        <tr class="table_header">
                            <th>Name</th>
                            <th>City</th>
                            <th>Occupation</th>
                        </tr>
                        <?php
                        while($row = mysqli_fetch_array($res))
                        {
                            echo "<tr>";
                            echo "<td>{$row['name']} </td>";
                            echo "<td>{$row['city']} </td>";
                            echo "<td>{$row['occupation']} </td>";
                            echo "</tr>";
                        }
                         ?>
                    

                    </table>
                    <div class="message-wrap dn">                      
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).on("click", "#save", function () {
                //get value of message 
                //var message = $("#message").val();
                var name = $("#name").val();
                var city = $("#city").val();
                var occupation = $("#occupation").val();
                //check if value is not empty
                if (name == "" ) {
                    $("#error_message").html("Please enter message");
                    return false;
                } else {
                    $("#error_message").html("");
                }

                function reset_form(){
                    $("#name").val("");
                    $("#city").val("");
                    $("#occupation").val("");
                }
                //Ajax call to send data to the insert.php
                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: {name: name, city:city, occupation:occupation},
                    cache: false,
                    success: function (data) {
                        // Insert new row after the table header (first row)
                        document.querySelector(".table_header").insertAdjacentHTML('afterend',data);
                        //Clear the textarea message
                        reset_form();
                    }
                });
            });
        </script>
    </body>
</html>