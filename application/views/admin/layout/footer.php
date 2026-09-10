</div><!-- /.content -->
</div><!-- /.main -->
</div><!-- /.admin-shell -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const sidebar = document.getElementById('adminSidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const themeToggle = document.getElementById('themeToggle');
    const themeMenu = document.getElementById('themeMenu');
    const userBtn = document.getElementById('adminUserBtn');
    const userMenu = document.getElementById('adminUserMenu');
    const noticeBtn = document.getElementById('noticeBtn');
    const noticeMenu = document.getElementById('noticeMenu');

    const isMobile = () => window.innerWidth <= 991;

    // Sidebar: collapsed by default on desktop; fully hidden off-canvas on mobile.
    function syncSidebarButton() {
        if (!toggle || !sidebar) return;
        const mobile = isMobile();
        const opened = mobile ? sidebar.classList.contains('is-open') : sidebar.classList.contains('is-open');
        const label = opened ? 'Close sidebar' : 'Open sidebar';
        toggle.setAttribute('aria-label', label);
        toggle.title = label;
    }

    function openSidebar() {
        if (!sidebar) return;
        sidebar.classList.add('is-open');
        if (isMobile()) {
            overlay && overlay.classList.add('show');
            body.style.overflow = 'hidden';
        } else {
            localStorage.setItem('bookspot-sidebar', 'open');
        }
        syncSidebarButton();
    }

    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('is-open');
        if (isMobile()) {
            overlay && overlay.classList.remove('show');
            body.style.overflow = '';
        } else {
            localStorage.setItem('bookspot-sidebar', 'closed');
        }
        syncSidebarButton();
    }

    function initSidebar() {
        if (!sidebar) return;
        if (isMobile()) {
            sidebar.classList.remove('is-open');
            overlay && overlay.classList.remove('show');
        } else if (localStorage.getItem('bookspot-sidebar') === 'open') {
            sidebar.classList.add('is-open');
        } else {
            sidebar.classList.remove('is-open');
        }
        syncSidebarButton();
    }

    initSidebar();
    toggle && toggle.addEventListener('click', function () {
        sidebar.classList.contains('is-open') ? closeSidebar() : openSidebar();
    });
    overlay && overlay.addEventListener('click', closeSidebar);
    sidebar && sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (isMobile()) closeSidebar();
        });
    });
    window.addEventListener('resize', initSidebar);

    // Theme mode + accent palette.
    const savedMode = localStorage.getItem('bookspot-admin-mode') || 'light';
    const savedAccent = localStorage.getItem('bookspot-admin-theme') || 'indigo';
    if (savedMode === 'dark') body.classList.add('theme-dark');
    ['emerald', 'ocean', 'rose', 'violet', 'amber'].forEach(function (name) {
        body.classList.remove('theme-' + name);
    });
    if (['emerald', 'ocean', 'rose', 'violet', 'amber'].indexOf(savedAccent) !== -1) {
        body.classList.add('theme-' + savedAccent);
    }

    function syncTheme() {
        if (!themeToggle) return;
        const dark = body.classList.contains('theme-dark');
        themeToggle.innerHTML = dark
            ? '<i class="fa-solid fa-sun"></i><span class="theme-toggle-label">Light</span>'
            : '<i class="fa-solid fa-moon"></i><span class="theme-toggle-label">Dark</span>';
        themeToggle.title = dark ? 'Switch to light mode' : 'Switch to dark mode';
        themeToggle.setAttribute('aria-label', themeToggle.title);
    }
    syncTheme();

    themeToggle && themeToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        body.classList.toggle('theme-dark');
        localStorage.setItem('bookspot-admin-mode', body.classList.contains('theme-dark') ? 'dark' : 'light');
        syncTheme();
    });

    const themePaletteBtn = document.getElementById('themePaletteBtn');
    themePaletteBtn && themePaletteBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        themeMenu && themeMenu.classList.toggle('show');
        userMenu && userMenu.classList.remove('show');
        noticeMenu && noticeMenu.classList.remove('show');
    });

    themeMenu && themeMenu.querySelectorAll('.theme-option').forEach(function (option) {
        option.addEventListener('click', function (e) {
            e.stopPropagation();
            ['emerald', 'ocean', 'rose', 'violet', 'amber'].forEach(function (name) {
                body.classList.remove('theme-' + name);
            });
            const name = option.dataset.theme || 'indigo';
            if (['emerald', 'ocean', 'rose', 'violet', 'amber'].indexOf(name) !== -1) {
                body.classList.add('theme-' + name);
            }
            localStorage.setItem('bookspot-admin-theme', name);
            themeMenu && themeMenu.classList.remove('show');
        });
    });

    // User / notification menus.
    userBtn && userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        userMenu && userMenu.classList.toggle('show');
        noticeMenu && noticeMenu.classList.remove('show');
        themeMenu && themeMenu.classList.remove('show');
    });
    noticeBtn && noticeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        noticeMenu && noticeMenu.classList.toggle('show');
        userMenu && userMenu.classList.remove('show');
        themeMenu && themeMenu.classList.remove('show');
    });
    document.addEventListener('click', function () {
        userMenu && userMenu.classList.remove('show');
        noticeMenu && noticeMenu.classList.remove('show');
        themeMenu && themeMenu.classList.remove('show');
    });

    // Shared DataTables configuration for every .admin-table.
    if (window.DataTable) {
        document.querySelectorAll('.admin-table').forEach(function (table) {
            const noSort = [];
            table.querySelectorAll('thead th.no-sort').forEach(function (th) {
                noSort.push(Array.from(th.parentNode.children).indexOf(th));
            });
            if (table.dataset.dtReady === '1') return;
            table.dataset.dtReady = '1';

            new DataTable(table, {
                responsive: true,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, 'All']
                ],
                order: [],
                columnDefs: [{ orderable: false, targets: noSort }],
                layout: {
                    topStart: [
                        'pageLength',
                        {
                            buttons: [
                                {
                                    extend: 'collection',
                                    text: '<i class="fa-solid fa-download"></i> Export',
                                    buttons: [
                                        { extend: 'copy', text: '<i class="fa-regular fa-copy"></i> Copy', exportOptions: { columns: ':visible' } },
                                        { extend: 'csv', text: '<i class="fa-solid fa-file-csv"></i> CSV', exportOptions: { columns: ':visible' } },
                                        { extend: 'excel', text: '<i class="fa-regular fa-file-excel"></i> Excel', exportOptions: { columns: ':visible' } },
                                        { extend: 'pdf', text: '<i class="fa-regular fa-file-pdf"></i> PDF', exportOptions: { columns: ':visible' }, orientation: 'landscape', pageSize: 'A4' },
                                        { extend: 'print', text: '<i class="fa-solid fa-print"></i> Print', exportOptions: { columns: ':visible' } }
                                    ]
                                },
                                { extend: 'colvis', text: '<i class="fa-solid fa-table-columns"></i> Columns Visibility' }
                            ]
                        }
                    ],
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
                language: {
                    search: '',
                    searchPlaceholder: 'Search...',
                    lengthMenu: 'Show _MENU_',
                    info: 'Showing _START_ to _END_ of _TOTAL_ records',
                    infoEmpty: 'Showing 0 to 0 of 0 records',
                    zeroRecords: 'No matching records found',
                    emptyTable: 'No records available'
                }
            });
        });
    }
});
</script>
</body>
</html>
