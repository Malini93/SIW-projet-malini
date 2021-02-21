<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <style type="text/css">
            #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
                height:400px;
            }
        </style>
        <title>Carte</title>
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
        <h3>Index des sites de visite</h3>
        <div class="row">

 <!-- PHP DEBUT --> 

<?php

require 'vendor/autoload.php';

use EasyRdf\Sparql\Client;
use EasyRdf\Sparql\Result;

$title = $_GET['id'];
$exploded = explode('/', $title);
$url_end = end($exploded);




$client = new Client("https://dbpedia.org/sparql", "");
        $url = "http://dbpedia.org/resource/". $url_end;
        $query = "
            select distinct ?lieu ?name  ?ville ?lattitude ?longitude where {
                BIND(<${url}> as ?lieu).
                ?lieu dbp:name ?name.
                OPTIONAL {
                  ?lieu dbo:location ?ville.
                }
                OPTIONAL {
                  ?lieu geo:lat ?lattitude.
              }
              OPTIONAL {
                  ?lieu geo:long ?longitude.
              }
               
                
            }
        ";
      

       $resultat = $client->query($query)[0];;


        
          echo $resultat->ville;
          $lat = $resultat->lattitude;
          $long = $resultat->longitude;

?>  


 <!-- PHP FIN --> 



        <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>                                                          

         
        </div>
        <!-- /.row (nested) --> 
      <!-- /.col-lg-10 --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /.container --> 
</div>



        <!-- Fichiers Javascript -->
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type="text/javascript">
            // On initialise la latitude et la longitude de Paris (centre de la carte)
            var lat = <?php echo $lat; ?>; 
            var lon = <?php echo $long; ?>;
            var macarte = null;
            // Fonction d'initialisation de la carte
            function initMap() {
                // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            }
            window.onload = function(){
		// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap(); 

var marker = L.marker([lat, lon]).addTo(macarte);
            };
        </script>

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
    </body>
</html>


    
    