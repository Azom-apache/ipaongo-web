 </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0 d-none">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  {{ env("APP_NAME") }} <i class="fa fa-copyright"></i> All Rights Reserved. |  Develop By {{ date("Y") }} <a href="https://www.uttarainfotech.com/" target="_new" >Uttara</a><a href="http://uit.com.bd/" target="_new"> Infotech</a>
               </div>
            </div>
         </div>
      </footer>

      <script src="{{asset('admin/js/jquery.min.js')}}"></script>
      <script src="{{asset('admin/js/popper.min.js')}}"></script>
      <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('admin/js/jquery.appear.js')}}"></script>
      <script src="{{asset('admin/js/countdown.min.js')}}"></script>
      <script src="{{asset('admin/js/waypoints.min.js')}}"></script>
      <script src="{{asset('admin/js/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('admin/js/wow.min.js')}}"></script>
      <script src="{{asset('admin/js/apexcharts.js')}}"></script>
      <script src="{{asset('admin/js/slick.min.js')}}"></script>
      <script src="{{asset('admin/js/select2.min.js')}}"></script>
      <script src="{{asset('admin/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('admin/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{asset('admin/js/smooth-scrollbar.js')}}"></script>
      <script src="{{asset('admin/js/lottie.js')}}"></script>
      <script src="{{asset('admin/js/chart-custom.js')}}"></script>
      <script src="{{asset('admin/js/custom.js')}}"></script>
      @stack('js')
      @yield('js_atik')
   </body>
</html>