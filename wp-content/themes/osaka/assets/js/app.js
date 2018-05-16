/* !APP */

var app = {
    config : {
        homeImages          : [webroot + '/wp-content/themes/osaka/images/architecture.3.jpg', webroot + '/wp-content/themes/osaka/images/architecture.2.jpg', webroot + '/wp-content/themes/osaka/images/architecture.6.jpg', webroot + '/wp-content/themes/osaka/images/architecture.1.jpg'],
        bkgImagesDefault    : webroot + '/wp-content/themes/osaka/images/architecture.3.jpg',
        bkgImagesInterval   : 7500,
        bkgImagesDuration   : 300,
        musicPlayer         : true,
        musicPlayerAutoplay : false,
        musicPath           : 'music',
        pagesJsonUrl        : webroot + '?json=get_recent_posts&count=100&post_type=page&custom_fields=tf_page_position,tf_page_width,tf_background_image,tf_type,tf_subtitle,tf_page_image,tf_page_collection,tf_page_gallery,tf_page_video_type,tf_page_video_id',
        playlistJsonUrl     : webroot + '?json=get_recent_posts&count=100&post_type=musictracks&custom_fields=tf_mp3_file_path,tf_ogg_file_path',
        collectionJsonUrl   : webroot + '?json=get_recent_posts&count=1000&post_type=collections_items&custom_fields=tf_collection_item_type,tf_collection_item_page,tf_collection_item_title,tf_collection_item_quote,tf_collection_item_author,tf_collection_item_image,tf_collection_item_collection,tf_collection_item_url',
        blogJsonUrl         : webroot + '?json=get_recent_posts&custom_fields=tf_post_image&page=1',
        commentsJsonUrl     : null,
        commentsPostUrl     : null,
        galleryJsonUrl      : webroot + '?json=get_post&id=:id&post_type=galleries&custom_fields=tf_gallery_images',
        mailTo              : 'saintpumpkin@gmail.com'
    },
    views  : {},
    models : {},
    router : null,
    collections : {},
    vars   : {
        sizeBase : 7
    },
    utils  : {}
};

var appEvents = {};
_.extend(appEvents, Backbone.Events);

// encapsulate jquery

(function($)
{
    
//var $ = $.noConflict(true);

/* !add indexOf method to IE */

if($.browser.msie && parseInt($.browser.version) < 9)
{
    Array.prototype.indexOf = function(obj, start) {
         for (var i = (start || 0), j = this.length; i < j; i++) 
         {
             if (this[i] === obj) { return i; }
         }
         return -1;
    }
}

/* !app.UTILS */

app.utils.whichTransitionEvent = function()
{
    var t;
    var el = document.createElement('fakeelement');
    
    var transitions = {
        'transition'       : 'transitionEnd',
        'OTransition'      : 'oTransitionEnd',
        'MSTransition'     : 'msTransitionEnd',
        'MozTransition'    : 'transitionend',
        'WebkitTransition' : 'webkitTransitionEnd'
    };
    
    for(t in transitions)
    {
        if( el.style[t] !== undefined )
        {
            return transitions[t];
        }
    }
}

app.utils.thumbUrl = function(imageUrl)
{
    var thumbUrl = imageUrl.replace( /^(.+)?\.(.+)$/ , '$1-'+ app.config.thumbWidth + 'x'+ app.config.thumbHeight +'.$2' );
    return thumbUrl;
}

app.utils.fadeImage = function(elements, callbackEach, callbackComplete)
{
    elements.imgpreload({
            
        each : function()
        {
            $(this)
                .css({
                    opacity    : 0,
                    visibility : 'visible'
                })
                .transition({
                    opacity    : 1,
                    duration   : 300,
                    easing     : 'easeInOutQuart'
                }, function()
                {
                    if(typeof(callbackEach) === 'function')
                    {
                        callbackEach(this);
                    }
                });
        },
        
        all : function()
        {
            if(typeof(callbackComplete) === 'function')
            {
                callbackComplete(this);
            }
        }
    });
}

app.utils.scrollbar = function(el)
{
    if(!Modernizr.cssscrollbar || $.browser.msie)
    {
        el.jScrollPane({
            verticalGutter : 0,
            autoReinitialise : true,
            autoReinitialiseDelay : 150
        });
    }
}

/* !app.ROUTER */

app.router = Backbone.Router.extend({

    routes : {
        ''                            : 'home',
        ':id/post/:post_id/:post_url' : 'blogPost',
        ':id/:page_url'               : 'section'
    },
    
    initialize : function()
    {
        this.vars           = {};
        this.currentSection = null;
    },
    
    home : function()
    {
        var that = this;
        if(this.currentSection)
        {
            that.currentSection.close();
        }
        
        that.currentSection = null;
        that.trigger('sectionSwitch');
        
    },
    
    blogPost : function(pageId, postId, postUrl)
    {
        if(!this.vars.pageLoaded)
        {
            if(isFinite(pageId))
            {
                this.vars.id        = pageId;
                this.vars.postId    = postId;
            }
            
            if(app_pages.models.length == 0)
            {
                app_pages.on('reset', this.blogPost, this);
                //app_pages.fetch();
            }
            else
            {
                var that = this;
                var page = app_pages.get(this.vars.id);
                
                if(typeof(app.vars.posts) === 'undefined')
                {
                    app.vars.posts = {};
                }
                
                if(typeof(app.vars.posts[this.vars.postId]) === 'undefined')
                {
                    app.vars.posts[this.vars.postId] = new app.models.post({
                        id : this.vars.postId
                    });
                    
                    app.vars.posts[this.vars.postId].on('change', this.blogPost, this);
                    app.vars.posts[this.vars.postId].fetch();
                }
                else
                {
                    var post = app.vars.posts[this.vars.postId]
                    var page = app_pages.get(this.vars.id);
                    
                    var newPage = function()
                    {
                        that.currentSection = new app.views.sectionBlogPost({
                            model   : page,
                            post    : post
                        });
                        
                        that.vars.pageLoaded = true;
                        
                        that.currentSection
                            .on('close', function()
                            {
                                that.vars.pageLoaded    = false;
                                this.close();
                            })
                            .on('sectionClosed', function(){
                                that.currentSection     = null;
                                that.vars.pageLoaded    = false;
                                that.trigger('sectionClosed');
                            });
                        
                        that.trigger('sectionSwitch');
                    }
                    
                    if(this.currentSection)
                    {
                        this.currentSection.off('sectionClosed');
                        this.currentSection.on('sectionClosed', newPage, this);
                        this.currentSection.trigger('close');
                    }
                    else
                    {
                        newPage();
                    }
                }
            }
        }
    },
    
    section : function(pageId, pageUrl, postId, postUrl)
    {
        if(isFinite(pageId))
        {
            this.vars.id     = pageId;
            this.vars.postId = null;
        }
        
        if(app_pages.models.length == 0)
        {
            app_pages.on('reset', this.section, this);
        }
        else
        {
            var that              = this;
            var page              = app_pages.get(this.vars.id);
            var pageType          = 'page';
            
            if(typeof(page.get('custom_fields').tf_type) === 'object')
            {
                pageType = page.get('custom_fields').tf_type[0];
            }
            
            var sectionObjectName = 'section' + pageType.substr(0,1).toUpperCase() + pageType.substr(1).toLowerCase();
            
            if(app.views[sectionObjectName] && this.currentSection != page)
            {
                var newPage = function()
                {
                    that.currentSection = new app.views[sectionObjectName]({
                        model : page
                    });
                    
                    that.currentSection
                        .on('close', function()
                        {
                            this.close();
                        })
                        .on('sectionClosed', function(){
                            that.currentSection = null;
                            that.trigger('sectionClosed');
                        });
                    
                    that.trigger('sectionSwitch');
                }
                
                if(this.currentSection)
                {
                    this.currentSection.off('sectionClosed');
                    this.currentSection.on('sectionClosed', newPage, this);
                    this.currentSection.trigger('close');
                }
                else
                {
                    newPage();
                }
            }
        }
    }
    
});

/* !app.views.MAIN */

app.views.main = Backbone.View.extend({

    el : '#container',
    
    initialize : function()
    {
        
        var that = this;
        
        // elements
        
        this.els               = {};
        this.els.header        = this.$('header');
        this.els.footer        = this.$('footer');
        this.els.content       = this.$('#content');
        this.els.icoFullScreen = this.$("#ico-fullscreen");
        this.els.homeClaim     = this.$("#home-claim");
        
        // views
        
        this.views           = {};
        this.views.ico       = new app.views.ico();
        this.views.bkg       = new app.views.bkg();
        
        // player
        
        this.playerSetup();
                
        // vars
        
        this.vars = {};
        this.vars.stopFullScreen = false;
        
        // home claim
        
        var displayClaim = function()
        {
            var isVisible = (that.els.homeClaim.css('opacity') == 0)? false : true;
            if(app_router.currentSection)
            {
                if(isVisible)
                {
                    that.els.homeClaim.transition({
                        easing      : 'easeInOutQuint',
                        duration    : 500,
                        queue       : false,
                        opacity     : 0,
                        left        : -100
                    }, function()
                    {
                        $(this).css('display', 'none');
                    });
                }
            }
            else
            {
                that.els.homeClaim.css('display', 'block').transition({
                    easing      : 'easeInOutQuint',
                    duration    : 500,
                    queue       : false,
                    opacity     : 1,
                    left        : 35
                });
            }
        }
        
        app_router.on('sectionSwitch', function()
        {
            displayClaim();
        }, this);
        
        //displayClaim();
        
        // animate header & footer
        
        var headerTop    = parseInt(this.els.header.css('top'));
        var footerBottom = parseInt(this.els.footer.css('bottom'));
        
        this.els.header.css({
            top : (this.els.header.height() + headerTop) * -1
        });
        
        this.els.footer.css({
            bottom : (this.els.footer.height() + footerBottom) * -1
        });
        
        // vars
        
        this.fullscreen = false;
        
        // events
        
        this.els.icoFullScreen.bind('click', function()
        {
            that.toggleFullscreen();
        });
        
        $(window).bind('load', function()
        {
            setTimeout(function()
            {
                that.els.header.transition({
                    top      : headerTop,
                    duration : 450,
                    easing   : 'easeOutBack',
                    queue    : false
                }, function()
                {
                    // headerMenu
        
                    that.views.header = new app.views.headerMenu({
                        collection : app_pages
                    });
                });
                
                that.els.footer.transition({
                    bottom   : footerBottom,
                    duration : 450,
                    easing   : 'easeOutBack',
                    queue    : false
                });
                    
            }, 1000);
        });
    },
    
    playerSetup : function()
    {
        if(app.config.musicPlayer && Modernizr.audio)
        {
            // player view
            
            this.views.musicPlayer = new app.views.footerPlayer({
                mainView   : this,
                collection : new app.collections.playlist()
            });
        }
    },
    
    toggleFullscreen : function()
    {
        this.views.ico.trigger('toggleFullscreen');
        if(!this.vars.stopFullScreen)
        {
            this.vars.stopFullScreen = true;
            var that         = this;
            
            var headerTop    = (this.fullscreen)? 
                $("#header-top").height() + 1 :
                this.els.header.height() * -1 ;
                
            var footerBottom = (this.fullscreen)? 
                $("#footer-bottom").height() + 1 :
                this.els.footer.height() * -1 ;
                
            var opacity  = (that.fullscreen)? 1 : 0;
            var duration = (that.fullscreen)? 450 : 550;
            var easing   = (that.fullscreen)? 'easeOutBack' : 'easeInExpo';
                
            this.trigger('toggleFullscreenStart');
            if(app_router.currentSection)
            {
                app_router.currentSection.trigger('toggleFullscreenStart');
            }
            
            // content
            
            if(this.fullscreen)
            {
                var margin = app.vars.sizeBase * 16;
                this.els
                    .content
                    .transition({
                        duration : duration,
                        easing   : easing,
                        queue    : false,
                        top      : margin,
                        bottom   : margin
                    });
            }
            
            // header
            
            this.els.header.transition({
                top      : headerTop,
                opacity  : opacity,
                duration : duration,
                easing   : easing,
                queue    : false
            }, function()
                {
                    // content
                    
                    if(!that.fullscreen)
                    {
                        setTimeout(function()
                        {
                            var margin = app.vars.sizeBase * 5;
                            that.els
                                .content
                                .transition({
                                    duration : 400,
                                    easing   : 'easeOutQuart',
                                    queue    : false,
                                    top      : margin,
                                    bottom   : margin
                                }, function()
                                {
                                    that.fullscreen          = !that.fullscreen;
                                    that.vars.stopFullScreen = false;
                                    
                                    that.trigger('toggleFullscreenEnd');
                                    if(app_router.currentSection)
                                    {
                                        app_router.currentSection.trigger('toggleFullscreenEnd');
                                    }
                                });
                        }, 400);
                    }
                    else
                    {
                        that.fullscreen          = !that.fullscreen;
                        that.vars.stopFullScreen = false;
                        
                        that.trigger('toggleFullscreenEnd');
                        if(app_router.currentSection)
                        {
                            app_router.currentSection.trigger('toggleFullscreenEnd');
                        }
                    }
                });
            
            // footer
            
            this.els.footer.transition({
                bottom   : footerBottom,
                opacity  : opacity,
                duration : duration,
                easing   : easing,
                queue    : false
            });
        }
    }
   
});

/* !app.views.BKG */

app.views.bkg = Backbone.View.extend({
    
    initialize : function()
    {
        app_router.on('sectionSwitch', this.render, this);
        
        this.vars          = {};
        this.vars.interval = null;
    },
    
    render : function()
    {
        var that = this;
        
        var backgroundImageId, backgroundImageId;
        var isHome = true;
        
        if(app_router.currentSection)
        {
            backgroundImageId   = (app_router.currentSection.model.attributes.custom_fields.tf_background_image)? app_router.currentSection.model.attributes.custom_fields.tf_background_image[0] : null;
            isHome = false;
        }
        
        if( backgroundImageId > 0 )
        {
            _.each(app_router.currentSection.model.get('attachments'), function(image)
            {
                if(backgroundImageId == image.id)
                {
                    backgroundImage = image.url;
                }
            });
            
            if( typeof(backgroundImage) === 'undefined' )
            {
                backgroundImage = false;
            }
        }
        else
        {
            backgroundImage = false;
        }
        
        clearInterval(that.vars.interval);
        
        var renderImg = function(img)
        {
            if(typeof(img) !== 'undefined')
            {
                if(img.constructor === Array)
                {
                    if(img.length > 1)
                    {
                        var bkgIndex = 0;
                        $.backstretch(img[bkgIndex], {speed: app.config.homeImagesDuration});
                        that.vars.interval = setInterval(function()
                        {
                            bkgIndex = (bkgIndex + 1 ===  app.config.homeImages.length)? 0 : bkgIndex + 1;
                            $.backstretch(img[bkgIndex], {speed: app.config.bkgImagesDuration});
                        }, app.config.bkgImagesInterval);
                    }
                    else
                    {
                        renderImg(img[0]);
                    }
                }
                if(img.constructor === String)
                {
                    $.backstretch(img, {speed: app.config.bkgImagesDuration});
                }
            }
            else
            {
                renderImg(app.config.bkgImagesDefault);
            }
        }
        
        if(isHome)
        {
            renderImg(app.config.homeImages);
        }
        else
        {
            var img = (backgroundImage)? backgroundImage : app.config.bkgImagesDefault;
            renderImg(img);
        }
    }
    
});

/* !app.views.HEADERMENU */

app.views.headerMenu = Backbone.View.extend({

    el : 'header nav',
    
    initialize : function()
    {
        this.template = _.template($('#tmpl_header_menu').html());
        
        // events
        
        app_router
            .on('sectionSwitch', this.menuSel, this)
            .on('sectionClosed', this.menuSel, this);
        
        this.on('headerMenuRendered', this.menuSel, this);
        
        // collection
        
        this.collection.on('reset', this.render, this)
        this.collection.fetch();
    },
    
    menuSel : function()
    {
        var anchors = this.$el.find(".root > a");
        anchors.removeClass('selected');
        
        if(app_router.currentSection)
        {
            var page   = app_router.currentSection.model;
            var pageId = page.get('id');
            var pages  = [];
            
            // search children & brothers
            
            _.each(app_menu_pages, function(el, i)
            {
                if(el.object_id == pageId)
                {
                    if(el.sub.length)
                    {
                        pages = el.sub;
                        $('#nav-' + pageId).addClass('selected');
                    }
                }
                
                if(el.sub.length)
                {
                    _.each(el.sub, function(subEl, i)
                    {
                        if(subEl.object_id == pageId)
                        {
                            pages = el.sub;
                            $('#nav-' + el.object_id).addClass('selected');
                        }
                    });
                }
            });
            
            if(pages.length === 0)
            {
                $('#nav-' + pageId).addClass('selected');
            }
        }
        else
        {
            anchors.removeClass('selected');
        }
    },
    
    render : function()
    {
        
        var that        = this;
        var deelay      = 0;
        var template    = this.template({
            //pages      : this.collection.rootPages(), 
            menuPages  : app_menu_pages,
            pages      : {},
            collection : this.collection
        });
        
        // add options to select menu
        
        var select = $("#header-select");
        var name,type,url,option, subpages, optgroup;
        _.each(this.collection.rootPages(), function(page)
        {
            name     = page.get('title');
            type     = page.get('type');
            subpages = that.collection.subPages(page.get('id'));
            
            switch(type)
            {
                case 'home':
                    url = '#/';
                    break;
                    
                case 'empty':
                    url = 'javascript:void(0)';
                    break;
                
                default:
                    url = '#/' + page.get('id') + '/' + page.get('name');
                    break;
            }
            
            option = document.createElement('option');
            option.setAttribute('value', url);
            option.appendChild(document.createTextNode(name));
            
            select.append(option);
            
            if(subpages.length)
            {
                optgroup = document.createElement('optgroup');
                optgroup.setAttribute('label', name);
                
                _.each(subpages, function(page)
                {
                    name        = page.get('name');
                    type        = page.get('type');
                    
                    switch(type)
                    {
                        case 'home':
                            url = '#/';
                            break;
                            
                        case 'empty':
                            url = 'javascript:void(0)';
                            break;
                        
                        default:
                            url = '#/' + page.get('id') + '/' + page.get('name');
                            break;
                    }
                    
                    option      = document.createElement('option');
                    option.setAttribute('value', url);
                    option.appendChild(document.createTextNode(name));
                    
                    $(optgroup).append(option);
                });
                
                select.append(optgroup);
            }
        });
        
        select.on('change', function()
        {
            location.href = $(this).val();
        });
        
        // append & animate menu
        
        this.$el
            .empty()
            .append(template)
            .find('.root > a')
            .css({
                opacity : 0, 
                rotate3d : '0,1,0,-35deg',
                transformOrigin : 'left center'
            })
            .each(function(i, el)
            {
                setTimeout(function()
                {
                    $(el).transition({
                        opacity     : 1,
                        perspective : '100px',
                        rotate3d    : '0,1,0,0deg',
                        duration    : 1000,
                        easing      : 'easeOutExpo'
                    }, function()
                    {
                        $(this).css({
                            transformOrigin : '50% 50%'
                        });
                    });
                }, deelay);
                
                deelay += 400;
            });
        
        this.trigger('headerMenuRendered');
    }
    
});

/* !app.views.FOOTERPLAYER */

app.views.footerPlayer = Backbone.View.extend({
    
    initialize : function()
    {
        this.template   = _.template($('#tmp_footer_player').html());
        
        // vars
        
        var that        = this;
        this.vars       = {};
        this.vars.index = 0;
        
        this.render();
        this.collection.on('reset', this.updatePlayer, this);
        
        appEvents.on('pagesLoaded', function(){
            that.collection.fetch();
        });
        
    },
    
    updatePlayer : function()
    {
        if(this.loadAudioFile())
        {
            if(app.config.musicPlayerAutoplay)
            {
                this.play();
            }
        }
    },
    
    loadAudioFile : function(index)
    {
        index = (index === undefined)? this.vars.index : index;
        if(isFinite(index) && this.collection.models.length)
        {
            this.vars.index     = Math.abs(parseInt(index));
            
            var audioEl = this.$el.find("audio");
            var audio   = this.collection.models[index];
            
            var mp3     = audio.get('custom_fields').tf_mp3_file_path;
            var ogg     = audio.get('custom_fields').tf_ogg_file_path;
            
            mp3         = (typeof(mp3) === 'object')? mp3[0] : null;
            ogg         = (typeof(ogg) === 'object')? ogg[0] : null;
            
            var audioFormats = [];
            
            if(ogg)
                audioFormats.push('ogg');
            
            if(mp3)
                audioFormats.push('mp3');
                
            if(audioFormats.length)
            {
                var audioFormat, audioPath;
                if(Modernizr.audio.ogg && _.indexOf(audioFormats, 'ogg') >= 0)
                {
                    audioFormat = 'ogg';
                    audioPath   = ogg;
                }
                else
                {
                    if(Modernizr.audio.mp3 && _.indexOf(audioFormats, 'mp3') >= 0)
                    {
                        audioFormat = 'mp3';
                        audioPath   = mp3; 
                    }
                }
                
                if(audioFormat)
                {
                    audioEl.attr('src', audioPath);
                }
                
                return true;
            }
            else
            {
                this.collection.models = this.collection.models.filter(function(value, i)
                {
                    return !(index == i);
                });
                this.vars.index = 0;
                this.loadAudioFile();
            }
            
        }
        
        return false;
    },
    
    play : function()
    {
        var that  = this;
        var index = this.vars.index;
        
        if(that.collection.models[index])
        {
            this.$el.find("audio")[0].play();
            
            this.$el
                .find('div span')
                .transition({
                    duration : 200,
                    opacity  : 0,
                    queue    : false,
                    easing   : 'easeOutExpo'
                }, function()
                {
                    $(this)
                        .css({
                        })
                        .text(that.collection.models[index].get('title'))
                        .transition({
                            duration   : 500,
                            opacity    : 1,
                            queue      : false,
                            easing     : 'easeOutExpo'
                        });
                });
        }
    },
    
    pause : function()
    {
        this.$el.find("audio")[0].pause();
        
        this.$el
            .find('div span')
            .transition({
                duration : 200,
                opacity  : .5,
                queue    : false,
                easing   : 'easeOutExpo'
            });
    },
    
    rewind : function()
    {
        this.vars.index--;
        if(this.vars.index < 0)
        {
            this.vars.index = this.collection.models.length - 1;
        }
        this.loadAudioFile();
        this.play();
    },
    
    forward : function()
    {
        this.vars.index++;
        if(this.vars.index == this.collection.models.length)
        {
            this.vars.index = 0;
        }
        this.loadAudioFile();
        this.play();
    },
    
    render : function()
    {
        var templateHtml = this.template({});
        var mainView     = this.options.mainView;
        var that         = this;
        
        if(mainView.els.footer.find('#footer-player'))
        {
            mainView.els.footer.remove('#footer-player')
        }
        
        mainView.els.footer.prepend(templateHtml);
        
        // el
        
        var footerPlayer = mainView.els.footer.find("#footer-player");
        this.el  = footerPlayer[0];
        this.$el = footerPlayer;
        
        // events
        
        this.$el.find("audio").bind('ended', function()
        {
            that.forward();
        })
        
        this.$el.find('#footer-player-play').bind('click', function()
        {
            that.play();
        });
        
        this.$el.find('#footer-player-pause').bind('click', function()
        {
            that.pause();
        });
        
        this.$el.find('#footer-player-rewind').bind('click', function()
        {
            that.rewind();
        });
        
        this.$el.find('#footer-player-forward').bind('click', function()
        {
            that.forward();
        });
        
    }
});

/* !app.views.ICO */

app.views.ico = Backbone.View.extend({
   
    el : '#ico-fullscreen',
    
    initialize : function()
    {
        this.$el.bind('mouseover', this.over);
        this.$el.bind('mouseout' , this.out );
        this.$el.bind('mousedown', this.down);
        
        this.on('toggleFullscreen', function()
        {
            var right = (app_mainView.fullscreen)? 35 : 21;
            var top   = (app_mainView.fullscreen)? 28 : 21;
            
            this.$el.transition({
                right       : right,
                top         : top,
                duration    : 400,
                queue       : false,
                easing      : 'easeOutExpo'
            })
            
        }, this);
    },
    
    over : function()
    {
        $(this).transition({
            opacity  : .8,
            rotate   : '90deg',
            duration : 400,
            queue    : false,
            easing   : 'easeOutExpo'
        });
    },
    
    out : function()
    {
        $(this).transition({
            opacity  : 1,
            scale    : 1,
            rotate   : '0deg',
            duration : 400,
            queue    : false,
            easing   : 'easeOutExpo'
        });
    },
    
    down : function()
    {
        $(this).transition({
            opacity  : .6,
            scale    : ($.browser.mozilla)? 1 : .9,
            rotate   : '180deg',
            duration : 400,
            queue    : false,
            easing   : 'easeOutExpo'
        }, function()
        {
            $(this).trigger('mouseout');
        });
    }
    
});

/* !app.views.SECTIONPAGE */

app.views.sectionPage = Backbone.View.extend({
    
    el : '#section-container',
    
    initialize : function()
    {
        this.render();
        return this;
    },
    
    events : {
        'click #section-close' : function()
        {
            this.close();
            this.on('sectionClosed', function(){
                app_router.navigate('#/');
            });
        }
    },
    
    close : function()
    {
        var that = this;
        this.$('#section-page')
            .transition({
                duration        : 750,
                easing          : 'easeOutExpo',
                queue           : false,
                perspective     : 300,
                rotate3d        : '0,1,0,-1deg',
                opacity         : 0
            }, function()
            {
                $(this).remove();
                that.trigger('sectionClosed');
                
                // unbind events
                that.off();
                that.model.off(null, null, this);
            });
            
        this.$('#menu-page')
            .transition({
                duration  : 750,
                easing    : 'easeOutExpo',
                queue     : false,
                opacity   : 0
            }, function()
            {
                $(this).remove();
            });
    },
    
    render : function()
    {
        var template        = _.template($('#tmp_section_page').html());
        var that            = this;
        var customFields    = this.model.get('custom_fields');
        var subtitle        = (customFields.tf_subtitle)?      customFields.tf_subtitle[0]      : null;
        var position        = (customFields.tf_page_position)? customFields.tf_page_position[0] : 'left';
        var width           = (customFields.tf_page_width)?    customFields.tf_page_width[0]    : '40';
        var imageId         = (customFields.tf_page_image)?    customFields.tf_page_image       : null;
        var image           = null;
        var _menuPages      = [];
        var menuPages       = [];
        var pageId          = this.model.get('id');
        
        if(isFinite(imageId))
        {
            imageId = parseInt(imageId);
            _.each(this.model.get('attachments'), function(_image)
            {
                if(imageId === _image.id)
                {
                    image = _image.url;
                }
            });
        }
        
        // find pages menu
        
        _.each(app_menu_pages, function(el, i)
        {
            if(pageId == el.object_id)
            {
                _menuPages = el.sub;
            }
            else
            {
                if(el.sub.length > 0)
                {
                    _.each(el.sub, function(_el, i)
                    {
                        if(pageId == _el.object_id)
                        {
                            _menuPages = el.sub;
                        }
                    });
                }
            }
        });
        
        
        var menuPage;
        
        _.each(_menuPages, function(el, i)
        {
            menuPage = {name : el.title};
            switch(el.object)
            {
                case 'page':
                    menuPage.url = '#/' + el.object_id + '/' + el.slug;
                    break;
                    
                default:
                    menuPage.url = el.url;
                    break;
            }
            menuPages.push(menuPage);
        });
        
        this.$el.html(template({
            title    : this.model.get('title'),
            subtitle : subtitle,
            image    : image,
            content  : this.model.get('content'),
            subPages : menuPages,
            width    : width,
            position : position
        }));
        
        var menu = this.$('#menu-page');
        menu.find('a').css({
            opacity         : 0,
            transformOrigin : (position == 'right')? 'right center' : 'left center',
            perspective     : 200,
            rotate3d        : (position == 'right')? '0,1,0,15deg' : '0,1,0,-15deg'
        });
        
        app.utils.fadeImage(this.$el.find('img'));
        app.utils.scrollbar(this.$el.find('#section-page'));
        
        this.$('#section-page')
            .css({
                opacity         : 0,
                transformOrigin : (position == 'right')? 'right center' : 'left center',
                perspective     : 300,
                rotate3d        : (position == 'right')? '0,1,0,1deg' : '0,1,0,-1deg'
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                rotate3d        : '0,0,0,0deg',
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
                if(menu.length)
                {
                    var deelay = 0;
                    menu.find('a').each(function(i,el)
                    {
                        deelay += 350;
                        setTimeout(function()
                        {
                            $(el).transition({
                                opacity  : 1,
                                duration : 350,
                                rotate3d : '0,0,0,0deg'
                            })
                        }, 
                        deelay);
                    });
                }
            });
    }
    
});

/* !app.views.SECTIONCONTACT */

app.views.sectionContact = Backbone.View.extend({
    
    el : '#section-container',
    
    initialize : function()
    {
        this.render();
        return this;
    },
    
    events : {
        'click #section-close' : function()
        {
            this.close();
            this.on('sectionClosed', function(){
                app_router.navigate('#/');
            });
        }
    },
    
    close : function()
    {
        var that = this;
        this.$('#section-page')
            .transition({
                duration        : 750,
                easing          : 'easeOutExpo',
                queue           : false,
                perspective     : 300,
                rotate3d        : '0,1,0,-1deg',
                opacity         : 0
            }, function()
            {
                $(this).remove();
                that.trigger('sectionClosed');
                
                // unbind events
                that.off();
                that.model.off(null, null, this);
            });
            
        this.$('#menu-page')
            .transition({
                duration  : 750,
                easing    : 'easeOutExpo',
                queue     : false,
                opacity   : 0
            }, function()
            {
                $(this).remove();
            });
    },
    
    render : function()
    {
        var template = _.template($('#tmp_section_contact').html());
        var that     = this;
        
        var customFields    = this.model.get('custom_fields');
        var subtitle        = (customFields.tf_subtitle)?      customFields.tf_subtitle[0]      : null;
        var position        = (customFields.tf_page_position)? customFields.tf_page_position[0] : 'left';
        var width           = (customFields.tf_page_width)?    customFields.tf_page_width[0]    : '40';
        var imageId         = (customFields.tf_page_image)?    customFields.tf_page_image       : null;
        var image           = null;
        var _menuPages      = [];
        var menuPages       = [];
        var pageId          = this.model.get('id');
        
        if(isFinite(imageId))
        {
            imageId = parseInt(imageId);
            _.each(this.model.get('attachments'), function(_image)
            {
                if(imageId === _image.id)
                {
                    image = _image.url;
                }
            });
        }
        
        // find pages menu
        
        _.each(app_menu_pages, function(el, i)
        {
            if(pageId == el.object_id)
            {
                _menuPages = el.sub;
            }
            else
            {
                if(el.sub.length > 0)
                {
                    _.each(el.sub, function(_el, i)
                    {
                        if(pageId == _el.object_id)
                        {
                            _menuPages = el.sub;
                        }
                    });
                }
            }
        });
        
        
        var menuPage;
        
        _.each(_menuPages, function(el, i)
        {
            menuPage = {name : el.title};
            switch(el.object)
            {
                case 'page':
                    menuPage.url = '#/' + el.object_id + '/' + el.slug;
                    break;
                    
                default:
                    menuPage.url = el.url;
                    break;
            }
            menuPages.push(menuPage);
        });
        
        
        this.$el.html(template({
            title       : this.model.get('title'),
            subtitle    : subtitle,
            image       : image,
            content     : this.model.get('content'),
            subPages    : menuPages,
            width       : width,
            position    : position,
            fomrUrl     : this.model.get('form_url'),
            message_ok  : (that.model.get('mail_sended'))? that.model.get('mail_sended') : "Mail sent",
            message_ko  : (that.model.get('mail_not_sended'))? that.model.get('mail_not_sended') : "An error occurred during email sending, please try again later"
        }));
        
        var menu = this.$('#menu-page');
        menu.find('a').css({
            opacity         : 0,
            transformOrigin : (position == 'right')? 'right center' : 'left center',
            perspective     : 200,
            rotate3d        : (position == 'right')? '0,1,0,15deg' : '0,1,0,-15deg'
        });
        
        app.utils.fadeImage(this.$el.find('img'));
        app.utils.scrollbar(this.$el.find('#section-page'));
        
        // fields validation
        
        this.$el.find("form.form:eq(0)").on('submit', function(e)
        {
            var values      = {};
            var errors      = [];
            
            values.name     = $(this).find('input[name="contact[name]"]').val();
            values.email    = $(this).find('input[name="contact[email]"]').val();
            values.subject  = $(this).find('input[name="contact[subject]"]').val();
            values.message  = $(this).find('textarea[name="contact[message]"]').val();
            
            for(var field in values)
            {
                switch(field)
                {
                    case 'name':
                        if(values.name == '')
                        {
                            errors.push((that.model.get('error_name'))? that.model.get('error_name') : 'Name is required.');
                        }
                        break;
                        
                    case 'email':
                        if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(values.email))
                        {
                            errors.push((that.model.get('error_email'))? that.model.get('error_email') : 'Email is incorrect.');
                        }
                        break;
                        
                    case 'subject':
                        if(values.subject == '')
                        {
                            errors.push((that.model.get('error_subject'))? that.model.get('error_subject') : 'Subject is required.');
                        }
                        break;
                        
                    case 'message':
                        if(values.message == '')
                        {
                            errors.push((that.model.get('error_message'))? that.model.get('error_message') : 'Message is required.');
                        }
                        break;
                }
            }
            
            e.preventDefault();
            
            if(errors.length)
            {
                
                _.each(errors, function(error)
                {
                    alert(error);
                });
            }
            else
            {
                var url     = themedir + '/mailsend.php';
                values.to   = app.config.mailTo;
                
                $.ajax({
                    url         : url,
                    data        : values,
                    type        : 'POST',
                    dataType    : 'json',
                    success     : function(response)
                    {
                        that.$el
                            .find("form.form:eq(0)")
                            .transition({
                                opacity     : 0,
                                duration    : 500,
                                easing      : 'easeOutExpo',
                                queue       : false
                            }, function()
                            {
                                $(this).css('display', 'none');
                                var selector = (response.sended)? '.form-ok' : '.form-ko';
                                that.$el
                                    .find(selector)
                                    .css({ display : 'block', opacity : 0 })
                                    .transition({
                                        opacity     : 1,
                                        duration    : 500,
                                        easing      : 'easeOutExpo',
                                        queue       : false
                                    });
                            });
                    }
                });
            }
        })
        
        this.$('#section-page')
            .css({
                opacity         : 0,
                transformOrigin : (position == 'right')? 'right center' : 'left center',
                perspective     : 300,
                rotate3d        : (position == 'right')? '0,1,0,1deg' : '0,1,0,-1deg'
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                rotate3d        : '0,0,0,0deg',
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
                if(menu.length)
                {
                    var deelay = 0;
                    menu.find('a').each(function(i,el)
                    {
                        deelay += 350;
                        setTimeout(function()
                        {
                            $(el).transition({
                                opacity  : 1,
                                duration : 350,
                                rotate3d : '0,0,0,0deg'
                            })
                        }, 
                        deelay);
                    });
                }
            });
    }
    
});

/* !app.views.SECTIONVIDEO */

app.views.sectionVideo = Backbone.View.extend({
    
    el : '#section-container',
    
    initialize : function()
    {
        this.render();
        
        // events
        
        this
            .on('toggleFullscreenStart', this.fullScreenStart, this)
            .on('toggleFullscreenEnd', this.fullScreenEnd, this);
        
        return this;
    },
    
    fullScreenStart : function()
    {
        var that = this;
        if(app_mainView.fullscreen)
        {
            this.$('#section-videofull-wrapper').find('iframe').remove();
            this.$('#section-videofull-wrapper')
                .transition({
                    duration        : 750,
                    easing          : 'easeOutExpo',
                    queue           : false,
                    scale           : .9,
                    opacity         : 0
                }, function()
                {
                    $(this).remove();
                    that.render();
                });
        }
    },
    
    fullScreenEnd : function()
    {
        var that = this;
        if(app_mainView.fullscreen)
        {
            this.$('#section-video-wrapper')
                .transition({
                    duration        : 750,
                    easing          : 'easeOutExpo',
                    queue           : false,
                    scale           : 1.1,
                    opacity         : 0
                }, function()
                {
                    $(this).remove();
                    that.renderFullScreen();
                });
        }
    },
    
    events : {
        'click #section-close' : function()
        {
            this.close();
            this.on('sectionClosed', function(){
                app_router.navigate('#/');
            });
        }
    },
    
    close : function()
    {
        var that = this;
        this.$('#section-video-wrapper')
            .transition({
                duration        : 750,
                easing          : 'easeOutExpo',
                queue           : false,
                scale           : 1.1,
                opacity         : 0
            }, function()
            {
                $(this).remove();
                that.trigger('sectionClosed');
                
                // unbind events
                that.off();
                that.model.off(null, null, this);
            });
        
    },
    
    render : function()
    {
        var template        = _.template($('#tmp_section_video').html());
        var that            = this;
        var customFields    = this.model.get('custom_fields');
        
        var subtitle        = '';
        if( typeof( customFields.tf_subtitle ) === 'object' )
        {
            subtitle        = customFields.tf_subtitle[0];
        }
        
        var videoType       = null;
        if( typeof( customFields.tf_page_video_type ) === 'object' )
        {
            videoType       = customFields.tf_page_video_type[0];
        }
        
        var videoId         = null;
        if( typeof( customFields.tf_page_video_id ) === 'object' )
        {
            videoId         = customFields.tf_page_video_id[0];
        }
        
        this.$el.html(template({
            title         : this.model.get('title'),
            subtitle      : subtitle,
            video_type    : videoType,
            video_id      : videoId,
            youtube_theme : 'dark'
        }));
        
        this.$('#section-video-wrapper')
            .css({
                opacity         : 0,
                transformOrigin : 'center center',
                scale           : 1.25
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                scale           : 1,
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
            });
    },
    
    renderFullScreen : function()
    {
        var template        = _.template($('#tmp_section_video_fullscreen').html());
        var that            = this;
        var customFields    = this.model.get('custom_fields');
        
        var subtitle        = '';
        if( typeof( customFields.tf_subtitle ) === 'object' )
        {
            subtitle        = customFields.tf_subtitle[0];
        }
        
        var videoType       = null;
        if( typeof( customFields.tf_page_video_type ) === 'object' )
        {
            videoType       = customFields.tf_page_video_type[0];
        }
        
        var videoId         = null;
        if( typeof( customFields.tf_page_video_id ) === 'object' )
        {
            videoId         = customFields.tf_page_video_id[0];
        }
        
        this.$el.html(template({
            title         : this.model.get('title'),
            subtitle      : subtitle,
            video_type    : videoType,
            video_id      : videoId,
            youtube_theme : 'dark'
        }));
        
        this.$('#section-videofull-wrapper')
            .css({
                opacity         : 0,
                transformOrigin : 'center center',
                scale           : .9
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                scale           : 1,
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
            });
    }
    
});

/* !app.views.SECTIONCOLLECTION */

app.views.sectionCollection = Backbone.View.extend({
    
    el : '#section-container',
    
    initialize : function()
    {
        
        this.vars = {};
        
        // collection
        
        if(!app.vars.collectionsItems)
        {
            app.vars.collectionsItems = new app.collections.collection();
            app.vars.collectionsItems.on('reset', function()
            {
                this.render();
            }, this);
            app.vars.collectionsItems.fetch();
        }
        else
        {
            this.render();
        }
    },
    
    close : function()
    {
        var that     = this;
        var interval = 0;
        var deelay   = 100;
        
        _.each(that.vars.boxesRandom, function(el, i)
        {
            setTimeout(function()
            {
                $(el).transition({
                    opacity  : 0,
                    scale    : 1.25,
                    duration : 250,
                    easing   : 'easeInOutQuart',
                    queue    : false
                }, function()
                {
                    if(i === that.vars.boxesRandom.length - 1)
                    {
                        that.$el.empty();
                        that.trigger('sectionClosed');
                        
                        // unbind events
                        that.off();
                        that.model.off(null, null, this);
                    }
                });
            }, interval);
            
            interval += deelay;
        });
    },
    
    render : function()
    {
        var template     = _.template($('#tmp_section_collection').html());
        
        // filter items
        
        var collectionId    = null;
        var collectionItems = [];
        var collectionItemCat;
        
        if( typeof(this.model.get('custom_fields').tf_page_collection) === 'object' )
        {
            collectionId = this.model.get('custom_fields').tf_page_collection[0];
        };
        
        app.vars.collectionsItems.each(function(collectionItem)
        {
            collectionItemCat = collectionItem.get('custom_fields');
            
            if(typeof(collectionItemCat.tf_collection_item_collection) === 'object')
            {
                if(collectionItemCat.tf_collection_item_collection.length)
                {
                    _.each(collectionItemCat.tf_collection_item_collection, function(itemCat)
                    {
                        if(itemCat == collectionId)
                        {
                            collectionItems.push(collectionItem);
                        }
                    })
                }
            }
        });
        
        this.$el.html(template({
            collection : collectionItems
        }));
        
        var that              = this;
        var boxes             = this.$el.find('.collection-box');
        var sectionCollection = this.$el.find('#section-collection');
        var boxesRandom       = [];
        var randomIndexes     = [];
        var randomNumber;
        var interval          = 0;
        var deelay            = 150;
        
        while( randomIndexes.length < boxes.length )
        {
            randomNumber = Math.floor(Math.random() * boxes.length);
            if(randomIndexes.indexOf(randomNumber) === -1)
            {
                randomIndexes.push(randomNumber);
                boxesRandom.push(boxes[randomNumber]);
            }
        };
        
        this.vars.boxesRandom = boxesRandom;
        app.utils.scrollbar(this.$el.find('#section-collection-container'));
        
        boxes.css({opacity : 0, scale : 1.2});
        app.utils.fadeImage(this.$el.find('img'), function()
        {
            sectionCollection.isotope('reLayout');
        });
        
        _.each(boxesRandom, function(el, i)
        {
            setTimeout(function()
            {
                $(el).transition({
                    scale    : 1,
                    opacity  : 1,
                    duration : 550,
                    easing   : 'easeInOutQuart',
                    queue    : false
                }, function()
                {
                    $(this).addClass('collection-box-transition');
                });
            }, interval);
            interval += deelay;
        });
        
        // isotope
        
        sectionCollection.isotope({
            itemSelector : '.collection-box',
            layoutMode   : 'masonry'
        });
        
    }
    
});

/* !app.views.SECTIONGALLERY */

app.views.sectionGallery = Backbone.View.extend({

    el : '#section-container',
    
    initialize : function()
    {
        this.template       = _.template($('#tmp_section_gallery').html());
        this.vars           = {};
        
        var customFields    = this.model.get('custom_fields');
        var galleryId       = null;
        
        if( typeof(customFields.tf_page_gallery) === 'object' )
        {
            galleryId       = parseInt(customFields.tf_page_gallery[0]);
        }
        
        this.vars.galleryId = galleryId;
        
        if(isFinite(galleryId))
        {
            if(!app.vars.galleries)
            {
                app.vars.galleries = {};
            }
            
            if(!app.vars.galleries[galleryId])
            {
                app.vars.galleries[galleryId] = new app.collections.gallery(null, {
                    id : galleryId
                });
                
                app.vars.galleries[galleryId].on('reset', function()
                {
                    this.render();
                }, this);
                
                app.vars.galleries[galleryId].fetch();
            }
            else
            {
                this.render();
            }
        }
        
        app_mainView.on('toggleFullscreenStart', function()
        {
            var opacity = (app_mainView.fullscreen)? 1 : 0;
            var icons   = $("#ico-right, #ico-left");
            
            icons
                .css({
                    display : 'block'
                })
                .transition({
                    opacity   : opacity,
                    easing    : 'easeInOutQuart',
                    duration  : 750
                }, function()
                {
                    if(opacity == 0)
                    {
                        $(this).css('display', 'none');
                    }
                });
            
        }, this);
        
    }, 
    
    close : function()
    {
        var that = this;
        this.$el
            .find("#section-gallery-image")
            .transition({
                "opacity"   : 0,
                "scale"     : .95,
                "easing"    : 'easeInOutQuart',
                "duration"  : 350
            }, function()
            {
                setTimeout(function()
                {
                    that.$el.find("#section-gallery-thumbs").transition({
                        "opacity"   : 0,
                        "scale"     : .9,
                        "easing"    : 'easeInOutQuart',
                        "duration"  : 350
                    }, function()
                    {
                        that.$el.empty();
                        that.trigger('sectionClosed');
                        
                        // unbind events
                        that.off();
                    });
                }, 300);
            });
            
        $("#ico-right, #ico-left")
            .transition({
                opacity   : 0,
                easing    : 'easeInOutQuart',
                duration  : 750
            }, function()
            {
                $(this).css({ display : 'none' })
            });
            
        $("#ico-right, #ico-left").off('.gallery');
    },
    
    switchImage : function(imageId)
    {
        var that            = this;
        var galleryId       = this.vars.galleryId;
        var gallery         = app.vars.galleries[galleryId].get(galleryId);
        var thumb           = this.$el.find("#section-gallery-thumbs-bar img[data-id="+ imageId +"]");
        var imageUrl        = this.vars.images[imageId];
        
        this.$el.find("#section-gallery-thumbs-bar img").removeClass('section-gallery-thumbs-sel');
        thumb.addClass('section-gallery-thumbs-sel');
        
        // move bar
        
        var thumbsContainerWidth = this.$el.find("#section-gallery-thumbs").width();
        var thumbLeft            = thumb.position().left;
        var thumbPosition        = thumbLeft + parseInt(thumb.css('margin-left')) + thumb.width();
        var bar                  = this.$el.find('#section-gallery-thumbs-bar');
        
        if( (parseInt(bar.css('left')) + thumbLeft) < 0 )
        {
            var barLeft = parseInt(bar.css('left')) + (parseInt(bar.css('left')) + thumbLeft) * -1;
            bar.transition({
                left        : barLeft,
                easing      : 'easeInOutQuart',
                duration    : 500
            });
        }
        
        if(thumbPosition > thumbsContainerWidth)
        {
            var difference = thumbPosition - thumbsContainerWidth;
            
            bar.transition({
                left        : difference * -1 -7,
                easing      : 'easeInOutQuart',
                duration    : 500
            });
        }
        
        this.$el
            .find("#section-gallery-image-content img")
            .transition({
                opacity  : 0,
                duration : 250,
                easing   : 'easeInOutQuart'
            }, function()
            {
                var parent = $(this).parent();
                $(this).remove();
                var imageHtml = _.template($("#tmp_section_gallery_image").html())({ imageUrl : imageUrl });
                parent.append(imageHtml);
                
                var newImage = that.$el.find("#section-gallery-image-content img");
                newImage.css('opacity', 0);
                    
                app.utils.fadeImage(newImage, null, function()
                {
                    that.vars.stop = false;
                });
            });
    },
    
    render : function()
    {
        var that           = this;
        var galleryId      = this.vars.galleryId;
        var gallery        = app.vars.galleries[galleryId].get(galleryId);
        var firstImageUrl;
        
        this.$el.html(this.template());
        
        var thumbs         = this.$el.find("#section-gallery-thumbs-bar"   );
        var imageContainer = this.$el.find("#section-gallery-image-content");
        
        // next prev arrows
        
        var icons = $("#ico-right, #ico-left");
        icons.css({ display : 'block', opacity : 0 })
            .transition({
                opacity   : 1,
                easing    : 'easeInOutQuart',
                duration  : 750
            });
        
        icons.on('click.gallery', function()
        {
            if(!that.vars.stop)
            {
                var direction  = $(this).attr('id').replace(/ico\-/, '');
                var nextThumb;
                if(direction == 'left')
                {
                    nextThumb = that.$el.find("#section-gallery-thumbs-bar img[data-id="+ that.vars.imageId +"]").prev();
                }
                else
                {
                    nextThumb = that.$el.find("#section-gallery-thumbs-bar img[data-id="+ that.vars.imageId +"]").next();
                }
                
                if(nextThumb.length)
                {
                    that.vars.stop    = true;
                    var nextId        = nextThumb.attr('data-id')            
                    that.vars.imageId = nextId;
                    that.switchImage(nextId);
                }
            }
        });
        
        // set thumbs
        
        var thumb;
        var images = [];
        
        if( typeof(gallery.get('custom_fields').tf_gallery_images) === 'object' )
        {
            _.each(gallery.get('custom_fields').tf_gallery_images, function(_image, i)
            {
                _.each(gallery.get('attachments'), function(attachment)
                {
                    if(attachment.id == _image)
                    {
                        images.push( attachment.url );
                        if(i === 0)
                        {
                            firstImageUrl = attachment.url;
                        }
                    }
                    
                })
            })
        }
        
        this.vars.images = images;
        
        _.each(images, function(img, index)
        {
            var thumbUrl = app.utils.thumbUrl(img);
            thumb = _.template($("#tmp_section_gallery_thumb").html())({ image : { thumb : thumbUrl, id : index }});
            thumbs.append(thumb);
        });
        
        app.utils.fadeImage(this.$el.find('#section-gallery-thumbs img'), function(el)
        {
            $(el).on('click', function()
            {
                var imageId = $(this).attr('data-id');
                if(imageId !== that.vars.imageId)
                {
                    that.vars.imageId = imageId;
                    that.switchImage(imageId);
                }
            });
        }, function()
        {
            var totalWidth = 0;
            var thumbBar   = that.$el.find('#section-gallery-thumbs-bar');
            
            thumbBar.find('img').each(function(i, el)
            {
                totalWidth += $(el).width() + parseInt($(el).css('margin-left'));
            });
            
            thumbBar.width(totalWidth);
        });
        
        this.$el
            .find("#section-gallery-thumbs")
            .css({ "opacity" : 0, "scale" : 1.1 });
            
        this.$el
            .find("#section-gallery-image")
            .css({ "opacity" : 0, "scale" : 1.1 });
        
        this.$el
            .find("#section-gallery-thumbs")
            .transition({
                "opacity"   : 1,
                "scale"     : 1,
                "easing"    : 'easeInOutQuart',
                "duration"  : 350
            }, function()
            {
                setTimeout(function()
                {
                    that.$el.find("#section-gallery-image").transition({
                        "opacity"   : 1,
                        "scale"     : 1,
                        "easing"    : 'easeInOutQuart',
                        "duration"  : 350
                    });
                }, 300);
            });
            
        // set first image
        
        if(app.vars.galleries[galleryId].length)
        {
            
            thumbs.find('img:eq(0)').addClass('section-gallery-thumbs-sel');
            
            var image         = _.template($("#tmp_section_gallery_image").html())({ imageUrl : firstImageUrl });
            that.vars.imageId = 0;
            imageContainer.empty().append(image);
            app.utils.fadeImage(this.$('#section-gallery-image img'));
        }
    }
    
})

/* !app.views.SECTIONBLOG */

app.views.sectionBlog = Backbone.View.extend({
    
    el : '#section-container',
    
    events : {
        'click #section-close' : function()
        {
            this.close();
            this.on('sectionClosed', function(){
                app_router.navigate('#/');
            });
        }
    },
    
    initialize : function()
    {
        // collection
        
        if(!app.vars.blog)
        {
            app.vars.blog = new app.collections.blog();
            app.vars.blog.on('reset', function()
            {
                this.render();
            }, this);
            
            app.vars.blog.fetch();
        }
        else
        {
            this.render();
        }
    },
    
    close : function(callback)
    {
        var that = this;
        this.$('#section-page')
            .transition({
                duration        : 750,
                easing          : 'easeOutExpo',
                queue           : false,
                perspective     : 300,
                rotate3d        : '0,1,0,-1deg',
                opacity         : 0
            }, function()
            {
                $(this).remove();
                that.trigger('sectionClosed');
                
                // unbind events
                that.off();
                that.model.off(null, null, this);
            });
            
        this.$('#menu-page')
            .transition({
                duration  : 750,
                easing    : 'easeOutExpo',
                queue     : false,
                opacity   : 0
            }, function()
            {
                $(this).remove();
                if( typeof callback === 'function' )
                {
                    callback();
                }
            });
    },
    
    render : function()
    {
        var template        = _.template($('#tmp_section_blog').html());
        var that            = this;
        var position        = (this.model.get('position') === undefined)? 'left' : that.model.get('position');
        var blog            = app.vars.blog;
        var customFields    = this.model.get('custom_fields');
        
        var subtitle        = (customFields.tf_subtitle)?      customFields.tf_subtitle[0]      : null;
        var position        = (customFields.tf_page_position)? customFields.tf_page_position[0] : 'left';
        var width           = (customFields.tf_page_width)?    customFields.tf_page_width[0]    : '40';
        var pages           = blog.pages;
        
        this.$el.html(template({
            subPages    : null,
            title       : this.model.get('title'),
            subtitle    : subtitle,
            posts       : blog.models,
            page        : this.model,
            width       : width,
            position    : position,
            pages       : blog.pages,
            currentPage : (app.vars.blog.currentPage)? app.vars.blog.currentPage : 1
        }));
        
        var posts    = this.$el.find('.post-list');
        
        app.utils.scrollbar(this.$el.find('#section-page'));
        
        // pagination
        
        this.$el
            .find('#pagination a')
            .on('click', function()
            {
                var page = $(this).attr('data-page');
                app.config.blogJsonUrl      = app.config.blogJsonUrl.replace(/page=([0-9]+)?$/, 'page=' + page);
                
                app.vars.blog.off();
                app.vars.blog               = new app.collections.blog();
                app.vars.blog.on('reset', function()
                {
                    var that = this;
                    this.close(function()
                    {
                        that.render();
                    });
                }, that);
                app.vars.blog.currentPage   = page;
                app.vars.blog.fetch();
            });
            
        
        // posts
        
        posts.css({
            opacity : 0
        });
        
        app.utils.fadeImage(this.$('#section-page img'));
        
        this.$('#section-page')
            .css({
                opacity         : 0,
                transformOrigin : (position == 'right')? 'right center' : 'left center',
                perspective     : 300,
                rotate3d        : (position == 'right')? '0,1,0,1deg' : '0,1,0,-1deg'
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                rotate3d        : '0,0,0,0deg',
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
                app.utils.fadeImage($('.post-list img'));
                
                var deelay   = 350;
                var interval = 350;
                
                posts.each(function(i, el)
                {
                    setTimeout(function()
                    {
                        $(el)
                            .css({
                                scale : .95
                            })
                            .transition({
                                opacity    : 1,
                                scale      : 1,
                                easing     : 'easeOutExpo',
                                duration   : 500
                            });
                    }, interval);
                    interval += deelay;
                });
            });
        
    }
    
});

/* !app.views.SECTIONBLOGPOST */

app.views.sectionBlogPost = Backbone.View.extend({
    
    el : '#section-container',
    
    initialize : function()
    {
        var postId  = this.options.post.get('id');
        var pageId  = this.model.get('id');
        
        this.vars = {};
        
        if(isFinite(postId) && isFinite(pageId))
        {
            var page            = app_pages.get(pageId);
            var customFields    = page.get('custom_fields');
            
            this.vars.position  = (customFields.tf_page_position)? customFields.tf_page_position[0] : 'left';
            this.vars.width     = (customFields.tf_page_width)?    customFields.tf_page_width[0]    : '40';
            
            if(!app.vars.comments)
            {
                app.vars.comments = {};
            }
            
            this.render();
            
            if(!app.vars.comments[postId])
            {
                this.loadComments();
            }
            else
            {
                this.renderCommentsList();
            }
        }
    },
    
    events : {
        'click #section-close' : function()
        {
            this.close();
            this.on('sectionClosed', function(){
                app_router.navigate('#/');
            });
        },
        
        'click #section-back' : function()
        {
            var page = app_pages.get(app_router.vars.id);
            app_router.navigate('#/' + page.get('id') + '/' + page.get('slug'));
        }
    },
    
    close : function()
    {
        var that = this;
        this.$('#section-page')
            .transition({
                duration        : 750,
                easing          : 'easeOutExpo',
                queue           : false,
                perspective     : 300,
                rotate3d        : '0,1,0,-1deg',
                opacity         : 0
            }, function()
            {
                $(this).remove();
                that.trigger('sectionClosed');
                
                // unbind events
                
                that.off();
                that.model.off();
                that.options.post.off();
            });
    },
    
    loadComments : function()
    {
        var postUrl = this.options.post.get('url');
        var postId  = this.options.post.get('id');
        var that    = this;
        
        app.vars.comments[postId] = null;
        
        $.ajax({
            url         : postUrl,
            dataType    : 'html',
            success     : function(response)
            {
                app.vars.comments[postId] = response;
                that.renderCommentsList();
            }
            
        });
    },
    
    renderCommentsList : function()
    {
        var postId          = this.options.post.get('id');
        var sectionPage     = this.$el.find('#section-page');
        var that            = this;
        
        if( sectionPage.length )
        {
            var contentComments = sectionPage.find('#section-page-content-comments');
            
            contentComments
                .empty()
                .append(app.vars.comments[postId]);
                
            app.utils.fadeImage( this.$el.find('#section-page-content-comments img') );
            
            var form    = sectionPage.find('#section-page-content-comments form');
            
            form.on('submit', function(e)
            {
                var loggedIn = (form.find('.logged-in-as').length)? true : false;
                var errors   = false;
                
                switch(loggedIn)
                {
                    case true:
                        var commentEl   = form.find('#comment');
                        
                        if(commentEl.val() === '')
                        {
                            errors = true;
                            commentEl.addClass('field-error');
                        }
                        else
                        {
                            commentEl.removeClass('field-error');
                        }
                        break;
                        
                    case false:
                        var commentEl   = form.find('#comment');
                        var authorEl    = form.find('#author');
                        var emailEl     = form.find('#email');
                        
                        if(commentEl.val() === '')
                        {
                            errors = true;
                            commentEl.addClass('field-error');
                        }
                        else
                        {
                            commentEl.removeClass('field-error');
                        }
                        
                        if(authorEl.val() === '')
                        {
                            errors = true;
                            authorEl.addClass('field-error');
                        }
                        else
                        {
                            authorEl.removeClass('field-error');
                        }
                        
                        if(!emailEl.val().match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
                        {
                            errors = true;
                            emailEl.addClass('field-error');
                        }
                        else
                        {
                            emailEl.removeClass('field-error');
                        }
                        
                        break;
                }
                
                e.preventDefault();
                
                if(!errors)
                {
                    var postUrl     = form.attr('action');
                    var postData    = {};
                    
                    form.find('input,textarea').each(function(i, el)
                    {
                        el = $(el);
                        postData[ el.attr('name') ] = el.val();
                    });
                    
                    $.ajax({
                        url     : postUrl,
                        type    : 'post',
                        data    : postData,
                        complete : function()
                        {
                            that.loadComments();
                        }
                    })
                }
                
            });
        }
        
    },
    
    render : function()
    {
        var template            = _.template($("#tmp_section_blog_post").html());
        var that                = this;
        
        var position            = (this.vars.position === undefined)? 'left'    : this.vars.position;
        var customFields        = this.model.get('custom_fields');
        var postCustomFields    = this.options.post.get('custom_fields');
        var subtitle            = (postCustomFields.tf_post_subtitle)? postCustomFields.tf_post_subtitle[0] : null;
        var imageId             = (postCustomFields.tf_post_image)? postCustomFields.tf_post_image[0] : null;
        var image               = null; 
        
        if( isFinite(imageId) )
        {
            _.each(this.options.post.get('attachments'), function(attachment)
            {
                if( attachment.id == imageId )
                {
                    image = attachment.url;
                }
            });
        }
        
        this.$el.html(template({
            subPages        : null,
            title           : this.options.post.get('title'),
            subtitle        : subtitle,
            image           : image,
            post            : this.options.post,
            displayComments : (this.model.get('comments') === undefined)? true : this.model.get('comments'),
            width           : (this.vars.width    === undefined)? 'default' : this.vars.width,
            position        : position
        }));
        
        app.utils.scrollbar(this.$el.find('#section-page'));
        app.utils.fadeImage(this.$('#section-page img'));
        
        this.$('#section-page')
            .css({
                opacity         : 0,
                transformOrigin : (position === 'right')? 'right center' : 'left center',
                perspective     : 300,
                rotate3d        : (position === 'right')? '0,1,0,1deg' : '0,1,0,-1deg'
            })
            .transition({
                duration        : 1500,
                easing          : 'easeOutExpo',
                queue           : false,
                rotate3d        : '0,0,0,0deg',
                opacity         : 1
            }, function()
            {
                that.trigger('sectionOpened');
            });
    }
    
});

/* !app.models.post */

app.models.post = Backbone.Model.extend({
    url : function()
    {
        return webroot + "?json=get_post&id=" + this.id + "&custom_fields=tf_post_image,tf_post_subtitle";
    },
    
    parse : function(response)
    {
        if(response.post)
        {
            return response.post;
        }
        return response;
    }
});

/* !app.models.collectionElement */

app.models.collectionElement = Backbone.Model.extend({});

/* !app.models.page */

app.models.page = Backbone.Model.extend({});

/* !app.models.audio */

app.models.music = Backbone.Model.extend({});

/* !app.models.comment */

app.models.comment = Backbone.Model.extend({});

/* !app.models.image */

app.models.image = Backbone.Model.extend({});

/* !app.collections.pages */

app.collections.pages = Backbone.Collection.extend({

    model : app.models.page,
    url   : app.config.pagesJsonUrl,
    
    initialize : function()
    {
        this.on('reset', function()
        {
            appEvents.trigger('pagesLoaded');
        });
    },
    
    rootPages : function()
    {
        return _.filter(this.models, function(page){ return (!isFinite(page.get('parent_id'))) && (page.get('hidden') !== true)  ; })
    },
    
    subPages : function(pageId)
    {
        return (isFinite(pageId))?
            _.filter(this.models, function(page){ return page.get('parent_id') == pageId; }):
            _.filter(this.models, function(page){ return isFinite(page.get('parent_id')); });
    },
    
    parse : function(response)
    {
        return response.posts;
    }
    
});

/* !app.collections.blog */

app.collections.blog = Backbone.Collection.extend({
    
    model : app.models.post,
    url   : function()
    {
        return app.config.blogJsonUrl;
    },
    
    parse   : function(response)
    {
        this.pages = response.pages;
        return response.posts;
    }
    
});

/* !app.collections.collection */

app.collections.collection = Backbone.Collection.extend({
    
    model   : app.models.collectionElement,
    url     : app.config.collectionJsonUrl,
    parse   : function(response)
    {
        return response.posts;
    }
    
})

/* !app.collections.playlist */

app.collections.playlist = Backbone.Collection.extend({
   
    model   : app.models.music,
    url     : app.config.playlistJsonUrl,
    parse   : function(response)
    {
        return response.posts;
    }
    
});

/* !app.collections.comments */

app.collections.comments = Backbone.Collection.extend({
   
    model : app.models.comment,
    url   : app.config.commentsJsonUrl,
    
    initialize : function(models, options)
    {
        // set url 
        
        var commentsId = options.id;
        if(this.url.indexOf(':id') > 0 && isFinite(commentsId))
        {
            this.url = this.url.replace(/\:id/, encodeURIComponent(commentsId));
        }
    }
    
});

/* !app.collections.gallery */

app.collections.gallery = Backbone.Collection.extend({
    
    model : app.models.image,
    url   : app.config.galleryJsonUrl,
    
    parse   : function(response)
    {
        return [response.post];
    },
    
    initialize : function(models, options)
    {
        // set url 
        
        var galleryId = options.id;
        if(this.url.indexOf(':id') > 0 && isFinite(galleryId))
        {
            this.url = this.url.replace(/\:id/, encodeURIComponent(galleryId));
        }
    }
    
})

/* !global vars */

var app_router, app_mainView, app_pages, app_playlist;

/* !init */

$(function()
{
    app_router   = new app.router();
    app_pages    = new app.collections.pages();
    app_mainView = new app.views.main();
    
    app_router.navigate('#/');
    Backbone.history.start();
});

})(jQuery);