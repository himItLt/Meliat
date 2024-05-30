$(document).ready(function(){
    var rootRoute = '/ck5e974ldld5782pnbp5fh73hj5dk/'
    
    setTimeout(function(){
        var removeBtn = `<button class="pb-block-remove" style="position:absolute;top:10px;right:10px;cursor:pointer;border:none;background:transparent;font-size:20px;"><i class="fa fa-times"></i></button>`
        var inlineScript = `
        <script>
            var btn = document.querySelectorAll('.pb-block-remove')
            for (var i = 0; i < btn.length; i++) {
                btn[i].addEventListener('click', function(){
                    var block = this.closest('.content-section')
                    block.parentNode.removeChild(block)
                })
            }
        </script>
        `

        var addBlockBtn = `<button type="button" class="add-block" style="border:1px solid #ccc;border-radius:2px;font-size:14px;padding:5px 10px;position:absolute;left:10px;top:10px;cursor:pointer;">Добавить блок</button>`
        var block = `
        <div class="col s4 product-item">
            <div class="product-item-wrap">
                <div class="product-item-img-wrap">
                    <img class="product-item-img lazyload" src="/images/Beleuchtung-mobile/320x240/einbaustrahler_led_1.jpg" alt="">
                </div>
                <div class="product-item-descr">
                    <div class="product-item-title">Artikelnummer: 101</div>
                    <div class="products-item-info">
                        <ul>
                            <li>Text</li>
                            <li>Gehäusedurchmesser: 80mm.</li>
                            <li>Einbautiefe: ca. 60mm.</li>
                        </ul>
                    </div>
                    <div class="product-item-price">Preis <b>ohne</b> Montage und Anschluss:</div>
                    <div class="product-item-price-wrap">
                        <div class="product-item-price">11,00 <span class="product-item-currency">Euro</span></div>
                    </div>
                </div>
            </div>
        </div>`

        var addBlockScript = `
        <script>
        var btn = document.querySelectorAll('.add-block')
        for (var i = 0; i < btn.length; i++) {
            btn[i].addEventListener('click', function(){
                var parent = document.querySelector('.products-list')
                var currentHTML = parent.innerHTML
                var block = \`
                    <div class="col s4 product-item">
                        <div class="product-item-wrap">
                            <div class="product-item-img-wrap">
                                <img class="product-item-img lazyload" src="/images/Beleuchtung-mobile/320x240/einbaustrahler_led_1.jpg" alt="">
                            </div>
                            <div class="product-item-descr">
                                <div class="product-item-title">Artikelnummer: 101</div>
                                <div class="products-item-info">
                                    <ul>
                                        <li>Text</li>
                                        <li>Gehäusedurchmesser: 80mm.</li>
                                        <li>Einbautiefe: ca. 60mm.</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">Preis <b>ohne</b> Montage und Anschluss:</div>
                                <div class="product-item-price-wrap">
                                    <div class="product-item-price">11,00 <span class="product-item-currency">Euro</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                \`
                parent.innerHTML = currentHTML + block
            })
        }
    </script>
        `

        $('#editor_ifr').contents().find('body').find('.content-section').append(removeBtn)
        $('body').find('#editor_ifr').contents().find('body').append(inlineScript)
        $('body').find('#editor_ifr').contents().find('body').find('.add-block').remove()
        $('body').find('#editor_ifr').contents().find('body').find('.products-list').parents('.content-section').append(addBlockBtn)
        $('body').find('#editor_ifr').contents().find('body').find('.products-list').parents('.content-section').append(addBlockScript)

        $('#ru_editor_ifr').contents().find('body').find('.content-section').append(removeBtn)
        $('body').find('#ru_editor_ifr').contents().find('body').append(inlineScript)
    },1000)
    

    $('.pb-select .cusom-select-input-value').on('change', function(){
        var id = $(this).val();
        var route = rootRoute + 'ajax/get-chunk-code/' + id

        var token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            url: route,
            type: "GET",
            headers: {
                'X-CSRF-Token': token
            },
            success: function(data) {
                var content = data['data']
                var removeBtn = `<button class="pb-block-remove" style="position:absolute;top:10px;right:10px;cursor:pointer;border:none;background:transparent;font-size:20px;"><i class="fa fa-times"></i></button>`

                var inlineScript = `
                <script>
                    var btn = document.querySelectorAll('.pb-block-remove')
                    for (var i = 0; i < btn.length; i++) {
                        btn[i].addEventListener('click', function(){
                            var block = this.closest('.content-section')
                            block.parentNode.removeChild(block)
                        })
                    }
                </script>
                `
                
                $('body').find('#editor_ifr').contents().find('body').append(content)
                $('body').find('#editor_ifr').contents().find('body').find('.content-section').append(removeBtn)
                
                $('body').find('#editor_ifr').contents().find('body').append(inlineScript)
            },
            error: function(msg) {}
        })
    })

    $('.ru_pb-select .ru_cusom-select-input-value').on('change', function(){
        var id = $(this).val();
        var route = rootRoute + 'ajax/get-chunk-code/' + id

        var token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            url: route,
            type: "GET",
            headers: {
                'X-CSRF-Token': token
            },
            success: function(data) {
                var content = data['data']
                var removeBtn = `<button class="pb-block-remove" style="position:absolute;top:10px;right:10px;cursor:pointer;border:none;background:transparent;font-size:20px;"><i class="fa fa-times"></i></button>`

                var inlineScript = `
                <script>
                    var btn = document.querySelectorAll('.pb-block-remove')
                    for (var i = 0; i < btn.length; i++) {
                        btn[i].addEventListener('click', function(){
                            var block = this.closest('.content-section')
                            block.parentNode.removeChild(block)
                        })
                    }
                </script>
                `
                
                $('body').find('#ru_editor_ifr').contents().find('body').append(content)
                $('body').find('#ru_editor_ifr').contents().find('body').find('.content-section').append(removeBtn)
                
                $('body').find('#ru_editor_ifr').contents().find('body').append(inlineScript)
            },
            error: function(msg) {}
        })
    })
})