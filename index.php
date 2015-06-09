<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>x-tractor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<div id="app">
    <div id="tractor-request">
        <div id="info" class="request-warper">
            <strong>X-tractor</strong> is a tool for extracting links and images from HTML. <br />
            Either input the URL of web page in text field, or paste some HTML in text box below.
        </div>

        <form method="post" id="xtractor-fetch" class="request-warper">
            <div class="form-line input-line">
                <label class="input">Source:</label>
                <textarea name="url"/>http://www.erezart.co.il/</textarea
            </div>

            <div class="form-line checkbox-line">
                <input type="checkbox" name="links" checked/>
                <label>X-tract links</label>
            </div>
            <div class="form-line checkbox-line">
                <input type="checkbox" name="images" checked/>
                <label>X-tract images</label>
            </div>

            <button type="submit" value="submit"><span class="image"></span> <span class="text">Go!</span></button>

        </form>
    </div>
    <hr class="clearfix"/>

    <div class="request-warper">
        <div id="links"></div>
        <div id="images"></div>
    </div>

</div>

<script id="images-template" type="text/x-handlebars-template">
    <h3>Found {{count}} Images</h3>
    <ul>
        {{#each images}}
        <li><img src="{{this}}" /></li>
        {{/each}}
    </ul>
</script>

<script id="links-template" type="text/x-handlebars-template">
    <h3>Found {{count}} Links</h3>
    <ul>
        {{#each links}}
        <li><a href="{{href}}">{{text}} </a></li>
        {{/each}}
    </ul>
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
