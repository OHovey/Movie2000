<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Metatags -->
    <meta type="description" content="Search our library of over 2500 movies produced after the year 2000">

    <title><?php $this->get_data('page_title'); ?></title>

    <!-- bootstrap JS, Popper.js and jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

</head>

<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","resources/xml/livesearch.php?q="+str,true);
  xmlhttp.send();
}

</script>

<script src="resources/js/search.js"></script>

<body class="<?php $this->get_data('page_class'); ?>">

  <?php include('app/views/includes/visual.php'); ?>

    <div class="wrapper">
        <div style="background-image: url('<?php try { $this->get_data('img'); } catch (Exception $e) { echo 'Error: ' . $e; } ?>')">

        <div class="above-nav container-fluid">
            <p id="website-summary">
              Hi, Welcome to Movie2000.uk, A website for searching through over 2500 movies produced after the year 2000.<br>
              <strong>Start your search below</strong>
            </p>
        </div>

       

        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">Movie 2000</a>
            <a class="navbar-item" href="movie.php?page=1">View All Movies</a>
            <form method="GET" id="movie-search" class="form-inline navbar-right">
                <input class="form-control mr-sm-2" id="searchbox" type="search" placeholder="Search Movies" name="title" onkeyup="showResult(this.value), injectGet(this.value)">
                <button onclick="injectGet(searchbox.value)" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>     
                   
        </nav>


        <ul id="livesearch">
            <?php $this->load('resources/xml/livesearch.php'); ?>
        </ul>

        
        

