    <?php require('includes/header.php');
    echo '<div class="inner">
    <h1> Climbing Club Database!</h1>';

      // add the movie id in case you are editing 
      $id = NULL;
      //set up a flag variable 
      $ok = true; 

     if(isset($_POST['submit'])){
        try {
          $id = $_POST['id']; 
          // store the form inputs in variables
          $name = filter_input(INPUT_POST, 'name');
          $email =  filter_input(INPUT_POST, 'email');
          $city =  filter_input(INPUT_POST, 'city');
          $skill =  filter_input(INPUT_POST, 'skill');
          $experience =  filter_input(INPUT_POST, 'experience');
          // $experience =  filter_input(INPUT_POST, 'experience', FILTER_VALIDATE_INT);
          
          if(empty($name)) {
            $ok = false; 
            echo '<p>Please fill out your name</p>';  
          }
          
          if(empty($email) || $email === false) {
            $ok = false; 
            echo '<p>Please enter a valid email</p>'; 
          }
          
          if(empty($city)) {
            $ok = false; 
            echo '<p> Please enter your city!</p>'; 
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
      }
      catch(PDOException $e) {
      //echo $e; 
      echo "<p> There was an error with your form submission </p>"; 
      mail('kuei-chin.huang@mygeorgian.ca', 'app submission error', $e); 
    }
  }
  
    require('includes/footer.php'); 
    ?>
