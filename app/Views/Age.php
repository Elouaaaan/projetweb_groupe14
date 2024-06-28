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

    return $this;
  }

  public function add_risque($risque)
  {
    $this->risque = $risque;

    return $this;
  }

  public function render()
  {
    $sum = 0;
    $count = count($this->age_info);

    foreach ($this->age_info as $age) {
      $sum += $age['age'];
    }
    $mean = $sum / $count;


    ob_start();
?>

    <main>

      <div class="head">
        <p class="resultat-final"><?php echo $mean; ?></p>
        <p class="moyenne">Moyenne d'âge prédit par <?php echo $count; ?> modèles</p>
      </div>
      </div>

      <div class="conteneur-boites">
        <?php foreach ($this->age_info as $age) : ?>
          <div class="boite">
            <p class="nom_modele">Modèle <?php echo $age['modele']; ?></p>
            <p class="resultat"><?php echo number_format($age['age'], 2); ?> ans</p>
          </div>
        <?php endforeach; ?>
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