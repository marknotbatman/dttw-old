<?php include('tf-controller.php'); ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?></title>
    
    <!-- !css -->
    <link href='http://fonts.googleapis.com/css?family=Chivo|Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/css/jquery.jscrollpane.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/css/style.css"              media="all" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/css/style_1024.css"         media="screen and (max-width: 1024px)" />
    <!--[if lt IE 9]>
    <script src="<?php bloginfo('stylesheet_directory') ?>/assets/js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/css/style_ie.css"           media="all" />
    <![endif]-->
    <style type="text/css">
    
        <?php
        $custom_colors = array(
            'base-color'                    => 'body',
            'color-anchors'                 => 'a',
            'color-h1'                      => 'h1',
            'color-h2'                      => 'h2',
            'color-h3'                      => 'h3',
            'color-h4'                      => 'h4',
            'color-h5'                      => 'h5',
            'color-anchors-menu'            => 'header nav ul li a',
            'color-anchors-menu-hover'      => 'header nav ul li a:hover',
            'color-anchors-menu-selected'   => 'header nav ul li a.selected',
            'color-player'                  => 'footer #footer-player div',
            'color-footer'                  => 'footer #footer-text',
            'color-page'                    => '#section-page',
            'color-comment-meta'            => '#section-page #section-page-wrapper #section-page-content #section-page-content-commentslist ul li .comment-meta',
            'color-page-menu'               => '#menu-page li a',
            'color-page-menu-hover'         => '#menu-page li a:hover',
            'collections-anchors'           => '#section-collection-container .collection-box a',
            'collections-pagelink-over'     => '#section-collection-container .collection-box.collection-box-pagelink a:hover',
            'collections-pageimagelink-over'    => '#section-collection-container .collection-box.collection-box-pageimagelink a:hover',
            'collections-blockquote'        => '#section-collection-container .collection-box.collection-box-quote blockquote',
            'collections-blockquote-author' => '#section-collection-container .collection-box.collection-box-quote span',
            'collections-boxlink'           => '#section-collection-container .collection-box.collection-box-link .collection-box-content a:hover',
            'post-list-title'               => '.post-list h2',
            'post-list-date'                => '.post-list h4',
            'post-list-continue'            => '.post-list a.post-list-readmore',
            'post-list-continue-over'       => '.post-list a.post-list-readmore:hover',
            'post-list-pagination'          => '#pagination li a',
            'post-list-pagination-sel'      => '#pagination li.pagination-sel a',
            'form-label'                    => '.form .form-input label',
            'form-fields'                   => '.form .form-input input,.form .form-input textarea'
        );
        
        $custom_bkg_colors = array(
            'collections-box-border'        => '#section-collection-container .collection-box:hover .collection-box-border',
        );
        
        foreach($custom_colors as $_custom_color_key => $_custom_color_selector)
        {
            $custom_color = $NHP_Options->get($_custom_color_key);
            if(is_string($custom_color))
            {
                echo "{$_custom_color_selector} { color : {$custom_color} }\n\t";
            }
        }
        
        foreach($custom_bkg_colors as $_custom_color_key => $_custom_color_selector)
        {
            $custom_color = $NHP_Options->get($_custom_color_key);
            if(is_string($custom_color))
            {
                echo "{$_custom_color_selector} { background-color : {$custom_color} }\n\t";
            }
        }
        
        ?> 
    </style>
    
    <!-- !templates -->
    
    <!-- !template header menu -->
    <script type="text/html" id="tmpl_header_menu">
        <ul>
        <% 
        var pageUrl, subPages, label;
        _.each(menuPages, function(menuItem, i){
            pageUrl  = (menuItem.type == 'custom')? menuItem.url : '#/' + menuItem.object_id + '/' + menuItem.slug;
            label    = (menuItem.type == 'custom')? menuItem.post_title : menuItem.title;
            subPages = menuItem.sub; %>
            <li class="root">
                <a id="nav-<%= menuItem.object_id %>" href="<%= pageUrl %>"><%= label %></a>
                <% if(subPages.length){ %>
                <ul>
                <% _.each(subPages, function(menuItem, i){
                    pageUrl  = (menuItem.type == 'custom')? menuItem.url : '#/' + menuItem.object_id + '/' + menuItem.slug;
                    label    = (menuItem.type == 'custom')? menuItem.post_title : menuItem.title;
                    %>
                    <li class="sub"><a href="<%= pageUrl %>"><%= label %></a></li>
                <% }); %>
                </ul>
                <% } %>
            </li><% 
        }); %>
        </ul>
    </script>
    
    <!-- !template footer player -->
    <script type="text/html" id="tmp_footer_player">
        <section id="footer-player">
            <audio src=""></audio>
            <div><span></span></div>
            <a href="javascript:void(0)" id="footer-player-play"></a>
            <a href="javascript:void(0)" id="footer-player-pause"></a>
            <a href="javascript:void(0)" id="footer-player-rewind"></a>
            <a href="javascript:void(0)" id="footer-player-forward"></a>
        </section>
    </script>
    
    <!-- !template section page -->
    <script type="text/html" id="tmp_section_page">
        <div id="section-page" class="section-page-width-<%= width %> section-page-position-<%= position %>">
            <div id="section-page-wrapper">
                <div id="section-page-content">
                    <h1><a href="javascript:void(0)" class="section-action" id="section-close"></a><%= title %></h1>
                    <% if(subtitle){ %><h4><%= subtitle %></h4><% } %>
                    <% if(image){ %>
                    <img src="<%= image %>" alt="" id="section-page-content-image" />
                    <% } %>
                    
                    <div id="section-page-content-text">
                    <%= (content !== undefined)? content : '' %>
                    </div>
                    
                </div>
            </div>
        </div>
        <% if(subPages && (width !== 'full' )){ %>
        <ul id="menu-page" class="menu-page-width-<%= width %> menu-page-position-<%= position %>">
            <% _.each(subPages, function(page, i){ %>
            <li><a href="<%= page.url %>"><%= page.name %></a></li>
            <% }) %>
        </ul>
        <% } %>
    </script>
    
    <!-- !template section contact -->
    <script type="text/html" id="tmp_section_contact">
        <div id="section-page" class="section-page-width-<%= width %> section-page-position-<%= position %>">
            <div id="section-page-wrapper">
                <div id="section-page-content">
                    <h1><a href="javascript:void(0)" class="section-action" id="section-close"></a><%= title %></h1>
                    <% if(subtitle){ %><h4><%= subtitle %></h4><% } %>
                    <% if(image){ %>
                    <img src="<%= image %>" alt="" id="section-page-content-image" />
                    <% } %>
                    
                    <div id="section-page-content-text">
                        <%= (content !== undefined)? content : '' %>
                        <form class="form" action="">
                            <div class="form-input form-input-text">
                                <label>name</label>
                                <input type="text" name="contact[name]" />
                            </div>
                            <div class="form-input form-input-text">
                                <label>email</label>
                                <input type="text" name="contact[email]" />
                            </div>
                            <div class="form-input form-input-text">
                                <label>subject</label>
                                <input type="text" name="contact[subject]" />
                            </div>
                            <div class="form-input form-input-textarea">
                                <label>message</label>
                                <textarea name="contact[message]"></textarea>
                            </div>
                            <div class="form-input form-input-submit">
                                <input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/ico/ico-28-confirm.png" value="submit" />
                            </div>
                        </form>
                        <div class="form-message form-ok"><%= message_ok %></div>
                        <div class="form-message form-ko"><%= message_ko %></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <% if(subPages && (width !== 'full' )){ %>
        <ul id="menu-page" class="menu-page-width-<%= width %> menu-page-position-<%= position %>">
            <% _.each(subPages, function(page, i){ %>
            <li><a href="<%= '#/' + page.get('id') + '/' + page.get('url') %>"><%= page.get('name') %></a></li>
            <% }) %>
        </ul>
        <% } %>
    </script>
    
    <!-- !template section blog -->
    <script type="text/html" id="tmp_section_blog">
        <div id="section-page" class="section-page-width-<%= width %> section-page-position-<%= position %>">
            <div id="section-page-wrapper">
                <div id="section-page-content">
                    <h1><a href="javascript:void(0)" class="section-action" id="section-close"></a><%= title %></h1>
                    <% if(subtitle){ %><h4><%= subtitle %>&nbsp;</h4><% } %>
                </div>
                <% 
                _.each(posts, function(post, i)
                {
                    var listClass    = (i % 2 == 0)? 'post-list-even' : 'post-list-odd';
                    
                    var customField  = post.get('custom_fields');
                    var hasImage     = ( customField.tf_post_image )? true : false;
                    var imageId      = ( hasImage )? customField.tf_post_image[0] : null;
                    var imageUrl;
                    
                    if( imageId )
                    {
                        _.each(post.get('attachments'), function(el, i)
                        {
                        	if( imageId == el.id )
                        	{  
                        	   imageUrl = el.url;
                        	}
                        });
                    }
                    var articleClass = (imageUrl)? 'post-list-article-with-thumb' : 'post-list-article-without-thumb'; 
                    %>
                    <div class="post-list <%= listClass %>">
                        <% if(imageUrl){ %>
                        <img class="post-list-thumb preload" src="<%= imageUrl %>" alt="" />
                        <% } %>
                        <article class="<%= articleClass %>">
                            <% var postDate = new Date(post.get('date').substr(0,10)); %>
                            <h4><%= postDate.getMonth() + 1 %>-<%= postDate.getDate() %>-<%= postDate.getFullYear() %></h4>
                            <h2><%= post.get('title') %></h2>
                            <p><%= post.get('excerpt') %></p>
                            <p><a class="post-list-readmore" href="#/<%= page.get('id') %>/post/<%= post.get('id') %>/<%= post.get('slug') %>">read more</a></p>
                        </article>
                        <div class="post-list-clear"></div>
                    </div>
                    <%
                });
                
                if(pages > 1)
                {
                    %>
                    <div id="pagination">
                    <ul>
                        <% var liClass; %>
                        <% for(var i = 1; i <= pages; i++){ liClass = (currentPage == i)? 'pagination-sel' : 'pagination-unsel'; %>
                        <li class="<%= liClass %>"><a href="javascript:void(0)" data-page="<%= i %>"><%= i %></a></li>
                        <% } %>
                    </ul>
                    </div>
                    <%
                }
                
                %>
            </div>
        </div>
        <% if(subPages){ %>
        <ul id="menu-page">
            <% _.each(subPages, function(page, i){ %>
            <li><a href="<%= '#/' + page.get('id') + '/' + page.get('url') %>"><%= page.get('name') %></a></li>
            <% }) %>
        </ul>
        <% } %>
    </script>
    
    <!-- !template section blog plost -->
    <script type="text/html" id="tmp_section_blog_post">
        <div id="section-page" class="section-page-width-<%= width %> section-page-position-<%= position %>">
            <div id="section-page-wrapper">
                <div id="section-page-content">
                    <h1>
                        <a href="javascript:void(0)" class="section-action" id="section-close"></a>
                        <a href="javascript:void(0)" class="section-action" id="section-back"></a>
                        <%= title %>
                    </h1>
                    <% if(subtitle){ %><h4><%= subtitle %>&nbsp;</h4><% } %>
                    <% if(image){ %>
                    <img src="<%= image %>" alt="" id="section-page-content-image" />
                    <% } %>
                    
                    <div id="section-page-content-text">                    
                        <%= post.get('content') %>
                        <div id="section-page-content-comments"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <% if(subPages){ %>
        <ul id="menu-page">
            <% _.each(subPages, function(page, i){ %>
            <li><a href="<%= '#/' + page.get('id') + '/' + page.get('url') %>"><%= page.get('name') %></a></li>
            <% }) %>
        </ul>
        <% } %>
    </script>
    
    <!-- !template section comments list -->
    <script type="text/html" id="tmp_section_commentslist">
        <ul>
            <% 
            if(comments.length === 0){ 
            %>
            <li>There's no comments at the moment.</li>
            <% 
            } else {
                _.each(comments, function(comment)
                { 
                %>
                <li>
                    <h5><%= comment.get('datetime') %></h5>
                    <h4><%= comment.get('name') %></h4>
                    <p><%= comment.get('comment') %></p>
                </li>
                <%
                });
            %>
            <% } %>
        </ul>
    </script>
    
    <!-- !template section video -->
    <script type="text/html" id="tmp_section_video">
        <div id="section-video-wrapper">
            <div id="section-video">
                <div id="section-video-content">
                    <h1><a href="javascript:void(0)" class="section-action" id="section-close"></a><%= title %></h1>
                    <% if(subtitle){ %><h4><%= subtitle %></h4><% } %>
                    <% 
                    var video_url = 'http://';
                    switch(video_type)
                    {
                        case 'youtube':
                            video_url += 'www.youtube.com/embed/' + video_id + '?wmode=transparent&theme=' + youtube_theme + '&controls=1&rel=0'
                            break;
                            
                        case 'vimeo':
                            video_url += 'player.vimeo.com/video/' + video_id
                            break;
                    }
                    %>
                    <iframe width="805" height="455" src="<%= video_url %>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
            </div>
        </div>
    </script>
    
    <!-- !template section video fullscreen -->
    <script type="text/html" id="tmp_section_video_fullscreen">
        <div id="section-videofull-wrapper">
            <% 
            var video_url = 'http://';
            switch(video_type)
            {
                case 'youtube':
                    video_url += 'www.youtube.com/embed/' + video_id + '?theme=' + youtube_theme + '&controls=1&rel=0'
                    break;
                    
                case 'vimeo':
                    video_url += 'player.vimeo.com/video/' + video_id
                    break;
            }
            %>
            <iframe src="<%= video_url %>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div>
    </script>
    
    <!-- !template section gallery -->
    <script type="text/html" id="tmp_section_gallery">
        <div id="section-gallery">
            <div id="section-gallery-image"><div id="section-gallery-image-content"></div></div>
            <div id="section-gallery-thumbs"><div id="section-gallery-thumbs-bar"></div></div>
        </div>
    </script>
    
    <script type="text/html" id="tmp_section_gallery_thumb">
        <img src="<%= image.thumb %>" data-id="<%= image.id %>" alt="" />
    </script>
    
    <script type="text/html" id="tmp_section_gallery_image">
        <img src="<%= imageUrl %>" alt="" />
    </script>
    
    <!-- !template section collection -->
    <script type="text/html" id="tmp_section_collection">
        <div id="section-collection-container">
            <div id="section-collection">
                <% 
                var collectionBoxClass, collectionBoxContent, collectionItemType, collectionItemUrl, collectionItemTitle, collectionItemImage;
                _.each(collection, function(collectionElement)
                {
                    collectionItemType = null;
                    if( typeof(collectionElement.get('custom_fields').tf_collection_item_type) === 'object' )
                    {
                        collectionItemType = collectionElement.get('custom_fields').tf_collection_item_type[0];
                    }
                    
                    collectionItemUrl       = 'javascript:void(0)';
                    if( typeof(collectionElement.get('custom_fields').tf_collection_item_page) === 'object' )
                    {
                        collectionItemUrl   = collectionElement.get('custom_fields').tf_collection_item_page[0];
                    }
                    
                    collectionItemImage     = null;
                    if( typeof(collectionElement.get('custom_fields').tf_collection_item_image) === 'object' )
                    {
                        collectionItemImage = collectionElement.get('custom_fields').tf_collection_item_image[0];
                        _.each(collectionElement.get('attachments'), function(image)
                        {
                            if(image.id == collectionItemImage)
                            {
                                collectionItemImage = image.images.medium.url;
                            }
                        });
                        
                        if(isFinite(collectionItemImage))
                        {
                            collectionItemImage = null;
                        }
                    }
                    
                    switch(collectionItemType)
                    {
                        case 'pageLink': 
                            collectionBoxClass      = 'collection-box-pagelink';
                            collectionBoxContent    = '<a href="'+ collectionItemUrl +'">'+ collectionElement.get('title') +'</a>';
                            break;
                            
                        case 'imagePageLink':
                            collectionBoxClass    = 'collection-box-pageimagelink';
                            collectionBoxContent  = '<a href="'+ collectionItemUrl +'">';
                            if(collectionItemImage)
                            {
                                collectionBoxContent += '<img src="'+ collectionItemImage +'" alt="" />';
                            }
                            collectionBoxContent += '<div class="collection-box-pageimagelink-content">'+ collectionElement.get('title') +'</div>';
                            collectionBoxContent += '</a>';
                            break;
                        
                        case 'quote':
                            var quote = '';
                            if( typeof(collectionElement.get('custom_fields').tf_collection_item_quote) === 'object' )
                            {
                                quote = collectionElement.get('custom_fields').tf_collection_item_quote[0];
                            }
                            
                            var author = '';
                            if( typeof(collectionElement.get('custom_fields').tf_collection_item_author) === 'object' )
                            {
                                author = collectionElement.get('custom_fields').tf_collection_item_author[0];
                            }
                            
                            collectionBoxClass    = 'collection-box-quote';
                            collectionBoxContent  = '<blockquote>'+ quote +'</blockquote><span>'+ author +'</span>';
                            break;
                            
                        case 'link':
                        
                            var url = '';
                            if( typeof(collectionElement.get('custom_fields').tf_collection_item_url) === 'object' )
                            {
                                url = collectionElement.get('custom_fields').tf_collection_item_url[0];
                            }
                        
                            collectionBoxClass    = 'collection-box-link';
                            collectionBoxContent  = '<a target="_blank" href="'+ url +'">'+ collectionElement.get('title') +'</a>';
                            break;
                            
                        case 'image':
                            collectionBoxClass    = 'collection-box-image';
                            collectionBoxContent  = '<img data-zoom="'+ collectionElement.get('zoom') +'" src="'+ collectionElement.get('image') +'" alt="" />';
                            if(collectionElement.get('title'))
                            {
                                collectionBoxContent += '<div class="collection-box-image-caption"><span>'+ collectionElement.get('title') +'</span></div>';
                            }
                            break;
                            
                    };
                    %>
                    <div class="collection-box <%= collectionBoxClass %> ">
                        <div class="collection-box-border"></div>
                        <div class="collection-box-content">
                            <%= collectionBoxContent %>
                        </div>
                    </div>
                    <%
                }); 
                %>
            </div>
        </div>
    </script>
    
    <script type="text/javascript">
        var webroot  = '<?php echo site_url(); ?>';
        var themedir = '<?php bloginfo('stylesheet_directory') ?>';
    </script>
    
    <?php wp_head(); ?>
    <script type="text/javascript">
        
        app.config.thumbWidth           = <?php echo get_option( 'thumbnail_size_w' ); ?>;
        app.config.thumbHeight          = <?php echo get_option( 'thumbnail_size_h' ); ?>;
        app.config.musicPlayer          = <?php echo ($NHP_Options->get('general-music-player'))?           'true' : 'false'; ?>;
        app.config.musicPlayerAutoplay  = <?php echo ($NHP_Options->get('general-music-player-autoplay'))?  'true' : 'false'; ?>;
        app.config.mailTo               = '<?php echo $NHP_Options->get('general-contacts-email'); ?>';
        <?php 
        $home_backgrounds = $NHP_Options->get('home-background');
        if(!empty($home_backgrounds))
        {
            if(is_array($home_backgrounds))
            {
                echo "app.config.homeImages = [];\n\t";
                foreach($home_backgrounds as $_home_background)
                {
                    echo "app.config.homeImages.push('{$_home_background}');";
                }
            }
        }
        ?> 
        var app_menu_pages = <?php echo json_encode($menu_data); ?>;
    </script>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">

    <!-- !container -->
    <div id="container">
        
        <!-- !header -->
        <div id="header-top"></div>
        <header>
            <?php 
            $logo_url = $NHP_Options->get('general-logo-url');
            if(is_null($logo_url))
            {
                $logo_url = get_stylesheet_directory_uri().'/assets/img/logo.png'; 
            }
            ?>
            <a id="header-logo" href="#/" id="header-logo"><img width="175" height="70" class="preload" src="<?php echo $logo_url; ?>" alt="<?php $NHP_Options->show('general-logo-alt'); ?>" /></a>
            <nav></nav>
            <select id="header-select"></select>
        </header>
        <a href="javascript:void(0)" id="ico-fullscreen" class="ico ico-28"></a>
        <a href="javascript:void(0)" id="ico-right"      class="ico ico-28"></a>
        <a href="javascript:void(0)" id="ico-left"       class="ico ico-28"></a>
        
        <!-- !home-claim -->
        <div id="home-claim">
            <span><?php $NHP_Options->show('home-claim-line-1') ?></span><br /><span><?php $NHP_Options->show('home-claim-line-2') ?></span>
        </div>
        
        <!-- !content -->
        <div id="content">
            <section id="section-container"></section>
        </div>
        
        <!-- !footer -->
        <footer>
            <section id="footer-socials">
                <?php 
                $ico_url = $NHP_Options->get('general-socials-facebook'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-facebook" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?>
                <?php 
                $ico_url = $NHP_Options->get('general-socials-twitter'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-twitter" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?>
                <?php 
                $ico_url = $NHP_Options->get('general-socials-plus'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-plus" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?>
                <?php 
                $ico_url = $NHP_Options->get('general-socials-dribbble'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-dribbble" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?>
                <?php 
                $ico_url = $NHP_Options->get('general-socials-flickr'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-flickr" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?>
                <?php 
                $ico_url = $NHP_Options->get('general-socials-feed'); 
                if( !empty($ico_url) ): ?>
                <a id="footer-socials-rss" target="_blank" href="<?php echo $ico_url ?>"></a>
                <?php endif; ?> 
            </section>
            <div id="footer-text"><?php $footer_text = $NHP_Options->get('general-footer-text'); echo substr($footer_text,0, 100); ?></div>
        </footer>
        <div id="footer-bottom"></div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>