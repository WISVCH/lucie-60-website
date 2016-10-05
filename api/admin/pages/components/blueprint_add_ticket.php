<div class="modal fade" id="ticketAddModal" tabindex="-1" role="dialog" aria-labelledby="addTicket">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="basketLabel">Add ticket</h4>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Ticket name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea name="description" class="form-control" id="description" cols="30"
                                  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Price: </label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                               placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="date">Date: </label>
                        <input type="date" class="form-control" id="date" name="date"
                               placeholder="Date event">
                    </div>
                    <div class="form-group">
                        <label for="max_sold">Max sold: </label>
                        <input type="number" class="form-control" id="max_sold" name="max_sold"
                               placeholder="Max sold tickets">
                    </div>
                    <div class="form-group">
                        <label for="available">Available: </label>
                        <select name="available" id="available" class="form-control">
                            <option value="0">False</option>
                            <option value="1">True</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="background">Background url: </label>
                        <input type="text" class="form-control" id="background" name="background"
                               placeholder="URL to background">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" name="addTicket">
                </div>
            </form>
        </div>
    </div>
</div>