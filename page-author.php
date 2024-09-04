<?php get_header()?>


<section class="mb-10">
        <div class="container">
          <div class="title-wrapper">
            <h1 class="">Authors</h1>
          </div>
          <div class="py-10 author-list">


                <?php 
                $authors = new WP_Query(array(
                    'post_type' => 'authors',
                    'posts_per_page' => 3,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                ))

                ?>

                <?php $counter = 1; if($authors->have_posts()) : while($authors->have_posts()) : $authors->the_post()?>
            <div class="pb-10 mb-10 border-b author-listitem border-dark last:border-none">
              <div class="flex flex-col items-center gap-10 md:flex-row">
                <img
                  src="<?php echo get_field('thumbnail')['url']?>"
                  alt=""
                  class="object-cover rounded-full shrink-0"
                />
                <div
                  class="flex flex-col items-center justify-between w-full md:flex-row"
                >
                  <h3 class="article-header"><?php the_title()?></h3>
                  <ul class="flex flex-col gap-2 md:gap-10 md:flex-row">
                    <li
                      class="flex justify-center gap-3 whitespace-nowrap lg:justify-start"
                    >
                      <span class="font-generalSemiBold">Job:</span> <?php the_field('job')?>
                    </li>
                    <li
                      class="flex justify-center gap-3 whitespace-nowrap lg:justify-start"
                    >
                      <span class="font-generalSemiBold">City:</span> <?php the_field('city')?>
                    </li>
                    <li>
                      <a href="<?php the_permalink()?>" class="link-arrow right"
                        >About
                        <svg class="icon-sm" role="image">
                          <use
                            xlink:href="<?php echo get_template_directory_uri()?>/img/sprite.svg#icon-arrow-right"
                          ></use>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
             <?php endwhile;
                else:
                    echo "no more post";
                endif;
                wp_reset_postdata();
            ?>  
      
          </div>
          <div class="pagination">
              <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $authors->max_num_pages,
                    'show_all' => true,
                    'prev_next' => True,
                    'prev_text' => __('<svg class="icon-sm" role="image">
                    <use xlink:href="'. get_template_directory_uri() .'/img/sprite.svg#icon-chevron-left"></use>
                  </svg>'),
                    'next_text' => __('<svg class="icon-sm" role="image">
                    <use xlink:href="'. get_template_directory_uri() .'/img/sprite.svg#icon-chevron-right"></use>
                  </svg>'),
                    ));
                ?>
          </div>


        </div>
      </section>


<?php get_footer()?>