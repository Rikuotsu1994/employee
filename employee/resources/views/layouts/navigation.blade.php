<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  <div class="container mx-auto flex justify-between items-center">
    <h1><a href="{{ route('index') }}" class="mt-2 text-3xl font-bold">社員管理システム</a></h1>
    <form method="POST" action="/logout">
      @csrf
      <input class="mt-2 text-xl border-8 bg-blue-300" type="submit" value="ログアウト">
    </form> 
  </div>

  @if (isset( $return_btn ))
    <div class="m-3">
      <a href="{{ $return_btn }}" class="bg-indigo-700 text-white rounded px-8 py-2 text-xl">戻る</a>
    </div>
  @endif
</nav>