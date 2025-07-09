<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <form id="payment-form">
            <div>
                <label>Name:</label>
                <input type="text" id="name" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" id="email" required>
            </div>
            <div>
                <label>Phone:</label>
                <input type="tel" id="phone" required>
            </div>
            <div>
                <label>Amount:</label>
                <input type="number" id="amount" required>
            </div>
            <button type="submit">Pay Now</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#payment-form').submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '/payment/create',
                    method: 'POST',
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        amount: $('#amount').val(),
                        item_id: 'ITEM-001',
                        item_name: 'Sample Item'
                    },
                    success: function(response) {
                        snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                alert('Payment success!');
                            },
                            onPending: function(result) {
                                alert('Payment pending!');
                            },
                            onError: function(result) {
                                alert('Payment failed!');
                            },
                            onClose: function() {
                                alert('You closed the popup without finishing the payment');
                            }
                        });
                    },
                    error: function(error) {
                        alert('Error creating payment!');
                    }
                });
            });
        });
    </script>
</body>
</html> 