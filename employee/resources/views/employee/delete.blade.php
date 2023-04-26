<x-app-layout>
  <x-dialog>
    <x-slot name="link_btn">{{ route('search') }}</x-slot>
  </x-dialog>
  <x-slot name="return_btn">{{ route('search') }}</x-slot>
  <script>
    $(function() {
      $('#submit').prop('disabled', true);
      $('#agree').on('click', function() {
        if ($(this).prop('checked') == false) {
          $('#submit').prop('disabled', true);
        } else {
          $('#submit').prop('disabled', false);
        }
      });
    });
  </script>
  <x-slot name="page_title">社員削除</x-slot>
  <div class="d-flex justify-center">
    <div class="w-full sm:max-w-4xl mt-8 px-8 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

      @if (!empty($workers))
        @foreach ($workers as $worker)
          <form action="/employee/delete/{{$worker->worker_id}}" method="post">
            @csrf
            <div class="[&_div]:mb-5 text-xl">
              <div>
                <label>ID</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->worker_id}}</p>
              </div>

              <div>
                <label>氏名</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->worker_name}}</p>
              </div>

              <div>
                <label>性別</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->sex}}</p>
              </div>

              <div>
                <label>年齢</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->age}}</p>
              </div>

              <div>
                <label>住所</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->address}}</p>
              </div>

              <div>
                <label>所属部署</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->department}}</p>
              </div>

              <div>
                <label>所属課</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->division}}</p>
              </div>

              <div>
                <label>入社日</label>
                <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                  {{$worker->hire_date}}</p>
              </div>

              <div class="d-flex justify-center text-red-600 font-semibold">
                上記の社員データを削除します。<br>削除した社員データは復旧できません。
              </div>
              <div class="d-flex justify-center">
                <input class="w-6 h-6 mr-2.5" type="checkbox" id="agree" name="agree" required="required">社員データの削除に同意します。
              </div>
              <div class="d-flex justify-center">
                <input class="mb-5 text-xl border-8 bg-blue-300 disabled-btn" id="submit" type="submit" value="社員削除"></div>
              </div>
            </div>
          </form>
        @endforeach
      @endif
    </div>
  </div>
</x-app-layout>