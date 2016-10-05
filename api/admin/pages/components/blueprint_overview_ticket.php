<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width: calc(80vw);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="basketLabel">Ticket <span class="ticket_name"></span></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="hidden_ticket" id="hidden_value" value="">
                    <input type="submit" name="submit_hidden" value="Show/Hide" class="btn btn-danger">
                </form>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Unique number</th>
                    </tr>
                    </thead>
                    <tbody class="consumers-details"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>