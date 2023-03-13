<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'contact_db';

$mysqli = new mysqli($host, $username, $password, $db);

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $guests = $_POST['guests'];
   $guests = filter_var($guests, FILTER_SANITIZE_STRING);

   $select_contact = $mysqli->query("SELECT * FROM `contact_form` WHERE name ='$name' AND number = '$number' AND guests = '$guests'");

   if($select_contact->num_rows > 0){
      $message = 'Message sent already!';
   }else{
      $insert_contact = $mysqli->query("INSERT INTO `contact_form`(name, number, guests) VALUES('$name','$number','$guests')");
      $message = 'Message sent successfully!';
   }
   echo '
   <div class="message">
      <span>'.$message.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';

   $result = $mysqli->query("select * from `contact_form`");
   if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         echo '
         <div class="message">
            <span>'.$row['name'].'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
}

?>

<?php


?>