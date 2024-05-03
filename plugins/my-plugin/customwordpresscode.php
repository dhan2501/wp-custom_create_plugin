 <!--Create Option code by function-->
 <?php 
 if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
} ?>
 <!--End-->
 
 <!--Mega menu dyanamic html to wordpress-->
 						<div class="desktop-menuboxin">


							 <!--<ul>
								<li class="menu-item-has-children"><a href="javascript:;">Solutions</a>
									<div class="mega_menu">
										<ul>
											<li>
												<a href="#">LOCATOR LOGiX</a>
												<p>Locate Management Platform for Managing Locate Requests</p>
											</li>
											<li>
												<a href="#">DiG LOGiX</a>
												<p>Full-Service Ticket Submission & Management System for Excavators</p>
											</li>
											<li>
												<a href="#">GEO LOGiX</a>
												<p>Mapping & GIS Technology Platform</p>
											</li>
											<li>
												<a href="#">LOCATOR LOGiX</a>
												<p>Enterprise Management Platform for 811 Centers</p>
											</li>
											<li>
												<a href="#">INSiGHT LOGiX</a>
												<p>Continuous Intelligence & Data Analytics Platform</p>
											</li>
										</ul>
									</div>
								</li>

								<li class="menu-item-has-children"><a href="javascript:;">Industries</a>
									<ul>
									    <li><a href="javascript:;">Solutions</a></li>
									    <li><a href="javascript:;">Partners</a></li>
									    <li><a href="javascript:;">Contact US</a></li>
									</ul>
								</li>
								<li class="menu-item-has-children"><a href="javascript:;">News</a>
									<ul>
									    <li><a href="javascript:;">Solutions</a></li>
									    <li><a href="javascript:;">Partners</a></li>
									    <li><a href="javascript:;">Contact US</a></li>
									</ul>
								</li>
								<li class="menu-item"><a href="javascript:;">Partners</a></li>
								<li class="menu-item"><a href="javascript:;">About Us</a></li>
							</ul>-->
							
						    <ul>
								 <?php 
						    $menu = wp_get_nav_menu_object('menu');
						    
						    function buildTree( array &$elements, $parentId = 0 )
								{
								    $branch = array();
								    foreach ( $elements as &$element )
								    {
								        if ( $element->menu_item_parent == $parentId )
								        {
								            $children = buildTree( $elements, $element->ID );
								            if ( $children )
								                $element->wpse_children = $children;

								            $branch[$element->ID] = $element;
								            unset( $element );
								        }
								    }
								    return $branch;
								}


								function wpse_nav_menu_2_tree( $menu_id )
								{
								$items = wp_get_nav_menu_items( $menu_id );
								return  $items ? buildTree( $items, 0 ) : null;
								}


								
								$tree = wpse_nav_menu_2_tree('menu'); 
								//print_r($tree);
								$count=0;
								foreach ($tree as $row) {
									if($row->menu_item_parent ==0){ $count++; }
									if($count==1){
										?>
										<li class="menu-item-has-children"><a href="javascript:;"><?= $row->title;?></a>
											<div class="mega_menu">
												<ul><?php
												 foreach ($row->wpse_children as $sumenu) {
												 	?>
												 	<li><a href="javascript:;"><?= $sumenu->title;?></a><p><?= $sumenu->description;?></p></li>
												 	<?php
												 }
                                                 ?>
												</ul>
											</div>
										</li>
										<?php
                                      }
									else{
										$is_single=!empty($row->wpse_children) ? false : true;
										if($is_single){
											<li class="menu-item"><a href="javascript:;"><?= $row->title;?></a></li>
											?>
											<?php

										}else{
											?>
										<li class="menu-item-has-children"><a href="javascript:;"><?= $row->title;?></a>
											<ul>
												 <?php
												 foreach ($row->wpse_children as $sumenu) {
												 	?>
												 	<li><a href="javascript:;"><?= $sumenu->title;?></a></li>
												 	<?php
												 }
                                                 ?>
											</ul>
										</li>
                                       <?php
                                       }

       

										
									}
                                    } ?>
								
								
						    </ul>

						</div>
 
 <!--End Mega MEnu-->
 
 if ( is_user_logged_in() ) {
   // your code for logged in user 
} else {
   // your code for logged out user 
}
 <?php //wp_nav_menu( array( 'menu' => 'responsive-top-menu', 'link_before' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i> ', 'link_after' => '','menu_class' => 'menu-list accordion' ) ); 
    $menu = wp_get_nav_menu_object('responsive-top-menu');
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
    ?>
    <ul class="menu-list accordion">
      <?php
      foreach($menuitems as $menuitemsRow){

        ?>
        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="<?= $menuitemsRow->url;?>"><?= $menuitemsRow->title;?></a></li>
        <?php
      }
      ?>
<!--2nd Option menu-->
 <?php
function buildTree( array &$elements, $parentId = 0 )
{
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->wpse_children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
}
function wpse_nav_menu_2_tree( $menu_id )
{
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? buildTree( $items, 0 ) : null;
}

$tree = wpse_nav_menu_2_tree( 'responsive-top-menu' );  // <-- Modify this to your needs!


?>
          

          <ul class="menu-list accordion">
           <?php
            foreach ($tree as $list) {
              if(empty($list->wpse_children)){
            ?>
            <li><a href="<?= $list->url;?>"><?= $list->title?></a></li>
             <?php 
           }
           else{
            ?>
            <li id="nav1" class="toggle accordion-toggle"> <span class="icon-plus"></span>
               <a class="menu-link"href="#"><?= $list->title;?></a> 
            <ul class="menu-submenu accordion-content">
              <?php
               foreach ($list->wpse_children as $subList) {
                ?>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-410 hvr-sweep-to-right"><a href="<?= $subList->url;?>"><?= $subList->title;?></a></li>
                <?php
               }
              ?>
            </ul>
            </li>
            <?php
           }
            }

           ?>

            <!-- <li><a href="<?php //echo home_url(); ?>">home</a></li> -->
           
            <!-- <li id="nav1" class="toggle accordion-toggle"> <span class="icon-plus"></span>
               <a class="menu-link"href="#">services</a> </li>
            <ul class="menu-submenu accordion-content">
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-410 hvr-sweep-to-right"><a href="#">Services 1</a></li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-409 hvr-sweep-to-right"><a href="#">Services 2</a></li>

            </ul> -->
          
            <!-- <li><a href="#">projects</a></li>
            <li><a href="#">Contact</a></li>
           
          
            <li><a href="#">News</a></li>
            <li><a href="#">Pages</a></li> -->

            <li class="quote-btn-cls"><a href="" data-toggle="modal" data-target="#myModal">get a quote</a> </li>
          </ul>
		  
<!--2nd End-->
 <?php  when create taxnomy for post
	//$the_permalink = the_permalink();
	$terms = get_the_terms( $post->ID, 'property_type' );
	if ( !empty( $terms ) ){
	// get the first term
	$term = array_shift( $terms ); ?>
	<a href="<?php the_permalink(); ?>"> <?php echo $term->name; ?></a>
<?php } ?>



<!--Call image in html inline css background url by using Image ACF-->
<?= wp_get_attachment_image_url( get_field('banner_image', 472), 'full'); ?>

<!--End-->


<!--Fetch data by tab function using Repetor ACF plugin-->
https://stackoverflow.com/questions/53149648/nested-tabs-with-repeater-advance-custom-fields-wordpress
<div class="about-new-cls menu-inner-tabs">
  <div class="container">
	<div id="exTab3" class="container">	
      <div class="col-lg-12 col-md-12">      
        <?php 
        if( have_rows('repeat_tab_for_menu') ): ?>
        <ul  class="nav nav-pills">
          <?php $i=1; while ( have_rows('repeat_tab_for_menu') ) : the_row(); ?>

        			<li  <?php if ($i==1) { ?>class="active"<?php } ?>>
                    
                <a  href="#<?php echo $i; ?>b" data-toggle="tab"><?php the_sub_field('title'); ?></a>
        			</li>
              <?php $i++; endwhile; ?>
          		
        		</ul>
      </div>
      <div class="tab-content clearfix">
        <?php $i=1; while ( have_rows('repeat_tab_for_menu') ) : the_row(); ?>
                  <?php
                  $string = sanitize_title( get_sub_field('title') );
                  ?>

      			  <div class="tab-pane <?php if ($i==1) { ?>in active<?php } ?>" id="<?php echo $i; ?>b">         
                  
                <div class="gal-cls">
                  <?php
                  while (have_rows('gallery_image')) {
                      the_row();
                      // Display each item as a list
                      $image = get_sub_field('image');
                  ?>
                          <div class="col-md-6 col-sm-6 col-gall">
                            <div class="menu-sub-tab">            
                              <div class="sub-tab-img">
                                <img src="<?php echo $image; ?>" class="sub-menu-sm-img">
                              </div>
                              <div class="sub-menu-text-dg-cls">
                                <div class="sub-tab-des">
                                  <h6><span><?php the_sub_field('title'); ?> </span> </h6>
                                </div>
                                <div class="sub-menu-description">
                                  <p><?php the_sub_field('content'); ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                  <?php  } // end while have rows section_items  ?>
                         

                </div>                
              </div>
        <?php $i++; endwhile; ?>
      </div>            
  </div>
          
  </div>
  <?php endif; ?>      
</div>



</div>
</div>
  </section>
<!--End tab-->

<!--Start Filter post by input field and dropdown cateory on click submit button -->
<!--Form 1  Redirect-->
<ul class="list-inline-location">
                                    <form action="property-list/">
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><input autocomplete="off" type="text" class="form-control rounded" name="q" id="search" placeholder="Enter Keyword Here..."></li>
<?php
  /*if( $terms = get_terms( array( 'post_type' => 'post', 'orderby' => 'name') ) ) :
    echo '<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><input name="categoryfilter" id="categoryfilter" class="inpad form-control" placeholder="Enter Keyword Here..."></li>';
    
  endif; */

  if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name', 'child_of' => 4, ) ) ) :

    echo '<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><div class="search-item search-select rtin-location"><select class="select-accessible" name="cat"><option value="">Select Location</option>';
    foreach ( $terms as $term ) :
      echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
    endforeach;
    echo '</select></div></li>';
  endif;
  ?>
                                        <li class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                            <i class="fa fa-sliders"></i>
                                        </li>
                                        <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sub-btn-cl-sjb"><button type="submit"
                                                id="apply" class="sub" id="contact33-submit">Search</button><i
                                                class="fa fa-search"></i></li>
                                      
                                    </form>
</ul>


<!--Form 2 filter same page-->
 <form action="">
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	<input autocomplete="off" type="text" class="form-control rounded" name="q" id="search" placeholder="Enter Keyword Here..." value="">
</li>
<?php

  if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name', 'child_of' => 4, ) ) ) :
    
    echo '<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><div class="search-item search-select rtin-location"><select class="select-accessible" name="cat"><option value="">Select Location</option>';
    foreach ( $terms as $term ) :
      echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
    endforeach;
    echo '</select></div></li>';
  endif;
  ?>
                                        <li class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                            <i class="fa fa-sliders"></i>
                                        </li>
                                        <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sub-btn-cl-sjb"><button type="submit"
                                                id="apply" class="sub" id="contact33-submit">Search</button><i
                                                class="fa fa-search"></i></li>
                                      
                                    </form>
                                </ul>


<!--End-->
                    <div id="misha_posts_wrap">
					<?php
					
					   $type = 'post';
	                   $args=[];
	                   $args['post_type']=$type;
	                   $args['post_status']='publish';
	                   $args['order']='asc';
	                   $args['posts_per_page']=-1;
	                   
	                   if(!empty($_GET['q'])){
	                   $args['s']=$_GET['q'];
	                   }
	                   if(!empty($_GET['cat'])){
	                   	$args['tax_query'] =[ 
	                   		['taxonomy' => 'category','field'    => 'term_id','terms'    => $_GET['cat']]
		                ];
	                   	
	                   }
	                
					$the_query = new WP_Query( $args ); ?>

                        <div class="row">
                            <?php if ( $the_query->have_posts() ) { while ( $the_query->have_posts() ) : $the_query->the_post(); ?>



                            <div class="col-lg-4 col-md-4">



                                <div class="property-box">
                                    <!--Start Dynamic Code-->
                                    <div class="property-img">
                                        <a href="<?php the_permalink(); ?>"><img
                                                src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>"></a>
                                        <div class="property-overlay"></div>
                                        <span class="listing-type-badge">
                                            For <?php if ( get_field('badge') ) {
      echo do_shortcode( get_field('badge') );
    } ?>
                                        </span>

                                        <div class="product-price">

                                            <bdi><span class="price-currency">$<?php if ( get_field('rate') ) {
        echo do_shortcode( get_field('rate') );
      } ?></span>/yr</bdi>



                                        </div>
                                    </div>

                                    <div class="property-category">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php if ( get_field('area') ) {
      echo do_shortcode( get_field('area') );
    } ?></a></h3>

                                        <ul class="entry-meta">
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php if ( get_field('location') ) {
      echo do_shortcode( get_field('location') );
    } ?></li>
                                        </ul>


                                        <ul class="product-features">
                                            <li><i class="fa fa-bed"></i><span class="icon"></span>Beds <?php if ( get_field('beds') ) {
      echo do_shortcode( get_field('beds') );
    } ?></li>
                                            <li><i class="fa fa-bath"></i><span class="icon"></span>Baths <?php if ( get_field('baths') ) {
      echo do_shortcode( get_field('baths') );
    } ?></li>
                                            <li><i class="fa fa-area-chart"></i><span class="icon"></span><?php if ( get_field('room_size') ) {
      echo do_shortcode( get_field('room_size') );
    } ?> sqft</li>
                                        </ul>




                                    </div>
                                    <!--End Dynamic Code -->


                                </div>
                            </div>
                            <?php endwhile; 
                        }else {
                        	?>
                        	<div class="clearfix"></div>
                    <div class="text-center main-btn">
                     There are no any related property found.........
                    </div>
                        	<?php
                        }
                             ?>

                        </div>
                    </div>
<!--End-->

<!--Make Tab section html to wordpress using php code with fetch filter cutom post type post-->
<ul class="nav nav-pills" role="tablist">
    <?php
    $args = array(
        'taxonomy' => 'our_menu_categories',
        'order' => 'ASC'
    );
    $categories = get_categories($args);
    $i=0;
    foreach($categories as $category) { 
    $i++;
    $is_active=false;
    $is_active=($i==1) ? "active" : "";

        echo 
            '<li class="'.$is_active.'">
                <a href="#'.$category->slug.'" role="tab" data-toggle="tab">    
                    '.$category->name.'
                </a>
            </li>';
    }?>
    </ul>
	
	
<!--Fetch post-->

<?php
$ii=0;
    foreach($categories as $category) { 
       $ii++;
    $is_active=false;
    $is_active=($ii==1) ? "active" : "";
       ?>
        <div class="tab-pane <?= $is_active;?>" id="<?= $category->slug;?>">
<div class="row">
 <?php

        $type = 'food_menu_post';
                   // $args=array(
                   // 'post_type' => $type,
                   // 'post_status' => 'publish',
                   //  'order'=>'asc',
                   //  'category_name' =>$category->slug
                   //  );

                $args = array(
                'post_type' => $type,
                'post_status' => 'publish',
                'order'=>'asc',
                'tax_query' => array(
                array(
                'taxonomy' => 'our_menu_categories',
                'field'    => 'term_id',
                'terms'    => $category->cat_ID,
                ),
                ),
                );           
                  $my_query = new WP_Query($args);
                   //$my_query = get_posts( $args );
        while ($my_query->have_posts()) : $my_query->the_post(); { ?>


  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="gall-in1">
      <div class="demo">
<div class="text-gal">
<h4><a href="#"><?php the_title(); ?></a></h4>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/line.png" class="line-img gal-line-img">
<p><?php the_content(); ?></p>

</div></div>
        </div>
  </div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
  <div class="gall-in1">
    <div class="demo">
      <div class="box7">
       
          <div class="vid-overlay"></div>
          <div class="news-date interior-spce-cls-fd"> <img src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>" class="interior-icon-cls"> </div>
          <div class="box-content">
            <div class="inner-content">
              <div class="gallery icon project-sub-icon"> <a href="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>" class="big read"> <span class="icon big-2"><i class="fa fa-plus"></i></span> </a> </div>
            </div>
          </div>
        
      </div>
    </div>
  </div>
</div>
<?php
}endwhile;
?>
</div>

</div>
<?php
 }
?>


              

            
            </div>
<!--End section-->



<!--Fetch Menu when all header  given in ul li-->
<?php //wp_nav_menu( array( 'menu' => 'responsive-top-menu', 'link_before' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i> ', 'link_after' => '','menu_class' => 'menu-list accordion' ) ); 
    $menu = wp_get_nav_menu_object('responsive-top-menu');
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
    ?>
    <ul class="menu-list accordion">
      <?php
      foreach($menuitems as $menuitemsRow){

        ?>
        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="<?= $menuitemsRow->url;?>"><?= $menuitemsRow->title;?></a></li>
        <?php
      }
      ?>

      <li class="table-btn"><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" data-toggle="modal" data-target="#myModal" >book a table</a></li>

<!--End-->

<!--Fetch data when create category-->
<?php
$args = array('taxonomy' => 'our_menu_categories'); 
$tax_menu_items = get_categories( $args );
//print_r($tax_menu_items);
foreach ( $tax_menu_items as $tax_menu_item ){ 
$slug = $tax_menu_item->taxonomy . '_' .$tax_menu_item->term_id;
$image_arry=get_field('image',$slug);
$thumbnail=!empty($image_arry['sizes']['thumbnail']) ? $image_arry['sizes']['thumbnail'] : '';
  ?>

<div class="col-lg-4 col-md-4">
        <div class="gall-in1">
          <div class="demo">
            <div class="box7">
             
                <div class="vid-overlay"></div>
                <div class="news-date interior-spce-cls-fd"> <img src="<?= $thumbnail;?>" class="interior-icon-cls"> </div>
                <div class="box-content">
                  <div class="inner-content">
                    <div class="gallery icon project-sub-icon"> <a href="<?= $thumbnail;?>" class="big read"> <span class="icon big-2"><i class="fa fa-plus"></i></span> </a> </div>
                  </div>
                </div>
              
            </div>

            <a href="<?php echo $tax_menu_item->slug; ?>" class="menu-name-hd"><?php echo $tax_menu_item->name; ?></a>
          </div>
        </div>
      </div>
<?php }  ?>

<!--ENd Section-->



<!--Display content indivual page-->
<?php 
        $id=5; 
        $post = get_post($id); 
        $content = apply_filters('the_content', $post->post_content); 
        echo $content;  
    ?>
<!--End-->

<!--Create shorcode by funtions-->
<?php 
function imsg_shortcode($atts,$content=null){
	$atts = shortcode_atts(
		array(
			'reply' => 'false',
		)
	);

	$msgType = (esc_attr($atts['reply']) == 'true') ? 'reply' : 'first';
	return '<div class="imsg' . $msgType . '">' . . '</div>';
}
add_shortcode('imsg','imsg_shortcode');
?>
<!--End shortcode by function-->

<!-- Condition mail body send -->
[group Support][/group][group Suggestion][/group][group Feedback][/group][group Complaint][/group]

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-group">
             [tel Phone class:cform placeholder minlength:10 maxlength:10 "Phone Number"]
            </div>            
        </div>        
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-group cform">  
[select* choice "Support" "Suggestion" "Feedback" "Complaint"]
</div>           




<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="input-group">
                <button type="submit" class="button size-lg icon_right submit-btn">submit <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>     
       
    </div>
</div>

mail body
[Support]Dear [FullName],

Thank you very much for contacting us with your Support Request.

We have forwarded your complaint to our Support Department and you will hear shortly from them about your request. 

Thank you for your patience in this matter.


Regards,
NetEdge Support Team
[/Support][Suggestion]Dear [FullName],

Thank you very much for taking out time to give us your Suggestion. We as an Organization continuously strive for improvement. Your suggestion will help us in this endeavour.

Your suggestion has been forwarded to our Quality and Process Improvement Department so that they can evaluate it and incorporate in our process.


Regards,
NetEdge Support Team
[/Suggestion][Feedback]Dear [FullName],

Thank you very much for giving us your Feedback. 

We always try to improve our service based on the feedback received by us from our Customers, Partners and Vendors. 

We will evaluate your feedback and try to improve ourselves based on your feedback.


Regards,
NetEdge Support Team
[/Feedback][Complaint]Dear [FullName],

Thank you very much for contacting us regarding your Complaint.

We have forwarded your complaint to our Client Service Department and you will hear shortly from them about the resolution of your complaint. 

Thank you for your patience in this matter.


Regards,
NetEdge Support Team
[/Complaint]


<!-- End -->

<!--update newsletter form code -->
<a href="http://15.207.164.88/netdev/index.php/update-newsletter/?e=[your-email]">Click to update</a>
<!--End update newsletter form code -->
<script>

input[type=file]{
    width:90px;
    color:transparent;
}

window.pressed = function(){
    var a = document.getElementById('aa');
    if(a.value == "")
    {
        fileLabel.innerHTML = "Choose file";
    }
    else
    {
        var theSplit = a.value.split('\\');
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};
</script>

<?php /*add_action( 'init', 'my_new_default_post_type', 1 );
function my_new_default_post_type() {

    register_post_type( 'post', array(
        'labels' => array(
            'name' => _x( 'Latest Courses', 'add new on admin bar' ),
        ),
        'public'  => true,
        '_builtin' => false, 
        '_edit_link' => 'post.php?post=%d', 
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => 'product' ),
        'query_var' => false,
        'with_front' => false,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
    ) );
}*/




use id in birthnumber in field
<script>
const $input = document.querySelector("#birthnumber");
const BIRTHNUMBER_ALLOWED_CHARS_REGEXP = /[0-9\/]+/;
$input.addEventListener("keydown", event => {
  if (!BIRTHNUMBER_ALLOWED_CHARS_REGEXP.test(event.key)) {
    event.preventDefault();
  }
});
</script>


add_action( 'woocommerce_after_shop_loop_item_title', 'wc_add_short_description' );

function wc_add_short_description() {
	global $product;

	?>
        <div itemprop="description" class="shortdescriptions">
            <?php echo substr( apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ), 0,100 ); echo '' ?>
        </div>
	<?php
}

<!----Start Hide and show div/ section using javascript---->
<style>
/*#myDIV {
  display: none;
}
#advance {
  display: none;
}
#premium{display: none;}*/
#Div1{display: none;}
#Div2{display: none;}
#Div3{display: none;}
</style>
<script>
 var divs = ["Div1", "Div2", "Div3", "Div4"];
    var visibleDivId = null;
    function divVisibility(divId) {
      if(visibleDivId === divId) {
        visibleDivId = null;
      } else {
        visibleDivId = divId;
      }
      hideNonVisibleDivs();
    }
    function hideNonVisibleDivs() {
      var i, divId, div;
      for(i = 0; i < divs.length; i++) {
        divId = divs[i];
        div = document.getElementById(divId);
        if(visibleDivId === divId) {
          div.style.display = "block";
        } else {
          div.style.display = "none";
        }
      }
    }

</script>
https://stackoverflow.com/questions/31799603/show-hide-multiple-divs-javascript
<body>
<div class="main_div">
<div class="buttons">
<a href="#" onclick="divVisibility('Div1');">Div1</a> | 
<a href="#" onclick="divVisibility('Div2');">Div2</a> | 
<a href="#" onclick="divVisibility('Div3');">Div3</a> | 
<a href="#" onclick="divVisibility('Div4');">Div4</a>
</div>
<div class="inner_div">
<div id="Div1">I'm Div One</div>
<div id="Div2" style="display: none;">I'm Div Two</div>
<div id="Div3" style="display: none;">I'm Div Three</div>
<div id="Div4" style="display: none;">I'm Div Four</div>
</div>
</div>
<!--Start If we use button tag-->
<a href="#Div3"><button class="order-butn" onclick="divVisibility('Div3');">Order Now</button></a>
<!-- End -->
<!--Also using this script in button tag -->
</body>
<!---- End ------------>
<?php

/*---------------------Start Add New Button in woocommerce------------------- */
function read_more() {
    global $product;
    if ( $product ) {
        $url = esc_url( $product->get_permalink() );
        echo '<a rel="nofollow" href="http://15.207.164.88/netportfoliodev/" class="read_more">Read More</a>';
    }
}
/*----------End--------------*/
<!--<ul class="select">
<li>Select by default filter</li>
<li><?php echo  esc_attr( $name ); ?></li>
<?php
    $catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
	
    'menu_order' => __( 'Default sorting', 'woocommerce' ),

    'popularity' => __( 'Sort by popularity', 'woocommerce' ),

    'rating'     => __( 'Sort by average rating', 'woocommerce' ),

    'date'       => __( 'Sort by newness', 'woocommerce' ),

    'price'      => __( 'Sort by price: low to high', 'woocommerce' ),

    'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
) );

if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
    unset( $catalog_orderby['rating'] );

foreach ( $catalog_orderby as $id => $name )
    echo '<li><a href="' . get_permalink( woocommerce_get_page_id( 'sample-page' ) ) . '?orderby=' . $id . '" >' . esc_attr( $name ) . '</a></li>';
?>
<span></span>
</ul>-->


/* Dynamic code for sortby ordeing when using shop page */
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php 
		$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
	
		'menu_order' => __( 'Default sorting', 'woocommerce' ),

		'popularity' => __( 'Sort by popularity', 'woocommerce' ),

		'rating'     => __( 'Sort by average rating', 'woocommerce' ),

		'date'       => __( 'Sort by newness', 'woocommerce' ),

		'price'      => __( 'Sort by price: low to high', 'woocommerce' ),

		'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
	) );

if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
    unset( $catalog_orderby['rating'] );

foreach ( $catalog_orderby as $id => $name )
    echo '<li><a href="' . get_permalink( woocommerce_get_page_id( 'sample-page' ) ) . '?orderby=' . $id . '" >' . esc_attr( $name ) . '</a></li>';
		foreach ( $catalog_orderby as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>	



/* Second*/
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
	<?php 
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by latest', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
			)
		);

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! wc_review_ratings_enabled() ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

	?>
		<?php 
foreach ( $catalog_orderby as $id => $name )
    echo '<li><a href="' . get_permalink( woocommerce_get_page_id( 'sample-page' ) ) . '?orderby=' . $id . '" >' . esc_attr( $name ) . '</a></li>';
		foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>	
?>

<?php
/* Below code for alll in one migration plugin for import website. */
/* This code add to in wp-config file */
@ini_set( 'upload_max_filesize' , '2000M' );
@ini_set( 'post_max_size', '2000M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );
 /* this code add to in .htaccess file */
php_value upload_max_filesize 2000M
php_value post_max_size 2000M
php_value memory_limit 256M
php_value max_execution_time 300
php_value max_input_time 300
?>

<?php
/* Without add price show add to cart button in woocommerce */
add_filter('woocommerce_is_purchasable', '__return_TRUE'); 
function wpa104760_default_price( $post_id, $post ) {

    if ( isset( $_POST['_regular_price'] ) && trim( $_POST['_regular_price'] ) == '' ) {
        update_post_meta( $post_id, '_regular_price', '0' );
    }

}

?>

<?php
/* Below code add in functions.php */
add_action( 'wp_footer', 'wpcf7_input_numbers_only');
function wpcf7_input_numbers_only() {
  echo '
  <script>
  onload =function(){ 
    var ele = document.querySelectorAll(\'.wpcf7-numbers-only\')[0];
    ele.onkeypress = function(e) {
      if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
      return false;
    }
    ele.onpaste = function(e){
      e.preventDefault();
    }
  }
  </script>
  ';
}

/* Add class in cf tel field */
class:wpcf7-numbers-only

/* User this id for disable character from tel number  with below script....  */
<input id="birthnumber" type="text" required pattern="[0-9\.]+" />
<script>
const $input = document.querySelector("#birthnumber");
const BIRTHNUMBER_ALLOWED_CHARS_REGEXP = /[0-9\/]+/;
$input.addEventListener("keydown", event => {
  if (!BIRTHNUMBER_ALLOWED_CHARS_REGEXP.test(event.key)) {
    event.preventDefault();
  }
});
</script>

/*------------------------- End -------------------------*/

/index.php/%year%/%monthnum%/%day%/%postname%/ 
/*---------------------------------Start -------------------------*/
 bloginfo( 'name' ); /*This code for get alt tag imgae name */

.staff-item-wrapper a {
    pointer-events: none;
    cursor: default;
}
/*----------------------- End -------------------------*/
?>
<?php
/* Code for hide text field */
add_action("wpcf7_posted_data", "wpcf7_modify_this");
function wpcf7_modify_this($posted_data) {

    // if user leaves the message area blank, set to "Field None"
    if ($posted_data['company'] == "")
        $posted_data['company'] = "Field Not Fill";
		
	if ($posted_data['text'] == "")
        $posted_data['text'] = "Field Not Fill";
		
	if ($posted_data['text'] == "")
        $posted_data['text'] = "Field Not Fill";

    return $posted_data;
}

//for dropdown select option add defualt 
first_as_label "-- Select Option --" 
?>

<!--Multiple tab add in woocommerec single page-->
https://stackoverflow.com/questions/39964939/adding-multiple-tabs-to-woocommerce-single-product-pages

<!--Change Shop Page Layout by using html -->
<!-- Rename woocommerce->archive-poduct.php file and create New archive-product.php file then copy paste below code and add own html layout. -->
<?php

defined('ABSPATH') || exit;
get_header('shop');
do_action('woocommerce_before_main_content'); ?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	
	?>
//<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</header>

<?php
if (woocommerce_product_loop()) {
    do_action('woocommerce_before_shop_loop'); 
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();	
?>
<div class="product-show">
    <div class="col-md-4 col-sm-6 col-xs-12">
		<div class="row">
			<div class="card">
				<div class="card-body">
				<!--<div class="row">-->
					<div class="product-show">
						
							<div class="col-md-3">
								<p>Experience : 3</p>
								<p>Project : 150+</p>
							</div>
							<div class="col-md-6">
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( $the_query->ID, array( 500, 400) );  ?></a>
								<div class="job-title"><p>Sumit Kumar</p></div>
								<div class="job-title"><p>(<?php echo the_title(); ?> )</p></div>
								<!--<div class="condidate_detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>-->
							</div>
							<div class="col-md-3">
								<div class="skills">
									<h5>Skills</h5>
									<p>PHP</p>
									<p>Photoshop</p>
									<p>Wordpress</p>
									<p>Python</p>
									<p>Python</p>
								</div>
							</div>
					</div>
						
					<!--</div>-->
					
				</div>
			</div>
		</div>
		<div class="condidate_detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>

	</div>
</div>
	<?php   }} do_action('woocommerce_after_shop_loop');
} else {
    do_action('woocommerce_no_products_found');
}
do_action('woocommerce_after_main_content');
do_action('woocommerce_sidebar');
get_footer('shop');

?>
<!--Then after below code in function.php file for autocustomize column and row.-->

<?php 
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 4 ;//4 products per row
    }
}

?>
<!--End Change Shop Page Layout by using html -->

<!--Condition wise send mail to user by contact form 7 code below-->
/*--------------Start Mail_2  ------------------------*/
function hsc_cf7_submit_update_email($cf){
    $formID = $cf->id();
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    if (!$submission){
        return;
    }
    
    if($formID == 'ENTER FORM ID'){

        $submitData = $submission->get_posted_data();

        $mail = $wpcf7->prop('mail_2');
        $mailBody = $mail['body'];
        if($submitData['anrede'][0] == 'Herr'){
            $mail['body'] = "<p>Sehr geehrter Herr</p>";
            $wpcf7->set_properties( array("mail_2" => $mail)) ;
        }elseif($submitData['anrede'][0] == 'Frau'){
           $mail['body'] = "<p>Sehr geehrte Frau</p>";
            $wpcf7->set_properties( array("mail_2" => $mail)) ;
        }
    }else{
        return;
    }
}
add_action( 'wpcf7_before_send_mail', 'hsc_cf7_submit_update_email' );

/*----------------End-----------------*/


<?php function hsc_cf7_submit_update_email($cf){
    $formID = $cf->id();
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    if (!$submission){
        return;
    }
    
    if($formID == '10546'){

        $submitData = $submission->get_posted_data();

        $mail = $wpcf7->prop('mail');
        $mailBody = $mail['body'];
        if($submitData['menu-847'][0] == 'Support'){
            $mail['body'] = "Thank you very much for contacting us with your Support Request.
							
							We have forwarded your complaint to our Support Department and you will hear shortly from them 							   about your request. 
							
							Thank you for your patience in this matter.
							
							Regards,
							NetEdge Support Team
							";
            $wpcf7->set_properties( array("mail" => $mail)) ;
        }elseif($submitData['menu-847'][0] == 'Suggest'){
           $mail['body'] = "Thank you very much for sending us your Suggestion. 
							
							We appreciate you taking time out to give us suggestion to improve our service. We strive for 							  continuous improvement of our services. Your suggestion will help us in this endeavour.
							
							Your suggestion has been forwarded to our Quality and Process Improvement Department so that 							 they can evaluate it and incorporate in our process.
							
							Regards,
							NetEdge Support Team
							";
            $wpcf7->set_properties( array("mail" => $mail)) ;
        }
		elseif($submitData['menu-847'][0] == 'Feedback'){
           $mail['body'] = "Thank you very much for giving us your Feedback.
							
							We always try to improve our service based on the feedback received by us from our Customers, 							  Partners and Vendors.
							
							We will evaluate your feedback and try to improve ourselves based on your feedback.
							
							Regards,
							NetEdge Support Team
							";
            $wpcf7->set_properties( array("mail" => $mail)) ;
        }
		elseif($submitData['menu-847'][0] == 'Enquire'){
           $mail['body'] = "<p>Sehr geehrte Frau</p>";
            $wpcf7->set_properties( array("mail" => $mail)) ;
        }
		elseif($submitData['menu-847'][0] == 'Complaint'){
           $mail['body'] = "Thank you very much for contacting us with your Complaint.
							
							We have forwarded your complaint to our Client Service Department and you will hear shortly 							from them about the resolution of your complaint. 
							
							Thank you for your patience in this matter.
							
							Regards,
							NetEdge Support Team
							";
            $wpcf7->set_properties( array("mail" => $mail)) ;
        }
    }else{
        return;
    }
}
add_action( 'wpcf7_before_send_mail', 'hsc_cf7_submit_update_email' ); ?>

 <title>
    <?php the_title();?>
</title>
-----------------------------------------------------------------------------------------		
<!--Dynamic logo -->					
<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<img class="header_logo" src="'.$image[0].'">';
?>
<img src="<?php header_image(); ?>" alt="">

//get the site url 
<?php echo get_site_url(); ?>
-----------------------------------------------------------------------------------------
<!-- Dynamic Custom type post code-->

    <?php $type = 'homebuildings';
                   $args=array(
                   'post_type' => $type,
                   'post_status' => 'publish',
                    'order'=>'asc',
					'category' => news,
					'posts_per_page' => 4,
                    );
                   $my_query = new WP_Query($args);
			  while ($my_query->have_posts()) : $my_query->the_post(); {?>
		  
		  
<?php }endwhile; wp_reset_query(); ?>	
/*Post Details page next prious code*/
<?php
    $next_post = get_adjacent_post( false, '', true);
    $next_post_url = get_the_permalink($next_post);

    $previous_post = get_adjacent_post( false, '', false);
    $previous_post_url = get_the_permalink($previous_post);

   $current_url = get_permalink( get_option( 'page_for_posts' ) );

?>
<?php if($previous_post_url == $current_url) {?>
	<a href="<?php echo $next_post_url;?>">Next post</a>
<?php }elseif($next_post_url == $current_url){?>
	<a href="<?php echo $previous_post_url;?>">Previous post</a>
<?php } else{ ?>
	<a href="<?php echo $previous_post_url;?>">Previous post</a>
	<a href="<?php echo $next_post_url;?>">Next post</a>
<?php } ?>		  
<?php the_time('F j, Y'); ?>
<?php the_author();?>
<?php echo  wp_get_attachment_url( get_post_thumbnail_id(177) );?>
<?php the_title(); ?>
<?php the_content(); ?>
 <?php $content = get_the_content(); echo mb_strimwidth($content, 0, 10, '...'); ?> 
 
 <?php $content = get_the_content(); echo implode(' ', array_slice(explode(' ', $content), 0, 17)); ?>
 
 <?php $author_id=$post->post_author; ?>
<?php the_author_meta( 'user_nicename' , $author_id ); ?>
 /*When Add Active class for post when odd even*/
 
 <?php $type = 'services';
                   $args=array(
                   'post_type' => $type,
                   'post_status' => 'publish',
                    'order'=>'asc',
                    );
                   $my_query = new WP_Query($args);
                   $i= 0;
			  while ($my_query->have_posts()) : $my_query->the_post(); {
			  	
			  	?>
            <div class="col-md-12 mb-3">
                <div class="service-single <?php if($i % 2 == 0){echo "sibling1"; } else{echo "";}?>">
                    <div class="header">
                        <div class="icon-area">
 
 
 <?php $i++; }endwhile; wp_reset_query(); ?>	
 /*Show category eeach post */
 <h6><?php the_time('F j, Y'); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<?php $cat = get_the_category(); 
                    for($i=0;$i<count($cat);$i++){
                    	if($i == count($cat)-1){
                    		echo $cat[$i]->cat_name;
                    	}else{
                    		echo $cat[$i]->cat_name.",";
                    	}
                    		
                    }
                     ?></h6>
 
 /*End */
<?php 
	if(has_post_thumbnail()):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); 
	?>
	<img src="<?= $image[0]; ?>">
	<?php 
	endif;
?>	
<?php $key="mykey"; echo get_post_meta($post->ID, $key, true); ?>
<?php  echo get_comments_number(); ?>
<?php 
$key="rating"; $rating_value = get_post_meta($post->ID, $key, true); 
for($i=0;$i<$rating_value;$i++){?>
<i class="fas fa-star fill"></i>
<?php } ?>

/*ACF rating*/
<?php                    
$rat = get_sub_field('rating', $post->ID );                       
for($i=0; $i<$rat; $i++){?>
<i class="fa fa-star"></i>
<?php } ?>
----------------------------------------------------------------------------------------
/* Dynamic code for flie link */
<?php bloginfo('template_url');?>/
<?php echo get_stylesheet_directory_uri(); ?>/
<?php echo get_stylesheet_directory_uri(); ?>/

// enqueue files	
function wpdocs_theme_name_scripts() {
	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

// create custom shortcode

add_shortcode( 'sample-shortcode','shortcode_function'  );
		function shortcode_function(  ) {
			return "Hello Shortcode";
		}
----------------------------------------------------------------------------------------
/*Custom Post type create in fucntion file*/
/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Movies', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Movies', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Movie', 'twentytwentyone' ),
        'all_items'           => __( 'All Movies', 'twentytwentyone' ),
        'view_item'           => __( 'View Movie', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Movie', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Movie', 'twentytwentyone' ),
        'update_item'         => __( 'Update Movie', 'twentytwentyone' ),
        'search_items'        => __( 'Search Movie', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'movies', 'twentytwentyone' ),
        'description'         => __( 'Movie news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'movies', $args );
  
}
  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_post_type', 0 );

--------------------------------------------------------------------------------------------------
// Widgets create by functions.php files

function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );
----------------------------------------------------------------------------------------
<!--Dynamic code for home page link -->
<?php echo home_url();?>
----------------------------------------------------------------------------------------
<!--Dynamic code for Sidebar call -->
<?php dynamic_sidebar('sidebar-31');  ?>
// To display footer_widget_areasidebar
<?php if ( is_active_sidebar( 'footer_widget_area' ) ) : ?>
    <?php dynamic_sidebar( 'footer_widget_area' ); ?>
<?php endif; ?>
----------------------------------------------------------------------------------------
<?php
if (have_rows('contact_us_section', 'options')) :
	while (have_rows('contact_us_section', 'options')) : the_row();
		if (get_row_layout() == 'contact_us') :
?>
<?php
		endif;
	endwhile;
endif;
?>
<!--dynamic menu code-->
          <?php
function buildTree( array &$elements, $parentId = 0 )
{
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->wpse_children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
}
function wpse_nav_menu_2_tree( $menu_id )
{
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? buildTree( $items, 0 ) : null;
}

$tree = wpse_nav_menu_2_tree( 'responsive-top-menu' );  // <-- Modify this to your needs!


?>
          

          <ul class="menu-list accordion">
           <?php
            foreach ($tree as $list) {
              if(empty($list->wpse_children)){
            ?>
            <li><a href="<?= $list->url;?>"><?= $list->title?></a></li>
             <?php 
           }
           else{
            ?>
            <li id="nav1" class="toggle accordion-toggle"> <span class="icon-plus"></span>
               <a class="menu-link"href="#"><?= $list->title;?></a> 
            <ul class="menu-submenu accordion-content">
              <?php
               foreach ($list->wpse_children as $subList) {
                ?>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-410 hvr-sweep-to-right"><a href="<?= $subList->url;?>"><?= $subList->title;?></a></li>
                <?php
               }
              ?>
            </ul>
            </li>
            <?php
           }
            }

           ?>

<?php  echo str_replace('sub-menu', 'open', wp_nav_menu( array(
                        'echo' => false,
                        'theme_location' => 'primary',
                      'container'      => 'false',
                      'walker' => new My_Walker_Nav_Menu(),
                        'items_wrap' => '<ul class="nav navbar-nav mobile-menu">%3$s</ul>' 
                      ) )
                    ); 
?>	
				<?php  echo str_replace('sub-menu', 'open', wp_nav_menu( array(
                        'echo' => false,
                        'theme_location' => 'primary',
                      	'container'      => 'false',
                      	'walker' => new My_Walker_Nav_Menu(),
                        'items_wrap' => '<ul class="navbar-links">%3$s</ul>' 
                      ) )
                    ); 
				?>	
<?php 
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='dropdown-menu'>\n";
  }
}



class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='dropdown'>\n";
  }
}
/*Dynamic Nav Menu*/
<?php
                            $menu = wp_get_nav_menu_object('top_menu');
                            $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
                            ?>
                            <ul class="navbar-nav ml-auto">
                            <?php
                              foreach($menuitems as $menuitemsRow){

                                ?>
                                <li class="nav-item active"><a class="nav-link" href="<?= $menuitemsRow->url;?>"><?= $menuitemsRow->title;?></a></li>
                                <?php
                              }
                              ?>
                              <li class="nav-item">
                                <a class="nav-link consultation" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Free Consultation</a>
                              </li>
                          </ul>
https://gist.github.com/Miri92/ffb67e6be29029e745078a914786238d
?>
 <?php wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'items_wrap'      => '<ul class="navbar-nav me-auto mb-2 mb-lg-0">%3$s</ul>',
                                            'menu'=> 'menu',
                                            'add_li_class'  => 'nav-link',
                                                        
                                        )); ?>

<?php wp_nav_menu( array( 'menu' => 'top-menu', 'menu_class' => 'nav navbar-nav' ) ); ?>
------------------------------------------------------------------------------------------	  

<!--Shortcode dynamic code -->

<?php echo do_shortcode(''); ?>

------------------------------------------------------------------------------------------

<!--breadcrumb Dynamic code-->
<div class="col-md-6">
        				<ul>
        					<li><a href="<?php echo home_url();?>">Home</a>
        					
                  
                  <?php global $post;
                  if ( $post->post_parent ) { ?>
                    <a href="<?php echo get_permalink( $post->post_parent ); ?>" >
                     <li> 
                       <?php echo get_the_title( $post->post_parent ); ?></li>
                    </a>
               		 <?php } ?>
                  
                  <li><a><?php the_title(); ?></a></li>
				  
				  
				  
---------------------------------------------------------------------------


<?php $type = 'post';
                   $args=array(
                   'post_type' => $type,
                   'post_status' => 'publish',
                    'order'=>'asc',
					'category' => blog,
                    );
                   $my_query = new WP_Query($args);
				   $i=1;
			  while ($my_query->have_posts()) : $my_query->the_post(); {?>
							<a href="#news<?php echo $i; ?>" class="selected"><img src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>" alt="" /><span class="carusal-our-news">Emergency Supplies</span></a>
							
							
							
			 <?php $i++;  } endwhile; ?>	

-------------------------------------------------------------------------
gtranslate plugin short code.
   <?php echo do_shortcode('[gtranslate]'); ?>			

  <?php $type = 'post';
        $args=array(
          
          'post_status' => 'publish',
		  'category_name' => 'blog'




function themify_woocommerce_params($params){
	 if(is_array($params)){
        return array_merge($params, array(
            'option_ajax_add_to_cart' => ( 'yes' == get_option('woocommerce_enable_ajax_add_to_cart') )? 'yes': 'no'
        ) );
    }else{
        return array(
            'option_ajax_add_to_cart' => ( 'yes' == get_option('woocommerce_enable_ajax_add_to_cart') )? 'yes': 'no'
        );
    }
}
		  
		  
		  
		  <?php $type = 'product';
			$args=array(
			  'post_type' => $type,
			  'post_status' => 'publish',
			  'posts_per_page' => 4,
			);
			$my_query = new WP_Query($args);
			  while ($my_query->have_posts()) : $my_query->the_post(); global $product;{?>
			  
			  
			  
			  
			  
			  
<?php $string = get_the_content();
	$newString = substr($string, 0, 500);
echo $newString;?>		


<?php echo site_url();?>/?add-to-cart=<?php echo $product->id;?>	

/* Comment  code from C:\xampp\htdocs\wpondemand\wp-content\plugins\woocommerce\templates\single-product\add-to-cart\simple.php (1 hit)
Then add below code in template 
 */

<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data">
		
<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

</form>  


<!--.htaccess Redirect Code-->

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteCond %{HTTPS} off 
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
RewriteBase /towncenter/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /towncenter/index.php [L]


</IfModule>


/*filter post on click  */

https://stackoverflow.com/questions/61898996/category-filtering-with-ajax-on-wordpress

https://www.youtube.com/watch?v=KRc47o8uDhk

/*wp-config ftp permission*/
define( 'FS_METHOD', 'direct' );

/* rating acf code */
<?php 
$i = 5;
$rating = $row['testimonial_ratings']; 
for($i=1; $i<=$rating; $i++){
?>
<li><i class="fas fa-star"></i></li>
<?php }

/*ACF*/

<?php 					 
$rat = get_sub_field('rating', $post->ID ); 					  
for($i=0; $i<$rat; $i++){?>
<i class="fa fa-star"></i>
<?php } ?>


/*anchor link code */
<?php 
$btn = get_field('promotion_button');
if($btn){
$btn_title = $btn['title'];
$btn_url = $btn['url'];	
?>
<a href="<?= esc_url($btn_url); ?>" class="read-btn"><?= esc_html($btn_title); ?></a>
<?php 
}
?>

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

I solved now, by adding this snippet in functions.php

function my_form_shortcode() {
   ob_start();
   get_template_part('my_form_template');
   return ob_get_clean();   
} 
add_shortcode( 'my_form_shortcode', 'my_form_shortcode' );


                            <?php 
                            $key="rating"; $rating_value = get_post_meta($post->ID, $key, true); 
                            $k = 0;
                            for($i=0;$i<$rating_value;$i++){?>
                            <i class="fas fa-star fill"></i>
                           <?php $k = $i; }  ?>
                           <?php for($j=0;$j<(5-$k-1);$j++) { ?>
                            <i class="fas fa-star fill"></i>
                          <?php } ?>
						  
/*Connent woocommerce plugin to theme woocommerce*/

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// For Post Page Redirecting
add_filter( 'single_template', function ( $single_template ) {

    $parent     = array(3,7); //Change to your category ID
    $categories = get_categories( 'child_of=' . $parent );
    $cat_names  = wp_list_pluck( $categories, 'name' );

    if ( has_category(array('highwaymen','news')) ) {
        $single_template = dirname( __FILE__ ) . '/blogdetail -Template-Copy.php';
    }
    return $single_template;

}, PHP_INT_MAX, 2 );



/* Woocommerce dynamic code*/
<div class="product-slider">
<?php $type = 'product';
                   $args=array(
                   'post_type' => $type,
                   'post_status' => 'publish',
                   'order'=>'asc',
				   'rating'=>'',
                   'tax_query'=>[[
                        'taxonomy'      => 'seller',
                        'field'         => 'slug', // can be 'term_id', 'slug' or 'name'
                        'terms'         => 'best-seller']]
                        
                    );
                   $my_query = new WP_Query($args);
              while ($my_query->have_posts()) {
				$my_query->the_post(); 
			    global $product;
				$avg_rating= ($product->get_average_rating() > 0) ? $product->get_average_rating() : 0;
                ?>
                <div class="item">
					<div class="product-box">
						<div class="img-wrap">
							<a href="<?php echo get_permalink($product->get_id()) ?>">
								<img src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>" alt="product-1">
							</a>
						</div>
						<div class="product-content">
							<a href="<?php echo get_permalink($product->get_id()) ?>">
								<h3><?php the_title(); ?></h3>
							</a>
						<div class="seller-tag">Best-seller</div>
						<div class="rating-box">
								<div class="rating">
								    <?php
									for($i=1;$i<=5;$i++){
										if($i <= round($avg_rating)){
										?>
										<i class="fas fa-star fill"></i>
										<?php
										}
										else{
										?>
										<i class="fas fa-star"></i>
										<?php
										}
									}
									?>
								</div>
								<span><?php echo $avg_rating;?> -based on <?= $product->get_review_count();?> reviews</span>
							</div>
							<div class="desc">
								<h4 class="category"><?= $product->get_categories();?></h4>
								<p><?php echo $product->get_short_description(); ?></p>
							</div>
							<div class="price">
								<?php
								if ($product->get_sale_price() != '') {
								?>
								<div class="orig-price"><?= get_woocommerce_currency_symbol(); ?> <?php echo $product->get_regular_price(); ?></div>
								<div class="sale-price"><?= get_woocommerce_currency_symbol(); ?> <?php echo !empty($product->get_sale_price()) ? $product->get_sale_price() : $product->get_price(); ?></div>
								<?php
								}
								else{
								?>
								<div class="sale-price"><?= get_woocommerce_currency_symbol(); ?> <?php echo !empty($product->get_regular_price()) ? $product->get_regular_price() : $product->get_price(); ?></div>
								<?php
								}
								if(!empty($product->regular_price) && !empty($product->sale_price)){
								?>
								<div class="benifit">Save <?= $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );?>%</div>
								<?php
								}
								?>
							</div>
							<p class="tax-con">  <?php
							if($product->get_tax_status()=='taxable'){
								echo "Inclusive of all taxes";
							}?></p>
							<?php
							if( $product->is_type( 'simple' ) ){ // For Simple Products
								?>
							<div class="add-to-cart">
								<a href="<?php echo site_url();?>/?add-to-cart=<?php echo $product->get_id();?>" class="add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id();?>" data-product_sku="<?= $product->get_sku();?>" aria-label="Add “<?php the_title(); ?>” to your cart" rel="nofollow"><i class="fas fa-shopping-cart"></i> Add to cart</a>
							</div>
							<?php
							}
							else{
								?>
							<div class="add-to-cart">
								<a href="<?php echo get_permalink($product->get_id());?>" ><i class="fas fa-shopping-cart"></i> Add to cart</a>
							</div>
							<?php
							}
							?>
						</div>
					</div>
        </div>

        <?php } wp_reset_query(); ?>
    </div>
	
	
	/*Redirect code*/
	
	Redirect 301 /reviews https://imtravsessed.com/review
	
	
	/*Woocommerce folder call from theme*/
	
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}    




/*Woocommerce Ajax cart */
add_action('wp_ajax_cart_count_retriever', 'woocommerce_header_add_to_cart_fragment');
add_action('wp_ajax_nopriv_cart_count_retriever', 'woocommerce_header_add_to_cart_fragment');

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fas fa-cart-plus"></i><sup><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></sup>
    <?php
    $fragments['a.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

/*Add html*/
    <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fas fa-cart-plus"></i><sup><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></sup>


/*Make Child theme function*/
<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;

add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );



/*ACF banner slider make dynamic*/

<div class="carousel-inner">
<?php 
$i= 0;
$slide = get_field('banner');
foreach($slide as $row){
$i++;
?>
    <div class="carousel-item <?php if($i==1){echo "active"; } else{echo "";}?>">
        <img class="d-block w-100" src="<?= $row['image']; ?>" alt="First slide">
        <div class="hero-bgm"></div>
        <div class="carousel-caption">
            <div class="content">
                <h1> <?= $row['title']; ?> <br><span> <?= $row['subtitle']; ?> </span></h1>
                <div class="button-box">
                    <a class="consultation2" href="<?= $row['button_link']; ?>"><?= $row['button_text']; ?></a>
                    <div class="phone-info d-flex justify-content-center align-items-center flex-row">
                        <div class="icon">
                            <img src="<?= $row['phone_icon_image']; ?>" alt="call-img" class="call">
                        </div>
                        <div class="number">
                            <span><?= $row['call_text']; ?></span>
                            <h5><a href="tel:+<?= $row['phone_number']; ?>" style="color: #dea057;"><?= $row['phone_number']; ?></a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
</div>



/*ACF Custom fields*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


/*For Pagination post*/
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$data= new WP_Query(array(
    'post_type'=>'catalogs', // your post type name
    'posts_per_page' => 6, // post per page
    'order'=>'asc',
    'paged' => $paged,
));

if($data->have_posts()) :
    while($data->have_posts())  : $data->the_post(); ?>
		//display post here
	<?php endwhile;?> 
	
<div class="pagination-news">
<?php $total_pages = $data->max_num_pages; ?>

   <?php if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            // 'prev_text'    => __('« prev'),
            // 'next_text'    => __('next »'),
        ));
    }
    ?>    
<?php else :?>
<h3><?php _e('404 Error&#58; Not Found', ''); ?></h3>
</div>



<?php endif; ?>
<?php wp_reset_postdata();?>

/*Mobile show search bar*/
<div class="mobile_search_backdrop">
    <div class="mobile_search-popup-wrapper">
        <button class="mobile-popup-toggle-btn"><i class="fas fa-times"></i></button>
        <form class="searchbar_wrapper" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">

            <input type="text" name="s" class="searchbox searchbar_input" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search...', 'woocommerce'); ?>">

            <?php if (class_exists('WooCommerce')) : ?>

                <div class="searchbar_select-wrapper">
                    <?php
                    if (isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                        $optsetlect = $_REQUEST['product_cat'];
                    } else {
                        $optsetlect = 0;
                    }
                    $args = array(
                        'show_option_all' => esc_html__('All Categories', 'woocommerce'),
                        'hierarchical' => 1,
                        'class' => 'cat',
                        'echo' => 1,
                        'value_field' => 'slug',
                        'exclude' => 15,
                        'selected' => $optsetlect,
                    );
                    $args['taxonomy'] = 'product_cat';
                    $args['name'] = 'product_cat';
                    $args['class'] = 'cate-dropdown  searchbar_select';
                    wp_dropdown_categories($args);

                    ?>
                </div>
                <input type="hidden" value="product" name="post_type">
            <?php endif; ?>

            <button type="submit" title="<?php esc_attr_e('Search', 'woocommerce'); ?>" class="searchbar_btn"><span>Search</span></button>

        </form>
    </div>
</div>


/*Search bar for in desktop*/
					<form class="searchbar_wrapper" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">

						<input type="text" name="s" class="searchbox searchbar_input" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search...', 'woocommerce'); ?>">

						<?php if (class_exists('WooCommerce')) : ?>

							<div class="searchbar_select-wrapper">
								<?php
								if (isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
									$optsetlect = $_REQUEST['product_cat'];
								} else {
									$optsetlect = 0;
								}
								$args = array(
									'show_option_all' => esc_html__('All Categories', 'woocommerce'),
									'hierarchical' => 1,
									'class' => 'cat',
									'echo' => 1,
									'value_field' => 'slug',
									'exclude' => 15,
									'selected' => $optsetlect,
								);
								$args['taxonomy'] = 'product_cat';
								$args['name'] = 'product_cat';
								$args['class'] = 'cate-dropdown searchbar_select';
								wp_dropdown_categories($args);

								?>
							</div>
							<input type="hidden" value="product" name="post_type">
						<?php endif; ?>

						<button type="submit" title="<?php esc_attr_e('Search', 'woocommerce'); ?>" class="searchbar_btn"><span><i class="fas fa-search"></i></span></button>

					</form>


        <?php
        $menu_items = wp_get_nav_menu_items( 'main_nav' ); // id or name of menu
        foreach ( (array) $menu_items as $key => $menu_item ) {
            if ( ! $menu_item->menu_item_parent ) {
                echo "<li class="nav-item . vince_check_active_menu($menu_item) . "><a href='$menu_item->url'>";
                echo $menu_item->title;
                echo "</a></li>";
            }
        }
        ?>
/*Active top  nav Menu bar*/
Add Active Class in menu
global $wp;
$currentMenu=home_url( $wp->request ).'/';
?>
/*Add Tag */
<?=($currentMenu==$menuitemsRow->url)?'active':''?>

/* 1st method Product tage display by categories with shortcode*/

add_shortcode( 'wc_product_tag', 'get_tag_term_name_for_product_id' );
function get_tag_term_name_for_product_id( $atts ) {
    // Shortcode attribute (or argument)
    extract( shortcode_atts( array(
        'taxonomy'   => 'product_tag', // The WooCommerce "product tag" taxonomy (as default)
        'product_id' => get_the_id(), // The current product Id (as default)
    ), $atts, 'wc_product_tag' ) );
    
    $term_names = (array) wp_get_post_terms( $product_id, $taxonomy, array('fields' => 'names') );
    $output = '<ul class="product-categories">';
    foreach ($term_names as $tags) {
        $term_link = get_term_link( $tags, 'product_tag' );
        //$term_name = $tags->name;
        $output .=  '<li class="cat-item "><a href="'.$term_link.'">'.$tags.'</a></li>';
    }
    $output .= '</ul>';
    // if( ! empty($term_names) ){
    //     // return a term name or multiple term names (in a coma separated string)
    //     return implode(', ', $term_names);
    // }
    return $output;
}
<?php echo do_shortcode('[wc_product_tag]'); ?>

/*2nd  method*/
add_shortcode( 'wc_product_tag', 'get_tag_term_name_for_product_id' );
function get_tag_term_name_for_product_id( $atts ) {
    global $product,$post;
    if(get_query_var('taxonomy')=='product_cat'){

    

    $id = get_queried_object();
    $cat_id = $id->slug;
    $products = wc_get_products(array(
    'category' => array($cat_id),
    'posts_per_page'=>-1,
    'post_status'=>'publish'
    ));
//print_r(get_the_terms('539', 'product_tag' ));
    

    //print_r(count($products));
    $tag_array=[];
    foreach($products as $rowData){
        foreach(get_the_terms($rowData->get_id(), 'product_tag' ) as $tags){
         $tag_array[$tags->term_id]=$tags->name;
        }
    }
    $output='<ul>';
    foreach($tag_array as $key => $value){
      $output.='<li>';
      $output.='<a href="'.get_term_link($key).'">';
      $output.=$value;
      $output.='</a>';
      $output.='</li>';
    }
    $output.='</ul>';


    return $output;
}
if(get_query_var('taxonomy')=='product_tag'){
  //echo "Thidjhghfg  f gf f j jhfj hf jhfj";  
   $term_name=get_queried_object()->name;
    $products = wc_get_products(array(
    'tag' => array($term_name),
    'posts_per_page'=>-1,
    'post_status'=>'publish'
    ));
    $tag_array=[];
    foreach($products as $rowData){
        foreach(get_the_terms($rowData->get_id(), 'product_tag' ) as $tags){
         $tag_array[$tags->term_id]=$tags->name;
        }
    }
    $output='<ul>';
    foreach($tag_array as $key => $value){
      $output.='<li>';
      $output.='<a href="'.get_term_link($key).'">';
      $output.=$value;
      $output.='</a>';
      $output.='</li>';
    }
    $output.='</ul>';
    return $output;
}

}

/*End Category Tag*/


/*Start Redirect Only test name page to one pages*/
function custom_redirects() {
 
    if ( is_page('test') ) {
        wp_redirect( home_url( '/' ) );
        die;
    }
 
}
add_action( 'template_redirect', 'custom_redirects' );

/*End*/

/*Start Dynamic breadcrumb code*/

/*copy paste code in functions.php page*/
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}
/*Copy past inner page banner section*/
<?php get_breadcrumb(); ?>
/*End */


/*
=======================================================
VCF file creation on saving post for Custom Post Type
=======================================================
*/

function my_project_create_vCard( $post_id ) {
    error_reporting(E_ERROR | E_PARSE);
    global $post;
    if($post->post_type != "signature"){
        return;
    }
    $vpost = get_post($post->ID);
    $contact_details = get_field('contact_details',$vpost->ID);
    $filename = strtolower(str_replace(" ","-",$vpost->post_name)).".vcf";
    header('Content-type: text/x-vcard; charset=utf-8');
    header("Content-Disposition: attachment; filename=".$filename);
    $data=null;
    $data.="BEGIN:VCARD\n";
    $data.="VERSION:3.0\n";
    $data.="N:".get_field('member_name',$vpost->ID)."\n";// get acf field value
    $data.="FN:".$vpost->post_title."\n"; // get post title
    $data.="REV:".date('Y-m-d h:i:s')."\n";
    $data.="ROLE:".get_field('designation',$vpost->ID)."\n"; // get acf field value
    foreach($contact_details as $row){
        if($row['contact_icon'] == 'fa fa-mobile'){
            $data.="TEL;TYPE=WORK,MSG:".$row['contact_text']."\n";
        }
        if($row['contact_icon'] == 'fa fa-phone'){
            $data.="TEL;TYPE=WORK,MSG:".$row['contact_text']."\n";
        }
        if($row['contact_icon'] == 'fa fa-map-marker'){
            $data.="ADR;TYPE#WORK,PREF:;;".$row['contact_text']."\n";
        }
        if($row['contact_icon'] == 'fa fa-map-marker'){
            $data.="LABEL;TYPE#WORK,PREF:".$row['contact_text']."\n";
        }
        if($row['contact_icon'] == 'fa fa-globe'){
            $data.="URL:".$row['contact_text']."\n";
        }
        if($row['contact_icon'] == 'fa fa-envelope'){
            $data.="EMAIL:".$row['contact_text']."\n";
        }
    }
    $data.="END:VCARD";
    print_r($data);
    $filePath = get_template_directory()."/vcf_folder/".$filename; // you can specify path here where you want to store file.
        $file = fopen($filePath,"w");
        fwrite($file,$data);
        fclose($file);
}
add_action( 'save_post', 'my_project_create_vCard' );

/*End VCard*/

/*Start Product tage display by categories*/

add_shortcode( 'wc_product_tag', 'get_tag_term_name_for_product_id' );
function get_tag_term_name_for_product_id( $atts ) {
    // Shortcode attribute (or argument)
    extract( shortcode_atts( array(
        'taxonomy'   => 'product_tag', // The WooCommerce "product tag" taxonomy (as default)
        'product_id' => get_the_id(), // The current product Id (as default)
    ), $atts, 'wc_product_tag' ) );
    
    $term_names = (array) wp_get_post_terms( $product_id, $taxonomy, array('fields' => 'names') );
    $output = '<ul class="product-categories">';
    foreach ($term_names as $tags) {
        $term_link = get_term_link( $tags, 'product_tag' );
        //$term_name = $tags->name;
        $output .=  '<li class="cat-item "><a href="'.$term_link.'">'.$tags.'</a></li>';
    }
    $output .= '</ul>';
    // if( ! empty($term_names) ){
    //     // return a term name or multiple term names (in a coma separated string)
    //     return implode(', ', $term_names);
    // }
    return $output;
}
/*Copy Past this shortcode in page*/
<?php echo do_shortcode('[wc_product_tag]'); ?>
/*End Code*/



/*Start Form Submit code*/
<?php
 
if(isset($_POST['submit'])){
    extract($_POST);
    // echo $name;
    $cfmail = get_field('email');
    $to = $cfmail;
    $subject = "Contact Email";
    $message = "Contact message from ".$name. "<br>";
    $message .= "Name: ".$name. "<br>";
    $message .= "Email: ".$email. "<br>";
    $message .= "Role: ".$role. "<br>";
    $message .= "Company: ".$company. "<br>";
    $message .= "Cell: ".$cell. "<br>";
    $message .= "Phone: ".$phone."<br>";
    $message .= "Message: ".$msg;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if(wp_mail($to,$subject,$message,$headers)){
        echo "<script>alert('Email Sent Successfully')</script>";
    }else{
        echo "<script>alert('Something Went Wrong')</script>";
    }
} ?>

/*End */

/*Start Add active class in menu */

/*Add Active Class in menu*/
global $wp;
$currentMenu=home_url( $wp->request ).'/';
?>
/*Add in menu Tag */
<?=($currentMenu==$menuitemsRow->url)?'active':''?>

/*End*/



/*Start When add classic editor specific custom post type*/
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type === 'product') return false;
    return $current_status;
}

/*End*/


/*Create Short code for set post display limit, display by category etc....*/
<h1><a href="https://code.tutsplus.com/tutorials/create-a-shortcode-to-list-posts-with-multiple-parameters--wp-32199"></a></h1>
// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode( 'list-posts', 'rmcc_post_listing_parameters_shortcode' );
function rmcc_post_listing_parameters_shortcode( $atts ) {
    ob_start();
 
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'post',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,
        'color' => '',
        'fabric' => '',
        'category' => '',
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => $type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'color' => $color,
        'fabric' => $fabric,
        'category_name' => $category,
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { 

    ?>
       

    <div class="reviews">
    <div class="row">
    	 <?php while ( $query->have_posts() ) : $query->the_post(); $postid = get_the_ID();?>
        <div class="col-md-6" id="post-<?php the_ID(); ?>">
            <div class="review-box">
                <div class="top">
                    <div class="reviewer-img">
                        <img src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() );?>" alt="img">
                    </div>
                    <div class="name">
                        <h3><?php the_title(); ?></h3>
                    </div>
                    <div class="top-label">
                        <!-- <h5>TOP 500 REVIEWER</h5> -->
                        
                        <?php
                        $key="top_reviews_number";
                        if(get_post_meta($postid, $key, true)){ ?>
                        	<?php echo '<h5>TOP ' .get_post_meta($postid, $key, true). ' REVIEWER</h5>';?> 
                        <?php } else{ ''; }
                        ?>
                    </div>
                </div>
                <div class="middle">
                    <div class="rating">
                        <div class="stars">
							<?php 
							
							$key="customer_review_rating"; $rating_value = get_post_meta($postid, $key, true); 
							//print_r($rating_value);

							for($i=0;$i<$rating_value;$i++){?>
							<i class="fas fa-star"></i>
							<?php } ?>
                            <!-- <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i> -->
                        </div>
                        <h4>Don’t Let ht lack of sunlight stop you.</h4>
                    </div>
                    <div class="review-detail">Reviwed in Australia on <?php the_time('j F Y'); ?></div>
                    <ul>
                       <li>Color Name: <span><?php $key="color_name"; echo get_post_meta($postid, $key, true); ?></span></li>
                       <li class="verified">Verified Purchase</li>
                    </ul>
                    <p class="desc">
                    <?php $content = get_the_content(); echo $content; ?>
                    </p>
                    <div class="helpful"><!-- 2 people found this helpful -->
                    	<?php
                        $key="helpful_field";
                        if(get_post_meta($postid, $key, true)){
                        	echo get_post_meta($postid, $key, true);
                        } else{  }
                        ?>

                    </div>
                </div>
            </div>
        </div>
         <?php endwhile;
            wp_reset_postdata(); ?>

    </div>

    <div class="link-heading">
        <div class="amazon-logo"><img src="https://twilightaction.com/wp-content/uploads/2022/09/Group-1416.png" alt="amazon-logo"></div>
        <p>Check all of our <a href="<?= site_url(); ?>/reviews/">reviews </a>here</p>
    </div>
</div>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
    }
}

/*End Code*/

/*Woocommerce https://stackoverflow.com/questions/17081483/custom-payment-method-in-woocommerce */

https://stackoverflow.com/questions/59863954/how-to-get-slugs-and-names-of-all-order-statuses-in-woocommerce
$order_statuses = array(
    'wc-pending'    => _x( 'Pending payment', 'Order status', 'woocommerce' ),
    'wc-processing' => _x( 'Processing', 'Order status', 'woocommerce' ),
    'wc-on-hold'    => _x( 'On hold', 'Order status', 'woocommerce' ),
    'wc-completed'  => _x( 'Completed', 'Order status', 'woocommerce' ),
    'wc-cancelled'  => _x( 'Cancelled', 'Order status', 'woocommerce' ),
    'wc-refunded'   => _x( 'Refunded', 'Order status', 'woocommerce' ),
    'wc-failed'     => _x( 'Failed', 'Order status', 'woocommerce' ),
);



<?php                
                    $soldout = get_the_terms( $post->ID, 'soldout' );
                    if ( !empty( $soldout ) ){ ?>
                        <span class="sold-out"><?php 
                        // get the first term
                        $soldout = array_shift( $soldout );
                        echo $soldout->name;
                    ?></span><?php
                    }
                
				
//start--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------				
// Add Quantity Inputs in checkout page

add_filter( 'woocommerce_cart_item_subtotal', 'bbloomer_checkout_item_quantity_input', 9999, 3 );
 

function bbloomer_checkout_item_quantity_input( $product_quantity, $cart_item, $cart_item_key ) {

if ( is_checkout() ) {

$product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

$product_quantity = woocommerce_quantity_input( array(

'input_name'  => 'shipping_method_qty_' . $product_id,

'input_value' => $cart_item['quantity'],

'max_value'   => $product->get_max_purchase_quantity(),

'min_value'   => '0',

), $product, false );

$product_quantity .= '<input type="hidden" name="product_key_' . $product_id . '" value="' . $cart_item_key . '">';

}

return $product_quantity;

}



// Detect Quantity Change and Recalculate Totals

add_action( 'woocommerce_checkout_update_order_review', 'bbloomer_update_item_quantity_checkout' );

function bbloomer_update_item_quantity_checkout( $post_data ) {

parse_str( $post_data, $post_data_array );

$updated_qty = false;

foreach ( $post_data_array as $key => $value ) {

if ( substr( $key, 0, 20 ) === 'shipping_method_qty_' ) {

$id = substr( $key, 20 );

WC()->cart->set_quantity( $post_data_array['product_key_' . $id], $post_data_array[$key], false );

$updated_qty = true;

}

}

if ( $updated_qty ) WC()->cart->calculate_totals();

}

//1.Get Product image in checkout page.....
/*add_filter( 'woocommerce_cart_item_name', 'bbloomer_product_image_review_order_checkout', 9999, 3 );
  
function bbloomer_product_image_review_order_checkout( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() ) return $name;
    $product = $cart_item['data'];
    $thumbnail = $product->get_image( array( '50', '50' ), array( 'class' => 'alignleft' ) );
    return $thumbnail . $name;
}
*/


//2. Get product image in checkout page..

add_filter( 'woocommerce_cart_item_name', 'ts_product_image_on_checkout', 10, 3 );

function ts_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {  

    /* Return if not checkout page */
    if ( ! is_checkout() ) {
        return $name;
    }

    /* Get product object */
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

    /* Get product thumbnail */
    $thumbnail = $_product->get_image();

    /* Add wrapper to image and add some css */
    $image = '<div class="ts-product-image" style="width: 52px; height: 45px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                . $thumbnail .
            '</div>';

    /* Prepend image to name and return it */
    return $image . $name;

}

// End --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


https://www.thiscodeworks.com/php-remove-product-item-from-woocommerce-checkout-page-using-ajax-stack-overflow-php/624ab092cbb8c90015cea943



<?php
$args = array( 'posts_per_page' =>'', 'category' =>3 , 'orderby'=> 'date','order'=> 'ASC' );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>    
        <h2><?php the_title();?></h2>
          <p><?php  echo substr($post->post_content,0,350);  ?>
          <a href="<?php the_permalink(); ?>" class="readmore">Read More</a></p>     
<?php endforeach; ?>


<?php
// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Buy Now', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Buy Now', 'woocommerce' );
}
//before regual price text 
add_filter( 'woocommerce_get_price_html', 'custom_text_before_price', 10, 2 );
function custom_text_before_price($price,$product){
    if($product->is_on_sale()){
    $text_before_price  = 'was';      
    return "<span class='ws'>" .$text_before_price ."</span>". $price;

    }else{
        return $price;
    }
          
}

https://stackoverflow.com/questions/60693560/add-text-after-the-price-in-woocommerce-product-per-product-id-wp



add_filter('manage_catalogs_posts_columns', 'codeflies_custom_post_column', 9);
function codeflies_custom_post_column($catalog_column)
{
    $catalog_column['catalog_id'] = __('Catalog ID');
    return $catalog_column;
}

//Get the Post Custom field name and post custom field Profile Image

add_action('manage_catalogs_posts_custom_column', 'display_custom_post_detail', 5, 3);
function display_custom_post_detail($catalog_column, $post_id)
{
    global $post;
    //echo $escorts_column;
    switch ($catalog_column) { 

        case 'catalog_id':
           $post_id = get_field('catalog_details_content');
          //print_r ($post_id);
            foreach($post_id as $postv){
            	echo $postv['content']."</br>";
            }
            //echo get_the_title($post_id);
            break;

        default:
            echo "Not Found";
    }
}
add_filter('manage_collections_posts_columns', 'collections_post_column', 15);
function collections_post_column($collection_column){
	$collection_column['collection_id'] = __('Collection ID');
    return $collection_column;
}
add_action('manage_collections_posts_custom_column', 'collections_display_custom_post_detail', 5, 3);
function collections_display_custom_post_detail($collection_column, $post_id)
{
    global $post;
    //echo $escorts_column;
    switch ($collection_column) { 

        case 'collection_id':
           $post_id = get_field('collection_length');
          //print_r ($post_id);
           
                 echo $post_id;
            //echo get_the_title($post_id);
            break;

        default:
            echo "Not Found";
    }
}


https://github.com/alextselegidis/easyappointments/blob/master/application/controllers/Backend.php



add_shortcode( 'wc_product_tag', 'get_tag_term_name_for_product_id' );
function get_tag_term_name_for_product_id( $atts ) {
    global $product,$post;
    if(get_query_var('taxonomy')=='product_cat'){

    $id = get_queried_object();
    $cat_id = $id->slug;
    $products = wc_get_products(array(
    'category' => array($cat_id),
	'order' => 'ASC',
    'posts_per_page'=>-1,
    'post_status'=>'publish'
    ));
//print_r(get_the_terms('539', 'product_tag' ));
    

    //print_r(count($products));
    $tag_array=[];
    foreach($products as $rowData){
        foreach(get_the_terms($rowData->get_id(), 'product_tag' ) as $tags){
         $tag_array[$tags->term_id]=$tags->name;
        }
    }
	$new_arr = usort($tag_array,'strnatcasecmp');
// 		print_r($tag_array);
    $output='<ul>';
    foreach($tag_array as $key => $value){
      $output.='<li>';
      $output.='<a href="'.site_url().'/product-tag/'.str_replace(" ","-",strtolower($value)).'">';
      $output.=$value;
      $output.='</a>';
      $output.='</li>';
    }
    $output.='</ul>';


    return $output;
}
if(get_query_var('taxonomy')=='product_tag'){
  //echo "Thidjhghfg  f gf f j jhfj hf jhfj";  
   $term_name=get_queried_object()->name;
    $products = wc_get_products(array(
    'tag' => array($term_name),
    'posts_per_page'=>-1,
'name__like' => "a",
 'order' => 'ASC', 
  'post_status'=>'publish'
    ));
    $tag_array=[];
    foreach($products as $rowData){
        foreach(get_the_terms($rowData->get_id(), 'product_tag' ) as $tags){
         $tag_array[$tags->term_id]=$tags->name;
        }
    }
    $output='<ul>';
    foreach($tag_array as $key => $value){
		
      $output.='<li>';
      $output.='<a href="'.get_term_link($key).'">';
      $output.=$value;
      $output.='</a>';
      $output.='</li>';
    }
    $output.='</ul>';
    return $output;
}

}


/*Display Custom Price */
add_action( 'woocommerce_single_product_summary', 'woocommerce_total_product_price');
function woocommerce_total_product_price() {
    global $woocommerce, $product;
    // let's setup our divs
    echo sprintf('<div id="product_total_price" style="margin-bottom:20px;">%s %s</div>',__('Product Total:','woocommerce'),'<span class="price">'.get_woocommerce_currency_symbol().''.$product->get_price().'</span>');
    ?>
        <script>
            jQuery(function($){
                var price = <?php echo $product->get_price(); ?>,
                    currency = '<?php echo get_woocommerce_currency_symbol(); ?>';

                $('[name=quantity]').change(function(){
                    if (!(this.value < 1)) {

                        var product_total = parseFloat(price * this.value);

                        $('#product_total_price .price').html( currency + product_total.toFixed(2));

                    }
                });
            });
        </script>
    <?php
}
add_shortcode('custom-price', 'woocommerce_total_product_price');




/*Custom add extra button in woocommerce loop*/
add_action( 'woocommerce_after_shop_loop_item', 'add_loop_custom_button', 1000 );
function add_loop_custom_button() {
    global $product;

    $product_link = $product->get_permalink(); // Link to the product (if needed)

    // Define your button link
    // $custom_link = home_url( "/cart/" ) ;

$product_id = $product->get_id();

$url        = wc_get_cart_url() . '?add-to-cart=' . $product_id;


    // Output
echo '<div class="action_btns">';

    echo '<div class="product_meta wcdp-preview-btn-div">
    <a class="button thickbox" href="' . esc_url( $url ) .'">' . __( "ADD CUT SAMPLE" )  . '</a>
    </div>';

/*				
					$soldout = get_the_terms( $product->ID, 'productsample' );
					if ( !empty( $soldout ) ){
                        // echo "hello";
					    // get the first term
					    $soldout = array_shift( $soldout ); 
					
    echo '<div class="product_meta wcdp-preview-btn-div">
    <a class="button thickbox" href="' . esc_url( $url ) .'">' . __( "ADD LARGE SAMPLE" )  . '</a>
    </div>';
}else{ 
  echo '<div class="btn-placeholder"></div> ';
}*/
echo '</div>';
}
add_shortcode('productsinglebutton', 'add_loop_custom_button');


/*Make Dynamic Sale badge*/
add_filter('woocommerce_sale_flash', 'lw_custom_sales_badgeX');
function lw_custom_sales_badgeX() {
    global $product;
    if(!empty($product->is_on_sale())){ 
        if(!empty(get_field('status',$product->get_id()))){
    ?>
       <span class="sale"><?php echo the_field('status',$product->get_id()); ?></span>
    <?php
        }
    }
}


/*Mini Cart item in header*/
<div class="header_cart-wrapper">
	<div class="header_cart-wrapper-in">		
		<?php
	    foreach ( WC()->cart->get_cart() as $cart_item_key =>  $cart_item ) {
		    $product_id         = $cart_item['product_id'];
		    $variation_id       = $cart_item['variation_id'];
		    $product            = $cart_item['data'];
		    $name               = $product->get_name();
		    $featured_img_url = get_the_post_thumbnail_url($product_id,'thumbnail');
		    $quantity           = $cart_item['quantity'];
		    $line_subtotal      = $cart_item['line_subtotal'];
		    $total_box      = $cart_item['total_box'];
		    
		?>
		<div class="crt-prdct">
		<div class="crdct-pro-img"><img src="<?= $featured_img_url; ?>">
		</div>
		<ul>
		<li><?= $name;  ?></li>
		<li><?= 'Quantity: '.$quantity; ?><?php if(!empty($total_box)){ echo " m<sup>2</sup> |"; }else{ echo " ";} ?><?php if(!empty($total_box)){echo ' '.$total_box; ?> Boxes<?php }else{"";} ?></li>	
		<li>Total: £ <?= number_format($line_subtotal, 2);?></li>
		</ul>
		</div>						
		
		<?php } ?>
		<?php 

		global $woocommerce;
		if ( $woocommerce->cart->cart_contents_count != 0 ) {
		?>
			<div class="clickbtn"><a href="<?php echo wc_get_cart_url(); ?>"> View Cart </a><a href="<?php echo wc_get_checkout_url(); ?>">Checkout</a>
		<?php
		} else {
		   echo "No product in cart...";
		}
		?>
		
		</div>
		</div>
		
	</div>
</div>


https://stackoverflow.com/questions/28576667/get-cart-item-name-quantity-all-details-woocommerce



//Make Dynamic category banner image by acf
$queriedObject=get_queried_object();
print_r($queriedObject);
echo get_field('banner_background_image','product_cat_'.$queriedObject->term_id);
<?= $queriedObject->name; ?>


// Hide shipping details from cart page.
add_filter( 'woocommerce_cart_needs_shipping', 'cart_needs_shipping' );
function cart_needs_shipping( $needs_shipping ) {
    if ( is_cart() ) {
        $needs_shipping = false;
    }
    return $needs_shipping;
} 


//When we want add new class in add to cart button
<?php
if ( $product->is_featured() ) {
    $extra_class = ' my-featured-class';
} else {
    $extra_class = '';
}
?>

<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt <?php echo $extra_class; ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>




// Stop hacking attack and change wp admin login dashboard url https://www.hindimepadhe.in/wordpress-login-url-security/
<IfModule mod_rewrite.c>RewriteEngine OnRewriteRule ^enter/?$ /wp-login.php?7ry709u355m3 [R,L]RewriteCond %{HTTP_COOKIE} !^.*wordpress_logged_in_.*$RewriteRule ^dashboard/?$ /wp-login.php?7ry709u355m3&redirect_to=/wp-admin/ [R,L]RewriteRule ^dashboard/?$ /wp-admin/?7ry709u355m3 [R,L]RewriteRule ^register/?$ /wp-login.php?7ry709u355m3&action=register [R,L]RewriteCond %{SCRIPT_FILENAME} !^(.*)admin-ajax\.phpRewriteCond %{HTTP_REFERER} !^(.*)yoursite.com/wp-adminRewriteCond %{HTTP_REFERER} !^(.*)yoursite.com/wp-login\.phpRewriteCond %{HTTP_REFERER} !^(.*)yoursite.com/enterRewriteCond %{HTTP_REFERER} !^(.*)yoursite.com/dashboardRewriteCond %{HTTP_REFERER} !^(.*)yoursite.com/registerRewriteCond %{QUERY_STRING} !^7ry709u355m3RewriteCond %{QUERY_STRING} !^action=logoutRewriteCond %{QUERY_STRING} !^action=rpRewriteCond %{QUERY_STRING} !^action=registerRewriteCond %{QUERY_STRING} !^action=postpassRewriteCond %{HTTP_COOKIE} !^.*wordpress_logged_in_.*$RewriteRule ^.*wp-admin/?|^.*wp-login\.php /not_found [R,L]RewriteCond %{QUERY_STRING} ^loggedout=trueRewriteRule ^.*$ /wp-login.php?7ry709u355m3 [R,L]</IfModule>


/*Child theme functions code*/

<?php
add_action("wp_enqueue_scripts", "wp_child_theme");
function wp_child_theme() 
{
	if((esc_attr(get_option("wp_child_theme_setting")) != "Yes")) 
	{
		wp_enqueue_style("parent-stylesheet", get_template_directory_uri()."/style.css");
	}

	wp_enqueue_style("child-stylesheet", get_stylesheet_uri());
	wp_enqueue_script("child-scripts", get_stylesheet_directory_uri() . "/js/scripts.js", array("jquery"), "6.1.1", true);
}

if(!function_exists("uibverification"))
{
	function uibverification() 
	{
        if((esc_attr(get_option("wp_child_theme_setting_html")) != "Yes")) 
        {
            if((is_home()) || (is_front_page())) 
            {
            ?><meta name="uib-verification" content="6A716F66D88AC6E71D95BD5B65ECD55F"><?php
            }
        }
	}
}
add_action("wp_head", "uibverification", 1);

function wp_child_theme_register_settings() 
{ 
	register_setting("wp_child_theme_options_page", "wp_child_theme_setting", "wct_callback");
    register_setting("wp_child_theme_options_page", "wp_child_theme_setting_html", "wct_callback");
}
add_action("admin_init", "wp_child_theme_register_settings");

function wp_child_theme_register_options_page() 
{
	add_options_page("Child Theme Settings", "Child Theme", "manage_options", "wp_child_theme", "wp_child_theme_register_options_page_form");
}
add_action("admin_menu", "wp_child_theme_register_options_page");

function wp_child_theme_register_options_page_form()
{ 
?>
<div id="wp_child_theme">
	<h1>Child Theme Options</h1>
	<h2>Include or Exclude Parent Theme Stylesheet</h2>
	<form method="post" action="options.php">
		<?php settings_fields("wp_child_theme_options_page"); ?>
		<p><label><input size="3" type="checkbox" name="wp_child_theme_setting" id="wp_child_theme_setting" <?php if((esc_attr(get_option("wp_child_theme_setting")) == "Yes")) { echo " checked "; } ?> value="Yes"> Tick to disable the parent stylesheet<label></p>
        <p><label><input size="3" type="checkbox" name="wp_child_theme_setting_html" id="wp_child_theme_setting_html" <?php if((esc_attr(get_option("wp_child_theme_setting_html")) == "Yes")) { echo " checked "; } ?> value="Yes"> Tick to disable the <a href="https://uibmeta.org">UIB Meta Tag</a> on your website homepage<label></p>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}

/*Style.css Child theme*/

/*
Theme Name:  
Template: 	 twentytwentyone
Theme URI:	 https://wordpress.org/themes/twentytwentyone/
Author:		 ChildThemeWP
Author URI:	 https://childthemewp.com
Version:	 1.0.0
License:	 GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags:    	 opensource     
Text Domain: twentytwentyonechild
*/



https://www.hostinger.in/tutorials/create-wordpress-theme-html5