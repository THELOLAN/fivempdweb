@extends('layouts.app')


@section('content')

    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-lg">
                    <div class="brand-logo pb-4 text-center">
                        <a href="{{ url('/') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('style/images/logo.png') }}" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('style/images/logo.png') }}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title text-center">Einrichtung notwendig</h4>
                                    <div class="nk-block-des">
                                        <p class=" text-center">Du hast bisher keine Datenbankverbindungen eingetragen! Das System ist daher noch nicht einsatzbereit. Bitte fülle nun das Formular aus.</p>
                                        <introduction></introduction>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-6 order-lg-last">
                                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms & Condition</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Help</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">&copy; 2021 SynchroV. Alle Rechte vorbehalten.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>

@endsection
