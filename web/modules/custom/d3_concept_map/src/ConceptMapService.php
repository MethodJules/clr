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

    $concepts = $node->field_concepts->referencedEntities();


    foreach ($concepts as $concept){
      $asd = 0;

    }
  }

  private function getConcepts(Integer $nodeId) {


  }

}
