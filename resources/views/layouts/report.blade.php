<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | Ngapak Resto</title>
  <link rel="stylesheet" href="{{url('polished/css/polished.min.css')}}">
  <link rel="stylesheet" href="{{url('polished/css/open-iconic-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('polished/css/report.css')}}">

  <link rel="icon" href="{{url('polished/assets/fav.png')}}">

  <style>
    
    }
  </style>

</head>

<body>


  <div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="{{url('polished/assets/ngapak.png')}}" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h1 class="invoice-id">Ngapak Resto</h1>
                        <strong><small class="text-muted">Developed By Ryan Dinul Fatah</small></strong>
                        <div>Ngapak Resto 2020 &copy; Allright Reserved.</div>
                        <div>(123) 456-789</div>
                        <div>officialngapakresto@gmail.com</div>
                    </div>
                </div>
            </header>
            <main>
                @yield('content')
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.

            </footer>
        </div>
      </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div>
          
        </div>
        
      </div>

  @stack('modal')
</body>
@stack('js')

</html>