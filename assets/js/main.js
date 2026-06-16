// =====================================================
//  Sam Nolan portfolio — front-end behavior
//  Loaded with `defer`, so the DOM is parsed when this runs.
// =====================================================

(function () {
    "use strict";

    const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const fine    = window.matchMedia("(hover: hover) and (pointer: fine)").matches;

    document.addEventListener("DOMContentLoaded", () => {
        initMobileMenu();
        initSuccessModal();
        initContactForm();
        initRevealOnScroll();
        initStaggerChildren();
        initStatsCounters();
        initNavbarScrollState();
        initActiveNavHighlight();
        initMagneticButtons();
        initServiceCardTilt();
        initCustomCursor();
    });

    // ===========================
    //  MOBILE MENU
    // ===========================

    function initMobileMenu() {

        const menuBtn    = document.querySelector(".menu-toggle");
        const closeBtn   = document.querySelector(".menu-close");
        const mobileMenu = document.querySelector(".mobile-menu");
        const overlay    = document.querySelector(".nav-overlay");

        if (!mobileMenu || !overlay) return;

        const open  = () => { mobileMenu.classList.add("active");    overlay.classList.add("active");    document.body.style.overflow = "hidden"; };
        const close = () => { mobileMenu.classList.remove("active"); overlay.classList.remove("active"); document.body.style.overflow = "";        };

        menuBtn?.addEventListener("click",  open);
        closeBtn?.addEventListener("click", close);
        overlay?.addEventListener("click",  close);
        mobileMenu.querySelectorAll("a").forEach((a) => a.addEventListener("click", close));

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && mobileMenu.classList.contains("active")) close();
        });
    }

    // ===========================
    //  SUCCESS MODAL
    // ===========================

    let modalAutoClose = null;

    function openSuccessModal() {
        const modal = document.getElementById("successModal");
        if (!modal) return;

        modal.classList.add("active");
        clearTimeout(modalAutoClose);
        modalAutoClose = setTimeout(() => modal.classList.remove("active"), 5000);
    }

    function dismissSuccessModal() {
        const modal = document.getElementById("successModal");
        if (!modal) return;

        modal.classList.remove("active");
        clearTimeout(modalAutoClose);
    }

    function initSuccessModal() {

        const modal      = document.getElementById("successModal");
        const closeBtn   = document.getElementById("closeModal");

        if (!modal) return;

        closeBtn?.addEventListener("click", dismissSuccessModal);
        modal.addEventListener("click", (e) => {
            if (e.target === modal) dismissSuccessModal();
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") dismissSuccessModal();
        });
    }

    // ===========================
    //  CONTACT FORM
    // ===========================

    function initContactForm() {

        const form     = document.getElementById("contactForm");
        const button   = form?.querySelector('button[type="submit"]');

        if (!form) return;

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            const originalLabel = button?.textContent;

            if (button) {
                button.disabled    = true;
                button.textContent = "Sending...";
            }

            try {
                const response = await fetch(form.action, {
                    method:  "POST",
                    body:    new FormData(form),
                    headers: { Accept: "application/json" },
                });

                let result = {};
                try { result = await response.json(); } catch (_) { /* not json */ }

                if (response.ok && result.success) {
                    openSuccessModal();
                    form.reset();
                } else {
                    alert(result.message || "Something went wrong. Please try again.");
                }
            } catch (err) {
                console.error("[contact]", err);
                alert("Network error. Please try again.");
            } finally {
                if (button) {
                    button.disabled    = false;
                    button.textContent = originalLabel || "Send Message";
                }
            }
        });
    }

    // ===========================
    //  SCROLL REVEAL  (data-reveal)
    // ===========================

    function initRevealOnScroll() {

        const targets = document.querySelectorAll("[data-reveal]");
        if (!targets.length || reduced || !("IntersectionObserver" in window)) {
            targets.forEach((el) => el.classList.add("is-in-view"));
            return;
        }

        const io = new IntersectionObserver(
            (entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        const el    = entry.target;
                        const delay = parseInt(el.dataset.revealDelay, 10) || 0;

                        if (delay) el.style.transitionDelay = `${delay}ms`;

                        el.classList.add("is-in-view");
                        io.unobserve(el);
                    }
                }
            },
            { threshold: 0.12, rootMargin: "0px 0px -8% 0px" }
        );

        targets.forEach((el) => io.observe(el));
    }

    // Stagger direct children of any [data-reveal-stagger] container.
    function initStaggerChildren() {
        document.querySelectorAll("[data-reveal-stagger]").forEach((parent) => {
            Array.from(parent.children).forEach((child, i) => {
                child.setAttribute("data-reveal-child", "");
                child.style.setProperty("--i", i);
            });
        });
    }

    // ===========================
    //  STATS COUNTERS
    // ===========================

    function initStatsCounters() {

        const items = document.querySelectorAll(".stats-item");
        if (!items.length) return;

        const animateOne = (el) => {

            const numEl = el.querySelector("h3");
            if (!numEl || numEl.dataset.counted) return;

            const raw    = numEl.textContent.trim();
            const match  = raw.match(/^(\d+(?:\.\d+)?)/);
            if (!match) { numEl.dataset.counted = "1"; return; }

            const target = parseFloat(match[1]);
            const suffix = raw.slice(match[1].length);
            const dur    = reduced ? 1 : 2200;
            const start  = performance.now();

            numEl.dataset.counted = "1";

            const tick = (now) => {
                const t   = Math.min(1, (now - start) / dur);
                // ease-out-expo
                const eased = t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
                const value = target * eased;
                const out   = Number.isInteger(target)
                    ? Math.round(value).toString()
                    : value.toFixed(1);
                numEl.textContent = out + suffix;
                if (t < 1) requestAnimationFrame(tick);
            };

            requestAnimationFrame(tick);
        };

        if (!("IntersectionObserver" in window) || reduced) {
            items.forEach(animateOne);
            return;
        }

        const io = new IntersectionObserver(
            (entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        animateOne(entry.target);
                        entry.target.classList.add("is-in-view");
                        io.unobserve(entry.target);
                    }
                }
            },
            { threshold: 0.4 }
        );

        items.forEach((el) => io.observe(el));
    }

    // ===========================
    //  NAVBAR — scrolled state
    // ===========================

    function initNavbarScrollState() {

        const nav = document.querySelector(".navbar");
        if (!nav) return;

        let ticking = false;

        const update = () => {
            nav.classList.toggle("scrolled", window.scrollY > 32);
            ticking = false;
        };

        window.addEventListener("scroll", () => {
            if (!ticking) {
                requestAnimationFrame(update);
                ticking = true;
            }
        }, { passive: true });

        update();
    }

    // ===========================
    //  ACTIVE NAV LINK
    // ===========================

    function initActiveNavHighlight() {

        const links = document.querySelectorAll(".nav-links a[href^='#']");
        if (!links.length || !("IntersectionObserver" in window)) return;

        const map = new Map();

        links.forEach((link) => {
            const id = link.getAttribute("href").slice(1);
            const section = document.getElementById(id);
            if (section) map.set(section, link);
        });

        if (!map.size) return;

        const io = new IntersectionObserver(
            (entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        links.forEach((l) => l.classList.remove("active"));
                        map.get(entry.target)?.classList.add("active");
                    }
                }
            },
            { threshold: 0.45, rootMargin: "-20% 0px -45% 0px" }
        );

        map.forEach((_, section) => io.observe(section));
    }

    // ===========================
    //  MAGNETIC BUTTONS
    // ===========================

    function initMagneticButtons() {

        if (!fine || reduced) return;

        const els = document.querySelectorAll("[data-magnetic]");
        const STRENGTH = 0.25;

        els.forEach((el) => {

            el.addEventListener("mousemove", (e) => {
                const rect = el.getBoundingClientRect();
                const dx   = e.clientX - (rect.left + rect.width  / 2);
                const dy   = e.clientY - (rect.top  + rect.height / 2);
                el.style.transform = `translate3d(${dx * STRENGTH}px, ${dy * STRENGTH}px, 0)`;
            });

            el.addEventListener("mouseleave", () => {
                el.style.transform = "";
            });
        });
    }

    // ===========================
    //  3D CARD TILT  (.service-card)
    // ===========================

    function initServiceCardTilt() {

        if (!fine || reduced) return;

        const cards    = document.querySelectorAll(".service-card");
        const MAX_TILT = 8;

        cards.forEach((card) => {

            let rect = null;

            const onEnter = () => { rect = card.getBoundingClientRect(); };

            const onMove = (e) => {
                if (!rect) rect = card.getBoundingClientRect();
                const px = (e.clientX - rect.left) / rect.width;
                const py = (e.clientY - rect.top)  / rect.height;
                const rx = (0.5 - py) * MAX_TILT;
                const ry = (px - 0.5) * MAX_TILT;
                card.style.transform =
                    `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`;
            };

            const onLeave = () => {
                card.style.transform = "";
                rect = null;
            };

            card.addEventListener("mouseenter", onEnter);
            card.addEventListener("mousemove",  onMove);
            card.addEventListener("mouseleave", onLeave);
        });
    }

    // ===========================
    //  CUSTOM CURSOR  (desktop only)
    // ===========================

    function initCustomCursor() {

        if (!fine || reduced) return;

        const dot  = document.createElement("div");
        const ring = document.createElement("div");
        dot.className  = "cursor-dot";
        ring.className = "cursor-ring";
        dot.setAttribute("aria-hidden", "true");
        ring.setAttribute("aria-hidden", "true");
        document.body.append(dot, ring);

        let dx = 0, dy = 0;   // dot
        let rx = 0, ry = 0;   // ring (lags slightly)
        let mx = 0, my = 0;   // pointer

        const onMove = (e) => {
            mx = e.clientX;
            my = e.clientY;
            if (!document.body.classList.contains("cursor-ready")) {
                document.body.classList.add("cursor-ready");
            }
        };

        document.addEventListener("mousemove", onMove, { passive: true });

        const tick = () => {
            // dot follows pointer almost exactly
            dx += (mx - dx) * 0.6;
            dy += (my - dy) * 0.6;
            // ring lags for nice trail
            rx += (mx - rx) * 0.18;
            ry += (my - ry) * 0.18;
            dot.style.transform  = `translate3d(${dx}px, ${dy}px, 0) translate(-50%, -50%)`;
            ring.style.transform = `translate3d(${rx}px, ${ry}px, 0) translate(-50%, -50%)`;
            requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);

        const hoverSelector = "a, button, [role='button'], .service-card, .portfolio-item, .skill-item, input, textarea, select, label, .info-card";

        document.addEventListener("mouseover", (e) => {
            if (e.target.closest(hoverSelector)) {
                document.body.classList.add("cursor-hover");
            }
        });

        document.addEventListener("mouseout", (e) => {
            if (e.target.closest(hoverSelector)) {
                document.body.classList.remove("cursor-hover");
            }
        });

        document.addEventListener("mouseleave", () => {
            document.body.classList.remove("cursor-ready");
        });

        document.addEventListener("mouseenter", () => {
            document.body.classList.add("cursor-ready");
        });
    }
})();
