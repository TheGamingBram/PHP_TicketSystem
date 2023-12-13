<?php
    require('Functions.php');
    class Create extends DB_Connection{
        public function CreateTicket($Ticket_Subject, $Ticket_Priority, $Ticket_Message, $Ticket_Attachments, $User_Name, $User_Email){
            $result = false;
            return $result;
        }
        private function CheckData_Subject($Ticket_Subject){}
        private function CheckData_Priority($Ticket_Priority){}
        private function CheckData_Message($Ticket_Message){}
        private function CheckData_Attachments($Ticket_Attachments){}
        private function CheckData_USRName($User_Name){}
        private function CheckData_Email($User_Email){}
    }
?>