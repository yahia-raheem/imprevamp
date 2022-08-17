<div class="imp-header-categories">
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