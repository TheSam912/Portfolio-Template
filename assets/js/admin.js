(function () {
    "use strict";

    // Auto-dismiss flash toasts
    const flash = document.querySelector(".flash");
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = "0";
            flash.style.transform = "translateY(-8px)";
            flash.style.transition = "opacity 0.3s, transform 0.3s";
            setTimeout(() => flash.remove(), 320);
        }, 4200);
    }

    // Live preview: profile fields
    const bindText = (inputId, targetId, attr = "textContent") => {
        const input  = document.getElementById(inputId);
        const target = document.getElementById(targetId);
        if (!input || !target) return;

        const update = () => {
            target[attr] = input.value.trim() || target.dataset.fallback || "—";
        };

        input.addEventListener("input", update);
        update();
    };

    bindText("short_summary", "preview-short-summary");
    bindText("about_summary", "preview-about-summary");
    bindText("contact_email", "preview-email", "textContent");
    bindText("contact_linkedin_text", "preview-linkedin");
    bindText("contact_github_text", "preview-github");
    bindText("contact_location", "preview-location");
    bindText("resume_file", "preview-resume-path");

    // File upload filename hint
    document.querySelectorAll('input[type="file"]').forEach((input) => {
        input.addEventListener("change", () => {
            const hint = input.closest(".file-drop")?.querySelector(".file-name");
            if (!hint) return;
            hint.textContent = input.files?.[0]?.name || "No file chosen";
        });
    });

    // Image preview on upload (projects / skills edit forms)
    document.querySelectorAll("[data-preview-target]").forEach((input) => {
        input.addEventListener("change", (e) => {
            const file = e.target.files?.[0];
            const target = document.getElementById(input.dataset.previewTarget);
            if (!file || !target) return;
            target.src = URL.createObjectURL(file);
        });
    });
})();
