<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalTitle">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="confirmModalBody">
                Are you sure you want to proceed?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="confirmModalForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" id="confirmModalButton">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle confirmation modals for forms
    document.querySelectorAll('form[data-confirm]').forEach(function(form) {
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                const title = form.getAttribute('data-title') || 'Confirm Action';
                const message = form.getAttribute('data-confirm') || 'Are you sure you want to proceed?';
                
                document.getElementById('confirmModalTitle').textContent = title;
                document.getElementById('confirmModalBody').textContent = message;
                
                const confirmForm = document.getElementById('confirmModalForm');
                confirmForm.action = form.action;
                confirmForm.method = form.method;
                
                // Clear previous hidden inputs
                confirmForm.querySelectorAll('input[type="hidden"]').forEach(function(input) {
                    if (input.name !== '_token') {
                        input.remove();
                    }
                });
                
                // Copy CSRF token
                const csrfToken = form.querySelector('input[name="_token"]')?.value;
                if (csrfToken) {
                    let csrfInput = confirmForm.querySelector('input[name="_token"]');
                    if (!csrfInput) {
                        csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        confirmForm.appendChild(csrfInput);
                    }
                    csrfInput.value = csrfToken;
                }
                
                // Copy all hidden inputs from original form
                form.querySelectorAll('input[type="hidden"]').forEach(function(input) {
                    if (input.name !== '_token') {
                        const newInput = input.cloneNode(true);
                        confirmForm.appendChild(newInput);
                    }
                });
                
                // Handle form submission
                confirmForm.onsubmit = function() {
                    form.submit();
                };
                
                modal.show();
            });
        }
    });
});
</script>

