<?php

namespace Drupal\clr_graphql\Plugin\GraphQL\InputTypes;
use Drupal\graphql\Plugin\GraphQL\InputTypes\InputTypePluginBase;

/**
 * The input type for concept mutations.
 *
 * @GraphQLInputType(
 *   id = "concept_input",
 *   name = "ConceptInput",
 *   fields = {
 *     "title" = "String",
 *   }
 * )
 */
class ConceptInput extends InputTypePluginBase {
}
