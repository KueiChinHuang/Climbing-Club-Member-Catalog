<!-- <select name="experience"  onchange="this.style.color='#555'"> -->
<?php
$theArray = array(
  "How\nlong\nhave\nyou\nbeen\nclimbing?",
  "Never\nclimb\nbefore",
  "Under\n3\nmonths",
  "3-6 months",
  "6 months - 1 years",
  "1 year - 2 years",
  "2 - 5 years",
  "5 - 10 years",
  "Over 10 years"
);

print_r($theArray);

foreach ($theArray as $value) {
  echo($value .'<br>');
//     if ($value == $experience) {
//         echo('<option selected="selected" value='.$value.'>'.$value.'</option>');
//     } else {
//         echo('<option value='.$value.'>'.$value.'</option>');
//     }
}
?>
<!-- </select> -->