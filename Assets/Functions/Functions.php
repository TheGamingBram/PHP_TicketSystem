<?php
    class DB_Connection{
        private $PDO_CONNECTION;

        public $connection_error = False;
        public $connection_error_message = "";


        public function __construct(){
            $DatabaseHost = "localhost";
            $DatabaseUsername = "root";
            $DatabasePassword = "";
            $DatabaseName = "php_ticketsystem";

            try {
                $this->PDO_CONNECTION = new PDO("mysql:host={$DatabaseHost};dbname={$DatabaseName}", $DatabaseUsername, $DatabasePassword);
            } catch (PDOException $e) {
                $this->connection_error = True;
                $this->connection_error_message = 'Connection failed: ' . $e->getMessage();
            }
        }

        public function Generate_Table(){
            $GetData = "SELECT * FROM ticket";
            $stmt = $this->PDO_CONNECTION->prepare($GetData);
            $stmt->execute();
            $GetData_OUT = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $Generated_Data ="";
            foreach ($GetData_OUT as $TicketData) {

                /* The code is performing a database query to count the number of rows in the
                "ticket_response" table where the "Ticket_id" column matches the current ticket's
                "Ticket_Id" value. */
                $GetData_ReactionCount = "SELECT COUNT(*) FROM ticket_response WHERE Ticket_id = ".$TicketData['Ticket_Id']."";
                $GetData_ReactionCount_Response = $this->PDO_CONNECTION->query($GetData_ReactionCount);
                $GetData_ReactionCount_Count = $GetData_ReactionCount_Response->fetchColumn();

                $Generated_Data .= "<tr>";
                    $Generated_Data .= "<td>" . $TicketData['Ticket_Id'] . "</td>";
                    $Generated_Data .= "<td>" . $TicketData['Ticket_Subject'] . "</td>";
                    $Generated_Data .= "<td data-order='".strtotime($TicketData['Ticket_DateTime'])."'>" . date("G:i - d/m/Y", strtotime($TicketData['Ticket_DateTime'])) . "</td>";
                    $Generated_Data .= "<td>" . "<a href='mailto: ".$TicketData['User_Email']."'>".$TicketData['User_Name']."</a>" . "</td>";
                    $Generated_Data .= "<td>" . $GetData_ReactionCount_Count . " Reaction" . "</td>";
                    $Generated_Data .= "<td>" . "<a href='ticket_view.php?ticket_id=".$TicketData['Ticket_Id']."'><button type='button' class='btn btn-primary'>View ticket</button></a>" . "</td>";
                $Generated_Data .= "</tr>";
            }
            return $Generated_Data;
        }
    }

    function CheckError($connection){
        $ErrorGen = "";

        if($connection->connection_error != False && $connection->connection_error_message != ""){
            $ErrorGen = "
            <nav class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Something went wrong!</h4>
                <hr>
                <p class='mb-0'>".$connection->connection_error_message."</p>
            </nav>
            ";
        }

        return $ErrorGen;
    }
    
?>