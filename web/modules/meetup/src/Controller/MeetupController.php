<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12.07.18
 * Time: 23:06
 */

namespace Drupal\meetup\Controller;

use Drupal\Core\Controller\ControllerBase;


class MeetupController extends ControllerBase
{
    public function meetup_save_to_db($event_id, $flag) {
        //Get current user id
        $uid = \Drupal::currentUser()->id();

        //Check if user_id and event_id already exists in database table
        $connection = \Drupal::database();
        $query = $connection->query("SELECT event_id, user_id FROM {meetup} WHERE event_id = :event_id AND user_id = :user_id;",
            [':event_id' =>$event_id,
                ':user_id' => $uid,

            ]);
        $result = $query->fetchAll();

        if ($result != NULL) {
            drupal_set_message(t('Event mit User existiert bereits'));
            return [];
        }


        //Get event name
        $nid = $event_id;
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($nid);
        $event_name = $node->title->value;

        $flag == 'interested' ? $is_interested = 'y': $is_interested = 'n';
        $flag == 'participating' ? $is_particpating = 'y': $is_particpating = 'n';
        $flag == 'not_participating' ? $is_particpating = 'n': $is_particpating = 'y';

        //TODO save to database
        $database = \Drupal::database();
        $fields = array(
            'event_id' => $event_id,
            'event_name' => $event_name,
            'user_id' => $uid,
            'is_interested' => $is_interested,
            'is_participating' => $is_particpating,
        );

        $database->insert('meetup')
            ->fields($fields)
            ->execute();
        //Add the meetup entry


        return array(
            '#type' => 'markup',
            '#markup' => t('Hello the event_id is @event_id and the name is @event_name, the flag is @flag, the userid is @uid', array(
                '@event_id' => $event_id,
                '@event_name' => $event_name,
                '@flag' => $flag,
                '@uid' => $uid,
                )),
        );
    }
}