<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Chat App</title>

    
    
</head>
<body>
<div class="container-fluid">
    @yield('content')
</div>

<div id="chat-overlay" class="row"></div>

<audio id="chat-alert-sound" style="display: none">
    <source src="{{ asset('sound/facebook_chat.mp3') }}" />
</audio>

@yield('script')

</body>
</html>
