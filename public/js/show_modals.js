document.addEventListener("DOMContentLoaded", function() {

    const modelEl = document.getElementById("deleteUserModal");
    const userDeleteModal = new bootstrap.Modal(modelEl);
    const deleteButtons  = document.querySelectorAll(".openDeleteModal");
    const confirmDeleteLink = document.getElementById("confirmDeleteLink");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const userId = this.getAttribute("data-user-id");
            confirmDeleteLink.href = `/delete-user/${userId}`;
            userDeleteModal.show();
        });
    });

});
