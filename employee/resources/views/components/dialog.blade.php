@if (Session::has('message'))
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
    $(window).load(function() {
      $('#modal_box').modal('show');
    });
  </script>
  <div class="modal fade modal-lg" id="modal_box" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body fs-3">
          {{ session('message') }}
        </div>
        <div class="modal-footer">
          <a href="{{ $link_btn }}" class="btn btn-outline-dark">OK</a>
        </div>
      </div>
    </div>
  </div>
@endif