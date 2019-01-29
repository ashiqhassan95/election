@extends('frontend.layouts.master')
@section('title')
    Home
@endsection

@section('content')
    <div class="shards-landing-page--1">
        <div class="welcome d-flex justify-content-center flex-column hero">
            <!-- Inner Wrapper -->
            <div class="inner-wrapper mt-auto mb-auto container">
                <div class="row">
                    <div class="col-md-7">
                        <h1 class="welcome-heading display-5 text-white">Computerized <br>Voting System</h1>
                        <p class="text-white">We can help you take your idea from concept to shipping using the latest
                            technologies and best practices available.</p>
                        <a href="{{ route('register') }}"
                           class="btn btn-lg btn-outline-white btn-pill align-self-center">Register now</a>
                    </div>
                </div>
            </div>
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section -->

        <!-- Our Services Section -->
        <div id="our-services" class="our-services section py-4">
            <h3 class="section-title text-center my-5">Our Services</h3>
            <!-- Features -->
            <div class="features py-4 mb-4">
                <div class="container">
                    <div class="row">
                        <div class="feature py-4 col-md-6 d-flex">
                            <div class="icon text-primary mr-3"><i class="fa fa-paint-brush"></i></div>
                            <div class="px-4">
                                <h5>Design & Branding</h5>
                                <p>Quisque mollis mi ac aliquet accumsan. Sed sed dapibus libero. Nullam luctus purus
                                    duis sensibus signiferumque.</p>
                            </div>
                        </div>
                        <div class="feature py-4 col-md-6 d-flex">
                            <div class="icon text-primary mr-3"><i class="fa fa-code"></i></div>
                            <div class="px-4">
                                <h5>Programming</h5>
                                <p>Quisque mollis mi ac aliquet accumsan. Sed sed dapibus libero. Nullam luctus purus
                                    duis sensibus signiferumque.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="feature py-4 col-md-6 d-flex">
                            <div class="icon text-primary mr-3"><i class="fa fa-font"></i></div>
                            <div class="px-4">
                                <h5>Copywriting</h5>
                                <p>Quisque mollis mi ac aliquet accumsan. Sed sed dapibus libero. Nullam luctus purus
                                    duis sensibus signiferumque.</p>
                            </div>
                        </div>
                        <div class="feature py-4 col-md-6 d-flex">
                            <div class="icon text-primary mr-3"><i class="fa fa-support"></i></div>
                            <div class="px-4">
                                <h5>Training & Support</h5>
                                <p>Quisque mollis mi ac aliquet accumsan. Sed sed dapibus libero. Nullam luctus purus
                                    duis sensibus signiferumque.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Features -->
        </div>
        <!-- / Our Services Section -->

        <!-- Our Blog Section -->
        <div class="blog section section-invert py-4">
            <h3 class="section-title text-center m-5">Latest Posts</h3>

            <div class="container">
                <div class="py-4">
                    <div class="row">
                        <div class="card-deck">
                            <div class="col-md-12 col-lg-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" src="/images/shards/common/card-1.jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Find Great Places to Work While Travelling</h4>
                                        <p class="card-text">He seems sinking under the evidence could not only grieve
                                            and a visit. The father is to bless and placed in his length hid...</p>
                                        <a class="btn btn-primary btn-pill" href="#">Read More &rarr;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" src="/images/shards/common/card-3.jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Quick Tips for Improving Your Website's Design</h4>
                                        <p class="card-text">He seems sinking under the evidence could not only grieve
                                            and a visit. The father is to bless and placed in his length hid...</p>
                                        <a class="btn btn-primary btn-pill" href="#">Read More &rarr;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" src="/images/shards/common/card-2.jpg"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">A Designer's Tips While Travelling and Working</h4>
                                        <p class="card-text">He seems sinking under the evidence could not only grieve
                                            and a visit. The father is to bless and placed in his length hid...</p>
                                        <a class="btn btn-primary btn-pill" href="#">Read More &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Our Blog Section -->

        <!-- Testimonials Section -->
        <div class="testimonials section py-4">
            <h3 class="section-title text-center m-5">Testimonials</h3>
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-4 testimonial text-center">
                        <div class="avatar rounded-circle with-shadows mb-3 ml-auto mr-auto">
                            <img src="/images/shards/common/avatar-1.jpeg" class="w-100" alt="Testimonial Avatar"/>
                        </div>
                        <h5 class="mb-1">Osbourne Tranter</h5>
                        <span class="text-muted d-block mb-2">CEO at Megacorp</span>
                        <p>Vivamus quis ex mattis, gravida erat a, iaculis urna. Proin ac eleifend tortor. Nunc in augue
                            eget enim venenatis viverra.</p>
                    </div>

                    <div class="col-md-4 testimonial text-center">
                        <div class="avatar rounded-circle with-shadows mb-3 ml-auto mr-auto">
                            <img src="/images/shards/common/avatar-2.jpeg" class="w-100" alt="Testimonial Avatar"/>
                        </div>
                        <h5 class="mb-1">Darrin Ollie</h5>
                        <span class="text-muted d-block mb-2">CEO at Megacorp</span>
                        <p>Nullam eu ligula facilisis, commodo velit non, vulputate dolor. Aenean congue euismod
                            vestibulum.</p>
                    </div>

                    <div class="col-md-4 testimonial text-center">
                        <div class="avatar rounded-circle with-shadows mb-3 ml-auto mr-auto">
                            <img src="/images/shards/common/avatar-3.jpeg" class="w-100" alt="Testimonial Avatar"/>
                        </div>
                        <h5 class="mb-1">Quinton Bruce</h5>
                        <span class="text-muted d-block mb-2">CEO at Megacorp</span>
                        <p> Aenean imperdiet ultrices tortor id convallis. Donec id metus magna. Morbi pretium odio
                            faucibus blandit gravida.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Testimonials Section -->

        <!-- Contact Section -->
        <div class="contact section-invert py-4">
            <h3 class="section-title text-center m-5">Contact Us</h3>
            <div class="container py-4">
                <div class="row justify-content-md-center px-4">
                    <div class="contact-form col-sm-12 col-md-10 col-lg-7 p-4 mb-4 card">
                        <form>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="contactFormFullName">Full Name</label>
                                        <input type="email" class="form-control" id="contactFormFullName"
                                               placeholder="Enter your full name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="contactFormEmail">Email address</label>
                                        <input type="email" class="form-control" id="contactFormEmail"
                                               placeholder="Enter your email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputMessage1">Message</label>
                                        <textarea id="exampleInputMessage1" class="form-control mb-4" rows="10"
                                                  placeholder="Enter your message..." name="message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-primary btn-pill d-flex ml-auto mr-auto" type="submit"
                                   value="Send Your Message">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('js-body')--}}
{{--<script type="text/javascript">--}}
{{--$(".welcome").css({ height: $(window).height() + "px" });--}}
{{--console.log('done');--}}

{{--$(window).on("resize", function() {--}}
{{--$(".welcome").css({ height: $(window).height() + "px" });--}}
{{--});--}}
{{--</script>--}}
{{--@endpush--}}