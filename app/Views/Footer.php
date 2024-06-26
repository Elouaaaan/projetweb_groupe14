<?php

namespace App\Views;

class Footer
{
  public function render()
  {
    ob_start();
    ?>

    <footer>
      <p>&copy; <?php echo date('Y'); ?> - <?php echo getenv('APP_NAME'); ?></p>
      <p>Site Web: <a href="<?php echo getenv('APP_URL'); ?>"><?php echo getenv('APP_URL'); ?></a></p>
    </footer>

    <?php
    return ob_get_clean();
  }
}

?>