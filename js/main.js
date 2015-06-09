(function () {

    var formData = {};

    function checkHttp(url) {
        var hasHost = true;
        if (!/^(f|ht)tps?:\/\//i.test(url)) {
            hasHost = false;
        }
        return hasHost;
    }


    var imagesRendering = {
        init: function (data){
            if (!this.template){
                this.compileTemplate();
            }

            this.render(data);
        },
        compileTemplate: function(){
            var source   = $("#images-template").html();
            this.template = Handlebars.compile(source);
        },

        render: function(data){

            if (formData.isUrlRequest ){
                data.forEach(function(item, index, theArray) {
                    if ( !checkHttp(item)) {
                        theArray[index] = formData.url + item;
                    }
                });
            }

            var html  = this.template({images: data, count: data.length});

            $('#images').html(html);
            $('#images').show();
        }
    };

    var linksRendering = {
        init: function (data){
            if (!this.template){
                this.compileTemplate();
            }

            this.render(data);
        },
        compileTemplate: function(){
            var source   = $("#links-template").html();
            this.template = Handlebars.compile(source);
        },

        render: function(data){
            var linksProcess = [];
            var elm = document.createElement("span");

            //clean empty links and keep only text for links
            data.forEach(function(item, index) {
                $(elm).html(item.text)

                if ($(elm).text().trim().length > 0 ){
                    linksProcess.push({href: item.href, text: $(elm).text().trim()});
                }

            });

            var html  = this.template({links: linksProcess, count: linksProcess.length});

            $('#links').html(html);
            $('#links').show();
        }
    };


    $( "#xtractor-fetch" ).submit(function( event ) {
        event.preventDefault();

        var data = $(this).serialize();

        formData = {};

        $(this).find('input').each(function( index, inputElm){
            formData[$(inputElm).attr('name')] = $(inputElm).val();
        });

        $(this).find('textarea').each(function( index, inputElm){
            formData[$(inputElm).attr('name')] = $(inputElm).val();
        });


        $('#images').hide().html('');
        $('#links').hide().html('');


        $.ajax({
            url: "/scripts/fetch.php",
            method: 'POST',
            data: data
            //context: document.body
        }).success( function(data){
            var response = JSON.parse(data);

            formData.isUrlRequest = response.isUrlRequest;

            if (response.result === 'OK'){
                if (response.images){
                    imagesRendering.init(response.images);
                }

                if (response.links){
                    linksRendering.init(response.links);
                }
            }
        });
    });

})();
