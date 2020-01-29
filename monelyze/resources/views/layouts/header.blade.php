@section('header')
<header>
    <nav class="nav">
        <a class="nav-link active button hvr-underline-reveal" href="/home">ホーム</a>
        <a class="nav-link button hvr-underline-reveal" href="/spend">入力</a>
        <a class="nav-link button hvr-underline-reveal" href="/users/edit">ユーザー設定</a>
        <a class="nav-link button hvr-underline-reveal" href="/monthlyInput">月初入力</a>
        <a class="nav-link button hvr-underline-reveal" href="/payment">固定費入力</a>
        <a class="nav-link disabled button hvr-underline-reveal" href="#" tabindex="-1" aria-disabled="true">無効</a>
        <p class="">{{ $username }}さん</p>
    </nav>
</header>
@endsection
