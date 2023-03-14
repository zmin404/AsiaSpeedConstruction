<?php
include_once get_template_directory() . '/anps-framework/classes/Dummy.php';

if (isset($_GET['save_dummy'])) {
    $dummy->save();
}

$dummy_class = 'content-inner envoo-dummy';

if ($dummy->select() === '1') {
    $dummy_class .= ' demo-twice';
}
?>
<form action="themes.php?page=theme_options&sub_page=dummy_content&save_dummy" method="post">
    <div class="<?php echo esc_attr($dummy_class); ?>">
        <h3><?php _e("Insert dummy content: posts, pages, categories", 'constructo'); ?></h3>
        <p><?php _e("Importing demo content is the fastest way to get you started. <br/> Please <strong>install all plugins required by the theme</strong> before importing content. If you already have some content on your site, make a backup just in case.", 'constructo'); ?></p>

        <div class="clear"></div>
        <div class="input">
            <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/demoimport_screen.jpg" />
            <div class="demotitle"><h4>Classic demo</h4></div>
            <div class="demo-buttons">
                <input type="submit" name="dummy1" class="dummy" value="<?php _e("Insert dummy content", 'constructo'); ?>" />
                <a class="launch" href="http://anpsthemes.com/constructo-new-demos/1/" target="_blank">launch demo preview</a>
            </div>
        </div>
        <div class="input">
            <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/import-extravagant.jpg" />
            <div class="demotitle"><h4>Extravagant demo</h4></div>
            <div class="demo-buttons">
                <input type="submit" name="dummy2" class="dummy" value="<?php _e("Insert dummy content", 'constructo'); ?>" />
                <a class="launch" href="http://anpsthemes.com/constructo-new-demos/3/" target="_blank">launch demo preview</a>
            </div>
        </div>
        <div class="clear"></div>
        <div class="input">
            <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/import-fullscreen.jpg" />
            <div class="demotitle"><h4>Fullscreen demo</h4></div>
            <div class="demo-buttons">
                <input type="submit" name="dummy3" class="dummy" value="<?php _e("Insert dummy content", 'constructo'); ?>" />
                <a class="launch" href="http://anpsthemes.com/constructo-new-demos/4/" target="_blank">launch demo preview</a>
            </div>
        </div>
        <div class="input">
            <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/import-limitless.jpg" />
            <div class="demotitle"><h4>Limitless demo</h4></div>
            <div class="demo-buttons">
                <input type="submit" name="dummy4" class="dummy" value="<?php _e("Insert dummy content", 'constructo'); ?>" />
                <a class="launch" href="http://anpsthemes.com/constructo-new-demos/2/" target="_blank">launch demo preview</a>
            </div>
        </div>
        <div class="clear"></div>
        <?php
            $demos = array(
                5  => 'Vertical menu demo',
                6  => 'Modern demo',
                7  => 'Iconic demo',
                8  => 'Simple demo',
                9  => 'Dark demo',
                10 => 'Craftsman demo',
                11 => 'Renovate demo',
            );
        ?>
        <?php foreach($demos as $index => $demo): ?>
            <div class="input">
                <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/demoinstall_<?php echo esc_attr($index); ?>.jpg" />
                <div class="demotitle"><h4><?php echo esc_html($demo); ?></h4></div>
                <div class="demo-buttons">
                    <input type="submit" name="dummy<?php echo esc_attr($index); ?>" class="dummy" value="<?php _e("Insert dummy content", 'constructo'); ?>" />
                    <a class="launch" href="http://anpsthemes.com/constructo-new-demos/<?php echo esc_attr($index); ?>/" target="_blank"><?php _e('launch demo preview', 'constructo'); ?></a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="clear"></div>
        <div class="absolute fullscreen importspin">
            <div class="table">
                <div class="table-cell center">
                    <div class="messagebox">
                    <i class="fa fa-cog fa-spin" style="font-size:30px;"></i>
                        <h2><strong>Import might take some time, please be patient</strong></h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
