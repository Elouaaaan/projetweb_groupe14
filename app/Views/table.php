<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Tableau</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

<body>
  <header>
    <h1>SQArbres</h1>
    <nav>
      <ul>
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Ajout</a></li>
        <li><a href="#">Carte & Tableau</a></li>
        <li><a href="#">Clusters</a></li>
        <li><a href="#">Âge et déracinage</a></li>
      </ul>
    </nav>
  </header>

  <div class="toggle-container">
    <input type="checkbox" id="longitude" class="column-toggle" data-col-index="0" checked="checked">
    <label for="longitude">Longitude</label>

    <input type="checkbox" id="latitude" class="column-toggle" data-col-index="1" checked="checked">
    <label for="latitude">Latitude</label>

    <input type="checkbox" id="quartier" class="column-toggle" data-col-index="2" checked="checked">
    <label for="quartier">Quartier</label>

    <input type="checkbox" id="secteur" class="column-toggle" data-col-index="3" checked="checked">
    <label for="secteur">Secteur</label>

    <input type="checkbox" id="hauteur_totale" class="column-toggle" data-col-index="4" checked="checked">
    <label for="hauteur_totale">Hauteur totale</label>

    <input type="checkbox" id="hauteur_tronc" class="column-toggle" data-col-index="5" checked="checked">
    <label for="hauteur_tronc">Hauteur tronc</label>

    <input type="checkbox" id="diametre_tronc" class="column-toggle" data-col-index="6" checked="checked">
    <label for="diametre_tronc">Diamètre tronc</label>

    <input type="checkbox" id="etat_arbre" class="column-toggle" data-col-index="7" checked="checked">
    <label for="etat_arbre">État arbre</label>

    <input type="checkbox" id="stade_developpement" class="column-toggle" data-col-index="8" checked="checked">
    <label for="stade_developpement">Stade de développement</label>

    <label for="port">Port</label>
    <input type="checkbox" id="port" class="column-toggle" data-col-index="9" checked="checked">

    <label for="pied">Pied</label>
    <input type="checkbox" id="pied" class="column-toggle" data-col-index="10" checked="checked">

    <label for="situation">Situation</label>
    <input type="checkbox" id="situation" class="column-toggle" data-col-index="11" checked="checked">

    <label for="revetement">Revêtement</label>
    <input type="checkbox" id="revetement" class="column-toggle" data-col-index="12" checked="checked">

    <label for="age_estime">Âge estimé</label>
    <input type="checkbox" id="age_estime" class="column-toggle" data-col-index="13" checked="checked">

    <label for="precision_estimee">Précision estimée</label>
    <input type="checkbox" id="precision_estimee" class="column-toggle" data-col-index="14" checked="checked">

    <label for="nombre_diagnostics">Nombre de diagnostics</label>
    <input type="checkbox" id="nombre_diagnostics" class="column-toggle" data-col-index="15" checked="checked">

    <label for="nom_technique">Nom technique</label>
    <input type="checkbox" id="nom_technique" class="column-toggle" data-col-index="16" checked="checked">

    <label for="villeca">Villeca</label>
    <input type="checkbox" id="villeca" class="column-toggle" data-col-index="17" checked="checked">

    <label for="feuillage">Feuillage</label>
    <input type="checkbox" id="feuillage" class="column-toggle" data-col-index="18" checked="checked">

    <label for="remarquable">Remarquable</label>
    <input type="checkbox" id="remarquable" class="column-toggle" data-col-index="19" checked="checked">
  </div>

  <table id="tableau">
    <tr>
      <th id="longitude">Longitude</th>
      <th id="latitude">Latitude</th>
      <th id="quartier">Quartier</th>
      <th id="secteur">Secteur</th>
      <th id="hauteur_totale">Hauteur totale</th>
      <th id="hauteur_tronc">Hauteur tronc</th>
      <th id="diametre_tronc">Diamètre tronc</th>
      <th id="etat_arbre">État arbre</th>
      <th id="stade_developpement">Stade de développement</th>
      <th id="port">Port</th>
      <th id="pied">Pied</th>
      <th id="situation">Situation</th>
      <th id="revetement">Revêtement</th>
      <th id="age_estime">Âge estimé</th>
      <th id="precision_estimee">Précision estimée</th>
      <th id="nombre_diagnostics">Nombre de diagnostics</th>
      <th id="nom_technique">Nom technique</th>
      <th id="villeca">Villeca</th>
      <th id="feuillage">Feuillage</th>
      <th id="remarquable">Remarquable</th>
    </tr>
    <tr>
      <td>3.2932636093638927</td>
      <td>49.84050020512298</td>
      <td>Quartier du Centre-Ville</td>
      <td>Quai Gayant</td>
      <td>6.0</td>
      <td>2.0</td>
      <td>37.0</td>
      <td>EN PLACE</td>
      <td>Jeune</td>
      <td>semi libre</td>
      <td>gazon</td>
      <td>Alignement</td>
      <td>Non</td>
      <td>15.0</td>
      <td>5.0</td>
      <td>0.0</td>
      <td>QUERUB</td>
      <td>VILLE</td>
      <td>Feuillu</td>
      <td>Non</td>
    </tr>
    <tr>
      <td>3.273379794709001</td>
      <td>49.861408713361236</td>
      <td>Quartier du Vermandois</td>
      <td>Stade Cepy</td>
      <td>13.0</td>
      <td>1.0</td>
      <td>160.0</td>
      <td>EN PLACE</td>
      <td>Adulte</td>
      <td>semi libre</td>
      <td>gazon</td>
      <td>Groupe</td>
      <td>Non</td>
      <td>50.0</td>
      <td>10.0</td>
      <td>0.0</td>
      <td>PINNIGnig</td>
      <td>VILLE</td>
      <td>Conifère</td>
      <td>Non</td>
    </tr>
    <tr>
      <td>3.289067824663547</td>
      <td>49.84451310660708</td>
      <td>Quartier du Centre-Ville</td>
      <td>Rue Villebois Mareuil</td>
      <td>12.0</td>
      <td>3.0</td>
      <td>116.0</td>
      <td>REMPLACÉ</td>
      <td>Adulte</td>
      <td>semi libre</td>
      <td>gazon</td>
      <td>Alignement</td>
      <td>Non</td>
      <td>30.0</td>
      <td>10.0</td>
      <td>0.0</td>
      <td>ACEPSE</td>
      <td>VILLE</td>
      <td>Feuillu</td>
      <td>Non</td>
  </table>

  <iframe src="./lll.html" name="carte" title="Carte">
  </iframe>


  <footer>
    <p>Il est beau mon footer hein ?</p>
  </footer>

  <script>
    function toggleColumn(colIndex, isVisible) {
      // afficher/masquer la colonne basée sur colIndex et isVisible
      document.querySelectorAll(`#tableau tr > *:nth-child(${colIndex + 1})`).forEach(cell => {
        if (isVisible) {
          cell.style.display = '';
        } else {
          cell.style.display = 'none';
        }
      });
    }
    
    // Correction du gestionnaire d'événements
    document.querySelectorAll('.column-toggle').forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        // Utiliser l'attribut data-col-index pour déterminer l'index de la colonne
        var colIndex = parseInt(this.getAttribute('data-col-index'), 10);
        // Afficher/masquer la colonne
        toggleColumn(colIndex, this.checked);
      });
    });
  </script>

</body>
</html>
