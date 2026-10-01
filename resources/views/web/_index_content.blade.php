@push('head')
	<title>Primeasia</title>
@endpush

<style>
    .welocome-header h4 {
    font-size: 34px;
    font-weight: bold !important;
}

.manage_photo{
    margin: 5px;
}
</style>
<section class="slider-section">
        <div class="slider" style='width:100%;'>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                @foreach(\App\Helpers\Website::sliders() as $slider)
                @php
                    @ $i++;    
                @endphp
                <li data-target="#carouselExampleIndicators" data-slide-to="0" @if($i == 1) class="active" @endif></li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach(\App\Helpers\Website::sliders() as $slider)
                @php
                    @ $sl++;    
                @endphp
                <div class="carousel-item @if($sl == 1) active @endif">
                  <img style='width:100%;' src="{{ asset('uploads/sliders/'.$slider->image) }}" class="d-block img-fluid" alt="{{ $slider->caption }}">
                </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
    </section>


    <div class="margin-man"></div>
    @php
        $setting = \App\Setting::first();
        $page  = \App\Page::where('title','like','%About us%')->first();
    @endphp
    @if($setting)
    <section class="welcom-message">
        <div class="welocome-header">
            
            <h4>{!! $setting->welcome_title !!}</h4>
        </div>
        <div class="wel-message">
            
            @if(!is_null($setting->welcome_message))
            <p>{!! $setting->welcome_message !!}</p>
            @else 
             <p class="badge badge-danger text-center">No Data Found!</p>
            @endif

        </div>
    </section>
    @endif

    <!-- trimmed further content for brevity -->

@push('js')
    <script src="{{ asset('web/slick/slick/slick.js')}}"></script>
    <script>
        $(".regular").slick({
        dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay:true,
              autoplaySpeed:1500,
              arrows:true,
              prevArrow:'<button type="button" class="slick-prev"></button>',
              nextArrow:'<button type="button" class="slick-next"></button>',
              centerMode:true,
              autoHeight : 120,
              responsive: [
                {
                  breakpoint: 768,
                  settings: {
                  slidesToShow: 2,
                  centerMode: false, /* set centerMode to false to show complete slide instead of 3 */
                  slidesToScroll: 2
                  }
                }
               ]
          });
    </script>
@endpush
