<!DOCTYPE html>
<html>
<head>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Trailers</title>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <script type="text/javascript" src="../js/main.js"></script>
</head>
<body>
<div class="loader">
  <div id="largeBox"></div>
  <div id="smallBox"></div>
</div>
<div id="outer">
<nav id="nav">
  <center><h2><a href="../index.php">Movie Trailers</a></h2></center>
</nav>


<?php

$curl = curl_init();

 $w = $_GET['ide'];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/$w/videos?language=en-US&api_key=8448903d151180f7e5b479d58032281a",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 100,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $dat = json_decode($response);
    ?><div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators"><?php
    $j=0;
    foreach ($dat -> results as $i) {
      if($j==0){
      ?><li data-target="#myCarousel" data-slide-to="<?php echo($j)?>" class="active"></li><?php
      $j++;
    }
      else{
      ?><li data-target="#myCarousel" data-slide-to="<?php echo($j)?>" ></li><?php
      $j++;
    }
    }
    ?></ol>
    <div class="carousel-inner"><?php
    $j=0;
   foreach ($dat -> results as $i ) {
    $y=$i->key;
    if($j==0){
      ?><div class="item active"><?php
      echo("<iframe src='http://www.youtube.com/embed/$y' height='450' frameborder='0' allowfullscreen style='width:100%;'></iframe>")."\t";
      ?></div><?php
    // echo  nl2br ("\n");
    }
    else{
      ?><div class="item"><?php
      echo("<iframe src='http://www.youtube.com/embed/$y' height='450' frameborder='0' allowfullscreen  style='width:100%;'></iframe>")."\t";
      ?></div><?php 
    }
    $j++;
     }
     ?></div>
     <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div><?php
}
?>

<?php

$curl = curl_init();

$w = $_GET['ide'];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/$w?language=en-US&api_key=8448903d151180f7e5b479d58032281a",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$dat = json_decode($response); 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
    // echo $response;
    $i=$dat;
    $y=$i->title;
    $r=$i->id;
    
    ?> <div class="details"> <?php
    ?> <div class="titl"> <?php
    if($y!=NULL){
    echo $y;
    echo  nl2br ("\n");
  } ?></div><?php
    $y=$dat->genres;
    if($y!=NULL){
    echo("Genres: | ");
    foreach ($y as $key) {
      echo($key->name)." |\t";
    }
    echo  nl2br ("\n");
  }
  $y = $dat->runtime;
  if($y!=0 && $y!=NULL){
    echo "Runtime: ".$y." mins";
    echo  nl2br ("\n");
  }
  $y = $dat->release_date;
  if($y!=0 && $y!=NULL){
    echo "Release date: ".$y;
    echo  nl2br ("\n");
  }
  $y = $dat->overview;
  if($y!=NULL){
    echo "Overview: ".$y;
    echo  nl2br ("\n");
  }
    ?></div><br><?php
}
?>
    <div id="bottom"></div>
</div>
<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>