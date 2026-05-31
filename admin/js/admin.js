// ===== CONFIG =====
const API = '../api/admin/';

// ===== STATE =====
let currentPage = 'dashboard';
let adminData = null;
let sidebarCollapsed = false;

// ===== LOGIN =====
const loginForm = document.getElementById('loginForm');
const togglePw = document.getElementById('togglePw');
const pwInput = loginForm?.querySelector('input[name="password"]');

togglePw?.addEventListener('click', () => {
    const isText = pwInput.type === 'text';
    pwInput.type = isText ? 'password' : 'text';
    togglePw.className = `fas fa-${isText ? 'eye' : 'eye-slash'} toggle-pw`;
});

loginForm?.addEventListener('submit', async e => {
    e.preventDefault();
    const btn = document.getElementById('loginBtn');
    const err = document.getElementById('loginError');
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Signing in...';
    btn.disabled = true;
    err.textContent = '';

    const body = new FormData(loginForm);
    try {
        const res = await fetch(API + 'login.php', { method: 'POST', body });
        const data = await res.json();
        if (data.success) {
            adminData = data.admin;
            showAdmin();
        } else {
            err.textContent = data.message || 'Invalid credentials.';
        }
    } catch {
        err.textContent = 'Connection error. Check your server.';
    }
    btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Sign In';
    btn.disabled = false;
});

function showAdmin() {
    document.getElementById('loginScreen').style.display = 'none';
    document.getElementById('adminApp').style.display = 'flex';
    document.getElementById('adminName').textContent = adminData?.full_name || 'Admin';
    navigateTo('dashboard');
}

async function checkSession() {
    try {
        const res = await fetch(API + 'check_session.php');
        const data = await res.json();
        if (data.logged_in) {
            adminData = data.admin;
            showAdmin();
        }
    } catch {}
}

async function adminLogout() {
    await fetch(API + 'logout.php', { method: 'POST' });
    location.reload();
}

// ===== SIDEBAR COLLAPSE =====
function toggleCollapse() {
    sidebarCollapsed = !sidebarCollapsed;
    document.getElementById('sidebar').classList.toggle('collapsed', sidebarCollapsed);
    document.getElementById('mainWrap').classList.toggle('collapsed', sidebarCollapsed);

    // Add tooltips when collapsed
    const labels = {
        dashboard: 'Dashboard',
        projects: 'Projects',
        inquiries: 'Inquiries',
        'add-project': 'Add Project'
    };
    document.querySelectorAll('.sb-link[data-page]').forEach(link => {
        link.setAttribute('data-tooltip', labels[link.dataset.page] || '');
    });
}

function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// ===== NAVIGATION =====
document.querySelectorAll('.sb-link[data-page]').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        navigateTo(link.dataset.page);
        document.getElementById('sidebar').classList.remove('open');
    });
});

function navigateTo(page) {
    currentPage = page;
    document.querySelectorAll('.sb-link').forEach(l => l.classList.remove('active'));
    document.querySelector(`.sb-link[data-page="${page}"]`)?.classList.add('active');
    const titles = {
        dashboard: 'Dashboard',
        projects: 'Projects',
        inquiries: 'Inquiries',
        'add-project': 'Add Project'
    };
    document.getElementById('pageTitle').textContent = titles[page] || page;
    const pages = {
        dashboard: renderDashboard,
        projects: renderProjects,
        inquiries: renderInquiries,
        'add-project': renderAddProject
    };
    (pages[page] || (() => {}))();
}

// ===== LOADER =====
function loadingHTML() {
    return `<div style="display:flex;align-items:center;justify-content:center;padding:4rem;color:var(--text3)">
        <i class="fas fa-circle-notch fa-spin" style="font-size:1.3rem"></i>
    </div>`;
}

// ===== DASHBOARD =====
async function renderDashboard() {
    const c = document.getElementById('mainContent');
    c.innerHTML = loadingHTML();
    try {
        const res = await fetch(API + 'dashboard_stats.php');
        const d = await res.json();
        c.innerHTML = `
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon cyan"><i class="fas fa-th-large"></i></div>
                <div><div class="stat-num">${d.total_projects||0}</div><div class="stat-lbl">Total Projects</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon teal"><i class="fas fa-photo-film"></i></div>
                <div><div class="stat-num">${d.total_media||0}</div><div class="stat-lbl">Media Files</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-envelope"></i></div>
                <div><div class="stat-num">${d.total_inquiries||0}</div><div class="stat-lbl">Total Inquiries</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red"><i class="fas fa-bell"></i></div>
                <div><div class="stat-num">${d.new_inquiries||0}</div><div class="stat-lbl">New Inquiries</div></div>
            </div>
        </div>
        <div class="section-card">
            <div class="section-card-head">
                <h3>Recent Inquiries</h3>
                <button class="btn btn-outline btn-sm" onclick="navigateTo('inquiries')">View All</button>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Name</th><th>Subject</th><th>Date</th><th>Status</th></tr></thead>
                    <tbody>${(d.recent_inquiries||[]).map(i => `
                        <tr onclick="openInquiry(${i.id})" style="cursor:pointer">
                            <td><strong>${esc(i.full_name)}</strong><br><span style="font-size:0.78rem;color:var(--text3)">${esc(i.email)}</span></td>
                            <td>${esc(i.subject)}</td>
                            <td>${formatDate(i.created_at)}</td>
                            <td><span class="status-badge status-${i.status}">${i.status}</span></td>
                        </tr>`).join('') || '<tr><td colspan="4"><div class="empty-state"><i class="fas fa-inbox"></i><p>No inquiries yet.</p></div></td></tr>'}
                    </tbody>
                </table>
            </div>
        </div>`;
        updateNewBadge(d.new_inquiries);
    } catch {
        c.innerHTML = '<p style="color:var(--text2);padding:2rem">Failed to load dashboard.</p>';
    }
}

// ===== PROJECTS =====
async function renderProjects() {
    const c = document.getElementById('mainContent');
    c.innerHTML = loadingHTML();
    try {
        const res = await fetch(API + 'get_projects.php');
        const d = await res.json();
        const projects = d.projects || [];
        c.innerHTML = `
        <div class="section-card">
            <div class="section-card-head">
                <h3>All Projects <span style="color:var(--text3);font-weight:400;font-size:0.85rem">(${projects.length})</span></h3>
                <button class="btn btn-primary btn-sm" onclick="navigateTo('add-project')"><i class="fas fa-plus"></i> Add Project</button>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Title</th><th>Category</th><th>Media</th><th>Year</th><th>Featured</th><th>Actions</th></tr></thead>
                    <tbody>${projects.length ? projects.map(p => `
                        <tr>
                            <td><strong>${esc(p.title)}</strong></td>
                            <td><span class="status-badge status-${(p.category||'other').toLowerCase().replace(/\s+/g,'-')}">${esc(p.category||'—')}</span></td>
                            <td style="color:var(--text3)">${(parseInt(p.image_count)||0)+(parseInt(p.video_count)||0)} files</td>
                            <td style="color:var(--text3)">${p.year||'—'}</td>
                            <td>${p.is_featured=='1'?`<span style="color:var(--warn);font-size:1rem">★</span>`:'<span style="color:var(--text3)">—</span>'}</td>
                            <td>
                                <div class="action-group">
                                    <button class="btn btn-outline btn-sm" onclick="openEditProject(${p.id})" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-outline btn-sm" onclick="manageMedia(${p.id},'${esc(p.title)}')" title="Media"><i class="fas fa-photo-film"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteProject(${p.id})" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>`).join('') : '<tr><td colspan="6"><div class="empty-state"><i class="fas fa-folder-open"></i><p>No projects yet.</p></div></td></tr>'}
                    </tbody>
                </table>
            </div>
        </div>`;
    } catch {
        c.innerHTML = '<p style="color:var(--text2);padding:2rem">Failed to load projects.</p>';
    }
}

// ===== ADD PROJECT (Centered) =====
function renderAddProject() {
    const c = document.getElementById('mainContent');
    c.innerHTML = `
    <div class="add-project-wrap">
        <div class="add-project-header">
            <div>
                <h2>Add New Project</h2>
                <p>Fill in the details below to publish a new project to your portfolio.</p>
            </div>
        </div>

        <form id="addProjectForm">
            <div class="form-card" style="margin-bottom:1.2rem">
                <div class="form-section-title">Basic Info</div>
                <div class="form-grid">
                    <div class="form-group-admin form-full">
                        <label>Project Title *</label>
                        <input type="text" name="title" placeholder="e.g. Smart Irrigation System" required>
                    </div>
                    <div class="form-group-admin">
                        <label>Category *</label>
                        <select name="category" required>
                            <option value="">— Select —</option>
                            <option value="Web">Web</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Data Analytics">Data Analytics</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group-admin">
                        <label>Year</label>
                        <input type="text" name="year" placeholder="e.g. Jan 2026">
                    </div>
                    <div class="form-group-admin form-full">
                        <label>Description</label>
                        <textarea name="description" rows="4" placeholder="Describe the project..."></textarea>
                    </div>
                </div>
            </div>

            <div class="form-card" style="margin-bottom:1.2rem">
                <div class="form-section-title">Tech & Links</div>
                <div class="form-grid">
                    <div class="form-group-admin form-full">
                        <label>Tech Stack</label>
                        <input type="text" name="tech_stack" placeholder="e.g. Flutter, ESP32, Firebase, Laravel">
                    </div>
                    <div class="form-group-admin">
                        <label>GitHub URL</label>
                        <input type="url" name="github_url" placeholder="https://github.com/devdcii/...">
                    </div>
                    <div class="form-group-admin">
                        <label>Live Site URL</label>
                        <input type="url" name="live_url" placeholder="https://yourproject.com">
                    </div>
                </div>
                <div class="form-group-admin">
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;text-transform:none;letter-spacing:0">
                        <input type="checkbox" name="is_featured" value="1" style="width:auto;accent-color:var(--primary)">
                        <span style="color:var(--text);font-size:0.88rem;font-weight:500">Mark as Featured project</span>
                    </label>
                </div>
            </div>

            <div class="form-card" style="margin-bottom:1.5rem">
                <div class="form-section-title">Media</div>
                <div class="upload-area" id="dropZone" onclick="document.getElementById('mediaInput').click()" ondragover="dragOver(event)" ondragleave="dragLeave(event)" ondrop="dropFiles(event)">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click or drag files here to upload</p>
                    <small>Images: JPG, PNG, WEBP (max 5MB) &nbsp;·&nbsp; Videos: MP4, MOV (max 100MB)</small>
                    <input type="file" id="mediaInput" multiple accept="image/*,video/*" onchange="previewMedia(this.files)">
                </div>
                <div class="media-grid" id="mediaPreview"></div>
            </div>

            <div style="display:flex;align-items:center;justify-content:center;gap:1rem">
                <button type="button" class="btn btn-outline" onclick="navigateTo('projects')">
                    <i class="fas fa-arrow-left"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="saveProjectBtn">
                    <i class="fas fa-save"></i> Save Project
                </button>
            </div>
            <div id="addProjectMsg" style="margin-top:1rem;font-size:0.88rem;text-align:center"></div>
        </form>
    </div>`;

    let selectedFiles = [];
    window.previewMedia = (files) => {
        selectedFiles = [...selectedFiles, ...Array.from(files)];
        renderPreview();
    };
    function renderPreview() {
        const grid = document.getElementById('mediaPreview');
        grid.innerHTML = selectedFiles.map((f, i) => {
            const isVideo = f.type.startsWith('video');
            const url = URL.createObjectURL(f);
            return `<div class="media-thumb">
                ${isVideo ? `<video src="${url}" muted></video>` : `<img src="${url}" alt="">`}
                <span class="media-type-tag">${isVideo ? 'video' : 'image'}</span>
                <button class="media-del" onclick="removeFile(${i})"><i class="fas fa-times"></i></button>
            </div>`;
        }).join('');
    }
    window.removeFile = (i) => { selectedFiles.splice(i, 1); renderPreview(); };
    window.dragOver  = (e) => { e.preventDefault(); document.getElementById('dropZone').classList.add('drag'); };
    window.dragLeave = ()  => document.getElementById('dropZone').classList.remove('drag');
    window.dropFiles = (e) => { e.preventDefault(); document.getElementById('dropZone').classList.remove('drag'); previewMedia(e.dataTransfer.files); };

    document.getElementById('addProjectForm').addEventListener('submit', async e => {
        e.preventDefault();
        const btn = document.getElementById('saveProjectBtn');
        const msg = document.getElementById('addProjectMsg');
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Saving...';
        btn.disabled = true;

        const fd = new FormData(e.target);
        selectedFiles.forEach(f => fd.append('media[]', f));

        try {
            const res = await fetch(API + 'save_project.php', { method: 'POST', body: fd });
            const d   = await res.json();
            if (d.success) {
                showToast('Project saved successfully!', 'success');
                navigateTo('projects');
            } else {
                msg.style.color = 'var(--danger)';
                msg.textContent = '✗ ' + (d.message || 'Error saving project.');
            }
        } catch {
            msg.style.color = 'var(--danger)';
            msg.textContent = '✗ Connection error.';
        }
        btn.innerHTML = '<i class="fas fa-save"></i> Save Project';
        btn.disabled = false;
    });
}

// ===== EDIT PROJECT =====
async function openEditProject(id) {
    try {
        const res = await fetch(API + 'get_project.php?id=' + id);
        const d   = await res.json();
        const p   = d.project;
        const body = document.getElementById('editProjectBody');
        document.getElementById('editModalTitle').textContent = 'Edit Project';

        body.innerHTML = `
        <form id="editProjectForm">
            <input type="hidden" name="id" value="${p.id}">
            <div class="form-section-title" style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--primary);margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid var(--border)">Basic Info</div>
            <div class="form-group-admin">
                <label>Title *</label>
                <input type="text" name="title" value="${esc(p.title)}" required>
            </div>
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>Category *</label>
                    <select name="category" required>
                        ${['Web','Mobile','Hardware','Data Analytics','Other'].map(cat =>
                            `<option value="${cat}"${p.category===cat?' selected':''}>${cat}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="form-group-admin">
                    <label>Year</label>
                    <input type="text" name="year" value="${esc(p.year||'')}" placeholder="e.g. Jan 2026">
                </div>
            </div>
            <div class="form-group-admin">
                <label>Tech Stack</label>
                <input type="text" name="tech_stack" value="${esc(p.tech_stack||'')}">
            </div>
            <div class="form-group-admin">
                <label>GitHub URL</label>
                <input type="url" name="github_url" value="${esc(p.github_url||'')}" placeholder="https://github.com/devdcii/...">
            </div>
            <div class="form-group-admin">
                <label>Live Site URL</label>
                <input type="url" name="live_url" value="${esc(p.live_url||'')}" placeholder="https://yourproject.com">
            </div>
            <div class="form-group-admin">
                <label>Description</label>
                <textarea name="description" rows="4">${esc(p.description||'')}</textarea>
            </div>
            <div class="form-group-admin">
                <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;text-transform:none;letter-spacing:0">
                    <input type="checkbox" name="is_featured" value="1"${p.is_featured=='1'?' checked':''} style="width:auto;accent-color:var(--primary)">
                    <span style="color:var(--text);font-size:0.88rem;font-weight:500">Featured project</span>
                </label>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <button type="button" class="btn btn-outline" onclick="manageMedia(${p.id},'${esc(p.title)}')">
                    <i class="fas fa-photo-film"></i> Manage Media
                </button>
            </div>
            <div id="editMsg" style="margin-top:1rem;font-size:0.88rem"></div>
        </form>`;

        openModal('editProjectModal');

        document.getElementById('editProjectForm').addEventListener('submit', async ev => {
            ev.preventDefault();
            const fd = new FormData(ev.target);
            try {
                const r  = await fetch(API + 'update_project.php', { method: 'POST', body: fd });
                const dt = await r.json();
                if (dt.success) {
                    showToast('Project updated!', 'success');
                    closeAllModals();
                    renderProjects();
                } else {
                    document.getElementById('editMsg').style.color = 'var(--danger)';
                    document.getElementById('editMsg').textContent = '✗ ' + (dt.message || 'Error');
                }
            } catch {
                document.getElementById('editMsg').style.color = 'var(--danger)';
                document.getElementById('editMsg').textContent = '✗ Connection error';
            }
        });
    } catch {
        showToast('Could not load project.', 'error');
    }
}

// ===== MANAGE MEDIA =====
async function manageMedia(projectId, title) {
    const body = document.getElementById('editProjectBody');
    document.getElementById('editModalTitle').textContent = `Media: ${title}`;
    body.innerHTML = `<div style="text-align:center;padding:2rem;color:var(--text3)"><i class="fas fa-circle-notch fa-spin"></i></div>`;
    openModal('editProjectModal');

    try {
        const res = await fetch(`../api/get_project_media.php?id=${projectId}`);
        const d = await res.json();
        const media = d.media || [];

        body.innerHTML = `
        <div class="media-grid" id="existingMedia" style="margin-bottom:1.5rem">
            ${media.length ? media.map(m => `
            <div class="media-thumb" id="media_${m.id}">
                ${m.type==='video'
                    ? `<video src="${m.url}" muted></video>`
                    : `<img src="${m.url}" alt="">`}
                <span class="media-type-tag">${m.type}</span>
                <button class="media-del" onclick="deleteMedia(${m.id},${projectId},'${esc(title)}')"><i class="fas fa-times"></i></button>
            </div>`).join('')
            : '<p style="color:var(--text3);font-size:0.88rem;margin-bottom:1rem">No media uploaded yet.</p>'}
        </div>
        <div class="upload-area" id="mDropZone" onclick="document.getElementById('mInput').click()">
            <i class="fas fa-plus-circle"></i>
            <p>Add more images / videos</p>
            <input type="file" id="mInput" multiple accept="image/*,video/*" onchange="uploadMedia(this.files,${projectId},'${esc(title)}')">
        </div>`;
    } catch {
        body.innerHTML = '<p style="color:var(--danger)">Failed to load media.</p>';
    }
}

window.uploadMedia = async (files, projectId, title) => {
    const fd = new FormData();
    fd.append('project_id', projectId);
    Array.from(files).forEach(f => fd.append('media[]', f));
    showToast('Uploading...', 'success');
    try {
        const res = await fetch(API + 'upload_media.php', { method:'POST', body:fd });
        const d = await res.json();
        if (d.success) { showToast('Uploaded!','success'); manageMedia(projectId, title); }
        else showToast(d.message||'Upload failed','error');
    } catch { showToast('Upload error','error'); }
};

window.deleteMedia = async (mediaId, projectId, title) => {
    if (!confirm('Delete this media file?')) return;
    try {
        const fd = new FormData(); fd.append('id', mediaId);
        const res = await fetch(API + 'delete_media.php', { method:'POST', body:fd });
        const d = await res.json();
        if (d.success) { document.getElementById('media_' + mediaId)?.remove(); showToast('Deleted','success'); }
        else showToast(d.message||'Delete failed','error');
    } catch { showToast('Error','error'); }
};

window.deleteProject = async (id) => {
    if (!confirm('Delete this project and all its media? This cannot be undone.')) return;
    const fd = new FormData(); fd.append('id', id);
    try {
        const res = await fetch(API + 'delete_project.php', { method:'POST', body:fd });
        const d = await res.json();
        if (d.success) { showToast('Project deleted','success'); renderProjects(); }
        else showToast(d.message||'Error','error');
    } catch { showToast('Error','error'); }
};

// ===== INQUIRIES =====
async function renderInquiries() {
    const c = document.getElementById('mainContent');
    c.innerHTML = loadingHTML();
    try {
        const res = await fetch(API + 'get_inquiries.php');
        const d = await res.json();
        const items = d.inquiries || [];
        c.innerHTML = `
        <div class="section-card">
            <div class="section-card-head">
                <h3>All Inquiries <span style="color:var(--text3);font-weight:400;font-size:0.85rem">(${items.length})</span></h3>
                <select id="filterStatus" onchange="filterInquiries()" style="background:var(--bg3);border:1px solid var(--border);color:var(--text);padding:0.4rem 0.7rem;border-radius:8px;font-size:0.82rem;cursor:pointer">
                    <option value="">All Status</option>
                    <option value="new">New</option>
                    <option value="read">Read</option>
                    <option value="replied">Replied</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>From</th><th>Subject</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody id="inquiryRows">
                        ${items.length ? items.map(i => inquiryRow(i)).join('') : '<tr><td colspan="5"><div class="empty-state"><i class="fas fa-inbox"></i><p>No inquiries yet.</p></div></td></tr>'}
                    </tbody>
                </table>
            </div>
        </div>`;
        window._allInquiries = items;
        updateNewBadge(items.filter(i=>i.status==='new').length);
    } catch {
        c.innerHTML = '<p style="color:var(--text2);padding:2rem">Failed to load inquiries.</p>';
    }
}

function inquiryRow(i) {
    return `<tr onclick="openInquiry(${i.id})" style="cursor:pointer">
        <td>
            <strong>${esc(i.full_name)}</strong><br>
            <span style="font-size:0.78rem;color:var(--text3)">${esc(i.email)}</span>
        </td>
        <td>${esc(i.subject)}</td>
        <td style="white-space:nowrap">${formatDate(i.created_at)}</td>
        <td><span class="status-badge status-${i.status}">${i.status}</span></td>
        <td onclick="event.stopPropagation()">
            <select onchange="updateStatus(${i.id},this.value,this)" style="background:var(--bg3);border:1px solid var(--border);color:var(--text);padding:0.3rem 0.5rem;border-radius:6px;font-size:0.78rem;cursor:pointer">
                ${['new','read','replied','archived'].map(s=>`<option value="${s}"${i.status===s?' selected':''}>${s}</option>`).join('')}
            </select>
        </td>
    </tr>`;
}

window.filterInquiries = () => {
    const status = document.getElementById('filterStatus').value;
    const rows = status ? window._allInquiries.filter(i=>i.status===status) : window._allInquiries;
    document.getElementById('inquiryRows').innerHTML = rows.length
        ? rows.map(inquiryRow).join('')
        : '<tr><td colspan="5" style="text-align:center;padding:2rem;color:var(--text3)">No results</td></tr>';
};

window.openInquiry = async (id) => {
    const body = document.getElementById('viewInquiryBody');
    body.innerHTML = '<div style="text-align:center;padding:2rem"><i class="fas fa-circle-notch fa-spin"></i></div>';
    openModal('viewInquiryModal');

    const res = await fetch(API + 'get_inquiry.php?id=' + id);
    const d = await res.json();
    const i = d.inquiry;
    if (!i) { body.innerHTML='<p style="color:var(--danger)">Not found.</p>'; return; }

    body.innerHTML = `
    <div class="inq-meta">
        <div class="inq-field"><label>From</label><p>${esc(i.full_name)}</p></div>
        <div class="inq-field"><label>Email</label><p><a href="mailto:${esc(i.email)}" style="color:var(--primary)">${esc(i.email)}</a></p></div>
        <div class="inq-field"><label>Phone</label><p>${esc(i.phone||'—')}</p></div>
        <div class="inq-field"><label>Received</label><p>${formatDate(i.created_at,true)}</p></div>
        <div class="inq-field form-full"><label>Subject</label><p>${esc(i.subject)}</p></div>
    </div>
    <div class="inq-message"><label>Message</label><p>${esc(i.message)}</p></div>
    <div class="form-group-admin">
        <label>Status</label>
        <select id="inqStatus" style="background:var(--bg3);border:1px solid var(--border);color:var(--text);padding:0.6rem 0.8rem;border-radius:8px">
            ${['new','read','replied','archived'].map(s=>`<option value="${s}"${i.status===s?' selected':''}>${s}</option>`).join('')}
        </select>
    </div>
    <div class="form-group-admin">
        <label>Admin Notes</label>
        <textarea id="inqNotes" rows="3" style="background:var(--bg3);border:1.5px solid var(--border);border-radius:8px;padding:0.7rem;color:var(--text);width:100%;font-family:'DM Sans',sans-serif">${esc(i.admin_notes||'')}</textarea>
    </div>
    <div class="form-actions">
        <button class="btn btn-primary" onclick="saveInquiryUpdate(${i.id})"><i class="fas fa-save"></i> Save</button>
        <a href="mailto:${esc(i.email)}?subject=Re: ${esc(i.subject)}" class="btn btn-outline"><i class="fas fa-reply"></i> Reply via Email</a>
    </div>
    <div id="inqMsg" style="margin-top:1rem;font-size:0.88rem"></div>`;
};

window.saveInquiryUpdate = async (id) => {
    const status = document.getElementById('inqStatus').value;
    const notes = document.getElementById('inqNotes').value;
    const fd = new FormData(); fd.append('id',id); fd.append('status',status); fd.append('admin_notes',notes);
    try {
        const res = await fetch(API + 'update_inquiry.php', {method:'POST',body:fd});
        const d = await res.json();
        if (d.success) {
            showToast('Saved!','success');
            closeAllModals();
            if(currentPage==='inquiries') renderInquiries();
            if(currentPage==='dashboard') renderDashboard();
        } else showToast(d.message||'Error','error');
    } catch { showToast('Error','error'); }
};

window.updateStatus = async (id, status) => {
    const fd = new FormData(); fd.append('id',id); fd.append('status',status);
    try {
        const res = await fetch(API + 'update_inquiry.php', {method:'POST',body:fd});
        const d = await res.json();
        if (d.success) showToast('Status updated','success');
        else showToast('Error','error');
    } catch { showToast('Error','error'); }
};

// ===== MODAL HELPERS =====
function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.getElementById('overlay').classList.add('open');
}
function closeAllModals() {
    document.querySelectorAll('.modal-panel').forEach(m => m.classList.remove('open'));
    document.getElementById('overlay').classList.remove('open');
}

// ===== TOAST =====
function showToast(msg, type='success') {
    let t = document.getElementById('globalToast');
    if (!t) {
        t = document.createElement('div');
        t.id = 'globalToast';
        t.className = 'toast';
        document.body.appendChild(t);
    }
    t.innerHTML = `<i class="fas fa-${type==='success'?'check-circle':'exclamation-circle'}"></i> ${msg}`;
    t.className = `toast ${type}`;
    setTimeout(() => t.classList.add('show'), 10);
    setTimeout(() => t.classList.remove('show'), 3500);
}

// ===== BADGE =====
function updateNewBadge(n) {
    const b = document.getElementById('newBadge');
    if (b) { b.textContent = n > 0 ? n : ''; b.style.display = n > 0 ? '' : 'none'; }
}

// ===== UTILS =====
function esc(str) {
    if (!str) return '';
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
function formatDate(str, full=false) {
    if (!str) return '—';
    const d = new Date(str);
    if (full) return d.toLocaleString('en-PH', {dateStyle:'medium',timeStyle:'short'});
    return d.toLocaleDateString('en-PH', {year:'numeric',month:'short',day:'numeric'});
}

// ===== INIT =====
window.addEventListener('DOMContentLoaded', checkSession);