document.addEventListener("DOMContentLoaded", function() {

    const userModelEl = document.getElementById("deleteUserModal");
    const userDeleteModal = new bootstrap.Modal(userModelEl);
    const deleteButtons = document.querySelectorAll(".openDeleteModal");
    const deleteUserForm = document.getElementById("deleteUserForm");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const action = this.getAttribute("data-action");
            deleteUserForm.setAttribute("action", action);
            userDeleteModal.show();
        });
    });

});
