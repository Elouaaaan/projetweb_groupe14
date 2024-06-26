<?php

namespace App\Views;

class Footer
{

  public function render()
  {
    ob_start();
    ?>

    <footer>
      <p>Il est beau mon footer hein ?</p>
    </footer>

    <?php

    return ob_get_clean();
  }
}

?>