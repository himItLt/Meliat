$(document).ready(function(){
    
    var rootRoute = '/ck5e974ldld5782pnbp5fh73hj5dk/'
    
    
    $('.mass-list-checkbox').on('change', function(){
        if($(this).prop('checked') === true) {
            $('.reslist-checkbox').prop('checked', true)
        } else {
            $('.reslist-checkbox').prop('checked', false)
        }
    })
    $('.mass-select').on('change', function(){
        if($(this).val() === 'destroy') {
            $('.reslist-checkbox').each(function(){
                if($(this).prop('checked') === true) {
                    var el = $(this).parents('.resource-tdrow')
                    var route = $(this).attr('data-route')
                    var method = 'delete'
                    $.ajax({
                        url: route,
                        type: "POST",
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: method
                        },
                        success: function(data) {
                            $(el).remove()
                        },
                        error: function(msg) {}
                    })
                }
            })
        }
    })
    
    $('.remove-btn-top').on('click', function(e){
        e.preventDefault()
        var route = $(this).attr('data-route')
        var token = $('meta[name="csrf-token"]').attr('content')

        $('.remove-back').on('click', function(){
            $('#confirm-modal').modal('hide')
        })
        $('#confirm-modal').modal('show')
        $('.confirm-remove').on('click', function(){
            $.ajax({
                url: route,
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'delete'
                },
                success: function(data) {
                    var url = rootRoute + 'review'
                    document.location.href = url
                },
                error: function(msg) {}
            })
        })
    })
    $('.remove-faq-btn-top').on('click', function(e){
        e.preventDefault()
        var route = $(this).attr('data-route')
        var token = $('meta[name="csrf-token"]').attr('content')

        $('.remove-back').on('click', function(){
            $('#confirm-modal').modal('hide')
        })
        $('#confirm-modal').modal('show')
        $('.confirm-remove').on('click', function(){
            $.ajax({
                url: route,
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'delete'
                },
                success: function(data) {
                    var url = rootRoute + 'questions'
                    document.location.href = url
                },
                error: function(msg) {}
            })
        })
    })
    
    var galleryBtn = $('.get-gallery-files').parents('body').find('.change-img-file')
    $(galleryBtn).on('click', function(){

        if($('#exampleModalLong .modal-img-item.active').length > 0) {
            var id = $('input[name=id]').val()
            $('#exampleModalLong .modal-img-item.active').each(function(){
                var img = $(this).find('.file-img-item').attr('src')
                $.ajax({
                    url: rootRoute + 'gallery',
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        file: img,
                        id: id
                    },
                    success: function(data) {
                        $('.gallery-list-layout').append(`
                            <div class="gallery-item">
                                <input type="hidden" name="gallery_id" value="${data.response.id}">
                                <input type="hidden" name="gallery_route" value="${data.response.route}">
                                <div class="gallery-item-wrap">
                                    <div class="gallery-thumb">
                                        <img class="gallery-thumb-img" src="${data.response.img}">
                                    </div>
                                    <div class="gallery-item-details dz-details">
                                        <div class="dz-filename">
                                            <span>${data.response.file}</span>    
                                        </div>
                                        <div class="dz-edit">
                                            <button type="button" class="dz-edit-btn">Редактировать</button>
                                        </div>
                                        <div class="dz-remove">
                                            <button type="button" class="dz-remove-btn">Удалить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    },
                    error: function(msg) {
                        console.log(msg)
                    }
                })
            })
            
        }
    }) 
    
    
    $('.bool-checkbox').on('change', function() {
        var parent = $(this).parents('.check-parent')
        var checkInput = $(parent).find('.checked-field')
        if($(this).prop('checked') === true) {
            $(checkInput).val(1)
        } else {
            $(checkInput).val(0)
            $(this).prop('checked', false)
        }
    })


    // CUSTOM SELECT
    $('.cusom-select-input').on('focus', function(){
        $(this).parents('.board-custom-select').find('.select-options-list').show()
    })
    $('.cusom-select-input').on('focusout', function(){
        var input = $(this)
        setTimeout(function(){
            $(input).parents('.board-custom-select').find('.select-options-list').hide()
        },100)
    })
    $('.board-custom-select').on('click', '.custom-select-option', function(){
        var val = $(this).attr('data-value')
        var displayText = $(this).text();
        $(this).parents('.board-custom-select').find('.cusom-select-input-value').val(val).change()
        $(this).parents('.board-custom-select').find('.cusom-select-input').val(displayText).change()
    })

    $('.category-option').each(function(){
        if($(this).hasClass('selected')) {
            $('.category-display-text').val($(this).text())
        }
    })

    $('.ru_cusom-select-input').on('focus', function(){
        $(this).parents('.ru_board-custom-select').find('.select-options-list').show()
    })
    $('.ru_cusom-select-input').on('focusout', function(){
        var input = $(this)
        setTimeout(function(){
            $(input).parents('.ru_board-custom-select').find('.select-options-list').hide()
        },100)
    })
    $('.ru_board-custom-select').on('click', '.custom-select-option', function(){
        var val = $(this).attr('data-value')
        var displayText = $(this).text();
        $(this).parents('.ru_board-custom-select').find('.ru_cusom-select-input-value').val(val).change()
        $(this).parents('.ru_board-custom-select').find('.ru_cusom-select-input').val(displayText).change()
    })


    $('.doc-title-input').on('keyup', function(){
        var val = $(this).val()
        $(this).parents('.tab-pane').find('.doc-title').text(val)
    })

    if($('#ace-editor').length > 0){
        var editor = ace.edit("ace-editor");
        editor.setTheme("ace/theme/twilight");
        editor.session.setMode("ace/mode/html");
    }
    
    $('.resource-form').on('submit', function(e){
        e.preventDefault()
        var action = $(this).attr('data-action')
        var route = $(this).attr('action')
        var token = $('meta[name="csrf-token"]').attr('content')
        var method = $('input[name=_method]').val()

        var menuindex = $(this).find('input[name=menuindex]').val();

        var de_title = $(this).find('input[name=de_title]').val();
        var de_meta_title = $(this).find('input[name=de_meta_title]').val();
        var de_meta_description = $(this).find('textarea[name=de_meta_description]').val();
        var de_meta_keywords = $(this).find('input[name=de_meta_keywords]').val();
        var de_content = ''
        $('body').find('#editor_ifr').contents().find('body').find('.content-section-wrap').each(function(){
            de_content += '<div class="content-section"><div class="content-section-wrap">' + $(this).html() + '</div></div>'
        })

        var de_alias = $(this).find('input[name=de_alias]').val();
        var de_uri = $(this).find('input[name=de_uri]').val();
        var de_published = $(this).find('input[name=de_published]').val();
        var de_menushow = $(this).find('input[name=de_menushow]').val();

        var ru_title = $(this).find('input[name=ru_title]').val();
        var ru_meta_title = $(this).find('input[name=ru_meta_title]').val();
        var ru_meta_description = $(this).find('textarea[name=ru_meta_description]').val();
        var ru_meta_keywords = $(this).find('input[name=ru_meta_keywords]').val();
        var ru_content = ''
        $('body').find('#ru_editor_ifr').contents().find('body').find('.content-section-wrap').each(function(){
            ru_content += '<div class="content-section"><div class="content-section-wrap">' + $(this).html() + '</div></div>'
        })
        var ru_alias = $(this).find('input[name=ru_alias]').val();
        var ru_uri = $(this).find('input[name=ru_uri]').val();
        var ru_published = $(this).find('input[name=ru_published]').val();
        var ru_menushow = $(this).find('input[name=ru_menushow]').val();
        var use_gallery = $(this).find('input[name=use_gallery]').val();
        //console.log(use_gallery)
        var per_page = $(this).find('input[name=per_page]').val();

        var reviewInput = $(this).find('input[name=use_review]')
        var use_review = 0
        if ($(reviewInput).prop('checked') === true) {
            use_review = 1
        }
        var faqInput = $(this).find('input[name=use_faq]')
        var use_faq = 0
        if ($(faqInput).prop('checked') === true) {
            use_faq = 1
        }

        var isCategoryInput = $(this).find('input[name=is_category]')
        var is_category = 0
        if ($(isCategoryInput).prop('checked') === true) {
            is_category = 1
        }

        var citylistInput = $(this).find('input[name=use_citylist]')
        var use_citylist = 0
        if ($(citylistInput).prop('checked') === true) {
            use_citylist = 1
        }

        var parent_id = $(this).find('input[name=parent_id]').val()

        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-Token': token
            },
            data: {
                _method: method,
                menuindex: menuindex,
                de_title: de_title,
                de_meta_title: de_meta_title,
                de_meta_description: de_meta_description,
                de_meta_keywords: de_meta_keywords,
                de_content: de_content,
                de_alias: de_alias,
                de_uri: de_uri,
                de_published: de_published,
                de_menushow: de_menushow,

                ru_title: ru_title,
                ru_meta_title: ru_meta_title,
                ru_meta_description: ru_meta_description,
                ru_meta_keywords: ru_meta_keywords,
                ru_content: ru_content,
                ru_alias: ru_alias,
                ru_uri: ru_uri,
                ru_published: ru_published,
                ru_menushow: ru_menushow,
                use_gallery: use_gallery,
                per_page: per_page,
                use_review: use_review,
                use_faq: use_faq,
                use_citylist: use_citylist,
                is_category: is_category,
                parent_id: parent_id,
                schema_data: editor.getValue()
            },
            beforeSuccess: function() {
                $('.resource-form input').prop('disabled', true)
            },
            success: function(data) {
                $('.resource-form input').prop('disabled', false)
                $('.action-msg').show()
                $('.msg').text(data['msg'])
                if(action === 'create'){
                    var url = document.location.href.replace(/create/gi, '')
                    document.location.href = url
                }
                setTimeout(function(){
                    $('.action-msg').hide()
                    $('.msg').text('')
                },3000)
            },
            error: function(msg) {}
        })
    })
    $('.submit-btn').on('click', function(){
        $('.resource-form').submit()
    })


    $('.profile-form').on('submit', function(e){
        e.preventDefault()
        var action = $(this).attr('data-action')
        var route = $(this).attr('action')
        var token = $('meta[name="csrf-token"]').attr('content')
        var method = $('input[name=_method]').val()

        var name = $(this).find('input[name=name]').val();
        var email = $(this).find('input[name=email]').val();
        var pass = $(this).find('input[name=pass]').val();


        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-Token': token
            },
            data: {
                _method: method,
                name: name,
                email: email,
                pass, pass
            },
            beforeSuccess: function() {
                $('.profile-form input').prop('disabled', 'disabled')
            },
            success: function(data) {
                $('.profile-form input').prop('enebled', 'enebled')
                $('.action-msg').show()
                $('.msg').text(data['msg'])
                // if(action === 'create'){
                //     var url = document.location.href.replace(/create/gi, '')
                //     document.location.href = url
                // }
                setTimeout(function(){
                    $('.action-msg').hide()
                    $('.msg').text('')
                },3000)
            },
            error: function(msg) {}
        })
    })
    $('.submit-btn').on('click', function(){
        $('.profile-form').submit()
    })


    $('.chunk-form').on('submit', function(e){
        e.preventDefault()
        var action = $(this).attr('data-action')
        var route = $(this).attr('action')
        var token = $('meta[name="csrf-token"]').attr('content')
        var method = $('input[name=_method]').val()

        var title = $(this).find('input[name=title]').val();
        var icon = $(this).find('input[name=icon]').val();      
        var content = editor.getValue()
        

        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-Token': token
            },
            data: {
                _method: method,
                title: title,
                icon: icon,
                content: content
            },
            beforeSuccess: function() {
                $('.chunk-form input').prop('disabled', 'disabled')
            },
            success: function(data) {
                $('.chunk-form input').prop('enebled', 'enebled')
                $('.action-msg').show()
                $('.msg').text(data['msg'])
                if(action === 'create'){
                    var url = document.location.href.replace(/create/gi, '')
                    document.location.href = url
                }
                setTimeout(function(){
                    $('.action-msg').hide()
                    $('.msg').text('')
                },3000)
            },
            error: function(msg) {}
        })
    })
    $('.submit-btn').on('click', function(){
        $('.chunk-form').submit()
    })

    $('.action-btn.remove').on('click', function(e){
        e.preventDefault()
        var elem = $(this).parents('.resource-tdrow')
        var route = $(this).attr('data-route')
        var method = $(this).attr('data-method')
        var token = $('meta[name="csrf-token"]').attr('content')

        $('.remove-back').on('click', function(){
            $('#confirm-modal').modal('hide')
        })
        $('#confirm-modal').modal('show')
        $('.confirm-remove').on('click', function(){
            $.ajax({
                url: route,
                type: "POST",
                headers: {
                    'X-CSRF-Token': token
                },
                data: {
                    _method: method
                },
                success: function(data) {
                    $(elem).remove()
                    $('.action-msg').show()
                    $('.msg').text(data['msg'])
                    setTimeout(function(){
                        $('.action-msg').hide()
                        $('.msg').text('')
                    },3000)
                },
                error: function(msg) {}
            })
        })
    })






    $('.getImg').on('click', function(e){
        e.preventDefault()
        $.ajax({
            url: rootRoute + 'ajax/files',
            type: "GET",
            success: function(data) {
                for (var i = 0; i < data['files'].length; i++) {
                   var filename = data['files'][i]['filename']
                   var filteExt = filename.substring(filename.lastIndexOf('.')+1, filename.length)
                   if (filteExt == 'jpeg' || filteExt == 'JPEG' || filteExt == 'jpg' || filteExt == 'JPG' || filteExt == 'png' || filteExt == 'PNG' || filteExt == 'GIF' || filteExt == 'gif') {
                       $('.modal-img-list').append('<div class="modal-img-item"><img class="file-img-item" src="/' + data['files'][i]['file'] + '"><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                   } else {
                       $('.modal-img-list').append('<div class="modal-img-item"><i class="fa fa-file-o"></i><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                   }
                }
                for (var i = 0; i < data['dirs'].length; i++) {
                    var icon = '<i class="fa fa-minus-circle"></i>'

                    if (data['dirs'][i]['status'] == 1) {
                        icon = '<i class="fa fa-folder"></i>'
                    }
                    $('.modal-dirs-list').append('<li class="dir-item" data-dir="'+data['dirs'][i]['dir']+'"><div class="listflex">'+icon+'<span>' + data['dirs'][i]['dir'] + '</span></div></li>')
                }
            },
            error: function(msg) {}
        })
    })
    $('.modal-dirs-list').on('click', '.dir-item .listflex', function(e){
        e.preventDefault()
        if($(this).hasClass('open')){
            $(this).parent().find('.dir-parent').slideUp(150)
            $(this).removeClass('open')
        } else {
            $('.modal-dirs-list .listflex').removeClass('active')
            $(this).addClass('active')
            $(this).addClass('open')
            var item = $(this).parent()
            var dir = $(this).parent().attr('data-dir')
            var curDir = dir.replace(/\//gi, '_dir_')
            
            $('.modal-title').text(dir)
            $.ajax({
                url: rootRoute + 'ajax/files/' + curDir,
                type: "GET",
                success: function(data) {
                    $('.modal-img-list').html('')
                    for (var i = 0; i < data['files'].length; i++) {
                        var filename = data['files'][i]['filename']
                        var filteExt = filename.substring(filename.lastIndexOf('.')+1, filename.length)
                        if (filteExt == 'jpeg' || filteExt == 'JPEG' || filteExt == 'jpg' || filteExt == 'JPG' || filteExt == 'png' || filteExt == 'PNG' || filteExt == 'GIF' || filteExt == 'gif') {
                            $('.modal-img-list').append('<div class="modal-img-item"><img class="file-img-item" src="/' + data['files'][i]['file'] + '"><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                        } else {
                            $('.modal-img-list').append('<div class="modal-img-item"><i class="fa fa-file-o"></i><div class="filename">'+data['files'][i]['filename']+'</div></div>')
                        }
                    }
                    $(item).append('<ul class="dir-parent"></ul>')
                    
                    for (var i = 0; i < data['dirs'].length; i++) {
                        var icon = '<i class="fa fa-minus-circle"></i>'

                        if (data['dirs'][i]['status'] == 1) {
                            icon = '<i class="fa fa-folder"></i>'
                        }
                        $(item).find('.dir-parent').append('<li class="dir-item" data-dir="'+data['dirs'][i]['dir']+'"><div class="listflex">'+icon+'<span>' + data['dirs'][i]['dirname'] + '</span></div></li>')
                    }
                },
                error: function(msg) {}
            })
        }
    })
    $('.modal-img-list').on('click', '.modal-img-item', function(e){
        if (e.ctrlKey){
            $(this).addClass('active')
        } else {
            $('.modal-img-item').removeClass('active')
            $(this).addClass('active')
        }
    })
    $('.change-img-file').on('click', function(){
        var img = $('.modal-img-list .modal-img-item.active img').attr('src')
        $('.icon-input').val(img)
        $('body').find('.mce-window').find('.mce-filepicker input').val(img)
        $('#exampleModalLong').modal('hide')
        $('.current-file-img img').attr('src', img)
        $('.modal-img-item').remove()
    })
    $('#exampleModalLong').on('hidden.bs.modal', function (e) {
        $('.modal-img-item').remove()
        $('.modal-dirs-list li').remove()
    })


    $('.review-submit-btn').on('click', function(e){
        e.preventDefault()
        $('.review-form').submit()
    })
    $('.review-form').on('submit', function(e){
        e.preventDefault()
        var action = $(this).attr('data-action')
        var route = $(this).attr('action')
        var token = $('meta[name="csrf-token"]').attr('content')
        var method = $('input[name=_method]').val()

        var name = $(this).find('input[name=name]').val()
        var lastname = $(this).find('input[name=lastname]').val()
        var email = $(this).find('input[name=email]').val()
        var vote = $(this).find('input[name=vote]').val()
        var local = $(this).find('select[name=local]').val()
        var text = $(this).find('textarea[name=text]').val()
        var publishedCheckbox = $(this).find('input[name=published]')
        if($(publishedCheckbox).prop('checked') === true) {
            published = 1
        } else {
            published = 0
        }


        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-Token': token
            },
            data: {
                _method: method,
                name: name,
                lastname: lastname,
                email: email,
                vote: vote,
                local: local,
                text: text,
                published: published
            },
            success: function(data) {
                $('.resview-form input').prop('disabled', false)
                $('.action-msg').show()
                $('.msg').text(data['msg'])
                if(action === 'create'){
                    var url = document.location.href.replace(/create/gi, '')
                    document.location.href = url
                }
                setTimeout(function(){
                    $('.action-msg').hide()
                    $('.msg').text('')
                },3000)
            },
            error: function(msg) {}
        })
    })
    

    $('.faq-form').on('submit', function(e){
        e.preventDefault()
        var action = $(this).attr('data-action')
        var route = $(this).attr('action')
        var token = $('meta[name="csrf-token"]').attr('content')
        var method = $('input[name=_method]').val()

        var name = $(this).find('input[name=name]').val()
        var subject = $(this).find('input[name=subject]').val()
        var email = $(this).find('input[name=email]').val()
        var locale = $(this).find('select[name=locale]').val()
        var question = $(this).find('textarea[name=question]').val()
        var ask = $(this).find('textarea[name=ask]').val()
        var publishedCheckbox = $(this).find('input[name=published]')
        if($(publishedCheckbox).prop('checked') === true) {
            published = 1
        } else {
            published = 0
        }
        console.log(published)


        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-Token': token
            },
            data: {
                _method: method,
                name: name,
                subject: subject,
                email: email,
                locale: locale,
                question: question,
                ask: ask,
                published: published
            },
            beforeSuccess: function() {
                $('.review-form input').prop('disabled', true)
            },
            success: function(data) {
                $('.resview-form input').prop('disabled', false)
                $('.action-msg').show()
                $('.msg').text(data['msg'])
                if(action === 'create'){
                    var url = document.location.href.replace(/create/gi, '')
                    document.location.href = url
                }
                setTimeout(function(){
                    $('.action-msg').hide()
                    $('.msg').text('')
                },3000)
            },
            error: function(msg) {}
        })
    })
    $('.submit-btn').on('click', function(){
        $('.raq-form').submit()
    })



    
    
    $('.gallery-list-layout').on('click', '.dz-edit-btn', function(){
        var parent = $(this).parents('.gallery-item')
        
        var updateRoute = $(parent).find('input[name=gallery_route]').val()
        var id = $(parent).find('input[name=gallery_id]').val()
        var getRoute = rootRoute + 'gallery/' + id + '/edit'

        $.ajax({
            url: getRoute,
            method: 'GET',
            success: function(data) {
                $('.gallery-item-form').find('.edit-gallery-thumb').attr('src', data['data']['root_path'] + data['data']['filename'])
                $('.gallery-item-form').find('input[name=gallery_alt]').val(data['data']['alt'])
                $('.gallery-item-form').find('input[name=gallery_title]').val(data['data']['title'])
                $('.gallery-item-form').find('textarea[name=gallery_caption]').val(data['data']['caption'])
                $('.gallery-item-form').find('input[name=gallery_item_id]').val(data['data']['id'])
            },
            error: function(msg) {}
        })
        $('#gallery-item-modal').modal('show')
        
        $('#gallery-item-modal').on('hidden.bs.modal', function (e) {
            $('.gallery-item-form input, .gallery-item-form input textarea').val('')
            $('.edit-gallery-thumb').attr('src', '')
        })
    })
     $('.save-btn').on('click', function(e){
            e.preventDefault()
            var id = $('.gallery-item-form').find('input[name=gallery_item_id]').val()
            $.ajax({
                url: rootRoute + 'gallery/' + id,
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    _method: "put",
                    alt: $('.gallery-item-form').find('input[name=gallery_alt]').val(),
                    title: $('.gallery-item-form').find('input[name=gallery_title]').val(),
                    caption: $('.gallery-item-form').find('textarea[name=gallery_caption]').val()
                },
                success: function(data) {
                    $('.action-msg').show()
                    $('.msg').text(data['msg'])
                    setTimeout(function(){
                        $('.action-msg').hide()
                        $('.msg').text('')
                    },3000)
                },
                error: function(msg) {}
            })
        })
    $('.gallery-list-layout').on('click', '.dz-remove-btn', function(){
        var parent = $(this).parents('.gallery-item')
        var id = $(parent).find('input[name=gallery_id]').val()

        $('#confirm-modal').modal('show')
        $('.remove-back').on('click', function(){
            $('#confirm-modal').modal('hide')
        })
        $('.confirm-remove').on('click', function(){
            var route = rootRoute + 'gallery/' + id

            $.ajax({
                url: route,
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'delete',
                },
                success: function(data) {
                    $(parent).remove()
                    $('.action-msg').show()
                    $('.msg').text(data['msg'])
                    setTimeout(function(){
                        $('.action-msg').hide()
                        $('.msg').text('')
                    },3000)
                },
                error: function(msg) {}
            })

        })
    })
    
    

    $('.manager-getupload-file-btn').on('click', function(){
        $('#manager-upload-modal').modal('show')
        $('#exampleModalLong').css('z-index', '1000')
        var path = ''
        path = $('body').find('#exampleModalLongTitle').text()
        console.log(path)
        
        if ($('#dropimage').length > 0) {
            $('.gallery-upload-file-btn').on('click', function(){
                $('#dropimage').click()
            })
            var myDropzone = new Dropzone("#dropimage", {
                url: rootRoute + 'files/upload',
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    _method: "put",
                },
                // init: function() {
                //     this.on("sending", function(file, xhr, formData){
                //         formData.append("id", $('input[name=id]').val())
                //         formData.append("path", path)
                //     });
                // }
            });
        }
        myDropzone.on("sending", function(file, xhr, formData) {
          // Will send the filesize along with the file as POST data.
            formData.append("id", $('input[name=id]').val())
            formData.append("path", $('body').find('#exampleModalLongTitle').text())
        });
        myDropzone.on("success", function(data) {
            var data = JSON.parse(data.xhr.response)
            console.log(data.path + '/' + data.file)
            
            $('.modal-img-list').append(`
                <div class="modal-img-item">
                    <img class="file-img-item" src="/${data.path}/${data.file}">
                    <div class="filename">${data.file}</div>
                </div>
            `)
        });
        
        $('#manager-upload-modal').on('hidden.bs.modal', function(){
            $('#exampleModalLong').css('z-index', '100000')
            myDropzone.removeAllFiles()
        })
    })
    
    



})

$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            $('.resource-form').submit()
            $('.chunk-form').submit()
            break;
        }
    }
});