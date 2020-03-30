<?php

namespace Drupal\clr_graphql\Plugin\GraphQL\Mutations;

use Drupal\graphql\Annotation\GraphQLMutation;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql_core\Plugin\GraphQL\Mutations\Entity\CreateEntityBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Mutation for creating a new concept node.
 *
 * @GraphQLMutation(
 *   id = "create_concept",
 *   entity_type = "node",
 *   entity_bundle = "concept",
 *   secure = true,
 *   name = "createConcept",
 *   type = "EntityCrudOutput!",
 *   arguments = {
 *     "input" = "ConceptInput"
 *   }
 * )
 */
class CreateConcept extends CreateEntityBase {

  /**
   * @inheritDoc
   */
  protected function extractEntityInput($value, array $args, ResolveContext $context, ResolveInfo $info) {
    return [
      'title' => $args['input']['title'],
    ];
  }

}
