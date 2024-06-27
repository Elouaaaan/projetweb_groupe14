<?php

namespace App\Views;

class Clusters
{
  public function render()
  {
    return '
          <div class="div-clusters">
            <p>Choix des clusters</p>
            <div class="form-group-radio">
              <div class="radio-group">
                <input type="radio" id="deux" name="choix-clusters" value="1" checked>
                <label for="deux">Deux clusters</label>
                <input type="radio" id="trois" name="choix-clusters" value"2">
                <label for="trois">Trois clusters</label>
                <input type="radio" id="anomalies" name="choix-clusters" value="3">
                <label for="anomalies">Détection des anomalies</label>
              </div>
            </div>

            <div class="map">

            </div>

          </div>
        ';
  }
}
