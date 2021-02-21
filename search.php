

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Travel France</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.css"/>
<link rel="stylesheet" type="text/css" href="css/animate.css"/>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" href="css/owl.theme.css"/>
<link rel="stylesheet" type="text/css" href="css/owl.transitions.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,100,200,300,500,600,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps:400,700' rel='stylesheet' type='text/css'>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<div class="main-header" id="main-header">
  <nav class="navbar mynav navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="index.php">Travel France</a> </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="index.php">Home</a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>


<!-- Portfolio -->
<div id="work" class="portfolio">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1 text-center text">
        <h3>Recherche Sites par ville</h3>
        <div class="row">


 <!-- PHP DEBUT --> 


            <?php

require 'vendor/autoload.php';

$word = ($_POST['ville']);


use EasyRdf\Sparql\Client;
use EasyRdf\Sparql\Result;



$client = new Client("https://dbpedia.org/sparql", "");
$query = "
select distinct ?name ?lien ?texte ?ville  where{
    ?lien dct:subject dbc:World_Heritage_Sites_in_France.
        ?lien dbp:name ?name.
    ?lien dbo:abstract ?texte  
    FILTER (lang(?texte) = 'fr') 
    ?lien dbo:location ?ville.
    FILTER (contains(lcase(str(?ville)),lcase('${word}')))   
}GROUP BY ?ville
    ";

    

        $resultat = $client->query($query);
        foreach($resultat as $ligne){
            echo "<div style='display: inline-block; width: 40%; margin:10px; vertical-align:top; background-color:white;'>
            <p> <a href='show.php?id=".$ligne->lien."'>".$ligne->name."</a></p>";
            
            echo "
            <p>".$ligne->texte."</p>
            </div>";
        }

?>

 <!-- PHP FIN --> 


         
        </div>
        <!-- /.row (nested) --> 
      <!-- /.col-lg-10 --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /.container --> 
</div>


<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4"> <span class="copyright">Copyright &copy; Travel France 2021</span> </div>
      <div class="col-md-4">

      </div>
      <div class="col-md-4">
        <ul class="list-inline quicklinks">
          <li>Designed by <a href="http://w3template.com">Travel France</a> </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="js/jquery.countTo.js"></script> 
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script> 
<script>
$(document).ready(function() {
     
      $("#owl-demo").owlCarousel({
     
          navigation : false, // Show next and prev buttons
          slideSpeed : 500,
          autoPlay : 3000,
          paginationSpeed : 400,
          singleItem:true
     
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
      });
     
    });

    /*$('.timer').each(count);*/
    jQuery(function ($) {
      // custom formatting example
      $('.timer').data('countToOptions', {
        formatter: function (value, options) {
          return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
      });


  // start all the timers
      $('#testimonials').waypoint(function() {
    $('.timer').each(count);
    });
 
      function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
      }
    });


    $(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  // Prevent default anchor click behavior
  event.preventDefault();

  // Store hash
  var hash = this.hash;

  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
  $('html, body').animate({
    scrollTop: $(hash).offset().top
  }, 900, function(){

    // Add hash (#) to URL when done scrolling (default click behavior)
    window.location.hash = hash;
    });
  });
})
</script>
</body>
</html>
