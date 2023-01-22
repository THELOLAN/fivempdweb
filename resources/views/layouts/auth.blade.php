<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{('style/images/favicon.ico')}}">
    <!-- Page Title  -->
    <title>Los Santos Police Department</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('style/assets/css/dashlite.css?ver=2.3.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('style/assets/css/theme.css?ver=2.3.0')}}">
</head>

<body class="nk-bod npc-general has-sidebar dark-mode" theme="dark">

<div class="nk-app-root" id="app">
    <!-- main @s -->
    <router-view></router-view>
    <!-- main @e -->
</div>


<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{asset('style/assets/js/bundle.js?ver=2.3.0')}}"></script>
<script src="{{asset('style/assets/js/scripts.js?ver=2.3.0')}}"></script>
{{--<script src="{{asset('style/assets/js/charts/gd-default.js?ver=2.3.0')}}"></script>--}}
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
