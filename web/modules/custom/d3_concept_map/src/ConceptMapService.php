<?php

namespace Drupal\d3_concept_map;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Class ConceptMapService.
 */
class ConceptMapService {

  /**
   * Constructs a new ConceptMapService object.
   */
  public function __construct() {

  }

  /**
   * Return the d3 graph data of the specified concept map (by entity ID) in
   * JSON format.
   *
   * @param int $nodeId
   *   The concept map ID.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getData($nodeId) {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $node = $node_storage->load($nodeId);

    foreach($node->field_concepts as $concept) {
      //Get concept
      $concept_title = $concept->entity->title->value;
      $referenced_concept_id = $concept->target_id;
      //Get relation
      $relation = $this->getRelation($referenced_concept_id);

      $referenced_nodes[] = [
        'name' => $concept_title,
        'id' => $referenced_concept_id,
        'relation' => $relation,
      ];
    }

    return $referenced_nodes;
  }


  public function getRelation($nid) {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $node = $node_storage->load($nid);
    foreach($node->field_relation as $relation) {
      $relation_title = $relation->title->value;
      $relation_target_id = $relation->target_id;
    }
    return ['relation_title' => $relation_title, 'relation_target_id' => $relation_target_id];
  }

  private function getConcepts($nodeId) {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $node = $node_storage->load($nodeId);
    return $node->get('title')->value;

  }

}
