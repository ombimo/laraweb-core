@if (!empty(config('seo.google_tag')))
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('seo.google_tag') }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ config('seo.google_tag') }}');
  </script>
@endif
