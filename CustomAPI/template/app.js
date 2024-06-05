$(document).ready(function() {
    $("#generateQR").click(function() {
        const date = $("#date").val();
        const subject = $("#subject").val();
        const data = `${date}-${subject}`;
        
        // Clear existing QR code
        $("#qrcode").empty();
        
        // Generate new QR code
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: data,
            width: 128,
            height: 128
        });

        // Refresh QR code every 5 seconds
        setInterval(function() {
            qrcode.clear();
            qrcode.makeCode(data);
        }, 5000);

        // Refresh QR code every 5 seconds
setInterval(function() {
    qrcode.clear();         // Clear existing QR code
    qrcode.makeCode(data);  // Generate new QR code
}, 5000);

    });
});
