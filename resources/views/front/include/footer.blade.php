 <!-- ======= Footer ======= -->
 @php use App\Models\Admin\ContactSetting; @endphp
 <footer id="footer" class="footer">

     <div class="container">
         <div class="row gy-4">
             <div class="col-lg-5 col-md-12 footer-info">
                 <a href="{{ route('front.homepage') }}" class="logo d-flex align-items-center">
                     <span>{{env('APP_NAME', 'Laravel App')}}</span>
                 </a>
                 <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies
                     darta donna mare fermentum iaculis eu non diam phasellus.</p>
                 <div class="social-links d-flex mt-4">
                     <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                     <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                     <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                     <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                 </div>
             </div>

             <div class="col-lg-2 col-6 footer-links">
                 <h4>Useful Links</h4>
                 <ul>
                     <li><a href="{{route('front.faqspage')}}">Faqs</a></li>
                     <li><a href="{{route('front.aboutpage')}}">About us</a></li>
                     <li><a href="{{route('front.servicespage')}}">Services</a></li>
                     <li><a href="{{route('front.term_and_conditionpage')}}">Terms of service</a></li>
                     <li><a href="{{route('front.privacy_policypage')}}">Privacy policy</a></li>
                 </ul>
             </div>

             <div class="col-lg-2 col-6 footer-links">
                 <h4>Our Services</h4>
                 <ul>
                     <li><a href="#">Web Design</a></li>
                     <li><a href="#">Web Development</a></li>
                     <li><a href="#">Product Management</a></li>
                     <li><a href="#">Marketing</a></li>
                     <li><a href="#">Graphic Design</a></li>
                 </ul>
             </div>

             <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                 <h4>Contact Us</h4>
                 <p>
                    {{ ContactSetting::get_contact_us_details()->location ? ContactSetting::get_contact_us_details()->location : 'A108 Adam Street, New York, NY 535022' }}<br><br>
                     <strong>Phone:</strong> <a href="tel:{{ContactSetting::get_contact_us_details()->phone ? ContactSetting::get_contact_us_details()->phone : '+1 5589 55488 55' }}" class="Blondie">{{ ContactSetting::get_contact_us_details()->phone ? ContactSetting::get_contact_us_details()->phone : '+1 5589 55488 55' }}</a><br>
                     <strong>Email:</strong> <a href="mailto:{{ ContactSetting::get_contact_us_details()->email ? ContactSetting::get_contact_us_details()->email : 'info@example.com' }}">{{ ContactSetting::get_contact_us_details()->email ? ContactSetting::get_contact_us_details()->email : 'info@example.com' }}</a><br>
                 </p>

             </div>

         </div>
     </div>

     <div class="container mt-4">
         <div class="copyright">
           <?php echo date("Y");  ?>  &copy; Copyright <strong><span>{{env('APP_NAME', 'Laravel App')}}</span></strong>. All Rights Reserved
         </div>
         <div class="credits">
             Designed by <a href="javascript:void(0);">{{env('APP_NAME', 'Laravel App')}}</a>
         </div>
     </div>

 </footer><!-- End Footer -->
 <!-- End Footer -->

 <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
         class="bi bi-arrow-up-short"></i></a>

 <div id="preloader"></div>
