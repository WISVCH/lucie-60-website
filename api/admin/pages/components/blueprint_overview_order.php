<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width: calc(80vw);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="basketLabel">Order <span class="order_key"></span></h4>
            </div>
            <div class="modal-body">
                <h5>Order details</h5>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>Consumer name</th>
                        <td><span class="consumer_name"></span></td>
                    </tr>
                    <tr>
                        <th>Consumer account</th>
                        <td><span class="consumer_account"></span></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><span class="order_amount"></span></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="order_status"></span></td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td><span class="order_created"></span></td>
                    </tr>
                    </tbody>
                </table>

                <h5>Tickets details</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Owner name</th>
                        <th>Owner email</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody class="ticket-details"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>