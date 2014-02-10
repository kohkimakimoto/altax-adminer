<?php
function adminer_object() {
    // required to run any plugin
    include_once __DIR__."/plugins/plugin.php";
    
    // autoloader
    foreach (glob(__DIR__."/plugins/*.php") as $filename) {
        include_once $filename;
    }
    
    $plugins = array(
        // specify enabled plugins here
        new AdminerVersionNoverify()
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin($plugins);
}

// Change directory to runs adminer-x.x.x.php correctly.
chdir(__DIR__);

// include original Adminer or Adminer Editor
include __DIR__."/adminer-4.0.3.php";