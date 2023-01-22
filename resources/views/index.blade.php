@extends('layouts.app')

@section('content')

        <div class="nk-main ">
            <!-- sidebar @s -->
            <sidebar></sidebar>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <header-component></header-component>
                <!-- main header @e -->
                <!-- content @s -->
                <router-view></router-view>
                <!-- content @e -->
                <!-- footer @s -->
                <footer-component></footer-component>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>

@endsection
