<?php
    require("./Assets/Functions/Functions.php");
    $DB_Connection = new DB_Connection;
    $ErrorGen = CheckError($DB_Connection);
    require("./Assets/HTML/Header.php");
?>
<html lang="en">
    <body>
        <div class="container">
            <table id="Ticket_View" class="table">
                <thead>
                    <tr>
                        <th>Ticket_ID</th>
                        <th>Ticket Subject</th>
                        <th>User</th>
                        <th>Date Submitted</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </body>
<html>
<script>
    let table = new DataTable('#Ticket_View', {
        bLengthChange: false,
        order: [[3, 'desc']],
        columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            }
        ]
    });
</script>