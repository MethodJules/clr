<?php

namespace Drupal\d3_concept_map\Controller;

use Drupal\Core\Controller\ControllerBase;

class ConceptMapController extends ControllerBase {


    public function iterateOverConcepts($node_id) {
        $data = array();
        //Hole Concepts
        $source_ids = $this->getConcepts($node_id);
        //Hole Relationen die von den Concepts ausgehen
        foreach($source_ids as $source_id) {
            $relation_ids = $this->getConceptRelations($source_id);
            //Hole Concepte die von der Relation ausgehen
            foreach($relation_ids as $relation_id) {
                $target_id = $this->getConcepts($relation_id);
                array_push($data, array('source_id' => $source_id, 'relation_id' => $relation_id, 'target_id' => $target_id[0]));
            }
        }
        //dsm($data);
        return $data;
    }


    public function iterateOverConcepts2($node_id) {
        $data = array();
        $relation_ids = $this->getConceptRelations($node_id);
            //Hole Concepte die von der Relation ausgehen
            foreach($relation_ids as $relation_id) {
                $target_id = $this->getConcepts($relation_id);
                array_push($data, array('source_id' => $node_id, 'relation_id' => $relation_id, 'target_id' => $target_id[0]));
            }
        return $data;
    }

    public function content() {

        $links = array();
        $nodes = array();

        //Get Concept Map Node
        $node_id = 13; //TODO: Parameterisieren


        $data = $this->iterateOverConcepts($node_id);
        dsm($data);
        $last_element = end($data);
        //dsm($last_element['target_id']);
        while(!empty($last_element['target_id'])) {
            /*Test*/
            $node_id = $last_element['target_id'];
            $relation_ids = $this->getConceptRelations($node_id);
            foreach($relation_ids as $relation_id) {
                $target_id = $this->getConcepts($relation_id);
                array_push($data, array('source_id' => $node_id, 'relation_id' => $relation_id, 'target_id' => $target_id[0]));
            }

            //array_push($data, $this->iterateOverConcepts2($last_element['target_id']));

            $last_element = end($data);
        };
        dsm('...');
        dsm($data);





        //$data['source_id'] = $source_id;


        /*
        //Get Concepts of Node Concept Map
        foreach($concept_map_node->field_concepts as $concept) {
            //Get concept
            $referenced_concept_ids[] = $concept->target_id;
        }

        foreach($referenced_concept_ids as $concept_node_id) {
            $concept_nodes[] = $node_storage->load($concept_node_id);
        }

        foreach($concept_nodes as $concept_node) {
            array_push($nodes,['id' => $concept_node->id(), 'conceptName' => $concept_node->title->value]);
            //Get Relation label
            foreach($concept_node->field_relation as $relation) {
                $relation_label = $this->getRelationLabel($relation->target_id);

            }
            //$graphData['links'] = $this->getLinks($concept_node->id());
        }
        */

        /*
        $graphData = [
            'nodes' => [
              [
                'name' => 'Concept Maps',
                'label' => '',
                'id' => 1
              ],
              [
                'name' => 'Mental structure of long term memory',
                'label' => '',
                'id' => 2
              ],
              [
                'name' => 'Relatedness structure',
                'label' => '',
                'id' => 3
              ],

            ],
            'links' => [
              [
                'source' => 1,
                'target' => 2,
                'type' => 'probe',
              ],
              [
                'source' => 2,
                'target' => 3,
                'type' => 'which assumed to have',
              ],

            ],
          ];
          */



        return ['#markup' => 'Concept Map'];


    }

    public function getLinks($node_id) {
        $node_id = 13; //TODO: Parameterisieren
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);

        foreach($node->field_relation as $relation) {
            $relation_target_id = $relation->target_id;
        }


    }

    public function getRelationLabel($node_id) {
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);
        return $node->title->value;
    }

    public function getConceptName($node_id) {
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);
        return $node->title->value;
    }

    public function getConceptId($node_id) {
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);
        return $node->id();
    }

    public function getConceptRelations($node_id) {
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);
        foreach($node->field_relation as $relation) {
            //Get concept
            $referenced_relation_ids[] = $relation->target_id;
        }
        return $referenced_relation_ids;
    }

    public function getConcepts($node_id) {
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($node_id);
        foreach($node->field_concepts as $concept) {
            //Get concept
            $referenced_concept_ids[] = $concept->target_id;
        }

        return $referenced_concept_ids;
    }
}
