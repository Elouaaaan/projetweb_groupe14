<?php

namespace App\Views;

$nav_list = [
  'Accueil' => '#php',
  'Ajout' => '#',
  'Carte & Tableau' => '#',
  'Clusters' => '#',
  'Âge et déracinage' => '#'
];

ob_start();

?>

<header>
  <h1>Arbres</h1>
  <nav>
    <ul>
      <?php foreach ($nav_list as $title => $url): ?>
        <li><a href="<?= $url ?>"><?= $title ?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
</header>

<?php

$header = ob_get_clean();

?>