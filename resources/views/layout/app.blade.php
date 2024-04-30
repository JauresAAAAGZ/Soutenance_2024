<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edu-Flow Depot</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <!-- Favicon icon -->
      <link rel="icon" href= {{asset('assets/images/lolink.ico')}} type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href={{asset('assets/css/bootstrap/css/bootstrap.min.css')}}>
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href={{asset('assets/icon/themify-icons/themify-icons.css')}}>
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href={{asset('assets/icon/icofont/css/icofont.css')}}>
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href={{asset('assets/css/style.css')}}>
      <link rel="stylesheet" type="text/css" href={{asset('assets/css/jquery.mCustomScrollbar.css')}}>
      <link rel="stylesheet" type="text/css" href={{'assets/css/jquery.dataTables.css'}}> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">




      
    </head>

    <body>

        
        @yield('content')
            
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
                      <img src="assets/images/browser/chrome.png" alt="Chrome">
                      <div>Chrome</div>
                  </a>
              </li>
              <li>
                  <a href="https://www.mozilla.org/en-US/firefox/new/">
                      <img src="assets/images/browser/firefox.png" alt="Firefox">
                      <div>Firefox</div>
                  </a>
              </li>
              <li>
                  <a href="http://www.opera.com">
                      <img src="assets/images/browser/opera.png" alt="Opera">
                      <div>Opera</div>
                  </a>
              </li>
              <li>
                  <a href="https://www.apple.com/safari/">
                      <img src="assets/images/browser/safari.png" alt="Safari">
                      <div>Safari</div>
                  </a>
              </li>
              <li>
                  <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                      <img src="assets/images/browser/ie.png" alt="">
                      <div>IE (9 & above)</div>
                  </a>
              </li>
          </ul>
      </div>
      <p>Sorry for the inconvenience!</p>
  </div>
  <![endif]-->
  <!-- Warning Section Ends -->
  <!-- Required Jquery -->
 
  <script type="text/javascript" src={{asset('assets/js/jquery/jquery.min.js')}}></script>
  <script type="text/javascript" src={{asset('assets/js/jquery-ui/jquery-ui.min.js')}}></script>
  <script type="text/javascript" src={{asset('assets/js/popper.js/popper.min.js')}}></script>
  
  <script type="text/javascript" src={{asset('assets/js/bootstrap/js/bootstrap.min.js')}}></script>
  
  
  <!-- jquery slimscroll js -->
  <script type="text/javascript" src={{asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}></script>
  <!-- modernizr js -->
  <script type="text/javascript" src={{asset('assets/js/modernizr/modernizr.js')}}></script>
  
    <script type="text/javascript" src={{asset('assets/js/modernizr/css-scrollbars.js')}}></script>
    <script type="text/javascript" src={{asset('assets/js/common-pages.js')}}></script>
  <!-- am chart -->
  <script src={{asset('assets/pages/widget/amchart/amcharts.min.js')}}></script>
  <script src={{asset('assets/pages/widget/amchart/serial.min.js')}}></script>
  <!-- Todo js -->
  <script type="text/javascript " src={{asset('assets/pages/todo/todo.js')}}></script>
  <!-- Custom js -->
  <script type="text/javascript" src={{asset('assets/pages/dashboard/custom-dashboard.js')}}></script>
  <script type="text/javascript" src={{asset('assets/js/script.js')}}></script>
  <script type="text/javascript " src={{asset('assets/js/SmoothScroll.js')}}></script>
  <script src={{asset('assets/js/pcoded.min.js')}}></script>
  <script src={{asset('assets/js/demo-12.js')}}></script>
  <script src={{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}></script>
    
   <script type="text/javascript" charset="utf8" src={{'assets/js/jquery.dataTables.js'}}></script>

   <script>

    $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "assets/js/French.json"
                }
            });
        });
   </script>
   <!-- Bootstrap JS (add it before the closing </body> tag) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> 
<script src={{'assets/js/script2.js'}}></script>
</body>

</html>