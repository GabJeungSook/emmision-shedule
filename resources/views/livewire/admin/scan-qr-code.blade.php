<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Scan QR Code
    </div>
    <div class="p-4 mt-5">
        <div class="flex justify-center mt-5">
            <input wire:model="scannedCode" autocomplete="off" wire:change="redirectToTransaction" type="text" id="qrInput" 
                   class="text-center p-4 text-2xl focus:outline-none w-full mx-14 rounded-md" autofocus>
        </div>
        <small class="flex justify-center mt-3 font-medium">*Scan QR Code Here*</small>
    </div>
</div>

<script>
    // Function to ensure the scanning input is always focused
    const qrInput = document.getElementById('qrInput');

    function ensureFocus() {
        if (qrInput && document.activeElement !== qrInput) {
            qrInput.focus();
        }
    }

    if (qrInput) {
        // Continuously check focus
        setInterval(ensureFocus, 100);

        // Prevent default behavior of clicking away
        document.addEventListener('click', (e) => {
            if (e.target.id !== 'qrInput' && e.target.tagName !== 'BUTTON') {
                e.preventDefault();
                qrInput.focus();
            }
        });
    }
</script>
