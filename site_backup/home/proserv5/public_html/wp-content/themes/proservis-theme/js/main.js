/**
 * Proservis Theme — Main JS
 * Vanilla JS, no jQuery, no dependencies
 */

(function() {
  'use strict';

  /* ============================================================
     MOBILE NAV
     ============================================================ */
  const toggle = document.getElementById('nav-toggle');
  const nav    = document.getElementById('site-nav');

  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // Закрыть по клику на ссылку
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    });
  }

  /* ============================================================
     SMOOTH SCROLL
     ============================================================ */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const offset = 80; // высота хедера
      const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  /* ============================================================
     CONTACT FORM
     ============================================================ */
  const form     = document.getElementById('proservis-form');
  const response = document.getElementById('form-response');
  const submitBtn = document.getElementById('form-submit');

  if (form) {
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Валидация
      const name  = form.querySelector('#name').value.trim();
      const phone = form.querySelector('#phone').value.trim();

      if (!name || !phone) {
        showResponse('error', 'Vyplňte prosím jméno a telefon.');
        return;
      }

      // Кнопка в состоянии загрузки
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Odesílám...';

      const data = new FormData(form);
      data.append('action', 'proservis_form');
      data.append('nonce', proservisData.nonce);

      try {
        const res  = await fetch(proservisData.ajaxUrl, { method: 'POST', body: data });
        const json = await res.json();

        if (json.success) {
          showResponse('success', json.data.message);
          form.reset();
        } else {
          showResponse('error', json.data.message);
        }
      } catch(err) {
        showResponse('error', 'Chyba připojení. Zavolejte nám prosím.');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Odeslat objednávku';
      }
    });
  }

  function showResponse(type, msg) {
    if (!response) return;
    response.style.display = 'block';
    response.style.padding = '12px 20px';
    response.style.borderRadius = '8px';
    response.style.marginTop = '16px';
    response.style.fontWeight = '600';

    if (type === 'success') {
      response.style.background = 'rgba(0,200,100,0.2)';
      response.style.color = '#00c864';
      response.style.border = '1px solid rgba(0,200,100,0.3)';
    } else {
      response.style.background = 'rgba(255,50,50,0.2)';
      response.style.color = '#ff6b6b';
      response.style.border = '1px solid rgba(255,50,50,0.3)';
    }

    response.textContent = msg;
    response.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  /* ============================================================
     SCROLL ANIMATIONS (Intersection Observer)
     No heavy libraries — ~10 lines of code
     ============================================================ */
  const animateEls = document.querySelectorAll(
    '.about-card, .how-step, .brand-item, .appliance-item, .services-table'
  );

  if ('IntersectionObserver' in window && animateEls.length) {
    // Стили добавляем через JS чтобы без JS всё работало
    const style = document.createElement('style');
    style.textContent = `
      .animate-hidden { opacity: 0; transform: translateY(24px); transition: opacity 0.5s ease, transform 0.5s ease; }
      .animate-visible { opacity: 1; transform: translateY(0); }
    `;
    document.head.appendChild(style);

    animateEls.forEach(el => el.classList.add('animate-hidden'));

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('animate-visible');
          }, i * 80);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    animateEls.forEach(el => observer.observe(el));
  }

  /* ============================================================
     STICKY HEADER SHADOW
     ============================================================ */
  const header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.style.boxShadow = window.scrollY > 10
        ? '0 4px 20px rgba(0,0,0,0.12)'
        : '0 2px 12px rgba(0,0,0,0.08)';
    }, { passive: true });
  }

})();
