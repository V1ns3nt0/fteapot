@extends('layouts.app')

@section('content')
<h2 class="text-center">Доставка</h2>
<div class="container">
    <h4>Доставка почтой России</h4>
    <p style="max-width: 700px">Стоимость рассчитывается и оплачивается сразу при оформлении заказа. Сроки доставки зависят от региона.
        При заказе от 1500 руб. доставка Почтой России по территории РФ - бесплатно!</p>

    <h4>Курьерская доставка (Томск)</h4>
    <p style="max-width: 700px">Осуществляется на указанный в заказе адрес, пожалуйста, обязательно введите номер своего мобильного телефона!
        Стоимость доставки 200 руб.. При покупке от 1500 доставка бесплатно. Срок доставки 3 рабочих дня с момента
        оплаты заказа.</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0 mt-5">
            <div>
                <h4>Способы оплаты</h4>
                <ol>
                    <li>Через QIWI Wallet</li>
                    <li>Через MasterPass</li>
                    <li>Через Сбербанк: оплата по SMS или Сбербанк Онлайн</li>
                    <li>Из кошелька WebMoney</li>
                    <li>С банковской карты Visa, MasterCard или Maestro</li>
                    <li> Из кошелька в Яндекс.Деньгах</li>
                </ol>
            </div>
            <div class="mt-5">
                <h4>Контактная информация</h4>
                <p>8 888 666 77 55, <br>
                    8 979 555 44 33 </p>
                <p>ugl_tea@pr.ru</p>
            </div>
        </div>
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="view overlay z-depth-1-half mt-5">
                <img src="/storage/img/delivery.jpeg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
