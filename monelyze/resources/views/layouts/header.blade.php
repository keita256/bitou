@section('header')
<header>
    <nav class="nav">
        <a class="nav-link active button hvr-underline-reveal" href="/home">ホーム</a>
        <a class="nav-link button hvr-underline-reveal" href="/spend">入力</a>
        <a class="nav-link button hvr-underline-reveal" href="/users/edit">ユーザー設定</a>
        <a class="nav-link disabled button hvr-underline-reveal" href="#" tabindex="-1" aria-disabled="true">無効</a>
        <p class="">{{ $user_name }}さん</p>
    </nav>
</header>
@endsection
