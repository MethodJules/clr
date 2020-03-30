<?php

namespace Drupal\clr_graphql\Plugin\GraphQL\Mutations;

use Drupal\graphql_core\Plugin\GraphQL\Mutations\Entity\DeleteEntityBase;

/**
 * Simple mutation for deleting an article node.
 *
 * @GraphQLMutation(
 *   id = "delete_concept",
 *   entity_type = "node",
 *   entity_bundle = "concept",
 *   secure = true,
 *   name = "deleteConcept",
 *   type = "EntityCrudOutput!",
 *   arguments = {
 *     "id" = "String"
 *   }
 * )
 */
class DeleteConcept extends DeleteEntityBase {

}
