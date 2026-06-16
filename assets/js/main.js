// Front-end behavior for the portfolio site.
// Loaded with `defer`, so the DOM is already parsed when this runs.

(function () {
    "use strict";

    // ===========================
    // MOBILE MENU
    // ===========================

    const menuBtn    = document.querySelector(".menu-toggle");
    const closeBtn   = document.querySelector(".menu-close");
    const mobileMenu = document.querySelector(".mobile-menu");
    const overlay    = document.querySelector(".nav-overlay");

    const openMenu = () => {
        mobileMenu?.classList.add("active");
        overlay?.classList.add("active");
    };

    const closeMenu = () => {
        mobileMenu?.classList.remove("active");
        overlay?.classList.remove("active");
    };

    menuBtn?.addEventListener("click", openMenu);
    closeBtn?.addEventListener("click", closeMenu);
    overlay?.addEventListener("click", closeMenu);

    // Close mobile menu when a link inside it is clicked.
    mobileMenu?.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", closeMenu);
    });

    // ===========================
    // SUCCESS MODAL
    // ===========================

    const modal       = document.getElementById("successModal");
    const closeModal  = document.getElementById("closeModal");

    let autoCloseTimer = null;

    const openModal = () => {
        modal?.classList.add("active");
        clearTimeout(autoCloseTimer);
        autoCloseTimer = setTimeout(() => {
            modal?.classList.remove("active");
        }, 5000);
    };

    const dismissModal = () => {
        modal?.classList.remove("active");
        clearTimeout(autoCloseTimer);
    };

    closeModal?.addEventListener("click", dismissModal);

    modal?.addEventListener("click", (e) => {
        if (e.target === modal) dismissModal();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") dismissModal();
    });

    // ===========================
    // CONTACT FORM
    // ===========================

    const contactForm = document.getElementById("contactForm");
    const submitBtn   = contactForm?.querySelector('button[type="submit"]');

    contactForm?.addEventListener("submit", async (event) => {
        event.preventDefault();

        const originalLabel = submitBtn?.textContent;
        if (submitBtn) {
            submitBtn.disabled    = true;
            submitBtn.textContent = "Sending...";
        }

        try {
            const response = await fetch(contactForm.action, {
                method:  "POST",
                body:    new FormData(contactForm),
                headers: { Accept: "application/json" },
            });

            let result = {};
            try {
                result = await response.json();
            } catch (_) {
                /* non-JSON response: treat as failure */
            }

            if (response.ok && result.success) {
                openModal();
                contactForm.reset();
            } else {
                alert(result.message || "Something went wrong. Please try again.");
            }
        } catch (err) {
            console.error("[contact]", err);
            alert("Network error. Please try again.");
        } finally {
            if (submitBtn) {
                submitBtn.disabled    = false;
                submitBtn.textContent = originalLabel || "Send Message";
            }
        }
    });
})();
