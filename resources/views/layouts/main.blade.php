<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.Title')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('image/kicon.png')}}" rel="apple-touch-icon">
    <link href="{{asset('image/kicon.png')}}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/vendor/aos/aos.css')}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">

</head>
@include('layouts.sidebar')

<main id="main">
    @yield('content')

@include('layouts.contact')

@include('layouts.footer')


