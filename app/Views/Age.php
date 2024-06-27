<?php

namespace App\Views;

class Age
{
  public function render()
  {
    ob_start();
    ?>

      <main>

        <div class="head">
          <p class="resultat-final">6,0 ans</p>
          <p class="moyenne">Moyenne d'âge prédit par 4 modèlels</p>
        </div>

        <div class="conteneur-boites">
          <div class="boite">
            <p class="nom_modele">modèle 1</p>
            <p class="resultat">5,92 ans</p>
            <p class="commentaire">temps d'éxecution: 0,24s</p>
          </div>
          <div class="boite">
            <p class="nom_modele">modèle 2</p>
            <p class="resultat">6,38 ans</p>
            <p class="commentaire">temps d'éxecution: 0,32s</p>
          </div>
          <div class="boite">
            <p class="nom_modele">modèle 3</p>
            <p class="resultat">6,12 ans</p>
            <p class="commentaire">temps d'éxecution: 0,28s</p>
          </div>
          <div class="boite">
            <p class="nom_modele">modèle 4</p>
            <p class="resultat">5,58 ans</p>
            <p class="commentaire">temps d'éxecution: 0,26s</p>
          </div>
        </div>

        <div class="head">
          <p class="resultat-final">Arraché</p>
          <p class="moyenne">Risque d'arrachage</p>
        </div>

      </main>

    <?php
    return ob_get_clean();
  }
}

?>