<x-app-layout>
  <div class="flex flex-row my-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('create') }}" class="bg-indigo-700 font-semibold text-white text-xl py-10 px-10 rounded">社員登録</a>
      <a href="{{ route('search') }}" class="bg-indigo-700 font-semibold text-white text-xl py-10 px-10 rounded">社員検索</a>
      <a href="{{ route('password.update') }}" class="bg-indigo-700 font-semibold text-white text-xl py-10 px-2 rounded">パスワード更新</a>
    </div>
  </div>
</x-app-layout>
