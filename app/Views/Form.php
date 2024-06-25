<?php

namespace App\Views;

class Form {
    private $form = '';

    public function __construct() {
        $this->form = '<form class="tree-form">';
    }

    public function addRow(FormRow $row) {
        $this->form .= $row->getRow();
    }

    public function getForm() {
        return $this->form . '</form>';
    }
}

class FormRow {
    private $rowHTML = '';

    public function __construct() {
        $this->rowHTML = '<div class="form-row">';
    }

    public function addField($label, $type, $placeholder) {
        $this->rowHTML .= '<div class="form-group">
        <label for="' . $label . '">' . $label . '</label>
        <input type="' . $type . '" id="' . $label . '" placeholder="' . $placeholder . '">
        </div>';
    }

    public function addRadioGroup($label, $name, $options) {
        $this->rowHTML .= '<div class="form-group-radio">
        <label for="' . $label . '">' . $label . '</label>
        <div class="radio-group">';
        foreach ($options as $option) {
        $this->rowHTML .= '<input type="radio" name="' . $name . '" id="' . $option . '" checked>
            <label for="' . $option . '">' . $option . '</label>';
        }
        $this->rowHTML .= '</div>
        </div>';
    }

    public function getRow() {
        return $this->rowHTML . '</div>';
  }
}

?>

<!-- 
  <form class="tree-form">

    <div class="form-row">
      <div class="form-group">
        <label for="longitude">Longitude</label>
        <input type="text" id="longitude" placeholder="3.2932636093638927">
      </div>
      <div class="form-group">
        <label for="latitude">Latitude</label>
        <input type="text" id="latitude" placeholder="49.84050020512298">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="quartier">Quartier</label>
        <input type="text" id="quartier" placeholder="Quartier du Centre-Ville">
      </div>
      <div class="form-group">
        <label for="secteur">Secteur</label>
        <input type="text" id="secteur" placeholder="Quai Gayant">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="hauteurTotale">Hauteur totale</label>
        <input type="text" id="hauteurTotale" placeholder="6.0">
      </div>
      <div class="form-group">
        <label for="hauteurTronc">Hauteur tronc</label>
        <input type="text" id="hauteurTronc" placeholder="2.0">
      </div>
      <div class="form-group">
        <label for="diametreTronc">Diamètre tronc</label>
        <input type="text" id="diametreTronc" placeholder="37.0">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="etatArbre">État arbre</label>
        <input type="text" id="etatArbre" placeholder="EN PLACE">
      </div>
      <div class="form-group">
        <label for="stadeDeveloppement">Stade développement</label>
        <input type="text" id="stadeDeveloppement" placeholder="Jeune">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="port">Port</label>
        <input type="text" id="port" placeholder="semi libre">
      </div>
      <div class="form-group">
        <label for="pied">Pied</label>
        <input type="text" id="pied" placeholder="gazon">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="situation">Situation</label>
        <input type="text" id="situation" placeholder="Alignement">
      </div>

      <div class="form-group-radio">
        <label for="revetement">Revêtement</label>
        <div class="radio-group">
          <input type="radio" id="oui" name="revetement" checked>
          <label for="oui">Oui</label>
          <input type="radio" id="non" name="revetement">
          <label for="non">Non</label>
        </div>
      </div>

    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="nombreDiagonal">Nombre diagonal</label>
        <input type="text" id="nombreDiagonal" placeholder="0.0">
      </div>
      <div class="form-group">
        <label for="nomTechnique">Nom technique</label>
        <input type="text" id="nomTechnique" placeholder="QUERUB">
      </div>
    </div>

    <div class="form-row">
      
      <div class="form-group-radio">
        <label for="villeca">Villeca</label>
        <div class="radio-group">
          <input type="radio" name="villeca" id="ville" checked>
          <label for="ville">VILLE</label>
          <input type="radio" name="villeca" id="casq" checked>
          <label for="casq">CASQ</label>
        </div>
      </div>

      <div class="form-group-radio">
        <label for="feuillage">Feuillage</label>
        <div class="radio-group">
          <input type="radio" name="feuillage" id="feuillu" checked>
          <label for="feuillu">Feuillu</label>
          <input type="radio" name="feuillage" id="conifère" checked>
          <label for="conifère">Conifère</label>
        </div>
      </div>

      <div class="form-group-radio">
        <label for="remarquable">Remarquable</label>
        <div class="radio-group">
          <input type="radio" name="remarquable" id="oui" checked>
          <label for="oui">Oui</label>
          <input type="radio" name="remarquable" id="non" checked>
          <label for="non">Non</label>
        </div>
      </div>

    </div>
    <div class="form-row">
      <button type="submit" class="submit-button">Soumettre</button>
    </div>
  </form> -->

