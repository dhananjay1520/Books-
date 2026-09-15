</div><!-- /.content -->
</div><!-- /.main -->
</div><!-- /.admin-shell -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/js/admin-ui.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.DataTable) return;
    document.querySelectorAll('.admin-table').forEach(function (table) {
        if (table.dataset.dtReady === '1') return;
        table.dataset.dtReady = '1';
        new DataTable(table, {
            responsive: true,
            pageLength: 10,
            lengthMenu: [[5,10,25,50,100,-1],[5,10,25,50,100,'All']],
            order: [],
            language: {
                search: '',
                searchPlaceholder: 'Search...',
                lengthMenu: 'Show _MENU_',
                info: 'Showing _START_ to _END_ of _TOTAL_ records',
                zeroRecords: 'No matching records found',
                emptyTable: 'No records available'
            }
        });
    });
</script>
</body>
</html>
