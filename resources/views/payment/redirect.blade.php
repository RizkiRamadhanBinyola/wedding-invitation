
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
    window.onload = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "/payment/success";
            },
            onPending: function(result) {
                window.location.href = "/payment/pending";
            },
            onError: function(result) {
                alert("Payment Failed");
            }
        });
    }
</script>

<p>Memuat halaman pembayaran...</p>

