(function() { 
    var url = document.getElementById('hidden_url').value;

    // Creates a new plugin class and a custom listbox
    tinymce.PluginManager.add( 'theme_shortcodes' , function( editor ){
        editor.addButton('theme_shortcodes', {
            type: 'listbox',
            text: 'Shortcodes',
            tooltip: 'Shortcodes builder',
            fixedWidth: true,
            onselect: function(e) {
                switch(this.value()) {
                    case 'alert':
                        var tb = tb_show('Alert', url + '/shortcodes/alert.php?TB_iframe=true"');
                    break;
                    case 'blog':
                        var tb = tb_show('Blog', url + '/shortcodes/blog.php?TB_iframe=true"');
                    break;
                    case 'button':
                        var tb = tb_show('Button', url + '/shortcodes/button.php?TB_iframe=true"');
                    break;
                    case 'color':
                        var tb = tb_show('Color', url + '/shortcodes/color.php?TB_iframe=true"');
                    break;
                    case 'columns':
                        var tb = tb_show('Columns', url + '/shortcodes/columns.php?TB_iframe=true"');
                    break;
                    case 'counter':
                        var tb = tb_show('Quote', url + '/shortcodes/counter.php?TB_iframe=true"'); 
                    break;
                    case 'dropcaps':
                        var tb = tb_show('Dropcaps', url + '/shortcodes/dropcaps.php?TB_iframe=true"');
                    break;
                    case 'googleMaps':
                        var tb = tb_show('Google Maps', url + '/shortcodes/google_maps.php?TB_iframe=true"');
                    break;
                    case 'heading':
                        var tb = tb_show('Heading', url + '/shortcodes/heading.php?TB_iframe=true"'); 
                    break;
                    case 'recentBlogPosts':
                        var tb = tb_show('Recent Blog Posts', url + '/shortcodes/recent_blog_posts.php?TB_iframe=true"');
                    break;
                    case 'recentPortfolioPosts':
                        var tb = tb_show('Recent Portfolio Posts', url + '/shortcodes/recent_portfolio_posts.php?TB_iframe=true"');
                    break;
                    case 'row':
                        var tb = tb_show('Row', url + '/shortcodes/row.php?TB_iframe=true"');
                    break;
                    case 'tabs':
                        var tb = tb_show('Tabs', url + '/shortcodes/tabs.php?TB_iframe=true"');
                    break;
                    case 'tabsElement':
                        var tb = tb_show('Tabs Element', url + '/shortcodes/tabs_element.php?TB_iframe=true"');
                    break;
                    case 'columnText':
                        var tb = tb_show('Text Block', url + '/shortcodes/column_text.php?TB_iframe=true"'); 
                    break;
                    case 'team':
                        var tb = tb_show('Team', url + '/shortcodes/team.php?TB_iframe=true"'); 
                    break;
                    case 'twitter':
                        var tb = tb_show('Twitter', url + '/shortcodes/twitter.php?TB_iframe=true"'); 
                    break;
                    case 'vimeo':
                        var tb = tb_show('Vimeo', url + '/shortcodes/vimeo.php?TB_iframe=true"'); 
                    break;
                    case 'youtube':
                        var tb = tb_show('YouTube', url + '/shortcodes/youtube.php?TB_iframe=true"'); 
                    break;
                    case 'quote':
                        var tb = tb_show('Quote', url + '/shortcodes/quote.php?TB_iframe=true"'); 
                    break;
                }
            },
            values: [
                {text: 'Alert', value: 'alert'},
                {text: 'Blog', value: 'blog'},
                {text: 'Button', value: 'button'},
                {text: 'Columns', value: 'columns'},
                {text: 'Color', value: 'color'},
                {text: 'Counter', value: 'counter'},
                {text: 'Dropcaps', value: 'dropcaps'},
                {text: 'Google Maps', value: 'googleMaps'},
                {text: 'Heading', value: 'heading'},
                {text: 'Recent Blog Posts', value: 'recentBlogPosts'},
                {text: 'Recent Portfolio Posts', value: 'recentPortfolioPosts'},
                {text: 'Row', value: 'row'},
                {text: 'Tabs', value: 'tabs'},
                {text: 'Tabs Element', value: 'tabsElement'},
                {text: 'Team', value: 'team'},
                {text: 'Text Block', value: 'columnText'},
                {text: 'Twitter', value: 'twitter'},
                {text: 'Vimeo', value: 'vimeo'},
                {text: 'YouTube', value: 'youtube'},
                {text: 'Quote', value: 'quote'},
            ]
        });
    });
    
    tinymce.init({
        plugins: 'theme_shortcodes',
        toolbar: 'styleselect '
    });
})();