document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;
    const navToggle = document.querySelector('.nav-toggle');
    const navPanel = document.querySelector('.nav-panel');
    const themeToggle = document.querySelector('.theme-toggle');

    if (navToggle && navPanel) {
        navToggle.addEventListener('click', () => {
            const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', String(!isOpen));
            navPanel.classList.toggle('is-open', !isOpen);
        });

        navPanel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                navToggle.setAttribute('aria-expanded', 'false');
                navPanel.classList.remove('is-open');
            });
        });
    }

    if (themeToggle) {
        const updateLabel = () => {
            const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
            themeToggle.setAttribute('aria-label', `Switch to ${nextTheme} theme`);
        };

        updateLabel();
        themeToggle.addEventListener('click', () => {
            root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('vibraze-theme', root.dataset.theme);
            updateLabel();
        });
    }

    document.querySelectorAll('[data-dialog-open]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const dialog = document.getElementById(trigger.dataset.dialogOpen);
            const form = dialog?.querySelector('[data-dialog-form]');
            if (form && trigger.dataset.action) form.action = trigger.dataset.action;
            dialog?.showModal();
        });
    });

    document.querySelectorAll('[data-dialog-close]').forEach((trigger) => {
        trigger.addEventListener('click', () => trigger.closest('dialog')?.close());
    });

    document.querySelectorAll('dialog').forEach((dialog) => {
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) dialog.close();
        });
    });
});
