<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{__('msg.title')}}</title>
  <link rel="stylesheet" href="{{asset('../css/style.css')}}">
</head>

<body>
  <!-- header -->
  <header class="menubar keep-menu">
        <div class="container">
            <div class="logo">
                <div class="gg"><img src="img/apv.png"></div>
            </div>
        </div>
  </header>
  <section>
        <div class="item">
          <li>
            <div class="form">
                <img class="img1" src="http://www.androidpolice.com/wp-content/themes/ap2/ap_resize/ap_resize.php?src=http%3A%2F%2Fwww.androidpolice.com%2Fwp-content%2Fuploads%2F2015%2F10%2Fnexus2cee_Search-Thumb-150x150.png&w=150&h=150&zc=3"> 
                <div>
                  <a href="{{ url('auth/google') }}" class="google btn">
                    <i class="fa fa-google fa-fw"></i>{{__('msg.login')}} 
                  </a>
                </div>
            </div>
          </li>
        </div>
  </section>
<footer class="footer">
    <p>{{__('msg.footer')}} </p>
</footer>

</body>

</html>