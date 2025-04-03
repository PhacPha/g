// js/scripts.js

document.addEventListener('DOMContentLoaded', () => {
    // Loading Overlay
    const loadingOverlay = document.getElementById('loading-overlay');
    if (loadingOverlay) {
        setTimeout(() => {
            loadingOverlay.classList.add('hidden');
        }, 1000);
    }

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        const isDark = localStorage.getItem('darkMode') === 'true';
        if (isDark) {
            document.body.classList.add('dark');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            const isDarkMode = document.body.classList.contains('dark');
            darkModeToggle.innerHTML = `<i class="fas fa-${isDarkMode ? 'sun' : 'moon'}"></i>`;
            localStorage.setItem('darkMode', isDarkMode);
        });
    }

    // Form Submission with Loading
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent for demo; remove if backend handles
            if (!form.checkValidity()) return;
            const submitBtn = form.querySelector('.btn-save, .btn-add');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
                loadingOverlay.classList.remove('hidden');
                setTimeout(() => {
                    submitBtn.innerHTML = 'Save';
                    submitBtn.disabled = false;
                    loadingOverlay.classList.add('hidden');
                    form.submit(); // Submit form (remove in demo)
                }, 2000);
            }
        });
    });

    // Delete Confirmation
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            const href = button.getAttribute('data-href') || button.getAttribute('href');
            const message = button.getAttribute('data-message') || 'this item';
            const confirmed = await confirmDelete(`Are you sure you want to delete ${message}?`);
            if (confirmed && href) window.location.href = href;
        });
    });

    // Modal Handling
    function showModal(modalId, data = {}) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        Object.entries(data).forEach(([key, value]) => {
            const input = modal.querySelector(`#${key}`);
            if (input) input.value = value;
        });
        modal.classList.remove('hidden');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.add('hidden');
    }

    // Edit Form Example
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const fields = JSON.parse(button.getAttribute('data-fields') || '{}');
            showModal('edit-modal', { 'edit-id': id, ...fields });
        });
    });

    document.querySelectorAll('.btn-cancel, .modal-close').forEach(button => {
        button.addEventListener('click', () => {
            hideModal(button.closest('.modal').id);
        });
    });

    // Responsive Table Adjustments
    function adjustTableLabels() {
        document.querySelectorAll('td').forEach(td => {
            const th = td.closest('table').querySelector(`thead th:nth-child(${Array.from(td.parentNode.children).indexOf(td) + 1})`);
            if (th) td.setAttribute('data-label', th.textContent);
        });
    }
    adjustTableLabels();
    window.addEventListener('resize', adjustTableLabels);
});

// SweetAlert2 Confirmation
async function confirmDelete(message) {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    });
    return result.isConfirmed;
}