@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">会員登録ありがとうございます！</h1>

                    <p class="text-center mb-3">
                        現在、仮会員の状態です。
                    </p>

                    <p class="text-center mb-3">
                        ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。
                    </p>

                    <p class="text-center mb-4">
                        メール本文内のURLをクリックすると本会員登録が完了となります。
                    </p>

                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn nagoyameshi-submit-button w-50 text-white">トップページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
