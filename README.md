# wpdk
It helps you to Enqueue Scripts and Generate Post-Type Very easy. It will save your time and reduce you code too.

##### Require The library File to your function.php
  ```ruby
   require_once get_template_directory().'/wpdk/Init.php';
  ```

# Hooks and Use
 ### Action Filter
* Enqueue Stylesheet for FrontEnd
  ###### wpdk_enqueue_public_style
  ```ruby
  add_filter('wpdk_enqueue_public_style', function ($styles) {
    return $styles = [
      [
        'handle' => 'style-handle',
        'src' => 'Url',
        'deps' => [], // Default False
        'ver' => '0.1' // Default False
        'media' => 'all|Print' // Default all
      ]
    ];
  });
  ```
    
* Enqueue Scripts for FrontEnd
  ###### wpdk_enqueue_public_scripts
  ```ruby
  add_filter('wpdk_enqueue_public_scripts', function ($scripts) {
    return $scripts = [
      [
        'handle' => 'script-handle',
        'src' => 'Url',
        'deps' => [], // Default False
        'ver' => '0.1' // Default False
        'in_footer' => True|False // Default False
      ]
    ];
  });
  ```

* Enqueue Stylesheet for AdminPanel
  ###### wpdk_enqueue_admin_style
  ```ruby
  add_filter('wpdk_enqueue_admin_style', function ($styles) {
    return $styles = [
      [
        'handle' => 'style-handle',
        'src' => 'Url',
        'deps' => [], // Default False
        'ver' => '0.1' // Default False
        'media' => 'all|Print' // Default all
      ]
    ];
  });
  ```

* Enqueue Scripts for AdminPanel
  ###### wpdk_enqueue_admin_scripts
  ```ruby
  add_filter('wpdk_enqueue_admin_scripts', function ($scripts) {
    return $scripts = [
      [
        'handle' => 'script-handle',
        'src' => 'Url',
        'deps' => [], // Default False
        'ver' => '0.1' // Default False
        'in_footer' => True|False // Default False
      ]
    ];
  });
  ```


    
###### PostType Generator
 * wpdk_generate_posttype
   ```ruby
   add_filter('wpdk_generate_posttype', function ($postList) {
      return $postList = [
            [
                'name' => 'Posttye Name',
                'label' => 'Posttype Label',
                'icon' => 'dashicons-id',
                'gutenberg' => true, // GutenBerg Enable Default False
            ]
       ];
   });
    ```
       
###### Taxonomy Generator
   * wpdk_generate_taxonomy
     ```ruby
     add_filter('wpdk_generate_taxonomy', function ($taxonomy) {
        return $taxonomy = [
              [
                  'name' => 'portfolio-category',
                  'label' => 'Portfolio Category',
                  'attached' => ['portfolio'], // Add the postype name in array where do you want to attach the taxonomy
                  'gutenberg' => true, // GutenBerg Enable Default False
              ],  
          ];
     });
       ```
 
