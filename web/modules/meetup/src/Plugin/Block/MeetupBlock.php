<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12.07.18
 * Time: 18:08
 */

namespace Drupal\meetup\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Class MeetupBlock
 * @package Drupal\meetup\Plugin\Block
 *
 * @Block(
 *     id="MeetupBlock",
 *     admin_label=@Translation("Meetup"),
 *      category=@Translation("Custom")
 * )
 */
class MeetupBlock extends BlockBase
{

    public function build()
    {
        // Implement build() method.

        $nids = \Drupal::entityQuery('node')->condition('type','event')->execute();
        $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);

        $list = array();


        foreach ($nodes as $node) {
            //kint($node);
            $title = $node->get('title')->value;
            array_push($list, $title);
        }


        $content = [
            '#theme' => 'item_list',
            '#list_type' => 'ul',
            '#title' => 'Events',
            '#items' => $list,
            '#prefix' => '<div id="meetup_block_item_list">',
            '#suffix' => '</div>',

        ];
        return $content;
    }
}