<?php
/**
 * WP Posts Master Overviews.
 * @package Posts
 * @author Flipper Code <flippercode>
 **/
  
 $features = array('Show listing of wordpress default posts and custom post types both, that is currently setup in your wordpress. Supported custom posts type.',
 'Filter by taxonomies. Supported unlimited taxonomies.',
 'Filter Posts by Terms Name. You can setup hierarchy between custom posts type, taxonomies and terms.',
 'Filter Posts by custom dates. You can decide Start & End Date.',
 'Filter posts by custom field name and it’s value. Very useful feature where you need not to worry about any programming.'
 );
 
 $productInfo = array('productName' => __('WP Posts Master',WPP_TEXT_DOMAIN),
                        'productSlug' => 'wp-posts-master',
                        'productTagLine' => 'Displays listing of default wordpress posts and custom post type posts without any programming. Show listings in pages, posts & custom templates. It’s Responsive, Multi-Lingual and Multi-Site Supported.',
                        'productTextDomain' => WPP_TEXT_DOMAIN,
                        'productIconImage' => WPP_URL.'core/core-assets/images/wp-poet.png',
                        'productVersion' => WPP_VERSION,
                        'productImagePath' => WPP_URL.'core/core-assets/product-images/',
                        'productImageName' => '12.png',
                        'premiumFeatures' => $features,
                        'productSaleURL' => 'https://codecanyon.net/item/wordpress-posts-listing-plugin/7292195',
                        'is_premium' => 'false',
                        'docURL' => 'http://www.flippercode.com/documentations/wp-posts-pro/',
                        'demoURL' => 'http://www.flippercode.com/product/wp-posts-pro/',
                        'have_premium' => 'true',
                        'productBanner' => 'https://image-cc.s3.envato.com/files/173018958/post-pro.jpg'
    );

    $productOverviewObj = new Flippercode_Product_Overview($productInfo);
