<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Error 504 | DashLite Admin Template</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('style/assets/css/dashlite.css?ver=2.3.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('style/assets/css/theme.css?ver=2.3.0')}}">
</head>

<body class="nk-body bg-dark npc-general pg-error">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle wide-xs mx-auto">
                    <div class="nk-block-content nk-error-ld text-center">
                        <h1 class="nk-error-head">403</h1>
                        <h3 class="nk-error-title text-white">Authorisierung fehlgeschlagen</h3>
                        <p class="nk-error-text text-white">Tut uns leid, aber du bist nicht authorisiert, diese Seite aufzurufen! Kontaktiere den Developer, wenn es sich hierbei um einen Fehler handeln sollte.</p>
                        <a href="{{ url()->previous() }}" class="btn btn-lg btn-primary mt-2">Zurück</a>
                    </div>
                </div><!-- .nk-block -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{asset('style/assets/js/bundle.js?ver=2.3.0')}}"></script>
<script src="{{asset('style/assets/js/scripts.js?ver=2.3.0')}}"></script>

</html>
