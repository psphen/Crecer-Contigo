<div id="preloader">
    <img src="{{ asset('frontend/img/preloader.gif') }}" alt="Preloader GIF">
</div>
<script>
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');

        function hidePreloader() {
            // console.log('Hide preloader');
            preloader.style.display = 'none';
        }

        if (document.readyState === 'complete') {
            hidePreloader();
        } else {
            window.addEventListener('load', hidePreloader);
        }
    });
</script>



