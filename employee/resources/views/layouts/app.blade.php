<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>社員管理システム</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Scripts -->
  <link rel="stylesheet" href="{{ asset('build/assets/app-5005f49e.css') }}">
  <script src="{{ asset('build/assets/app-c36adf3f.js') }}"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div>
  @include('layouts.navigation')
    <main>
  @if (isset( $page_title ))
    <div class="d-flex justify-center">
      <div class="text-3xl">{{ $page_title }}</div>
    </div>
  @endif
      {{ $slot }}
    </main>
  </div>
</body>
</html>