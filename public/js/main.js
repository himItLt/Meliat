$(document).ready(function(){
    
    var ww = document.body.clientWidth;
    if(ww <= 1024) {
        $('.nav-toggle').on('click', function(e){
            e.preventDefault();
            $('.nav').slideToggle(300);
        });

        $('.mobile-lang').on('click', function(){
            $('.langs-list').fadeToggle(200);
        });
        
        var headerHeight = $('.page-header').height()
        $(window).scroll(function () {
            if ($(this).scrollTop() > headerHeight) {
                $('.nav-layout').addClass('sticky-nav');
            } else {
                $('.nav-layout').removeClass('sticky-nav');
            }
        });
        console.log(headerHeight)
    }

    $('.cookie-check-btn').on('click', function(e){
        e.preventDefault()
        $.ajax({
            url: 'ajax/cookie-check',
            type: 'GET',
            data: {
                value: 1
            },
            success: function(data) {
                $('.cookie-check-layout').css('bottom','-100px')
                setTimeout(function(){
                    $('.cookie-check-layout').remove()
                },3000)
            },
            error: function(msg) {

            }
        })
    })

    $('.content-section iframe').wrap('<span class="col s8 video"></span>')

    $('.pagin-btn').on('click', function(){
        var i = 1
        $('.hidden-img-item').each(function(){
            i++
            if(i < 14) {
                $(this).removeClass('hidden-img-item')
                if($('.hidden-img-item').length < 1) {
                    $('.pagin-btn').hide()
                }
            } else {
                return false
            }
        })
    })
    
    
    
    $().fancybox({ 
        
        selector : '[data-fancybox="gallery"]',
        protect: true,
        animationEffect: "zoom",
        transitionEffect: "slide",
        lang: "de",
        i18n: {
            en: {
              CLOSE: "Close",
              NEXT: "Next",
              PREV: "Previous",
              ERROR: "The requested content cannot be loaded. <br/> Please try again later.",
              PLAY_START: "Start slideshow",
              PLAY_STOP: "Pause slideshow",
              FULL_SCREEN: "Full screen",
              THUMBS: "Thumbnails",
              DOWNLOAD: "Download",
              SHARE: "Share",
              ZOOM: "Zoom"
            },
            de: {
              CLOSE: "Schliessen",
              NEXT: "Weiter",
              PREV: "Zurück",
              ERROR: "Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es später nochmal.",
              PLAY_START: "Diaschau starten",
              PLAY_STOP: "Diaschau beenden",
              FULL_SCREEN: "Vollbild",
              THUMBS: "Vorschaubilder",
              DOWNLOAD: "Herunterladen",
              SHARE: "Teilen",
              ZOOM: "Maßstab"
            }
        },
        afterShow: function( instance, current ) {
      
            var countItems = $.fancybox.getInstance().group.length
            var countPages = countItems / 12
            var pages = Math.ceil(countPages)
            var index = $.fancybox.getInstance().current.index
            var currentPage = Math.ceil((index + 2) / 12)
            var trigger = (index + 2) / 12
            var loaded = $('.section-gallery-item').not('.hidden-img-item').length
            
            if (currentPage == trigger) {
                if(loaded < (currentPage + 1) * 12) {
                    var i = 1
                    $('.hidden-img-item').each(function(){
                        i++
                        if(i < 14) {
                            $(this).removeClass('hidden-img-item')
                            if($('.hidden-img-item').length < 1) {
                                $('.pagin-btn').hide()
                            }
                        } else {
                            return false
                        }
                    })
                }
            }
        }
    }); 
    
    



    // Scroll top
    var top_show = 600;
    var delay = 1000;
    $(document).ready(function() {
        $(window).scroll(function () {
        if ($(this).scrollTop() > top_show) $('.scroll-top').fadeIn();
        else $('.scroll-top').fadeOut();
        });
        $('.scroll-top').click(function () {
        $('body, html').animate({
            scrollTop: 0
        }, delay);
        });
    })


    // Autocomplete
    $('.city-search-form').submit( function(event){
        event.preventDefault();
    })
    $('.city-search-input').on('input', function(e){
        var str = $(this).val();
        var city = ''
        var out = ''
        var reg = new RegExp(str, "i");
        $('.cities-list li').each(function(){
            city = $(this).find('.city').text();
            out = city.match(reg);
            if(out === null) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    })


    // Review form
    $('.form-rating-star').hover(function(){
        $('.form-rating-star').removeClass('hover');
        var rating = $(this).attr('data-rating');
        var i = 0;
        $('.form-rating-star').each(function(){
            if(i++ < rating){
                $(this).addClass('hover');
            }
        });
        $('.vote-descr-'+rating).addClass('hover')
        if($('.vote-descr-'+rating).hasClass('active') === false) {
            $('.vote-descr.active').hide()
        }
    }, function(){
        $('.form-rating-star').removeClass('hover');
        $('.vote-descr').removeClass('hover');
        $('.vote-descr.active').show()
    });
    $('.form-rating-star').on('click', function(e){
        e.preventDefault();
        $('.form-rating-star').removeClass('active');
        var rating = $(this).attr('data-rating');
        var i = 0;
        $('.form-rating-star').each(function(){
            if(i++ < rating){
                $(this).addClass('active');
            }
        });
        $('.review_vote_' + rating).prop('checked', true);
        $('.vote-descr').removeClass('active');
        $('.vote-descr').attr('style', '');
        $('.vote-descr-' + rating).addClass('active');
        
        if(+rating !== 0) {
            $('input[name=review_vote]').removeClass('error-input')
            $('input[name=review_vote]').removeClass('empty-field')
        
            $(this).parents('.form-group').find('.error-msg').text('');
        }
    });
    var vote = $('input[name=review_vote]:checked').val()
    $('.form-rating-star').each(function(){
        var val = $(this).attr('data-rating')
        var i = 0
        $('.form-rating-star').each(function(){
            if(i++ < vote){
                $(this).addClass('active');
            }
        });
    })


    // Validate Forms
    function isStr(formId, input) {
        var name = $(formId).find(input);
        $(name).on('change focusout keyup', function(){
            var nameVal = $(this).val();
            var regName = /[^\p{L}]+$/
            if(regName.test(nameVal)) {
                $(this).addClass('not-error');
                $(this).removeClass('error-input');
                $(this).removeClass('empty-field');
                $(this).next('.error-msg').text('');
            } else {
                $(this).removeClass('not-error');
                $(this).addClass('error-input');
                $(this).addClass('empty-field');
                var lang = $('html').attr('lang')
                var msg = ''
                if (lang == 'de') {
                    msg = 'Füllen Sie das Feld aus'
                } else if (lang = 'ru') {
                    msg = 'Заполните поле'
                }
                $(formId).find(this).next('.error-msg').text(msg);
            }
        })
    }

    function isEmail(formId) {
        var name = $(formId).find('input[name=email]');
        $(name).on('change focusout keyup', function(){
            var nameVal = $(this).val();
            var regName = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
            if(regName.test(nameVal)) {
                $(this).addClass('not-error');
                $(this).removeClass('error-input');
                $(this).removeClass('empty-field');
                $(this).next('.error-msg').text('');
            } else {
                $(this).removeClass('not-error');
                $(this).addClass('error-input');
                $(this).addClass('empty-field');
                var lang = $('html').attr('lang')
                var msg = ''
                if (lang == 'de') {
                    msg = 'E-Mail eingeben'
                } else if (lang = 'ru') {
                    msg = 'Введите E-mail'
                }
                $(formId).find(this).next('.error-msg').text(msg);
            }
        })
    }

    function isPhone(formId, input) {
        var phone = $(formId).find(input);
        $(phone).on('change focusout keyup', function(){
            var phoneVal = $(this).val();
            var regPhone = /^\+?[0-9_. -()]+$/;
            var form = formId;

            if(regPhone.test(phoneVal) && phoneVal.length > 10 && phoneVal.length < 20) {
                $(this).addClass('not-error');
                $(this).removeClass('error-input');
                $(this).removeClass('empty-field');
                $(this).next('.error-msg').text('');
            } else {
                $(this).removeClass('not-error');
                $(this).addClass('error-input');
                $(this).addClass('empty-field');
                var lang = $('html').attr('lang')
                var msg = ''
                if (lang == 'de') {
                    msg = 'Geben Sie das Telefon ein'
                } else if (lang = 'ru') {
                    msg = 'Введите номер телефона'
                }
                $(formId).find(this).next('.error-msg').text(msg);
            }
        })
    }

    function defaultSuccess(formId) {
        var parent = $(formId).parents('.form-layout');
        var blockHeight = $(parent).find('.form-outer').height();
        $(parent).css("height", blockHeight + "px");
        
        $(parent).find('.form-outer').addClass('form-send');
        setTimeout(function(){
            $(parent).find('.form-outer').hide();
            $(parent).find('.success-msg').addClass('active');
        },300);
        setTimeout(function(){
            $(formId).remove();
        },600);
    }
    $('.success-remove-btn').on('click', function(){
        $(this).parents('.form-container').remove()
    })
    
    function isVote(formId) {
        $(formId).on('submit', function(){
            var vote = $(this).find('input[name=review_vote]:checked').val()
            var input = $(this).find('input[name=review_vote]:checked')
            if(+vote === 0) {
                $(input).removeClass('not-error');
                $(input).addClass('error-input');
                $(input).addClass('empty-field');
                var lang = $('html').attr('lang')
                var msg = ''
                if (lang == 'de') {
                    msg = 'Geben Sie bitte ihre Bewertung ab'
                } else if (lang = 'ru') {
                    msg = 'Поставьте оценку'
                }
                $(input).parents('.form-group').find('.error-msg').text(msg);
            } else {
                $('input[name=review_vote]').removeClass('error-input')
                $('input[name=review_vote]').removeClass('empty-field')
                $('input[name=review_vote]').removeClass('not-error')
                $(input).addClass('not-error');
                $(input).removeClass('error-input');
                $(input).removeClass('empty-field');
                $(input).parents('.form-group').find('.error-msg').text('');
            }
        })
    }

    function send(formId, url, success, validateCount) {
        $(formId).on('submit', function(e){
            e.preventDefault();
            var regProtect = /[^\p{L}]+$/;
            var protect = $(this).find('input[name=fullname]').val();

            if($(this).find('.not-error').length == validateCount && protect.length < 1) {
                if(success == 1) {
                    defaultSuccess(formId);
                } else if (success == 2) {
                    $('.success-modal').addClass('active');
                    $('.callback-form-wrap').addClass('hide');
                    setTimeout(function(){
                        $(formId).remove();
                    },300);
                }
                console.log('ok')

                $.ajax({
                    url: url,
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),

                    beforeSend: function(xhr, textStatus){ 
                        $(formId).find(':input').attr('disabled','disabled');
                    },
                    success: function(response){
                        $(formId).find('.form-wrap').remove();
                        $(formId).find('.msg-success').fadeIn(150)
                        $(formId).find('.msg-success').html('Ваша заявка отправлена.<br><br>Наш менеджер свяжеться с Вами в ближайшее время.');
                        if (popup == 1) {
                            setTimeout(function(){
                                $(formId).find('.msg-success').fadeOut(300)
                            },5000)
                        }
                    }
                })
            } else {
                $(this).find('.empty-field').addClass('error-input');
                var lang = $('html').attr('lang')
                var msg = ''
                if (lang == 'de') {
                    msg = 'Füllen Sie das Feld aus'
                } else if (lang = 'ru') {
                    msg = 'Заполните поле'
                }
                $(this).find('.empty-field').next('.error-msg').text(msg);
                console.log('error')
                return false;
            }
        })
    }

    //isStr('#feedback-form', 'select[name=anrede]');
    isStr('#feedback-form', 'input[name=name]');
    //isStr('#feedback-form', 'input[name=vorname]');
    isPhone('#feedback-form', 'input[name=telefon]');
    isStr('#feedback-form', 'input[name=address]');
    isStr('#feedback-form', 'input[name=plz]');
    isStr('#feedback-form', 'input[name=ort]');
    isStr('#feedback-form', 'textarea[name=msg]');
    isEmail('#feedback-form');
    send('#feedback-form', '/ajax/feedback', 1, 7);

    isPhone('#callback-form', 'input[name=telefon]');
    send('#callback-form', 'ajax/callback', 2, 1);

    //isStr('#contact-form', 'select[name=anrede]');
    isStr('#contact-form', 'input[name=name]');
    //isStr('#contact-form', 'input[name=vorname]');
    isPhone('#contact-form', 'input[name=telefon]');
    isStr('#contact-form', 'input[name=address]');
    isStr('#contact-form', 'input[name=plz]');
    isStr('#contact-form', 'input[name=ort]');
    isStr('#contact-form', 'textarea[name=msg]');
    isEmail('#contact-form');
    send('#contact-form', '/ajax/feedback', 1, 7);

    isStr('.review-form', 'input[name=name]');
    isStr('.review-form', 'input[name=vorname]');
    isStr('.review-form', 'textarea[name=msg]');
    isEmail('.review-form');
    isVote('.review-form')
    send('.review-form', '/ajax/review', 1, 5);

    isStr('.faq-form', 'textarea[name=msg]');
    isStr('.faq-form', 'input[name=subject]');
    isEmail('.faq-form');
    send('.faq-form', '/ajax/faq', 1, 3);
    
    
    if($('#footer-feedback-success-icon').length > 0) {
        var footerFeedbackSuccess = SVG('footer-feedback-success-icon').size(150, 150)
        var footerFeedbackSuccessBox = footerFeedbackSuccess.viewbox(0, 0, 510, 510)
        footerFeedbackSuccessBox.path('M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z').attr({ fill: '#80d72f' })
        
    }
    if($('#modal-feedback-success-icon').length > 0) {
        var modalFeedbackSuccess = SVG('modal-feedback-success-icon').size(150, 150)
        var modalFeedbackSuccessBox = modalFeedbackSuccess.viewbox(0, 0, 510, 510)
        modalFeedbackSuccessBox.path('M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z').attr({ fill: '#ffffff' })
    }
    if($('#contacts-feedback-success-icon').length > 0) {
        var contactsFeedbackSuccess = SVG('contacts-feedback-success-icon').size(150, 150)
        var contactsFeedbackSuccessBox = contactsFeedbackSuccess.viewbox(0, 0, 510, 510)
        contactsFeedbackSuccessBox.path('M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z').attr({ fill: '#80d72f' })
        
    }
    if($('#reviews-success-icon').length > 0) {
        var reviewsSuccess = SVG('reviews-success-icon').size(150, 150)
        var reviewsSuccessBox = reviewsSuccess.viewbox(0, 0, 510, 510)
        reviewsSuccessBox.path('M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z').attr({ fill: '#80d72f' })
        
    }
    if($('#faq-success-icon').length > 0) {
        var faqSuccess = SVG('faq-success-icon').size(150, 150)
        var faqSuccessBox = faqSuccess.viewbox(0, 0, 510, 510)
        faqSuccessBox.path('M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z').attr({ fill: '#80d72f' })
        
    }
    
    
    
});