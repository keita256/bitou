<!DOCTYPE html>
<html>
<head>
    @yield('head')
</head>
<body>
    @yield('header')

    <!--コンテンツ-->
    <div class="continer">
        @yield('content')
        
        @yield('sidebar')
    </div>
    
    <footer>
        
    </footer>
</body>
</html>