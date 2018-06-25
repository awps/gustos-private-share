<?php

namespace GustosPrivateShare;

/**
 * Class Display
 *
 * @package Gustos
 */
class Display
{
    /**
     * @param int $post_id
     */
    public function render($post_id)
    {
        $status = get_post_status($post_id);
        if ('private' === $status) {
            echo '<h3 class="recipe-section-h section-share-private">' .
                 __('Share this recipe', 'gustos-private-share')
                 . '</h3>';
            echo '<p class="recipe-shared-description">' .
                 __('This recipe is private but you still can share it using this special link.',
                     'gustos-private-share')
                 . '</p>';

            $modifier = new Modifier();

            echo '<input class="recipe-shared-link" onclick="this.select();" value="' .
                 add_query_arg(
                     'shared',
                     $modifier->getKey($post_id),
                     get_the_permalink($post_id)
                 ) . '" />';
        }
    }

}
