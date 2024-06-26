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
            . '<button class="sort_asc">&#9650;</button>'
            . '<button class="sort_desc">&#9660;</button>'
            . '</div>';

        $this->columns[] = '<th id="' . $id . '">' . $sortbtns . $label . '</th>';

        return $this;
    }

    public function addRow($data)
    {
        // $ageBtn = '<button type="button" class="age-btn" value="' . $data['id_arbre'] . '">Prédire</button>';
        $ageBtn = '<button type="button" class="age-btn" value="' . $data['id_arbre'] . '" onclick="window.location.href=\'./age.php?id_arbre=' . $data['id_arbre'] . '\'">Prédire</button>';


        $row = '<tr><td>' . $ageBtn . '</td>';
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
            <!-- <button type="submit" id="search-button">Rechercher</button> -->
        </div>

        <div class="toggle-container">
            <?php foreach ($this->toggleButtons as $toggleButton) : ?>
                <?= $toggleButton ?>
            <?php endforeach; ?>
        </div>

        <table id="tableau">
            <thead>
                <tr>
                    <th id="id_arbre">Prédiction âge</th>
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

        <div class="btn-voirplus">
            <button type="button" id="pagedown">Page Précédente</button>
            <span id="numeropage">1</span>
            <button type="button" id="pageup">Page Suivante</button>
        </div>

        <div id="map">
        </div>

        <div class="btn-clusters">
            <button type="button" onclick="window.location.href='./clusters.php'">Voir les clusters</button>
        </div>
<?php
        return ob_get_clean();
    }
}
?>