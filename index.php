<?php require('includes/header.php'); 
echo '<div class="inner">
    <h1> Climbing Club Database!</h1>';
// initializing variables
$id = null;
$name = null;
$email = null;
$city = null;
$skill = null;
$experience = null;

if (!empty($_GET['id']) && (is_numeric($_GET['id']))) {

  $id = $_GET['id'];

  require('includes/db.php');

  $sql = "SELECT * FROM climbingclub WHERE id = :id";

  //prepare

  $cmd = $conn->prepare($sql);

  $cmd->bindParam(':id', $id);

  $cmd->execute();

  // use fetchAll to store our results
  $club = $cmd->fetchAll();

  foreach ($club as $cclub) {
    $name = $cclub['name'];
    $email = $cclub['email'];
    $city = $cclub['city'];
    $skill = $cclub['skill'];
    $experience = $cclub['experience'];
  }

  $cmd->closeCursor();

}

?>
     <p> Welcome to join Georgian Climbing Club!</p>
      <form method="post" action="send-it.php">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="What's Your Name" value="<?php echo $name ?>">
        </div>
        <div class="form-group">
          <input type="text" name="email" class="form-control" placeholder="Your Eamil?"value="<?php echo $email ?>">
        </div>
        <div class="form-group">
          <input type="text" name="city" class="form-control" placeholder="Your city" value="<?php echo $city ?>">
        </div>
        <div class="form-group">
          <input type="text" name="skill" class="form-control" placeholder="Assess your climbing skill (1 - 10)" value="<?php echo $skill ?>">
        </div>
        <div class="form-group">
          <select name="experience">
            <option disabled selected value>How long have you been climbing?</option>
            <option value="0">Never climb before</option>
            <option value="Under 3 months">Under 3 months</option>
            <option value="3-6 months">3-6 months</option>
            <option value="6 months - 1 years">6 months - 1 years</option>
            <option value="1 year - 2 years">1 year - 2 years</option>
            <option value="2 - 5 years">2 - 5 years</option>
            <option value="5 - 10 years">5 - 10 years</option>
            <option value="Over 10 years">Over 10 years</option>
          </select>
        </div>
        <!-- need t add this hidden input so we know which record we are deleting ! -->
          <input type="hidden" value="<?php echo $id ?>" name="id">
          <input type="submit" name="submit" value="submit" class="btn btn-primary">
      </form>
    
<?php require('includes/footer.php'); ?>