<?php get_header()?>

<section>
    <div class="container">
        <div class="flex items-center justify-between my-5" id="go-back">
          <a
            href="<?php echo site_url('/magazine')?>"
            class="flex items-center gap-2 mb-5 uppercase hover:underline group md:mb-0 font-generalSemiBold"
          >
            <div
              class="transition-all -translate-x-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-0"
            >
              <svg class="icon-sm" role="image">
                <use xlink:href="<?php echo get_template_directory_uri()?>/img/sprite.svg#icon-arrow-left"></use>
              </svg>
            </div>

            <span
              class="transition-transform -translate-x-7 group-hover:translate-x-0"
              >Go Back</span
            >
          </a>

          <h4 id="single-title">Magazine</h4>
        </div>

        <div class="grid grid-cols-2 gap-10 my-20">
          <h2 class="max-w-[470px]" id="single-main-title"><?php the_title()?></h2>
          <p id="single-main-excerpt">
            <?php the_field('excerpt')?>
          </p>
        </div>

        <div class="flex items-center justify-between mb-10 " id="single-article-details">
          <div class="details">
            <ul >
              <li><span>Author:</span> <?php echo get_field('author')->post_title ?></li>
              <li><span>Date:</span> <?php echo get_the_date('j F, Y')?></li>
              <li><span>Duration:</span> <?php the_field('duration')?></li>
            </ul>
          </div>
          <a href="#" class="block category" id="single-article-category"><?php echo get_the_terms($post->ID, 'categories')[0]->name  ?></a>
        </div>


        <div class="banner" id="single-article-banner">
          <img src="<?php the_field('thumbnail')?>" alt="" class="object-cover w-full" />
        </div>
    </div>
</section>

<article class="single-article">
      <div class="single-wrapper max-w-[1000px] mx-auto w-full">
        <div class="grid grid-cols-[300px_1fr] gap-20 my-20">
          <aside class="sticky top-0 self-start">
            <div class="flex gap-5 pb-5 mb-5 border-b border-dark">

            <?php $author = get_field('author'); 
              if ($author) {
                $author_post_id = $author->ID;
                $thumbnail_url = get_field('thumbnail', $author_post_id)['url']; 
              }
            ?>

              <img
                src="<?php echo esc_url($thumbnail_url) ?>"
                alt=""
                class="rounded-full size-24"
              />
              <p class="text-3xl font-generalSemiBold"><?php echo get_field('author')->post_title ?></p>
            </div>


            <ul class="flex justify-between mb-2">
              <li class="font-generalSemiBold">Date:</li>
              <li><?php echo get_the_date('j F, Y')?></li>
            </ul>

            <ul class="flex justify-between mb-2">
              <li class="font-generalSemiBold">Read:</li>
              <li><?php the_field('duration')?></li>
            </ul>
          </aside>

          <main id="main-article">
            <?php the_content()?>
          </main>

        </div>
      </div>
</article>

<!-- LATEST -->
    <section class="mb-20 latest">
      <div class="container">
        <div
          class="flex items-center justify-between py-10 pb-20 border-t border-dark"
        >
          <h2 class="uppercase">Latest Post</h2>

          <a href="#" class="link-arrow right"
            >All Articles
            <svg class="icon-sm" role="image">
              <use xlink:href="./img/sprite.svg#icon-arrow-right"></use>
            </svg>
          </a>
        </div>

        <div class="grid overflow-hidden border md:grid-cols-3 border-dark lastest-grid">



            <?php 
            $article = new WP_Query(array(
                'post_type' => "magazines",
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID())
            
                ))
            ?>
            <?php if($article->have_posts()) : while($article->have_posts()) : $article->the_post()?>

          <div class="p-10 grid-item">
            <span class="after"></span>
            <span class="before"></span>
            <div class="flex items-center justify-between mb-10">

              <a href="<?php echo get_the_terms($post->ID, 'categories')[0]->slug ?>" class="category"><?php echo get_the_terms($post->ID, 'categories')[0]->name?></a>
            </div>

            <div class="mb-10 img-wrap">
              <img
                src="<?php echo get_field('thumbnail')?>"
                alt=""
                class="object-cover w-full h-full"
              />
            </div>

            <a href="<?php the_permalink()?>"><h3 class="article-header"><?php the_title()?></h3></a>
            <p class="mb-10 line-clamp-4">
              <?php the_field('excerpt')?>
            </p>
            <div class="details">
              <ul>
                <li><span>Date:</span> <?php echo get_the_date('j F, Y')?></li>
                <li><span>Duration:</span> <?php the_field('duration')?></li>
              </ul>
            </div>
          </div>
          <?php endwhile;
            else:
                echo 'no post';
            endif;
            wp_reset_postdata()
          ?>



        </div>
      </div>
    </section>



    

<?php get_footer()?>