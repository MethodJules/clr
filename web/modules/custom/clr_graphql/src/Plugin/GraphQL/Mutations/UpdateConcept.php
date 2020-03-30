<?php

namespace Drupal\clr_graphql\Plugin\GraphQL\Mutations;

use Drupal\graphql\Annotation\GraphQLMutation;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql_core\Plugin\GraphQL\Mutations\Entity\UpdateEntityBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Simple mutation for updating an existing article node.
 *
 * @GraphQLMutation(
 *   id = "update_concept",
 *   entity_type = "node",
 *   entity_bundle = "concept",
 *   secure = true,
 *   name = "updateConcept",
 *   type = "EntityCrudOutput!",
 *   arguments = {
 *     "id" = "String",
 *     "input" = "ConceptInput"
 *   }
 * )
 */
class UpdateConcept extends UpdateEntityBase {

  /**
   * {@inheritdoc}
   */
  protected function extractEntityInput($value, array $args, ResolveContext $context, ResolveInfo $info) {
    return array_filter([
      'title' => $args['input']['title'],
    ]);
  }

}
