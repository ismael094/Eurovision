<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="resources/themes/default/js/jquery.dynatable.js" ></script>
<script>
                $(document).ready(function () {    
                    $('#my-table').dynatable({
                    readers: {
                      'can': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'voz': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      },
                      'media': function(el, record) {
                        return parseFloat(el.innerHTML) || 0;
                      }
                    }
                  });
                })
                
                
            </script>
<script src="resources/themes/default/vendor/bootstrap/js/popper.js"></script>
<!--===============================================================================================-->
<script src="resources/themes/default/vendor/select2/select2.min.js"></script>
<script src="resources/themes/default/js/bootstrap.min.js"></script>
<script src="resources/themes/default/js/ajaxRequest.js" ></script>
<script type="text/javascript" src="resources/themes/default/js/jquery.mobile-events.min.js"></script>
<!--===============================================================================================-->
        <script src="resources/themes/default/vendor/tilt/tilt.jquery.min.js"></script>
        <script >
                $('.js-tilt').tilt({
                        scale: 1.1
                })
        </script>
<!--===============================================================================================-->
        <script src="resources/themes/default/js/main.js"></script>
        

<!-- Plugin JavaScript -->
<script src="resources/themes/default/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="resources/themes/default/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="resources/themes/default/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="resources/themes/default/js/creative.min.js"></script>
<script src="resources/themes/default/js/docs.js"></script>
<script type="text/javascript" data-o="fdsf">
            
    
    var $img = $(".circleP img"),
        width = $img.width(),
        height = $img.height(),
        tallAndNarrow = width / height < 1;
    if ($img != null) {
        if (tallAndNarrow) {
            $img.addClass('tallAndNarrow');
        }
        $img.addClass('loaded');
    }   
    

    $img = $(".circlePer img"),
      width = $img.width(),
      height = $img.height(),
      tallAndNarrow = width / height < 1;
    if ($img != null) {
        if (tallAndNarrow) {
            $img.addClass('tallAndNarrow');
        }
        $img.addClass('loaded');
    }  
    
</script>