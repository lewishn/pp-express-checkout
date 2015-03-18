# pp-express-checkout

This is an exercise on implementing the Paypal Express Checkout API on a shopping site using PHP.
To use the application, simply add the desired item(s) to your cart and proceed to view your shopping cart.

At the shopping cart page, clicking on the checkout button will redirect to the paypal sign in page.
The website makes an API call to retrieve transaction details.
Since this is run in sandbox mode, only sandbox accounts are accepted. 

Once checked in, you will be asked to review and confirm your order.
An API call to PayPal to request payment is invocated.
The transaction is initiated, and once it is completed, you will be redirected back to the home page.