<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
        integrity="sha256-1A78rJEdiWTzco6qdn3igTBv9VupN3Q1ozZNTR4WE/Y=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('#theme_select').on('change', function() {
            event.preventDefault();
            if ($( "#theme_select" ).val() == "dark") {
                $('link[href="custom.css"]').attr('href','custom_dark.css');
                $.cookie("theme", "dark", { expires : 10 });
            } else {
                $('link[href="custom_dark.css"]').attr('href','custom.css');
                $.cookie("theme", "light", { expires : 10 });
            }
        });

        $('#removeThemeCookie').click(function(){
            event.preventDefault();
            $.removeCookie('theme');
            location.reload();
        });
    });
</script>
<?php
    $light = 'selected';
    $dark = '';
    if(isset($_COOKIE["theme"]) && $_COOKIE["theme"] == "dark"){
        $dark = 'selected';
        $light = '';
        echo '<link rel="stylesheet" href="custom_dark.css">';
    } else {
        echo '<link rel="stylesheet" href="custom.css">';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <select class="browser-default custom-select" id="theme_select">
                <option value="light" <?php echo $light?>>Light</option>
                <option value="dark" <?php echo $dark?>>Dark</option>
            </select>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-4"><button id="removeThemeCookie">Hard Remove Theme Cookie</button></div>
    </div>
</div>
