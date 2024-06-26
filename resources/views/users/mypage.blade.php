@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h1>マイページ</h1>

        <hr>

        <!-- 全員に表示するメニュー -->
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">会員情報の編集</label>
                            <p>アカウント情報の編集</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('mypage.edit') }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-lock fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">パスワード変更</label>
                            <p>パスワードを変更します</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('mypage.edit_password') }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <!-- 無料会員のみ表示するメニュー -->
        @if(Auth::user()->paid_membership_flag == false)
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-archive fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-name">有料会員登録</label>
                                <p>有料会員の登録ができます</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('checkout.session') }}" onclick="event.preventDefault(); document.getElementById('stripe-form').submit();">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </a>

                        <form action="{{ route('checkout.session') }}" method="GET" id="stripe-form" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <hr>
        @endif

        <!-- 有料会員のみ表示するメニュー -->
        @if(Auth::user()->paid_membership_flag == true)
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-archive fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-name">クレジットカード変更</label>
                                <p>クレジットカードの変更ができます</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('change.card') }}" onclick="event.preventDefault(); document.getElementById('stripe-change-form').submit();">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </a>

                        <form action="{{ route('change.card') }}" method="GET" id="stripe-change-form" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <hr>

            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-archive fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-name">予約一覧</label>
                                <p>予約一覧を確認できます</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('reservations.index') }}">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-archive fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-name">レビュー一覧</label>
                                <p>投稿したレビュー一覧を確認できます</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('reviews.index') }}">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-archive fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-name">有料会員解約</label>
                                <p>有料会員の解約ができます</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('cancel.subscription') }}">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>
        @endif

        <!-- 全員に表示するログアウトメニュー -->
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-sign-out-alt fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">ログアウト</label>
                            <p>ログアウトします</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <!-- 無料会員のみ表示する退会メニュー -->
        @if(Auth::user()->paid_membership_flag == false)
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <i class="fas fa-user-times fa-3x"></i>
                        </div>
                        <div class="col-9 d-flex align-items-center ms-2 mt-3">
                            <div class="d-flex flex-column">
                                <label for="user-delete">退会する</label>
                                <p>アカウントを削除します</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="btn" data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal">
                            <i class="fas fa-chevron-right fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                            <form method="POST" action="{{ route('mypage.destroy') }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn nagoyameshi-delete-submit-button">退会する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
        @endif

    </div>
</div>
@endsection
