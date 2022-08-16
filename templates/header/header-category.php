<div class="imp-header-categories">
    <div class="imp-header-categories-dropdown">
        <a class="imp-header-category-hover">
            <i class="fa-solid fa-bars"></i>
            <span class="cat-title">Category</span>
        </a>
        <div class="imp-categories-dropdown">
            <?php
            $taxonomies = get_terms( array(
                'taxonomy' => 'course-category',
                'hide_empty' => false
            ) );
            
            if ( !empty($taxonomies) ) :
                $output = '<ul>';
                foreach( $taxonomies as $category ) {
                    if( $category->parent == 0 ) {
                        $output.= '<li><a title="'. esc_attr( $category->term_id ) .'" href="' . esc_url( get_term_link( $category ) ) . '">'. esc_html( $category->name ) .'</a></li>';
                    }
                }
                $output.='</ul>';
                echo $output;
            endif;
            ?>
        </div>
    </div>

    <form method="get" class="search-form" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" class="search-text" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_html__( 'Search...', 'cps' ); ?>">
        <button type="submit" class="btn btn-default">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </button>
    </form>

</div>