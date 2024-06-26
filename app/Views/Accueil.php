<?php

namespace App\Views;

class Accueil
{
  public function render()
  {
    ob_start();
    ?>

    <main>
      <h2>Arbres de Saint-Quentin</h2>
      <h3>02100</h3>
      <a id="decouvrir" href="#descriptif">Découvrir</a>
      <img src="assets/images/stquentin.webp" alt="ville de Saint-Quentin">
      <h4 id="descriptif">Descriptif rapide</h4>
      <p>lala Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus debitis quae eligendi praesentium quisquam, perspiciatis minus nostrum aliquam maiores veritatis earum et sequi nam laudantium quaerat vero eum laboriosam dolorem.</p>
    </main>

    <?php


    return ob_get_clean();
  }
}

?>