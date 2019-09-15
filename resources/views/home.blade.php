@extends('layouts.app')

@section('content')

<div class="container">

    <section class="main_information">
        <div class="title">
            <h2>Main information</h2>
        </div>
        <dl>
            <dt>Account name:</dt>
            <dd>{{ Auth::user()->name }}</dd>
            <dt>Public identifier:</dt>
            <dd>{{ Auth::user()->public_id }}</dd>
            <dt>Bank account balance:</dt>
            <dd>{{ Auth::user()->money }} EUR</dd>
        </dl>
    </section>

    <section class="transaction_history">
        <div class="title">
            <h2>Transactions history</h2>
        </div>
        <div class="transaction_history__list_container">
            <ul class="transaction_history__list">
            @foreach ($transaction_history as $transaction_history_item)
                <li class="transaction_history__list_item {{ $transaction_history_item['is_sent'] ? 'transaction_history__list_item--sent' : 'transaction_history__list_item--recieved'}}">
                    <dl>
                        <dt>Date:</dt>
                        <dd>{{ $transaction_history_item['date'] }}</dd>
                        <dt>Money transfered:</dt>
                        <dd>{{ $transaction_history_item['money'] }} Eur</dd>
                        @if($transaction_history_item['is_sent'])
                            <dt>Sent to:</dt>
                            <dd>{{ $transaction_history_item['target'] }}</dd>
                        @else
                            <dt>Recieved from:</dt>
                            <dd>{{ $transaction_history_item['target'] == 0 ? 'System' : $transaction_history_item['target'] }}</dd>
                        @endif
                    </dl>
                </li>
            @endforeach
            </ul>
        </div>
    </section>

    <section class="transfer">
        <div class="title">
            <h2>Make a transaction</h2>
        </div>
        <form class="transfer__form" action="/send" method="POST">
            @csrf
            <div class="transfer__form__item">
                <label for="amount">Money to transfer</label>
                <input type="number" id="amount" name="amount">
            </div>
            <div class="transfer__form__item">
                <label for="recipient">Recipient's public identifier</label>
                <input type="number" id="recipient" name="recipient">
            </div>
            <input class="btn" type="submit" value="Transfer the money">
        </form>
    </section>

</div>

@if($errors->any())
<section class="errors">
    <ul class="errors__list">
    @foreach($errors->all() as $error)
        <li class="errors__list_item">{{ $error }}</li>
    @endforeach
    </ul>
</section>
@endif

@endsection
