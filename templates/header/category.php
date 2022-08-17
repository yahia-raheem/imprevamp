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