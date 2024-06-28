<?php

namespace App\Views;

class Age
{
  private $risque;
  private $age_info = [];

  public function add_age($age, $modele)
  {
    $this->age_info[] = [
      'age' => $age,
      'modele' => $modele
    ];
    var_dump($this->age_info);

    return $this;
  }

  public function add_risque($risque)
  {
    $this->risque = $risque;

    return $this;
  }

  public function render()
  {
    ob_start();
?>

    <main>

      <div class="head">
        <p class="resultat-final"></p>
        <p class="moyenne">Moyenne d'âge prédit par <?php echo count($this->age_info); ?> modèles</p>
      </div>
      </div>

      <div class="conteneur-boites">
        <?php foreach ($this->age_info as $age) : ?>
          <div class="boite">
            <p class="nom_modele">modèle <?php echo $age['modele']; ?></p>
            <p class="resultat"><?php echo $age['age']; ?> ans</p>
          </div>
        <?php endforeach; ?>
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
        <p class="resultat-final">Risque de déracinement il y a 1 mois</p>
        <p class="moyenne"><?php echo number_format($this->risque, 2); ?>%</p>
      </div>

    </main>

<?php
    return ob_get_clean();
  }
}

?>