
const API_BASE = 'http://localhost/devdcii';

// ─── NAV ─────────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
  updateActiveNav();
});

function updateActiveNav() {
  const sections = document.querySelectorAll('section[id]');
  const scrollPos = window.scrollY + 100;
  sections.forEach(sec => {
    const id = sec.getAttribute('id');
    const link = document.querySelector('.nav-links a[href="#' + id + '"]');
    if (link) {
      link.classList.toggle(
        'active',
        scrollPos >= sec.offsetTop && scrollPos < sec.offsetTop + sec.offsetHeight
      );
    }
  });
}

// ─── SMOOTH SCROLL ───────────────────────────────────────────
function smoothScrollTo(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}

document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = a.getAttribute('href');
    if (target.length > 1) {
      const el = document.getElementById(target.slice(1));
      if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth' }); }
    }
  });
});

// ─── MOBILE MENU ─────────────────────────────────────────────
document.getElementById('menuToggle').addEventListener('click', () => {
  document.getElementById('mobileMenu').classList.toggle('open');
});

function closeMobileMenu() {
  document.getElementById('mobileMenu').classList.remove('open');
}

// ─── SCROLL REVEAL ───────────────────────────────────────────
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.reveal, .reveal-l, .reveal-r').forEach(el => revealObserver.observe(el));

// ─── PROJECTS ────────────────────────────────────────────────
let allProjects = [];

async function loadProjects() {
  const grid = document.getElementById('projectsGrid');
  const empty = document.getElementById('projectsEmpty');
  try {
    const res = await fetch(API_BASE + '/api/get_projects.php');
    if (!res.ok) throw new Error('Server error ' + res.status);
    const text = await res.text();
    let data;
    try { data = JSON.parse(text); } catch { throw new Error('Invalid JSON'); }
    allProjects = data.projects || [];
    renderProjects(allProjects);
  } catch (e) {
    console.error('loadProjects error:', e.message);
    if (grid) grid.innerHTML = '';
    if (empty) empty.style.display = 'block';
  }
}

function renderProjects(projects) {
  const grid = document.getElementById('projectsGrid');
  const empty = document.getElementById('projectsEmpty');
  if (!grid) return;
  if (!projects || !projects.length) {
    grid.innerHTML = '';
    if (empty) empty.style.display = 'block';
    return;
  }
  if (empty) empty.style.display = 'none';

  grid.innerHTML = projects.map(p => {
    // Tech tags
    const tags = p.tech_stack
      ? p.tech_stack.split(',').map(t =>
        `<span class="project-tag">${t.trim()}</span>`
      ).join('')
      : '';

    // Hover buttons (only show if URL exists)
    const hoverBtns = [
      p.github_url
        ? `<a class="pha-btn code" href="${p.github_url}" target="_blank" rel="noopener" onclick="event.stopPropagation()">
             <i class="fab fa-github"></i> GitHub
           </a>` : '',
      p.live_url
        ? `<a class="pha-btn live" href="${p.live_url}" target="_blank" rel="noopener" onclick="event.stopPropagation()">
             <i class="fas fa-external-link-alt"></i> Live
           </a>` : '',
      `<button class="pha-btn detail" onclick="event.stopPropagation();openProject(${p.id})">
         <i class="fas fa-expand"></i> Details
       </button>`
    ].join('');

    // Footer icon links
    const footerLinks = [
      p.github_url
        ? `<a class="project-link-icon" href="${p.github_url}" target="_blank" rel="noopener" title="GitHub" onclick="event.stopPropagation()">
             <i class="fab fa-github"></i>
           </a>` : '',
      p.live_url
        ? `<a class="project-link-icon" href="${p.live_url}" target="_blank" rel="noopener" title="Live Site" onclick="event.stopPropagation()">
             <i class="fas fa-external-link-alt"></i>
           </a>` : '',
    ].join('');

    const thumb = p.thumbnail
      ? `<img src="${p.thumbnail}" alt="${p.title}" class="project-thumb" loading="lazy">`
      : `<div class="project-no-thumb"><i class="fas fa-th-large"></i></div>`;

    return `
      <div class="project-card" data-category="${p.category}" onclick="openProject(${p.id})">
        <div class="project-thumb-wrap">
          ${thumb}
          <div class="project-thumb-overlay"></div>
          <span class="project-cat-badge">${p.category}</span>
          <div class="project-hover-actions">${hoverBtns}</div>
        </div>
        <div class="project-body">
          <div class="project-title">${p.title}</div>
          <div class="project-desc">${p.description || ''}</div>
          ${tags ? `<div class="project-tags">${tags}</div>` : ''}
        </div>
        <div class="project-footer">
          <div class="project-links">${footerLinks}</div>
          <span class="project-year">${p.year || ''}</span>
          <div class="view-btn"><i class="fas fa-arrow-right"></i> View</div>
        </div>
      </div>`;
  }).join('');
}

document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const filter = btn.dataset.filter;
    renderProjects(
      filter === 'all'
        ? allProjects
        : allProjects.filter(p => p.category && p.category.toLowerCase() === filter.toLowerCase())
    );
  });
});

// ─── PROJECT MODAL ───────────────────────────────────────────
async function openProject(id) {
  const modal = document.getElementById('projectModal');
  const content = document.getElementById('modalContent');
  content.innerHTML = `
    <div class="modal-layout">
      <div style="flex:0 0 42%;background:rgba(5,8,22,.6);border-right:1px solid var(--border);display:flex;align-items:center;justify-content:center;padding:2rem;">
        <i class="fas fa-circle-notch fa-spin" style="font-size:2rem;color:var(--text3)"></i>
      </div>
      <div style="flex:1;padding:2rem;display:flex;align-items:center;justify-content:center;">
        <p style="color:var(--text3)">Loading...</p>
      </div>
    </div>`;
  modal.classList.add('open');
  document.body.style.overflow = 'hidden';

  try {
    const res = await fetch(API_BASE + '/api/get_project_media.php?id=' + id);
    const data = await res.json();
    const p = data.project;
    const media = data.media || [];

    // Build media left panel
    const images = media.filter(m => m.type !== 'video');
    const videos = media.filter(m => m.type === 'video');
    const allMedia = media;

    let mainMedia = '';
    if (allMedia.length > 0) {
      const first = allMedia[0];
      mainMedia = first.type === 'video'
        ? `<div class="modal-main-thumb"><video controls src="${first.url}" preload="metadata"></video></div>`
        : `<div class="modal-main-thumb"><img src="${first.url}" alt="${p.title}" onclick="openLightbox('${first.url}')" style="cursor:zoom-in"></div>`;
    }

    let galleryHtml = '';
    if (allMedia.length > 1) {
      galleryHtml = `<div class="modal-gallery-grid">` +
        allMedia.slice(1).map(m =>
          m.type === 'video'
            ? `<div class="modal-gallery-item"><video src="${m.url}" muted></video></div>`
            : `<div class="modal-gallery-item"><img src="${m.url}" alt="${p.title}" onclick="openLightbox('${m.url}')"></div>`
        ).join('') +
        `</div>`;
    }

    const actionBtns = [
      p.live_url ? `<a class="modal-act-btn live" href="${p.live_url}" target="_blank" rel="noopener"><i class="fas fa-external-link-alt"></i> Live Demo</a>` : '',
      p.github_url ? `<a class="modal-act-btn code" href="${p.github_url}" target="_blank" rel="noopener"><i class="fab fa-github"></i> GitHub</a>` : '',
    ].filter(Boolean).join('');

    // Tech stack pills
    const techPills = p.tech_stack
      ? `<div class="modal-tech-wrap">
           <span class="modal-tech-label">Tech Stack</span>
           <div class="modal-tech-pills">
             ${p.tech_stack.split(',').map(t => `<span class="modal-tech-pill">${t.trim()}</span>`).join('')}
           </div>
         </div>`
      : '';

    content.innerHTML = `
      <div class="modal-layout">
        <div class="modal-left">
          ${mainMedia || `<div class="modal-no-media"><i class="fas fa-images"></i><p>No media yet.</p></div>`}
          ${galleryHtml}
          ${actionBtns ? `<div class="modal-action-btns">${actionBtns}</div>` : ''}
        </div>
        <div class="modal-right">
          <div>
            <div class="modal-cat">${p.category}</div>
            <div class="modal-title">${p.title}</div>
            ${p.year ? `<div class="modal-year"><i class="fas fa-calendar-alt"></i>${p.year}</div>` : ''}
          </div>
          ${p.description ? `<div class="modal-desc">${p.description}</div>` : ''}
          ${techPills}
        </div>
      </div>`;
  } catch (e) {
    const p = allProjects.find(x => x.id == id);
    content.innerHTML = `
      <div class="modal-layout">
        <div class="modal-left"><div class="modal-no-media"><i class="fas fa-exclamation-circle"></i><p>Could not load media.</p></div></div>
        <div class="modal-right">
          ${p ? `<div class="modal-title">${p.title}</div><div class="modal-desc">${p.description || 'No details available.'}</div>` : `<p style="color:var(--text2)">Could not load project details.</p>`}
        </div>
      </div>`;
  }
}

function closeModal() {
  document.getElementById('projectModal').classList.remove('open');
  document.body.style.overflow = '';
}

function closeProjectModal(e) {
  if (e.target === document.getElementById('projectModal')) closeModal();
}

// ─── LIGHTBOX ────────────────────────────────────────────────
function openLightbox(src) {
  let lb = document.getElementById('lightbox');
  if (!lb) {
    lb = document.createElement('div');
    lb.id = 'lightbox';
    lb.className = 'lightbox';
    lb.innerHTML = `
      <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
      <img id="lbImg" alt="">`;
    lb.addEventListener('click', e => { if (e.target === lb) closeLightbox(); });
    document.body.appendChild(lb);
  }
  document.getElementById('lbImg').src = src;
  lb.classList.add('open');
}

function closeLightbox() {
  document.getElementById('lightbox')?.classList.remove('open');
}

// ─── CONTACT FORM ────────────────────────────────────────────
document.getElementById('contactForm')?.addEventListener('submit', async e => {
  e.preventDefault();
  const btn = document.getElementById('submitBtn');
  const msg = document.getElementById('formMsg');
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sending...';
  msg.className = 'form-message';
  msg.textContent = '';

  try {
    const res = await fetch(API_BASE + '/api/submit_inquiry.php', {
      method: 'POST',
      body: new FormData(e.target)
    });
    const data = await res.json();
    if (data.success) {
      msg.className = 'form-message success';
      msg.textContent = 'Your message has been sent! I will get back to you soon.';
      e.target.reset();
    } else {
      throw new Error(data.message || 'Server error');
    }
  } catch (err) {
    msg.className = 'form-message error';
    msg.textContent = 'Something went wrong: ' + (err.message || 'Please try again.');
  }

  btn.disabled = false;
  btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
  setTimeout(() => { msg.className = 'form-message'; msg.textContent = ''; }, 6000);
});

// ─── ESC KEY ─────────────────────────────────────────────────
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') { closeModal(); closeLightbox(); }
});

// ─── INIT ────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  loadProjects();
  updateActiveNav();
});

// ─── CHAT WIDGET ─────────────────────────────────────────────
function toggleChat() {
  const box = document.getElementById('chatBox');
  box.classList.toggle('open');
  if (box.classList.contains('open')) {
    document.getElementById('chatInput').focus();
  }
}

async function sendChat() {
  const input = document.getElementById('chatInput');
  const msg = input.value.trim();
  if (!msg) return;

  appendMsg(msg, 'user');
  input.value = '';
  input.disabled = true;
  document.getElementById('chatSendBtn').disabled = true;

  // Show typing indicator immediately
  const typing = appendTyping();

  // typing + API delay
  const delay = Math.min(1000 + msg.length * 30, 3000);

  const [res] = await Promise.allSettled([
    fetch(API_BASE + '/api/gemini_chat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: msg })
    }),
    new Promise(r => setTimeout(r, delay))
  ]);

  typing.remove();

  try {
    if (res.status === 'fulfilled') {
      const data = await res.value.json();
      appendMsg(data.reply || 'Sorry, I could not answer that.', 'bot');
    } else {
      appendMsg('Connection error. Please try again.', 'bot');
    }
  } catch {
    appendMsg('Connection error. Please try again.', 'bot');
  }

  input.disabled = false;
  document.getElementById('chatSendBtn').disabled = false;
  input.focus();
}

function appendMsg(text, sender) {
  const messages = document.getElementById('chatMessages');
  const div = document.createElement('div');
  div.className = `chat-msg ${sender}`;
  div.innerHTML = `<div class="chat-bubble">${text}</div>`;
  messages.appendChild(div);
  messages.scrollTop = messages.scrollHeight;
  return div;
}

function appendTyping() {
  const messages = document.getElementById('chatMessages');
  const div = document.createElement('div');
  div.className = 'chat-msg bot chat-typing';
  div.innerHTML = `<div class="chat-bubble"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>`;
  messages.appendChild(div);
  messages.scrollTop = messages.scrollHeight;
  return div;
}
