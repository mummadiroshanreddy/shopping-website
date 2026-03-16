/**
 * Phlox Luxe — app.js
 * Premium UX interactions: animations, cart drawer, FAQ, mobile menu, newsletter popup, wishlist
 */

(function () {
  'use strict';

  /* ──────────────────────────────────
     UTILITY
  ────────────────────────────────── */
  const $ = (s, ctx = document) => ctx.querySelector(s);
  const $$ = (s, ctx = document) => [...ctx.querySelectorAll(s)];

  /* ──────────────────────────────────
     ANNOUNCEMENT BAR
  ────────────────────────────────── */
  const announceClose = $('#luxe-announce-close');
  if (announceClose) {
    announceClose.addEventListener('click', () => {
      const bar = $('#luxe-announce');
      if (bar) { bar.style.height = bar.offsetHeight + 'px'; bar.style.overflow = 'hidden'; bar.style.transition = 'height 0.3s ease'; setTimeout(() => { bar.style.height = '0'; bar.style.padding = '0'; }, 10); setTimeout(() => bar.remove(), 350); }
      sessionStorage.setItem('hideAnnounce', '1');
    });
    if (sessionStorage.getItem('hideAnnounce')) { const bar = $('#luxe-announce'); if (bar) bar.remove(); }
  }

  /* ──────────────────────────────────
     STICKY NAV — add scrolled class
  ────────────────────────────────── */
  const nav = $('#luxe-nav');
  if (nav) {
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 60);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ──────────────────────────────────
     MOBILE MENU
  ────────────────────────────────── */
  const hamburger = $('#nav-hamburger');
  const mobileMenu = $('#mobile-menu');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      const open = hamburger.classList.toggle('open');
      mobileMenu.classList.toggle('open', open);
      hamburger.setAttribute('aria-expanded', open);
      document.body.style.overflow = open ? 'hidden' : '';
    });
    mobileMenu.addEventListener('click', e => {
      if (e.target.tagName === 'A') {
        hamburger.classList.remove('open');
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  /* ──────────────────────────────────
     HERO ANIMATION
  ────────────────────────────────── */
  const hero = $('#luxe-hero');
  if (hero) { setTimeout(() => hero.classList.add('loaded'), 100); }

  /* ──────────────────────────────────
     SCROLL REVEAL
  ────────────────────────────────── */
  const reveals = $$('.reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(el => io.observe(el));
  } else {
    reveals.forEach(el => el.classList.add('visible'));
  }

  /* ──────────────────────────────────
     CART DRAWER
  ────────────────────────────────── */
  const cartOverlay = $('#cart-overlay');
  const cartDrawer  = $('#cart-drawer');
  const openCart = () => {
    if (!cartOverlay || !cartDrawer) return;
    cartOverlay.classList.add('open');
    cartDrawer.classList.add('open');
    document.body.style.overflow = 'hidden';
  };
  const closeCart = () => {
    cartOverlay.classList.remove('open');
    cartDrawer.classList.remove('open');
    document.body.style.overflow = '';
  };
  const cartToggle = $('#cart-toggle');
  const cartClose  = $('#cart-close');
  if (cartToggle) cartToggle.addEventListener('click', openCart);
  if (cartClose)  cartClose.addEventListener('click', closeCart);
  if (cartOverlay) cartOverlay.addEventListener('click', closeCart);

  /* Quick Add to Cart */
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.product-quick-add');
    if (!btn) return;
    const id = btn.dataset.id;
    if (!id || typeof luxeData === 'undefined') return;

    btn.textContent = '✓ Added!';
    btn.style.background = 'var(--clr-accent)';
    setTimeout(() => { btn.textContent = '+ Quick Add'; btn.style.background = ''; }, 2000);

    fetch(luxeData.ajaxUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `action=luxe_add_to_cart&product_id=${id}&quantity=1&nonce=${luxeData.nonce}`
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        const badge = $('#cart-count');
        if (badge) badge.textContent = data.data.count;
        setTimeout(openCart, 400);
      }
    })
    .catch(() => {});
  });

  /* ──────────────────────────────────
     WISHLIST TOGGLE
  ────────────────────────────────── */
  const WISHLIST_KEY = 'luxe_wishlist';
  const getWishlist = () => JSON.parse(localStorage.getItem(WISHLIST_KEY) || '[]');
  const saveWishlist = (arr) => localStorage.setItem(WISHLIST_KEY, JSON.stringify(arr));

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.wishlist-toggle');
    if (!btn) return;
    const id = String(btn.dataset.id);
    let list = getWishlist();
    const icon = btn.querySelector('i');
    if (list.includes(id)) {
      list = list.filter(x => x !== id);
      if (icon) { icon.className = 'fa-regular fa-heart'; }
      btn.classList.remove('wishlisted');
    } else {
      list.push(id);
      if (icon) { icon.className = 'fa-solid fa-heart'; }
      btn.classList.add('wishlisted');
      btn.style.transform = 'scale(1.3)';
      setTimeout(() => btn.style.transform = '', 300);
    }
    saveWishlist(list);
  });

  // Restore wishlist state on page load
  const wl = getWishlist();
  wl.forEach(id => {
    const btn = $$(`.wishlist-toggle[data-id="${id}"]`);
    btn.forEach(b => {
      b.classList.add('wishlisted');
      const icon = b.querySelector('i');
      if (icon) icon.className = 'fa-solid fa-heart';
    });
  });

  /* ──────────────────────────────────
     FAQ ACCORDION
  ────────────────────────────────── */
  $$('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      $$('.faq-item.open').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ──────────────────────────────────
     PRODUCT PAGE — TABS
  ────────────────────────────────── */
  $$('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tab;
      $$('.tab-btn').forEach(b => b.classList.remove('active'));
      $$('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      const panel = $(`#tab-${target}`);
      if (panel) panel.classList.add('active');
    });
  });

  /* ──────────────────────────────────
     PRODUCT THUMBNAIL SWAPPER
  ────────────────────────────────── */
  $$('.product-thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
      $$('.product-thumb').forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
      const mainImg = $('.product-main-img img');
      const src = thumb.querySelector('img')?.src;
      if (mainImg && src) mainImg.src = src;
    });
  });

  /* ──────────────────────────────────
     SIZE / COLOR SELECTORS
  ────────────────────────────────── */
  $$('.size-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const parent = btn.closest('.size-options');
      if (parent) $$('.size-btn', parent).forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });
  $$('.color-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const parent = btn.closest('.color-options');
      if (parent) $$('.color-btn', parent).forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  /* ──────────────────────────────────
     QUANTITY CONTROLS (standalone)
  ────────────────────────────────── */
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.qty-btn');
    if (!btn) return;
    const control = btn.closest('.qty-control') || btn.closest('.cart-item-qty');
    if (!control) return;
    const numEl = control.querySelector('.qty-num');
    if (!numEl) return;
    let val = parseInt(numEl.textContent, 10) || 1;
    if (btn.textContent.trim() === '−' || btn.textContent.trim() === '-') val = Math.max(1, val - 1);
    else val += 1;
    numEl.textContent = val;
  });

  /* ──────────────────────────────────
     NEWSLETTER POPUP
  ────────────────────────────────── */
  const popup      = $('#newsletter-popup');
  const popupClose = $('#popup-close');
  const popupDismiss = $('#popup-dismiss');

  const showPopup = () => {
    if (popup && !sessionStorage.getItem('popupShown')) {
      popup.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  };
  const hidePopup = () => {
    if (!popup) return;
    popup.classList.remove('show');
    document.body.style.overflow = '';
    sessionStorage.setItem('popupShown', '1');
  };

  if (popupClose) popupClose.addEventListener('click', hidePopup);
  if (popupDismiss) popupDismiss.addEventListener('click', hidePopup);
  if (popup) popup.addEventListener('click', (e) => { if (e.target === popup) hidePopup(); });

  // Show after 5 seconds
  if (popup && !sessionStorage.getItem('popupShown')) {
    setTimeout(showPopup, 5000);
  }

  // Popup form submit
  const popupForm = $('#popup-form');
  if (popupForm) {
    popupForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const input = popupForm.querySelector('input[type="email"]');
      if (input) {
        popupForm.innerHTML = '<p style="color:var(--clr-accent);font-weight:600;font-size:1rem;">🎉 You\'re in! Check your inbox for your discount code.</p>';
        setTimeout(hidePopup, 2500);
      }
    });
  }

  // Footer / inline newsletter forms
  $$('.newsletter-form, #footer-newsletter').forEach(form => {
    if (form.id === 'popup-form') return;
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = form.querySelector('button');
      if (btn) { btn.textContent = '✓ Subscribed!'; btn.style.background = '#2ecc71'; }
    });
  });

  /* ──────────────────────────────────
     SEARCH TOGGLE (basic)
  ────────────────────────────────── */
  const searchToggle = $('#search-toggle');
  if (searchToggle) {
    searchToggle.addEventListener('click', () => {
      let overlay = $('#search-overlay');
      if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'search-overlay';
        overlay.innerHTML = `
          <div id="search-box">
            <input type="search" id="search-input" placeholder="Search products…" autocomplete="off" autofocus>
            <button id="search-go" class="btn btn-accent">Search</button>
            <button id="search-x">✕</button>
          </div>`;
        overlay.style.cssText = 'position:fixed;inset:0;z-index:500;background:rgba(0,0,0,0.85);display:flex;align-items:center;justify-content:center;';
        overlay.querySelector('#search-box').style.cssText = 'display:flex;gap:0.5rem;width:min(600px,90vw);';
        overlay.querySelector('#search-input').style.cssText = 'flex:1;padding:1rem 1.5rem;border:none;border-radius:2px;font-size:1rem;';
        overlay.querySelector('#search-x').style.cssText = 'background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer;padding:0 0.5rem;';
        document.body.appendChild(overlay);
        overlay.querySelector('#search-x').addEventListener('click', () => overlay.remove());
        overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.remove(); });
        overlay.querySelector('#search-go').addEventListener('click', () => {
          const q = overlay.querySelector('#search-input').value.trim();
          if (q && typeof luxeData !== 'undefined') window.location = luxeData.shopUrl + '?s=' + encodeURIComponent(q);
        });
        overlay.querySelector('#search-input').addEventListener('keydown', (e) => {
          if (e.key === 'Enter') {
            const q = e.target.value.trim();
            if (q && typeof luxeData !== 'undefined') window.location = luxeData.shopUrl + '?s=' + encodeURIComponent(q);
          }
        });
      } else {
        overlay.remove();
      }
    });
  }

  /* ──────────────────────────────────
     CONTACT FORM (basic prevent default)
  ────────────────────────────────── */
  const contactForm = $('.luxe-contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = contactForm.querySelector('button[type="submit"]');
      if (btn) {
        btn.textContent = '✓ Message Sent! We\'ll reply soon.';
        btn.style.background = '#2ecc71';
        btn.disabled = true;
      }
    });
  }

})();
