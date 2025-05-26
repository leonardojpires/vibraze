document.addEventListener("DOMContentLoaded", function() {

    const bandModelEl = document.getElementById("deleteBandModal");
    const bandDeleteModal = new bootstrap.Modal(bandModelEl);
    const bandDeleteButtons = document.querySelectorAll(".openBandDeleteModal");
    const deleteBandForm = document.getElementById("deleteBandForm");

    bandDeleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const action = this.getAttribute("data-action");
            deleteBandForm.setAttribute("action", action);
            bandDeleteModal.show();
        });
    });

});
