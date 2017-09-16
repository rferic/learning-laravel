<form action="stripe/process_subscription" method="POST">
    <input type="text" class="form-control" name="coupon" value="" placeholder="Introduce your coupon" />
    <input type="hidden" name="type" value="{{ $type }}" />
    <script
    src="//checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="{{ env('STRIPE_KEY') }}"
    data-name="{{ $name }}"
    data-description="{{ $description }}"
    data-image="//stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="en"
    data-zip-code="false"
    data-currency="eur"
    >
    </script>
</form>
