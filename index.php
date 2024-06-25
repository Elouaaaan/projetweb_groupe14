<?php
require_once __DIR__ . '/autoload.php';

use App\Views\Form;
use App\Views\FormRow;

$form = new Form();

$row = new FormRow();
$row->addField('Longitude', 'text', '3.2932636093638927');
$row->addField('Latitude', 'text', '49.84050020512298');
$form->addRow($row);

$row = new FormRow();
$row->addField('Quartier', 'text', 'Quartier du Centre-Ville');
$row->addField('Secteur', 'text', 'Quai Gayant');
$form->addRow($row);

$row = new FormRow();
$row->addField('Hauteur totale', 'text', '6.0');
$row->addField('Hauteur tronc', 'text', '2.0');
$row->addField('Diamètre tronc', 'text', '37.0');
$form->addRow($row);

$row = new FormRow();
$row->addField('État arbre', 'text', 'EN PLACE');
$row->addField('Stade développement', 'text', 'Jeune');
$form->addRow($row);

$row = new FormRow();
$row->addField('Port', 'text', 'semi libre');
$row->addField('Pied', 'text', 'gazon');
$form->addRow($row);

$row = new FormRow();
$row->addField('Situation', 'text', 'Alignement');
$form->addRow($row);

$row = new FormRow();
$row->addField('Revêtement', 'radio', ['Oui', 'Non'], 'oui');
$form->addRow($row);

$row = new FormRow();
$row->addField('Nombre diagonal', 'text', '0.0');
$row->addField('Nom technique', 'text', 'QUERUB');
$form->addRow($row);

$row = new FormRow();
$row->addField('Villeca', 'radio', ['VILLE', 'CASQ'], 'ville');
$row->addField('Feuillage', 'radio', ['Feuillu', 'Conifère'], 'feuillu');
$row->addField('Remarquable', 'radio', ['Oui', 'Non'], 'oui');
$form->addRow($row);

echo $form->getForm();

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Tree</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

</body>

<?php
