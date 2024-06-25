<?php

namespace App\Views;

class FormRow {
    private $rowHTML = '';

    public function __construct() {
        $this->rowHTML = '<div class="form-row">';
    }

    public function addField($label, $name, $type, $placeholder, $required = false) {
        $this->rowHTML .= '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>
        <input type="' . $type . '" id="' . $name . '" name="' . $name . '" placeholder="' . $placeholder . '"';
        if ($required) {
            $this->rowHTML .= ' required="required"';
        }
        $this->rowHTML .= '>
        </div>';
    }

    public function addRadioGroup($label, $name, $options) {
        $this->rowHTML .= '<div class="form-group-radio">
        <label>' . $label . '</label>
        <div class="radio-group">';
        foreach ($options as $index => $option) {
            $this->rowHTML .= '<input type="radio" name="' . $name . '" id="' . $name . '_' . $option[0] . '" value="' . $option[1] . '"';
            if ($index === 0) {
            $this->rowHTML .= ' checked';
            }
            $this->rowHTML .= '>';
            $this->rowHTML .= '<label for="' . $name . '_' . $option[0] . '">' . $option[1] . '</label>';
        }
        $this->rowHTML .= '</div>
        </div>';
    }

    public function addSelect($label, $name, $options) {
        $this->rowHTML .= '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>
        <select id="' . $name . '" name="' . $name . '">';
        foreach ($options as $option) {
            $this->rowHTML .= '<option value="' . $option[0] . '">' . $option[1] . '</option>';
        }
        $this->rowHTML .= '</select>
        </div>';
    }

    public function addSubmit($label) {
        $this->rowHTML .= '<div class="form-row">
        <button type="submit" class="submit-button">' . $label . '</button>
        </div>';
    }

    public function getRow() {
        return $this->rowHTML . '</div>';
  }
}