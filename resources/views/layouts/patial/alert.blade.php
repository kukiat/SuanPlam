@if (Session::has('info'))
  <div class="alert alert-info" role="alert" id="alertt">

    {{ Session::get('info') }}
  </div>
@endif
