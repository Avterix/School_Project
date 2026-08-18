/* ============================================================
   ALWAYS RELOAD AT THE TOP OF THE PAGE
   Browsers by default try to restore the last scroll position on
   reload — this turns that off and forces scroll(0,0) every time.
============================================================ */
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
window.scrollTo(0, 0);

window.addEventListener('load', () => {
    window.scrollTo(0, 0);
});

document.addEventListener('DOMContentLoaded', () => {
    // 1. Live Time Formatting
    const timeDisplay = document.getElementById('live-time');
    
    const updateTime = () => {
        if(!timeDisplay) return;
        
        const now = new Date();
        
        // Format Time (e.g. 6:30pm)
        let hours = now.getHours();
        let minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'pm' : 'am';
        
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        
        const timeString = `${hours}:${minutes}${ampm}`;
        
        // Format Date (e.g. 23 June, 2024)
        const day = now.getDate();
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const monthString = months[now.getMonth()];
        const year = now.getFullYear();
        
        const dateString = `${day} ${monthString}, ${year}`;
        
        // Combine
        timeDisplay.innerHTML = `${timeString} &bull; ${dateString}`;
    };

    // Initialize and set interval
    updateTime();
    setInterval(updateTime, 60000); // Update every minute

    // 2. Simple Parallax Effect for Background Text
    const bgText = document.querySelector('.background-massive-text');
    
    document.addEventListener('mousemove', (e) => {
        if(!bgText) return;
        const x = (window.innerWidth - e.pageX * 2) / 100;
        const y = (window.innerHeight - e.pageY * 2) / 100;
        
        bgText.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
    });
});
// 3. Typewriter Effect dengan Kursor & Looping Text Animation
const dynamicWord = document.getElementById('dynamic-word');
const words = ['future...', 'product..', 'brands...'];
let wordIndex = 0;
let charIndex = 0;
let isDeleting = false;
let typeSpeed = 150; // Kecepatan ngetik

function type() {
    const currentWord = words[wordIndex];
    
    if (isDeleting) {
        // Hapus karakter
        dynamicWord.textContent = currentWord.substring(0, charIndex - 1);
        charIndex--;
        typeSpeed = 70; // Lebih cepet pas ngehapus
    } else {
        // Nambah karakter
        dynamicWord.textContent = currentWord.substring(0, charIndex + 1);
        charIndex++;
        typeSpeed = 150; // Normal pas ngetik
    }

    // Kalau kata udah selesai diketik
    if (!isDeleting && charIndex === currentWord.length) {
        isDeleting = true;
        typeSpeed = 2000; // Jeda sebelum mulai hapus (2 detik)
    } 
    // Kalau kata udah selesai dihapus
    else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % words.length; // Pindah ke kata selanjutnya
        typeSpeed = 500; // Jeda sebelum mulai ngetik lagi
    }

    setTimeout(type, typeSpeed);
}

// Jalankan fungsi
if (dynamicWord) {
    type();
}

    // 4. Fullscreen Menu Toggle
    const menuBtn = document.querySelector('.menu-toggle-btn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    const fullscreenMenu = document.getElementById('fullscreenMenu');

    if (menuBtn && fullscreenMenu && closeMenuBtn) {
        menuBtn.addEventListener('click', () => {
            fullscreenMenu.classList.add('active');
            // Supaya ga bisa scroll body pas menu kebuka
            document.body.style.overflow = 'hidden'; 
        });

        closeMenuBtn.addEventListener('click', () => {
            fullscreenMenu.classList.remove('active');
            // Balikin scroll
            document.body.style.overflow = 'auto'; 
        });
    }

    // 5. Interactive Card Slider (Design to explore)
    const navDots = document.querySelectorAll('.nav-dots .dot');
    const sliderThumb = document.querySelector('.slider-thumb');
    const cardTitle = document.querySelector('.card-text-content h3');
    
    // Data state untuk tiap dot (teks & posisi thumb)
    const cardStates = [
        { title: "Design to<br>explore.", thumbPos: "0px" },
        { title: "Code to<br>innovate.", thumbPos: "45px" } // 60px track - 15px thumb
    ];

    navDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            // Hapus class active dari semua dot, tambahin ke dot yg diklik
            navDots.forEach(d => d.classList.remove('active'));
            dot.classList.add('active');

            // Geser Thumb UI
            sliderThumb.style.left = cardStates[index].thumbPos;

            // Efek ganti teks
            cardTitle.style.opacity = '0';
            setTimeout(() => {
                cardTitle.innerHTML = cardStates[index].title;
                cardTitle.style.opacity = '1';
            }, 300); // Waktu ganti menyesuaikan durasi fade out CSS
        });
    });
/* ─────────────────────────────────────────────────
   SPLASH
───────────────────────────────────────────────── */
/* ─────────────────────────────────────────────────
   SPLASH SCREEN (PERFECT GEOMETRY, ANTI-BUG, & ANTI-FREEZE)
───────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Live Time Formatting (Biarin kodingan lu yg lama)
    const timeDisplay = document.getElementById('live-time');
    const updateTime = () => { /* ... kode waktu lu ... */ };
    if (timeDisplay) { updateTime(); setInterval(updateTime, 60000); }

    // 2. Simple Parallax Effect (Biarin kodingan lu yg lama)
    const bgText = document.querySelector('.background-massive-text');
    document.addEventListener('mousemove', (e) => { /* ... parallax lu ... */ });

    // 3. FUNGSI SPLASH KOMPLIT
    const initSplash = () => {
        const splash = document.getElementById('splash');
        if (!splash) return;

        // KUNCI 1: Kunci scroll dan mouse dari user pas awal load
        document.body.classList.add('locked');

        // Waktu mulai (Buat ngecek tab freeze)
        const startTime = Date.now();
        const totalSplashDuration = 4500; // Estimasi total waktu animasi (4.5 detik)

        // Fungsi penutup biar bersih (Dipakai normal maupun darurat)
        const closeSplash = () => {
            splash.classList.add('exit');
            setTimeout(() => {
                splash.style.display = 'none';
                document.body.classList.remove('locked'); // Buka kunci scroll
                document.body.classList.add('start-anim'); // Aba-aba buat animasi CSS masuk
            }, 900);
        };

        const tl = gsap.timeline({
            onComplete: closeSplash
        });

        // SETUP AWAL (Kode lu asli)
        gsap.set(".logo-part", { strokeDasharray: 500,  stroke: "#0d0d0d", strokeWidth: 0.5, strokeDashoffset: 500, fill: "transparent", opacity: 0 });
        gsap.set(".part-hook", { x: 40, y: -40, scale: 0.8 });
        gsap.set(".part-diag", { x: -10, y: 0, scale: 0.8 });
        gsap.set(".splash-title, .splash-sub", { opacity: 0, y: 15 });

        // ANIMASI (Kode lu asli)
        tl.to(".logo-part", { opacity: 1, strokeDashoffset: 0, duration: 1.2, ease: "power3.inOut" })
          .to([".part-hook", ".part-diag"], { x: 0, y: 0, scale: 1, duration: 0.8, stagger: 0.1, ease: "expo.out" }, "-=0.2")
          .to(".logo-part", { fill: "#0d0d0d", stroke: "#0d0d0d", strokeWidth: 0, duration: 0.4 }, "-=0.2")
          .to(".part-diag", { fill: "#0d0d0d", stroke: "#0d0d0d", duration: 0.4 }, "-=0.2") 
          .to([".splash-title", ".splash-sub"], { opacity: 1, y: 0, duration: 0.7, stagger: 0.2, ease: "power2.out" }, "-=0.2")
          .to({}, { duration: 1.5 });

        // PERSENTASE ANGKA (Kode lu asli)
        let n = 0;
        const pctEl = splash.querySelector('.splash-pct');
        const iv = setInterval(() => {
            n += Math.floor(Math.random() * 9) + 2;
            if (n >= 100) { n = 100; clearInterval(iv); }
            if (pctEl) pctEl.textContent = n + '%';
        }, 50);

        // KUNCI 2: ANTI-FREEZE SAAT TAB BACKGROUND
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                const timeElapsed = Date.now() - startTime;
                
                // Kalau user ngebuka tab setelah 4.5 detik (animasi harusnya udah kelar)
                if (timeElapsed > totalSplashDuration) {
                    tl.progress(1); // Paksa GSAP instan lompat ke animasi 100% selesai
                    clearInterval(iv); // Stop hitungan interval biar ga error
                    if (pctEl) pctEl.textContent = '100%';
                    // Nggak perlu manggil closeSplash() lagi, karena tl.progress(1) 
                    // bakal otomatis nge-trigger onComplete dari timeline GSAP-nya
                }
            }
        });
    };

    // Eksekusi jalan
    initSplash();
});
/* ============================================================
   PRODUCT SECTION — reveal-on-scroll, nav contrast swap,
   size/colour selectors, thumbnail gallery, add-to-bag feedback
============================================================ */
document.addEventListener('DOMContentLoaded', () => {

    // 6. Reveal-on-scroll (Multi-direction setup)
    const revealEls = document.querySelectorAll('.reveal-from-bottom, .reveal-from-left, .reveal-from-right, .reveal-scale');
    
    if (revealEls.length) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    revealObserver.unobserve(entry.target); // Animasi cuma jalan 1x
                }
            });
        }, { threshold: 0.15 }); // 0.15 biar nunggu masuk layar dikit baru dijalanin

        revealEls.forEach((el) => revealObserver.observe(el));
    }

    // 7. Fixed navbar switches to a dark-friendly palette while the
    // black product section is behind it, so it stays readable.
    const navbar = document.querySelector('.navbar');
    const productSection = document.getElementById('product');

    if (navbar && productSection) {
        const navObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                navbar.classList.toggle('on-dark', entry.isIntersecting);
            });
        }, { threshold: 0.35 });

        navObserver.observe(productSection);
    }

    // 8. Size & colour pill selectors
    const setupOptionRow = (rowId) => {
        const row = document.getElementById(rowId);
        if (!row) return;
        row.addEventListener('click', (e) => {
            const btn = e.target.closest('.option-btn');
            if (!btn) return;
            row.querySelectorAll('.option-btn').forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');
        });
    };
    setupOptionRow('sizeRow');
    setupOptionRow('colourRow');

    // 9. Thumbnail gallery — swaps a CSS filter on the main photo to stand
    // in for a different angle/colourway until real product photos are
    // dropped in (just replace the img src's when they're ready).
    const mainProductImg = document.getElementById('mainProductImg');
    const productThumbs = document.getElementById('productThumbs');

    if (mainProductImg && productThumbs) {
        productThumbs.addEventListener('click', (e) => {
            const thumb = e.target.closest('.thumb-item');
            if (!thumb) return;

            productThumbs.querySelectorAll('.thumb-item').forEach((t) => t.classList.remove('active'));
            thumb.classList.add('active');

            mainProductImg.style.filter = thumb.getAttribute('data-filter') || 'none';
        });
    }

    // 10. "+ Details" accordion for the fabric/description copy
    const detailsToggle = document.getElementById('detailsToggle');
    const productDesc = document.getElementById('productDesc');

    if (detailsToggle && productDesc) {
        detailsToggle.addEventListener('click', () => {
            const isOpen = productDesc.classList.toggle('is-open');
            detailsToggle.classList.toggle('is-open', isOpen);
            const icon = detailsToggle.querySelector('.toggle-icon');
            if (icon) icon.textContent = isOpen ? '×' : '+';
        });
    }

    // 11. Add to Bag — quick confirmation feedback, then resets itself
    const addToBagBtn = document.getElementById('addToBagBtn');
    if (addToBagBtn) {
        const label = addToBagBtn.querySelector('.btn-label');
        const originalLabel = label ? label.textContent : 'Add to Bag';
        let resetTimer = null;

        addToBagBtn.addEventListener('click', () => {
            addToBagBtn.classList.add('added');
            if (label) label.textContent = 'Added ✓';

            clearTimeout(resetTimer);
            resetTimer = setTimeout(() => {
                addToBagBtn.classList.remove('added');
                if (label) label.textContent = originalLabel;
            }, 1800);
        });
    }
});
/* ============================================================
   12. FULLPAGE SCROLL SNAP (JS ONLY)
============================================================ */
const sections = document.querySelectorAll('section'); // Target semua <section>
let currentSection = 0;
let isScrolling = false;

// Supaya pas di-refresh selalu mulai dari indeks 0 (Paling atas)
window.addEventListener('load', () => {
    currentSection = 0;
});
// ============================================================
//   LENIS SMOOTH SCROLL SETUP
// ============================================================
const lenis = new Lenis({
    duration: 1.2, // Atur angka ini buat ngubah seberapa "ngambang" scrollnya
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), 
    smoothWheel: true,
    wheelMultiplier: 1, // Kecepatan scroll mouse biasa
});

// Loop biar Lenis jalan terus seirama sama refresh rate monitor
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);
// Brands Interaction Logic
const brandsContainer = document.getElementById('brandsContainer');
const items = document.querySelectorAll('.orbit-item');
const detailsPanel = document.querySelector('.partner-details-panel');
const closeBtn = document.querySelector('.close-btn');

items.forEach(item => {
    item.addEventListener('click', () => {
        // Isi data ke panel
        document.getElementById('detailTitle').innerText = item.dataset.title;
        document.getElementById('detailDesc').innerText = item.dataset.desc;
        document.getElementById('detailImg').src = item.dataset.img;

        // Aktifkan panel
        brandsContainer.classList.add('is-active');
    });
});

closeBtn.addEventListener('click', () => {
    brandsContainer.classList.remove('is-active');
});

// Project Section — tap-to-expand (mirrors the hover behaviour for touch devices)
const projectTrack = document.getElementById('projectTrack');
if (projectTrack) {
    const projectCards = projectTrack.querySelectorAll('.project-card');
    projectTrack.addEventListener('click', (e) => {
        const card = e.target.closest('.project-card');
        if (!card) return;

        projectCards.forEach((c) => c.classList.remove('is-open'));
        card.classList.add('is-open');
    });
}