<?php
  $server="localhost";
  $username= "root";
  $password = "root";
  $db_name="movierating";

  $conn= NEW mysqli($server, $username, $password, $db_name);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  if (isset($_POST["submit"])) {
    $movie_name = $_POST["movie"];
    $rating = $_POST["star"];
    $curdata = $conn->query("SELECT rating,times_rated from detail WHERE movie_name = '$movie_name' LIMIT 1");
    $curdata = $curdata->fetch_assoc();
    $currating = $curdata["rating"];
    $timesrated = $curdata["times_rated"] + 1;
    $newrating = ($currating + $rating) / 2;
    $currating = $conn->query("UPDATE detail SET rating = '$newrating', times_rated = '$timesrated' WHERE movie_name = '$movie_name'");
  }
$resultset = $conn->query("SELECT movie_name from detail");
$result = $conn->query("SELECT movie_name, rating from detail");
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">

<style>

body{
  background: #525252cf;
}
div.stars {
  width: 270px;
  display: inline-block;
}
h2,h4{
  text-align: center;
}
input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
</head>
<body>
  <div class="container">
    <div class="col-md-12 mt-5">
      <h2>MOVIE RATING SYSTEM</h2><br>
      <h4>Select and rate the movie</h4>
    </div>
    <div class="col-md-12 mt-5">
      <form action="" method="POST">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <select class="form-control form-control-lg" name="movie">
              <?php
                while($rows = $resultset->fetch_assoc())
                {
                  $movie_name=$rows['movie_name'];
              ?>
                <option><?php echo $movie_name; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-4"></div>
          <div class="col-md-4 ml-4">
            <div class="stars">
              <input class="star star-5" id="star-5" type="radio" value="5" name="star" required="" />
              <label class="star star-5" for="star-5"></label>
              <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
              <label class="star star-4" for="star-4"></label>
              <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
              <label class="star star-3" for="star-3"></label>
              <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
              <label class="star star-2" for="star-2"></label>
              <input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
              <label class="star star-1" for="star-1"></label>
            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="row mt-4">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-dark btn-lg btn-block" name="submit">Submit</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </form>
    </div>
    <div class="col-md-12 mt-5">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Movie Name</th>
            <th scope="col">Average Rating</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($rows = $result->fetch_assoc())
            {
              $movie_name=$rows['movie_name'];
              $rating = $rows['rating'];
          ?>
          <tr>
            <td><?php echo $movie_name; ?></td>
            <td><?php echo number_format($rating,2,'.',''); ?></td>
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>