
<?php
//custom meta field
$custom = get_post_custom(get_the_ID());
$cf_pagetitle = (isset($custom["page-title"][0]))? $custom["page-title"][0] : "";
$cf_pagedesc = (isset($custom["page-desc"][0]))? $custom["page-desc"][0] : "";
$singletitle = of_get_option('templatesquare_single_title' ,'Blog');
?>

<?php
if(is_singular('pdetail') || is_attachment()){

	$titleoutput='<h1 class="pagetitle nodesc"><span>'.get_the_title().'</span></h1>';
	echo $titleoutput;
	
}elseif(is_single()){

	$titleoutput='<h1 class="pagetitle nodesc"><span>'.$singletitle.'</span></h1>';
	echo $titleoutput;
	
}elseif(is_archive()){
	echo ' <h1 class="pagetitle nodesc"><span>';
	if ( is_day() ) :
	printf( __( 'Daily Archives <span>%s</span>', 'templatesquare' ), get_the_date() );
	elseif ( is_month() ) :
	printf( __( 'Monthly Archives <span>%s</span>', 'templatesquare' ), get_the_date('F Y') );
	elseif ( is_year() ) :
	printf( __( 'Yearly Archives <span>%s</span>', 'templatesquare' ), get_the_date('Y') );
	elseif ( is_author()) :
	printf( __( 'Author Archives %s', 'templatesquare' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" );
	else :
	printf( __( '%s', 'templatesquare' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	endif;
	echo '</span> </h1>';
	
}elseif(is_search()){
	echo ' <h1 class="pagetitle nodesc"><span>';
	printf( __( 'Search Results for %s', 'templatesquare' ), '<span>' . get_search_query() . '</span>' );
	echo '</span> </h1>';
	
}elseif(is_404()){
	echo ' <h1 class="pagetitle nodesc"><span>';
	_e( '404 Page', 'templatesquare' );
	echo '</span> </h1>';
	
}elseif( is_home() ){
	$homeid = get_option('page_for_posts');
	echo ' <h1 class="pagetitle nodesc"><span>';
	echo ($homeid)? get_the_title( $homeid ) : __('Blog', 'templatesquare');
	echo '</span> </h1>';
}else{

 if (have_posts()) : while (have_posts()) : the_post();
 
 	if($cf_pagedesc==""){$addclass="nodesc";}else{$addclass="";}
 
 	if(!is_front_page()){
		$titleoutput='';
		if($cf_pagetitle == ""){
			$titleoutput.='<h1 class="pagetitle '.$addclass.'"><span>'.get_the_title().'</span></h1>';
			$titleoutput.='<span class="pagedesc">'.$cf_pagedesc.'</span>';
		}else{
			$titleoutput.='<h1 class="pagetitle '.$addclass.'"><span>'.$cf_pagetitle.'</span></h1>';
			$titleoutput.='<span class="pagedesc">'.$cf_pagedesc.'</span>';
		}
		
		echo $titleoutput;
	}
endwhile; endif; wp_reset_query();

}

?>
 
