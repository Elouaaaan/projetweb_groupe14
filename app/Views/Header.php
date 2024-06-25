<?php

namespace App\Views;

class Header
{
  private $nav_list;

  public function __construct()
  {
    $this->appConfig = require_once(__DIR__ . '/../../config/app.php');

    $url = $this->appConfig['url'];
    $this->nav_list = [
      'Accueil' => $url,
      'Ajout' => $url . 'ajout.php',
      'Carte & Tableau' => $url . 'carte.php',
      'Clusters' => $url . 'clusters.php',
      'Âge et déracinage' => $url . 'age.php',
    ];

    $currentUrl = $url . ltrim($_SERVER['REQUEST_URI'], '/');
    foreach ($this->nav_list as $title => $url) {
      if ($url === $currentUrl) {
        $this->nav_list[$title] = '#';
      }
    }
  }

  public function render()
  {
    ob_start();
    ?>

    <header>
      <h1><?php echo $this->appConfig['name']; ?></h1>
      <nav>
        <ul>
          <?php foreach ($this->nav_list as $title => $url): ?>
            <li><a href="<?= $url ?>"><?= $title ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </header>

    <?php

    return ob_get_clean();
  }
}

?>