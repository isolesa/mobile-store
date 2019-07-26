<script>
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".menu_body").hide();
        $(".menu_head").click(function(){
            $(this).next(".menu_body").slideToggle(600);
            var plusmin;
            plusmin = $(this).children(".plusminus").text();
            if( plusmin == '+')
                $(this).children(".plusminus").text('-');
            else
                $(this).children(".plusminus").text('+');
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#example').barrating({
            theme: 'fontawesome-stars'
        });
    });
</script>