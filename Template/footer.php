<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Jqurey -->
<script src="/assets/plugins/Jquery/dist/jquery.min.js"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/plugins/tether/dist/js/tether.min.js"></script>

<!-- Required Fremwork -->
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Scrollbar JS-->
<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

<!--classic JS-->
<script src="/assets/plugins/classie/classie.js"></script>

<!-- notification -->
<script src="/assets/plugins/notification/js/bootstrap-growl.min.js"></script>

<!-- Sparkline charts -->
<script src="/assets/plugins/jquery-sparkline/dist/jquery.sparkline.js"></script>

<script src="/assets/plugins/raphael/raphael.min.js"></script>
<script src="/assets/plugins/morris.js/morris.js"></script>

<!-- Counter js  -->
<script src="/assets/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="/assets/plugins/countdown/js/jquery.counterup.js"></script>
<script src="/assets/plugins/DataTables/datatables.min.js"></script>
<script src="/assets/plugins/datepicker/js/moment-with-locales.min.js"></script>
<script src="/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="/assets/js/sweetalert.js"></script>

<!-- Echart js -->
<script src="/assets/plugins/charts/echarts/js/echarts-all.js"></script>
<script type="text/javascript" src="/assets/js/select2.min.js"></script>

<!-- custom js -->
<script type="text/javascript" src="/assets/js/main.min.js"></script>
<script type="text/javascript" src="/assets/js/main.js"></script>
<script type="text/javascript" src="/assets/pages/elements.js"></script>
<script src="/assets/js/menu.min.js"></script>
<script>
    var $window = $(window);
    var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
            nav.addClass('active');
        }
        else {
            nav.removeClass('active');
        }
    });
</script>

</body>

</html>
