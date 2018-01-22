<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="resources/themes/default/js/jquery.dynatable.js" ></script>
<script>
                $(document).ready(function () {    
                    $('#my-table').dynatable();
                })
                $('#my-table').dynatable({
                    readers: {
                      'columnName': function(el, record) {
                        return Number(el.innerHTML) || 0;
                      }
                    }
                  });
            </script>
<script src="resources/themes/default/js/bootstrap.min.js"></script>
<script src="resources/themes/default/js/ajaxRequest.js" ></script>
<script type="text/javascript" src="resources/themes/default/js/jquery.mobile-events.min.js"></script>