const Swal = require('sweetalert2');

window.addEventListener('swal:confirm', event => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit('delete', event.detail.id);
        }
    });
});

window.addEventListener('swal:fire', event => {
    Swal.fire({
        title: event.detail.title,
        html: event.detail.html,
        showConfirmButton: false,
        didOpen: function() {
            document.getElementById('heartCountButton').addEventListener('click', function() {
                Livewire.emit('increaseHeartCount', event.detail.id);
            });
        },
        willOpen: function(modalElement) {
            window.addEventListener('counterUpdated', function(event) {
                // update the counter display in modal
                const heartCount = modalElement.querySelector('#heartCountButton');
                if (heartCount) {
                    heartCount.innerHTML = '<ion-icon name="heart"></ion-icon>&nbsp;' + event.detail.heartCount;
                }
            });
        }
    });
});

window.addEventListener('scrollToTop', event => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

