@if (!empty($type) && !empty($msg))
  <div class="alert {{ $type }} alert-dismissible fade show" role="alert">
    {{ $msg }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
