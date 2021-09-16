<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, init" ial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <?php wp_enqueue_style('vrn', plugin_dir_url(__FILE__) . "css/style.css");  ?>
    <?php wp_enqueue_script('vrn', plugin_dir_url(__FILE__) . "/JS/custom.js", true); ?>
</head>

<body>
    <div class="wrapper-main">
    <div class="flag-box"></div>
    <div class="ip-address"></div>
        <div class="boxes">
        <div class="left">
            <div class="ip1"></div>
        </div>
        <div class="right">
            <div class="ip2"></div>
        </div>
        </div>
        <button class="btn" id="btn">View</button>
    </div>
</body>
</html>