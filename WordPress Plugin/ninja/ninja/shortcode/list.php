<?php

add_action( 'init', 'ninja_shortcodes_init' );

function ninja_shortcodes_init() {
	add_shortcode( 'cakelist', 'ninja_cake_list' );
}

function ninja_cake_list( $atts = [], $content = null, $tag = '' ) {


  if(isset($_GET['cakeid']) && $_GET['cakeid']!=''){
    $cake_id = $_GET['cakeid'];

    ob_start();
    ?>

        <section class="padding-top-100 padding-bottom-100">
          <div class="container"> 
          <div class = "card-wrapper">
          <div class = "card" id="cake_detail_block" data-cid="<?php echo $cake_id?>">
            <!-- card left -->
            <div class = "product-imgs" >
              <div class = "img-display">
                <div class = "img-showcase" id="cake_imgs">

              </div>
              </div>
              <div class = "img-select" id="cake_thumbs">
                
              </div>
            </div>
            <!-- card right -->
            <div class = "product-content">
              <h2 class = "product-title" id="cake_title"></h2>

              <div class = "product-price">
                <p class = "price">$<span id="cake_price"></span></p>
              </div>

              <div class = "product-detail">
                <ul>
                  <li>Type: <span id="cake_type"></span></li>
                </ul>
                <h2>about this item: </h2>
                <span id="cake_receipe"></span>
              </div>

              <div class = "purchase-info">
                <button type = "button" class = "btn">
                  Add to Cart <i class = "fas fa-shopping-cart"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php

    $output = ob_get_contents();
    ob_end_clean();

  }else{

    $atts = shortcode_atts(
      array(
        'cat' => '',
      ), $atts, 'cakelist' );

      ob_start();
      ?>
      <section class="shop-page">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="title">
                  <h2>Cakes</h2>
                </div>
            </div>
          </div>
          <div class="item-display">
            <div class="row">
              <div class="col-md-12">
                <span class="product-num">
                  <form>
                      <?php
                      if($atts['cat'] != ''){
                        //todo
                      }else{
                      ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Sugar Free</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">brownie</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">cupcakes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                        <label class="form-check-label" for="inlineCheckbox4">chocolate strip</label>
                      </div>
                      <?php
                      }
                      ?>
                </form>
                </span>
              </div>
          </div>
          </div>
          
          <!-- Popular Item Slide -->
          <div class="shop-items row" id="ninja_cake_list" data-cat="<?php echo $atts['cat']?>" data-url="<?php echo get_permalink();?>"> 
            
            
          </div>
        </div>
      </section>


      <?php
      $output = ob_get_contents();
      ob_end_clean();

    }

	return $output;
}