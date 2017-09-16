<form action="stripe/process_subscription" method="POST">
    <input type="text" class="form-control" name="coupon" value="" placeholder="Introduce tu cupón" />
    <input type="hidden" name="type" value="{{ $type }}" />
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_q5BW2TvGUbbJgFo9dExFhAd0"
            data-name="{{ $name }}"
            data-description="{{ $description }}"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="es"
            data-zip-code="false"
            data-currency="eur"
    >
    </script>
</form>