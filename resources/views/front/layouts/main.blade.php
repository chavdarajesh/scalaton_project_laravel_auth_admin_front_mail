<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ env('APP_NAME', 'Laravel App') }} | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('front.layouts.head')
</head>

<body>
    @include('front.include.header')
    @yield('content')
    @include('front.include.footer')
    @include('front.layouts.footer')
</body>

</html>
