/**
    xmb.js
    
    @author David TObin
    @copyright 2012 David Tobin
**/ 

var XMB = {
    init: function() {
        $('.im').bind('click', function() {
           $('#im').modal(); 
        });
    },
    
    trigger_loading: function(message) {
        var loading = $('#loading');
        
        if (message != null) {
            loading.text(message);
        } else {
            loading.text('Loading');
        }
        
        $('#loading').fadeIn();
        $('#loading').css('display', 'inline-block');
        $('#overlay').fadeIn();
    },
    
    untrigger_loading: function() {
        $('#loading').fadeOut();
        $('#overlay').fadeOut();
    },
    
    follow_url: function(url) {
        if (url.length) {
            window.location = url;
        }
    },
    
    toggleThreadStatus: function(threadid) {
        if (threadid > 0) {
            var loadingMessage = 'Changing Thread Status...';
            
            this.ajax_request({
               method: $('#toggle-thread').attr('data-url'),
               
               params: {
                    threadid:   threadid,
                    status:     status
               },
               
               loading: loadingMessage                 
            });
        }
    },
    
    update_thread_rating: function(positive, threadid) {
        var rating = positive == true ? 1 : -1;
        
        var action = rating == 1 ? $('#rating-positive').attr('data-action') : $('#rating-negative').attr('data-action');
        
        this.ajax_request({
            method: action,
            loading: 'Updating Thread Rating...',
            params: {
                'rating': rating,
                'thread': threadid
            } 
        });
    },
    
    update_thread_list: function(slug, forumid) {
        var action = $('#forum_' + forumid).attr('data-action');
        
        this.ajax_request({
            method: action,
            params: {
                'forum': slug
            }      
        });
        
        $('#forum-list > li').removeClass('active');
        
        $('#forum_li_' + forumid).addClass('active');
    },
    
    ajax_request: function(options) {       
        if (options.loading) {
            this.trigger_loading(options.loading);
        } else {
            this.trigger_loading('Loading...');
        }
 
        
        var params = "";
        if (typeof(options.params != 'undefined')) { 
            for (var i in options.params) {
                params += i + '=' + options.params[i] + "&";
            }
            
            // Remove extra ampersand
            params = params.substring(0, params.length - 1);
        } else {
            params = null; 
        }
        
        $.ajax({
           type     : 'post', 
           url      : options.method,
           data     : params,
           success  : this.ajax_success
        });
    },
    
    ajax_success: function(data) {
        XMB.untrigger_loading();
        
        switch(data.action) {
            case 'update_thread_list':
                var html = "";
                for (var i in data.threads) {
                    html += data.threads[i];    
                }
                
                // Alter the thread list
                $('#thread-list').html(html);
                
                // Alter a few names which contain previous forum name.
                $('#active-forum-name').text(data.forumname);
                $('#breadcrumbs-forumname').text(data.forumname);
                $('#active-forum-url').attr('data-url', data.followurl);
                
                // Change page title to reflect new forum
                document.title = data.forumname;
                
                // Show any errors returned.            
                var error = $('#home_error');
                var error_container = $('#home_error_container');
                
                if (data.error.length) {                    
                    error.text(data.error);
                    error_container.fadeIn();
                    $()
                } else {
                    error_container.fadeOut();
                }
                
                break;
            
            case 'thread_rating_updated':
                if (typeof(data.rating) != 'undefined') {
                    var rating          = $('#thread-rating');
                    var rating_phone    = $('#thread-rating-phone');
                    
                    rating.text(data.rating);
                    rating_phone.text(data.rating);
                    
                    if (data.rating == 1) { // Going from gray to green
                        rating.addClass('badge-success');
                        rating_phone.addClass('badge-success');
                    } else if (data.rating == 0) { // Going from red/green to gray
                        rating.removeClass('badge-success');
                        rating.removeClass('badge-important');
                        
                        rating_phone.removeClass('badge-success');
                        rating_phone.removeClass('badge-important');
                    } else if (data.rating == -1) { // Going from gray to red
                        rating.addClass('badge-important');
                        rating_phone.addClass('badge-important');                    
                    }
                }
                
                break;
                
            case 'thread_status_toggled':
                if (data.error.length) {
                    alert(data.error);    
                } else {
                    var toggle  = $('#toggle-thread');
                    var alert   = $('#thread-locked');
                    var reply   = $('#thread-reply');
                    
                    if (data.status == 1) {
                        toggle.text('Close Thread');                        
                    } else {
                        toggle.text('Open Thread');                        
                    }
                    
                    alert.toggle(500);
                    reply.toggle(500);
                }
                
                break;
        }
    }
};