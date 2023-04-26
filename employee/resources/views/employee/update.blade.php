<x-app-layout>
  <x-dialog>
    <x-slot name="link_btn">{{ route('search') }}</x-slot>
  </x-dialog>
  <x-slot name="return_btn">{{ route('search') }}</x-slot>
  <x-slot name="page_title">社員更新</x-slot>
  <div class="d-flex justify-center">
    <div class="w-full sm:max-w-4xl mt-8 px-8 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

      @if (!empty($workers))
        @foreach ($workers as $worker)
          <div class="[&_div]:mb-5 text-xl">
            <div>
              <label>ID　※IDは変更できません</label>
              <p class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
                {{$worker->worker_id}}</p>
            </div>

            <form action="/employee/update/{{$worker->worker_id}}" method="post">
              @csrf
              <div>
                <label>氏名</label>
                @if ($errors->has('worker_name'))
                  <div class="text-sm text-red-400">{{ $errors->first('worker_name') }}</div>
                @endif
                <input type="text" name="worker_name" value="{{ $worker->worker_name }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>性別</label>
                @if ($errors->has('sex'))
                  <div class="text-sm text-red-400">{{ $errors->first('sex') }}</div>
                @endif
                <input type="text" name="sex" value="{{ $worker->sex }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>年齢</label>
                @if ($errors->has('age'))
                  <div class="text-sm text-red-400">{{ $errors->first('age') }}</div>
                @endif
                <input type="text" name="age" value="{{ $worker->age }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>住所</label>
                @if ($errors->has('address'))
                  <div class="text-sm text-red-400">{{ $errors->first('address') }}</div>
                @endif
                <input type="text" name="address" value="{{ $worker->address }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>所属部署</label>
                @if ($errors->has('department'))
                  <div class="text-sm text-red-400">{{ $errors->first('department') }}</div>
                @endif
                <input type="text" name="department" value="{{ $worker->department }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>所属課</label>
                @if ($errors->has('division'))
                  <div class="text-sm text-red-400">{{ $errors->first('division') }}</div>
                @endif
                <input type="text" name="division" value="{{ $worker->division }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div>
                <label>入社日</label>
                @if ($errors->has('hire_date'))
                  <div class="text-sm text-red-400">{{ $errors->first('hire_date') }}</div>
                @endif
                <input type="date" name="hire_date" value="{{ $worker->hire_date }}"
                  class="w-full py-2 border-b focus:outline-none focus:border-b-4 border-green-300">
              </div>

              <div class="d-flex justify-center">
                <input class="mb-5 text-xl border-8 bg-blue-300" type="submit" value="社員更新">
              </div>

            </form>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</x-app-layout>