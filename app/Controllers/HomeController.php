<?php

namespace App\Controllers;

use App\Models\Arbre;
use App\Models\Categories\Feuillage;
use App\Models\Categories\Nomtech;
use App\Models\Categories\Pied;
use App\Models\Categories\Port;
use App\Models\Categories\Quartier;
use App\Models\Categories\Secteur;
use App\Models\Categories\Situation;
use App\Models\Categories\Stadedev;
use App\Models\Categories\Villeca;
use App\Models\Categories\ArbEtat;

use App\Views\HTML;
use App\Views\Header;
use App\Views\Footer;
use App\Views\Accueil;
use App\Views\Form;
use App\Views\FormRow;
use App\Views\Tableau;
use App\Views\Clusters;

class HomeController
{
    static public function index()
    {
        $header = (new Header())->render();
        $content = (new Accueil())->render();
        $footer = (new Footer())->render();

        $cssFiles = [
            'main.css',
            'header.css',
            'footer.css',
            'accueil.css',
        ];

        echo HTML::generateHTML($header, $content, $footer, $cssFiles);
    }

    static public function ajout()
    {
        $quartier = new Quartier;
        $secteur = new Secteur;
        $feuillage = new Feuillage;
        $villeca = new Villeca;
        $nomtech = new Nomtech;
        $situation = new Situation;
        $pied = new Pied;
        $port = new Port;
        $stadedev = new Stadedev;
        $arbEtat = new ArbEtat;

        $header = (new Header())->render();
        $form = new Form();

        $row = new FormRow();
        $row->addField('Longitude', 'longitude', 'text', '3.2932636093638927', true);
        $row->addField('Latitude', 'latitude', 'text', '49.84050020512298', true);
        $form->addRow($row);

        $row = new FormRow();
        $row->addSelect('Quartier', 'quartier', $quartier->all(), true);
        $row->addSelect('Secteur', 'secteur', $secteur->all(), true);
        $form->addRow($row);

        $row = new FormRow();
        $row->addField('Hauteur totale (cm)', 'haut_tot', 'text', 600, true);
        $row->addField('Hauteur tronc (cm)', 'haut_tronc', 'text', 200, true);
        $row->addField('Diamètre tronc (cm)', 'tronc_diam', 'text', 37, true);
        $form->addRow($row);

        $row = new FormRow();
        $row->addSelect('Etat de l\'arbre', 'arb_etat', $arbEtat->all());
        $row->addSelect('Stade de développement', 'stade_dev', $stadedev->all());
        $form->addRow($row);

        $row = new FormRow();
        $row->addSelect('Pied', 'pied', $pied->all());
        $row->addSelect('Port', 'port', $port->all());
        $form->addRow($row);

        $row = new FormRow();
        $row->addSelect('Situation', 'situation', $situation->all());
        $row->addRadioGroup('Revêtement', 'revetement', [
            ['0', 'Non'],
            ['1', 'Oui'],
        ]);
        $form->addRow($row);

        $row = new FormRow();
        $row->addField('Nombre de diagnostics', 'nb_diag', 'text', 0, true);
        $row->addSelect('Nom technique', 'nom_tech', $nomtech->all());
        $form->addRow($row);

        $row = new FormRow();
        $row->addRadioGroup('Villeca', 'villeca', $villeca->all());
        $row->addRadioGroup('Feuillage', 'feuillage', $feuillage->all());
        $row->addRadioGroup('Remarquable', 'remarquable', [
            ['0', 'Non'],
            ['1', 'Oui'],
        ]);
        $form->addRow($row);

        $row = new FormRow();
        $row->addSubmit('Soumettre');
        $form->addRow($row);

        $content = $form->getForm();
        $footer = (new Footer())->render();

        $cssFiles = [
            'main.css',
            'header.css',
            'footer.css',
            'form.css',
        ];

        $jsFiles = [
            'form.js',
        ];

        echo HTML::generateHTML($header, $content, $footer, $cssFiles, $jsFiles);
    }

    static public function tableaucarte()
    {
        $header = (new Header())->render();

        $tableau = new Tableau();

        $table_data = (new Arbre())->all('id_arbre', false, 100, 1);

        $content = $tableau->addColumn('Longitude', 'longitude')
            ->addColumn('Latitude', 'latitude')
            ->addColumn('Quartier', 'quartier')
            ->addColumn('Secteur', 'secteur')
            ->addColumn('Hauteur totale (cm)', 'haut_tot')
            ->addColumn('Hauteur tronc (cm)', 'haut_tronc')
            ->addColumn('Diamètre tronc (cm)', 'tronc_diam')
            ->addColumn('Etat de l\'arbre', 'arb_etat')
            ->addColumn('Stade de développement', 'stadedev')
            ->addColumn('Pied', 'pied')
            ->addColumn('Port', 'port')
            ->addColumn('Situation', 'situation')
            ->addColumn('Revêtement', 'revetement')
            ->addColumn('Nombre de diagnostics', 'nbr_diag')
            ->addColumn('Nom technique', 'nomtech')
            ->addColumn('Villeca', 'villeca')
            ->addColumn('Feuillage', 'feuillage')
            ->addColumn('Remarquable', 'remarquable')
            ->addRows($table_data)
            ->render();


        $footer = (new Footer())->render();

        $cssFiles = [
            'main.css',
            'header.css',
            'footer.css',
            'tableau.css',
            'carte.css',
        ];

        $jsFiles = [
            'tableau.js',
        ];

        echo HTML::generateHTML($header, $content, $footer, $cssFiles, $jsFiles);
    }

    static public function clusters()
    {
        $header = (new Header())->render();
        $content = "<div id='clusters'>Les clusters</div>";
        $footer = (new Footer())->render();

        $cssFiles = [
            'main.css',
            'header.css',
            'footer.css',
            'carte.css',
        ];

        $jsFiles = [
            'clusters.js',
        ];

        echo HTML::generateHTML($header, $content, $footer, $cssFiles, $jsFiles);
    }
}
