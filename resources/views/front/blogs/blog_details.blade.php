@extends('front.layouts.main')
@section('title', 'Blogs Details')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url({{ asset('assets/front/img/page-header.jpg') }});">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Blogs</h2>
                            <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas
                                consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione
                                sint. Sit quaerat ipsum dolorem.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="{{ route('front.blog') }}">Blogs</a></li>
                        <li>Blogs Details</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="service-details" class="service-details">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">
                    <div class="col-lg-12">
                        <img src="{{ asset($Blog->image) }}" alt="" class="img-fluid services-img">
                        <h3>{{ $Blog->title }}</h3>
                        <div>
                            {{ $Blog->description }}
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Service Details Section -->

    </main><!-- End #main -->


@stop
