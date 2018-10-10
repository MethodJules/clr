<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 05.09.18
 * Time: 19:16
 */

namespace Drupal\clr_navigation\Controller;

use Drupal\Core\Controller\ControllerBase;
class Conceptualisation extends ControllerBase
{


    public function view_all_concepts() {
        //TODO implement View all concepts
        
    }

    public function view_concept_matrix() {

        global $base_url;
        $concept_matrix['table'] = array(
            '#type' => 'table',
            '#caption' => $this->t('Concept Matrix'),
            '#header' => array('Fokus', 'Ziel', 'Organisation', 'Zielgruppe', 'Rahmen'),
            '#rows' => array(
                array('Ergebnis', 'Integration', 'historisch', 'Fachpublikum', 'vollständig'),

            ),
        );

        $concept_matrix['link'] = array(
            '#type' => 'markup',
            '#markup' => '<a href="' . $base_url . '/node/add/scope">Add Scope</a>',
        );

        return $concept_matrix;
    }
}