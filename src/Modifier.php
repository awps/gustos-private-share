<?php

namespace GustosPrivateShare;

/**
 * Class Modifier
 *
 * @package Gustos
 */
class Modifier {
    /**
     * @var \WP_Post|null
     */
    protected $shared_post = null;

    /**
     * @var string
     */
    protected $meta_key = 'gustos_private_shared_key';

    /**
     * Add the filters
     *
     * @return void
     */
    public function addFilters() {
        add_filter( 'the_posts', [ $this, 'thePostsModifier' ] );
        add_filter( 'posts_results', [ $this, 'resultsModifier' ] );
    }

    /**
     * Generate a key for a specific post.
     *
     * @param int $post_id
     *
     * @return string
     */
    public function getKey( $post_id ) {
        if ( empty( $post_id ) ) {
            return false;
        }

        $key = get_post_meta( $post_id, $this->meta_key, true );

        if ( empty( $key ) ) {
            $key = uniqid();
            update_post_meta( $post_id, $this->meta_key, $key );
        }

        return $key;
    }

    /**
     * @param int $post_id
     *
     * @return bool
     */
    public function canView( $post_id ) {
        return ! empty( $_GET['shared'] ) && $this->getKey( $post_id ) == $_GET['shared'];
    }

    /**
     * @param array $posts
     *
     * @return mixed
     */
    public function resultsModifier( $posts ) {
        // is_single won't work correctly
        if ( 1 !== count( $posts ) ) {
            return $posts;
        }

        $the_post = $posts[0];

        // Modify only this post type.
        if ( ! isset( $the_post->post_type ) || 'smk_recipes' !== $the_post->post_type ) {
            return $posts;
        }

        $status = get_post_status( $the_post );

        if ( 'private' === $status && $this->canView( $the_post->ID ) ) {
            $this->shared_post = $the_post;
        }

        return $posts;
    }

    /**
     * @param array $posts
     *
     * @return array
     */
    public function thePostsModifier( $posts ) {
        if ( empty( $posts ) && ! is_null( $this->shared_post ) ) {
            return [ $this->shared_post ];
        }
        else {
            $this->shared_post = null;

            return $posts;
        }
    }

}
