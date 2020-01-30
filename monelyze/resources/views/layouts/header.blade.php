@section('header')
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/home">Monelyze</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="レスポンシブ・ナビゲーションバー">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Navber">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="active"><a class="nav-item nav-link active button hvr-underline-reveal" href="/home">ホーム</a></li>
                <li><a class="nav-item nav-link button hvr-underline-reveal" href="/spend">入力</a></li>
                <li><a class="nav-item nav-link button hvr-underline-reveal" href="/users/edit">ユーザー設定</a></li>
                <li><a class="nav-item nav-link button hvr-underline-reveal" href="/monthlyInput">月初入力</a></li>
                <li><a class="nav-item nav-link button hvr-underline-reveal" href="/payment">固定費入力</a></li>
                <li>
                    <p class="nav-item">{{ $username }}さん</p>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</header>
@endsection