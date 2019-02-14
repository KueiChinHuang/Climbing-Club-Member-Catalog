<?php 

require('includes/header.php');

echo '<div class="inner">
<h1> Climbing Club Database!</h1>';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// add the movie id in case you are editing 
$id = NULL;
//set up a flag variable 
$ok = true; 

if(isset($_POST['submit'])){
  try {
    $id = $_POST['id']; 
    // store the form inputs in variables
    $name = filter_input(INPUT_POST, test_input('name'));
    $email =  filter_input(INPUT_POST, 'email');
    $city =  filter_input(INPUT_POST, test_input('city'));
    $skill =  filter_input(INPUT_POST, test_input('skill'));
    $experience =  filter_input(INPUT_POST, test_input('experience'));

  
    if (empty($name)) {
      $ok = false; 
      echo "<p>Name is required</p>";
    } else {
      $name = test_input($name);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $ok = false; 
        echo "<p>Only letters and white space allowed in Name</p>"; 
      }
    }
    
    if (empty($email)) {
      $ok = false; 
      echo '<p>Email is required</p>';
    } else {
      $email = test_input($email);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ok = false; 
        echo '<p>Invalid email format</p>'; 
      }
    }
    
    if (empty($city)) {
      $ok = false; 
      echo "<p>Name is required</p>";
    } else {
      $city = test_input($city);
      // check if city only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
        $ok = false; 
        echo "<p>Only letters and white space allowed in City</p>"; 
      }
    }

    if ($skill == 0 ){
      $ok = true; 
    } else if (empty($skill)) {
      $ok = false; 
      echo '<p>Skill is required</p>';
    } else if (!filter_var($skill, FILTER_VALIDATE_INT)) {
      $ok = false; 
      echo '<p>Invalid skill format</p>'; 
    } 
    else if ($skill < 0 || $skill > 10 ) {
      $ok = false; 
      echo '<p>Invalid skill level</p>'; 
    }

    if(empty($experience)) {
      $ok = false; 
      echo '<p>Please choose your experience of climbing</p>';  
    }

    
    if($ok === TRUE) {

      //cnnect t dab
      require('includes/db.php'); 
    
      if(!empty($id)) {
        $sql = "UPDATE climbingclub SET name = :name, email = :email, city = :city, skill = :skill, experience = :experience WHERE id = :id";       
      }
      else {            
        $sql = "INSERT INTO climbingclub(name, email, city, skill, experience) VALUES (:name, :email, :city, :skill, :experience)";
      }
    
      $cmd = $conn->prepare($sql); 
  
      $cmd->bindParam(':name', $name);
      $cmd->bindParam(':email', $email); 
      $cmd->bindParam(':city', $city);
      $cmd->bindParam(':skill', $skill); 
      $cmd->bindParam(':experience', $experience);
      
      // if we are updating,, we need t bind
      if(!empty($id)) {
        $cmd->bindParam(':id', $id);   
      }
  
      $cmd->execute(); 
      
      echo "<p> Thanks for join climbing club!</p>";
      echo '<p> View all the club members <a href="club.php">here</a>'; 
      
      $cmd->closeCursor(); 
    }
    
  } catch(PDOException $e) {
    //echo $e; 
    echo "<p> There was an error with your form submission </p>"; 
    mail('kuei-chin.huang@mygeorgian.ca', 'app submission error', $e); 
  }
}

require('includes/footer.php'); 
?>
