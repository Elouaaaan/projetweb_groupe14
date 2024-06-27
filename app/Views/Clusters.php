<?php

namespace App\Views;

class Clusters
{
    public function render()
    {
        return '
          <div class="div-clusters">
            <div class="form-group-radio">
              <label for="choix-clusters">Choix des clusters</label>
              <div class="radio-group">
                <input type="radio" id="deux" name="choix-clusters" checked>
                <label for="deux">Deux clusters</label>
                <input type="radio" id="trois" name="choix-clusters">
                <label for="trois">Trois clusters</label>
                <input type="radio" id="anomalies" name="choix-clusters">
                <label for="anomalies">Détection des anomalies</label>
              </div>
            </div>
          </div>
        ';
    }
}
