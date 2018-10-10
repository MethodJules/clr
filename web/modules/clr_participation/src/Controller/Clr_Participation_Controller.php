<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 07.09.18
 * Time: 23:06
 */

namespace Drupal\clr_participation\Controller;


class Clr_Participation_Controller
{
    public function interested() {
        return array(
            '#type' => 'markup',
            '#markup' => 'Sie sind jetzt interessiert an '
        );

    }


}