@extends('front.layouts.main')
@section('title', 'Blogs List')
@section('content')
    @php
        use App\Models\Faqs;
        $Faqs = Faqs::get_all_faqs();
    @endphp
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
                        <li>Blogs</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blogs Section ======= -->

        <section id="service" class="services pt-0">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Blogs</span>
                    <h2>Blogs</h2>

                </div>

                <div class="row gy-4">
                    @if (!$Blogs->isEmpty())
                        @foreach ($Blogs as $Blog)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="{{ asset($Blog->image) }}" alt="" class="img-fluid">
                                    </div>
                                    <h3><a href="{{ route('front.blog_details', ['id' => $Blog->id]) }}"
                                            class="stretched-link">{{ $Blog->title }}</a></h3>
                                    <p>{{ substr($Blog->description, 0, 20) . '..' }}</p>
                                </div>
                            </div><!-- End Card Item -->
                        @endforeach
                    @endif

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        @if (!$Faqs->isEmpty())
            <!-- ======= Frequently Asked Questions Section ======= -->
            <section id="faq" class="faq">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <span>Frequently Asked Questions</span>
                        <h2>Frequently Asked Questions</h2>

                    </div>

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-10">

                            <div class="accordion accordion-flush" id="faqlist">

                                @foreach ($Faqs as $Faq)
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $Faq->id }}">
                                                <i class="bi bi-question-circle question-icon"></i>
                                                {{ $Faq->title }}
                                            </button>
                                        </h3>
                                        <div id="faq-content-{{ $Faq->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist">
                                            <div class="accordion-body">
                                                {{ $Faq->description }}

                                            </div>
                                        </div>
                                    </div><!-- # Faq item-->
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </section><!-- End Frequently Asked Questions Section -->
        @endif
        <!-- End Frequently Asked Questions Section -->

    </main><!-- End #main -->


@stop
