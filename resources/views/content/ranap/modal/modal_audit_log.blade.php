@push('style')
    <style>
        .audit-item {
            position: relative;
            border-left: 3px solid #dee2e6;
            margin-left: 15px;
            padding-left: 25px;
            padding-bottom: 25px;
        }

        .audit-item:last-child {
            padding-bottom: 0;
        }

        .audit-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            position: absolute;
            left: -8px;
            top: 4px;
        }

        .audit-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            background: #fff;
        }

        .audit-detail {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        .audit-detail td,
        .audit-detail th {
            border: 1px solid #dee2e6;
            padding: 6px;
            font-size: 12px;
        }
    </style>
@endpush
<div class="modal fade" id="modalAuditLog" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history me-2"></i>
                    Detail Log Perubahan
                </h5>

                <button class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div id="auditTimeline"></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm"
                    data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
    <script>
        function getTrackerLog(table, e) {

            const keys = {
                no_rawat: $(e).data('no_rawat'),
                tgl_perawatan: $(e).data('tgl_perawatan'),
                jam_rawat: $(e).data('jam_rawat')
            };

            $.get("{{ route('audit-logs.get') }}", {
                table: table,
                keys: keys
            }).done(function(response) {

                let html = '';

                response.forEach(function(log) {

                    let b = badge(log.audit_action);

                    html += `
            <div class="audit-item">

                <span class="audit-dot"
                    style="background:${b.dot}">
                </span>

                <div class="audit-card">

                    <div class="d-flex justify-content-between">

                        <span class="badge bg-${b.color}">
                            ${log.audit_action}
                        </span>


                        <small class="text-muted">
                            ${moment(log.created_at).format('DD/MM/YYYY HH:mm:ss')}
                        </small>

                    </div>

                   <div class="mt-2">

Diubah Oleh :
                            <strong class="ms-2">
                                ${log.username}
                            </strong>

                        </div>

            `;

                    if (log.details.length) {

                        html += `
                    <table class="audit-detail mt-3">

                        <thead>

                            <tr>

                                <th>Field</th>

                                <th>Old Value</th>

                                <th>New Value</th>

                            </tr>

                        </thead>

                        <tbody>
                `;

                        log.details.forEach(function(detail) {

                            html += `

                        <tr>

                            <td>${detail.field_name}</td>

                            <td>${detail.old_value ?? '-'}</td>

                            <td>${detail.new_value ?? '-'}</td>

                        </tr>

                    `;

                        });

                        html += `
                        </tbody>

                    </table>
                `;

                    }

                    html += `

                </div>

            </div>

            `;

                });

                $("#auditTimeline").html(html);

                $("#modalAuditLog").modal('show');

            });

        }

        function badge(action) {

            switch (action) {

                case 'INSERT':
                    return {
                        color: 'success',
                            dot: '#198754'
                    };

                case 'UPDATE':
                    return {
                        color: 'warning',
                            dot: '#ffc107'
                    };

                case 'DELETE':
                    return {
                        color: 'danger',
                            dot: '#dc3545'
                    };

                default:
                    return {
                        color: 'secondary',
                            dot: '#6c757d'
                    }

            }

        }
    </script>
@endpush
