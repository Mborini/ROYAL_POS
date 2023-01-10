</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const element = document.getElementById('qr');

let isVisible = true;

let isBordered = false;

setInterval(() => {
    if (isBordered) {
        element.style.border = 'none';
        isBordered = false;
    } else {
        element.style.border = '2px solid #FF652F';
        isBordered = true;
    }
}, 500);
element.addEventListener('mouseover', event => {
    // Your code here

    Swal.fire({

        imageUrl: './photos/QR.jpg',
        imageHeight: 320,
        title: 'Scan QR On Your Moblie',


    })
});
</script>

</html>