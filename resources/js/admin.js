/* Feedback Modal */
if (document.getElementById('admin-dynamic-modal')) {
    const dynamicModal = new bootstrap.Modal(document.getElementById('admin-dynamic-modal'));

    window.addEventListener('show-dynamic-modal', event => {
       dynamicModal.show();
    });

    window.addEventListener('hide-dynamic-modal', event => {
       dynamicModal.hide();
    });
}
