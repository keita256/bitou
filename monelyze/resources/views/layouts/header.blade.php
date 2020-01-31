@section('header')
<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-bottom: 1em">
        <a class="navbar-brand" href="/home">Monelyze</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="レスポンシブ・ナビゲーションバー">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Navber">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mr-auto">
                <li><a class="nav-item nav-link button" href="/spend">入力</a></li>
                <li><a class="nav-item nav-link button" href="/users/edit">ユーザー設定</a></li>
                <li><a class="nav-item nav-link button" href="/monthlyInput">月初入力</a></li>
                <li><a class="nav-item nav-link button" href="/payment">固定費入力</a></li>
                <li><a class="nav-item nav-link button" href="/statistics">年度別統計</a></li>
            </ul>
            @if(Auth::check())
            <ul class="navbar-nav">{{ Auth::user()->name }}さん</ul>
            @endif
        </div><!-- /.navbar-collapse -->
    </nav>
</header>
@endsection
