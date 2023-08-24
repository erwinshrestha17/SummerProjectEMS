<!-- Invoices -->
<div class="row mt-2">
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Invoices</h6>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">View All</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <ul class="list-group">
                        <!-- Your invoice list items here -->
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
                                <span class="text-xs">#MS-415646</span>
                            </div>
                            <div class="d-flex align-items-center text-sm">
                                $180
                                <!-- Add a link to trigger PDF generation -->
                                <a href="generate_pdf.php?invoice=MS-415646" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" target="_blank"><i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> PDF</a>
                            </div>
                        </li>
                        <!-- Repeat for other invoices -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
