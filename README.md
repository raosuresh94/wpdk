# wpdk
It helps you to Enqueue Scripts and Generate Post-Type Very easy. It will save your time and reduce you code too.

##### Require The library File to your function.php
  ```ruby
   require_once __DIR__.'/wpdk-lib/Init.php';
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
       
       
 ###### Create Customizer Option with hook
   * wpdk_register_theme_option
   
        ```ruby
             add_filter('wpdk_register_theme_option', function ($sections) {
                 return $sections = [
                    [
                        'panel' => [
                            'id' => 'social_panel',
                            'title' => 'Social Details',
                            'description' => 'Add Social Details Here!',
                            'priority' => 160,
                        ],
                        'section' => [
                            'id' => 'social_section',
                            'panel' => 'social_panel',
                            'title' => 'Social Links',
                            'priority' => 30,
                        ],
                        'setting' => [
                            'id' => 'facebook_link',
                            'default' => 'Facebook Link',
                            'transport' => 'refresh',
                        ],
                        'control' => [
                            'id' => 'facebook_link',
                            'title' => 'Facebook Link',
                            'section' => 'social_section',
                            'setting' => 'facebook_link',
                        ],
                    ],
                    [
                        'setting' => [
                            'id' => 'twitter_link',
                            'default' => 'Twitter Link',
                            'transport' => 'refresh',
                        ],
                        'control' => [
                            'id' => 'twitter_link',
                            'title' => 'Twitter Link',
                            'section' => 'social_section',
                            'setting' => 'twitter_link',
                        ],
                    ],
                    [
                        'setting' => [
                            'id' => 'linkedin_link',
                            'default' => 'Linked In Link',
                            'transport' => 'refresh',
                        ],
                        'control' => [
                            'id' => 'linkedin_link',
                            'title' => 'Linked In Link',
                            'section' => 'social_section',
                            'setting' => 'linkedin_link',
                        ],
                    ],
                ];
             });
        ```
   
