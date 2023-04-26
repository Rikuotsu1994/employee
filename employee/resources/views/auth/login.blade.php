<x-guest-layout>
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <script>
    {{-- ブラウザバック時にリロード --}}
    window.onpageshow = function(event) {
      if (event.persisted || window.performance.getEntriesByType("navigation")[0].type === 'back_forward') {
        window.location.reload();
      }
    };
  </script>
  @if (Session::has('message'))
    <div class="fs-5 text-danger fw-bold">
      {{ session('message') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
  @csrf
    {{-- id --}}
    <div>
      <x-input-label for="worker_id" :value="__('ID')" />
      <x-text-input id="worker_id" class="block mt-1 w-full p-3 text-xl" type="text" name="worker_id" :value="old('worker_id')" autofocus/>
      <x-input-error :messages="$errors->get('worker_id')" class="mt-2" />

    {{-- password --}}
    <div class="mt-4">
      <x-input-label for="password" :value="__('パスワード')" />
      <x-text-input id="password" class="block mt-1 w-full p-3 text-xl" type="password" name="password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <x-primary-button class="ml-3">
        {{ __('ログイン') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
