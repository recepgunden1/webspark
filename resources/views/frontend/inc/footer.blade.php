<footer class="site-footer border-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-6">
          <div class="row">
            <div class="col-md-12">
              <h3 class="footer-heading mb-4">Menü</h3>
            </div>
            <div class="col-md-6 col-lg-4">
              <ul class="list-unstyled">
                <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>
                <li><a href="{{route('hakkimizda')}}">Hakkımızda</a></li>
                <li><a href="{{route('urunler')}}">Ürünler</a></li>
                <li><a href="{{ route('iletisim') }}">İletişim</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-6">
          <div class="block-5 mb-5">
            <h3 class="footer-heading mb-4">İletişim</h3>
            <ul class="list-unstyled">
              <li class="address">{{$settings['adres']}}</li>
              <li class="phone"><a href="tel://{{str_replace(' ','',$settings['phone'])}}">{{$settings['phone']}}</a></li>
              <li class="email">{{$settings['email']}}</li>
            </ul>
          </div>


        </div>
      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> Tüm hakları saklıdır | Recep Günden
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>

      </div>
    </div>
  </footer>
