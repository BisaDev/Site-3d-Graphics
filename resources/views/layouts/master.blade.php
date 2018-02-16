<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Maniak - I do!</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="{{asset('css/site.css')}}" rel="stylesheet" type="text/css">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#1c202a">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#1c202a">

</head>
<body>

    @yield('content')



    <script type="text/javascript" src="{{asset('js/site.js')}}"></script>

    <div id="death">
        <div class="death-container">
            <h4 class="title">
                <span class="center">maniak</span>
            </h4>
            <p class="intro">
                A fatal exception 0E has occurred at 0028:C562F1B7 in VXD ctpci9x(05). The current application will be terminated.
            </p>

            <ul class="list">
                <li>* Press CTRL+ALT+DEL again to restart your computer. You will lose any unsaved information in all applications. </li>
                <li>* We understand you want to peek into this awesome page!</li>
            </ul>

            <p class="centered">Close the inspector window to continue <span class="blink">_</span> </p>
        </div>
    </div>

    <script type="text/javascript">
        var element = new Image;
        var devtoolsOpen = false;
        var bodyElement = document.body;
        var devWantsJob = false;
        var enabled = false;

        window.job = {
             want(email = null){
                 if(email){
                     devWantsJob = true;
                     console.clear();
                     console.log('%cNice! we will be in touch', 'font-size:40px;color:#fff;text-shadow:0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);');
                 }else{
                     console.log('maybe send me your email');
                 }
            }
        }

        element.__defineGetter__("id", function() {
            devtoolsOpen = true; // This only executes when devtools is open.
        });

        setInterval(function() {
            if(!devWantsJob && enabled){
                devtoolsOpen = false;
                console.log(element);

                if(devtoolsOpen){
                    if(!bodyElement.classList.contains('death')){
                        bodyElement.classList.add('death');
                    }
                }else{
                    bodyElement.classList.remove('death');
                }
                console.clear();
                console.log('%cHello there, so you like looking under the hood?', 'font-size:40px;color:#fff;text-shadow:0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);');
                console.info('%cthere might be something else here', 'font-size:10px;color:#FF1141')
            }
        }, 1000);
    </script>
</body>
</html>
