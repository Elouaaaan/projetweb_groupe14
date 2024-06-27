<?php

namespace App\Views;

class Header
{
  private $nav_list;

  public function __construct()
  {
    $url = getenv('APP_URL');
    $this->nav_list = [
      'Accueil' => $url,
      'Ajout' => $url . 'ajout.php',
      'Carte & Tableau' => $url . 'tableaucarte.php',
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
      <h1><?php echo getenv('APP_NAME'); ?></h1>
      <nav class="header-nav">
        <button class="header-toggle" onclick="toggleNav()">☰</button>
        <ul class="header-ul">
          <?php foreach ($this->nav_list as $title => $url): ?>
            <li class="header-li"><a class="header-a" href="<?= $url ?>"><?= $title ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </header>

    <script>
      function toggleNav() {
        const navUl = document.querySelector('.header-ul');
        navUl.classList.toggle('show');
      }
    </script>

    <?php

    return ob_get_clean();
  }
}

?>