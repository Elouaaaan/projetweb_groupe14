<?php

namespace App\Views;

class Tableau
{
    private $toggleButtons = [];
    private $columnsNames = [];
    private $columns = [];
    private $rows = [];

    public function addColumn($label, $id)
    {
        $this->toggleButtons[] = '<input type="checkbox" id="column_' . $id . '" class="column-toggle" data-col-index="' . count($this->toggleButtons) . '" checked="checked">
        <label for="column_' . $id . '">' . $label . '</label>';

        $this->columnsNames[] = $id;

        $sortbtns = '<div class="sort-buttons">'
            . '<button onclick="sortTable(' . count($this->columnsNames) . ', \'asc\')">&#9650;</button>'
            . '<button onclick="sortTable(' . count($this->columnsNames) . ', \'desc\')">&#9660;</button>'
            . '</div>';

        $this->columns[] = '<th id="' . $id . '">' . $sortbtns . $label . '</th>';

        return $this;
    }

    public function addRow($data)
    {
        $row = '<tr>';
        foreach ($this->columnsNames as $column) {
            $row .= '<td>' . $data[$column] . '</td>';
        }
        $row .= '</tr>';

        $this->rows[] = $row;

        return $this;
    }

    public function addRows($data)
    {
        foreach ($data as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function render()
    {
        ob_start();
?>
        <div class="search-button">
            <input type="text" id="search" name="search" placeholder="Rechercher...">
            <button type="submit" id="search-button">Rechercher</button>
        </div>

        <div class="toggle-container">
            <?php foreach ($this->toggleButtons as $toggleButton) : ?>
                <?= $toggleButton ?>
            <?php endforeach; ?>
        </div>

        <table id="tableau">
            <thead>
                <tr>
                    <?php foreach ($this->columns as $column) : ?>
                        <?= $column ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->rows as $row) : ?>
                    <?= $row ?>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php
        return ob_get_clean();
    }
}
?>