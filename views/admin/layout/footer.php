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

<script src="<?= base_url('assets/js/admin-ui.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.DataTable) return;
    document.querySelectorAll('.admin-table').forEach(function (table) {
        const noSort = [];
        table.querySelectorAll('thead th.no-sort').forEach(function (th) {
            noSort.push(Array.from(th.parentNode.children).indexOf(th));
        });
        if (table.dataset.dtReady === '1') return;
        table.dataset.dtReady = '1';
        new DataTable(table, {
            responsive: true, pageLength: 10,
            lengthMenu: [[5,10,25,50,100,-1],[5,10,25,50,100,'All']], order: [],
            columnDefs: [{ orderable:false, targets:noSort }],
            layout: {
                topStart: ['pageLength', {buttons:[
                    {extend:'copy', text:'<i class="fa-regular fa-copy"></i> Copy', exportOptions:{columns:':visible'}},
                    {extend:'excel', text:'<i class="fa-regular fa-file-excel"></i> Excel', exportOptions:{columns:':visible'}},
                    {extend:'pdf', text:'<i class="fa-regular fa-file-pdf"></i> PDF', exportOptions:{columns:':visible'}, orientation:'landscape', pageSize:'A4'},
                    {extend:'print', text:'<i class="fa-solid fa-print"></i> Print', exportOptions:{columns:':visible'}},
                    {extend:'colvis', text:'<i class="fa-solid fa-table-columns"></i> Columns'}
                ]}], topEnd:'search', bottomStart:'info', bottomEnd:'paging'
            },
            language:{search:'', searchPlaceholder:'Search...', lengthMenu:'Show _MENU_', info:'Showing _START_ to _END_ of _TOTAL_ records', infoEmpty:'Showing 0 to 0 of 0 records', zeroRecords:'No matching records found', emptyTable:'No records available'}
        });
    });
});
</script>
</body>
</html>
