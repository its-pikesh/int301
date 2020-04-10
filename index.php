
<?php
  $server="localhost";
  $username= "root";
  $password = "";
  $db_name="movierating";

  $conn= NEW mysqli($server, $username, $password, $db_name);

  // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  //echo "Connected successfully";
$resultset = $conn->query("SELECT movie_name from detail");

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Movie rating system</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="./style1.css">

</head>
<body>


<!-- partial:index.partial.html -->
<div class="container">
  <form class="form">
    <div class="selectbox selectbox--unselect" data-option="">
      <div class="selectbox__displayWord">
        -- Select --
      </div>
      <div class="option-container">
       <?php
            while($rows = $resultset->fetch_assoc())
            {
              $movie_name=$rows['movie_name'];
              //echo "<option value='$movie_name'>$movie_name</option>";
               echo "<div class='option-container__option'>
                        <input type='radio' class='option__radio' id='$movie_name' name='category'>
                        <label class='option__label' for='$movie_name' data-value='$movie_name'>$movie_name</label>
                    </div>";
            }
          ?>
      </div>
    </div>
    
    <button class="form__submit-button" type="button">Submit</button>
</div>
<div>
  </form>
  <br>
  <div>
    <form class="star_form">
      <fieldset>
        <span class="star-cb-group">
          <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>
          <input type="radio" id="rating-4" name="rating" value="4" /><label for="rating-4">4</label>
          <input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>
          <input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>
          <input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>
          <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
        </span>
      </fieldset>
    </form>
  </div>

</div>


<!-- partial -->
  <script  src="./script.js"></script>
  <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>-->
  <script  src="./script1.js"></script>



</body>
</html>
