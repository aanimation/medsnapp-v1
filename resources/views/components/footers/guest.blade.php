<footer class="footer position-absolute bottom-footer py-4 w-100 z-index-1">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 my-auto">
                <div class="copyright text-center text-sm text-white text-lg-start">
                    © {{ config('app.name') }} {{ now()->format("Y") }}
                </div>
            </div>
            {{--
            <div class="col-12 col-md-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white"
                            target="_blank">About Us</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/license" class="nav-link pe-0 text-white"
                            target="_blank">License</a>
                    </li>
                </ul>
            </div>
            --}}
        </div>
    </div>
</footer>
