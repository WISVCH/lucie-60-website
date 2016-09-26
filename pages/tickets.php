<?php include_once "components/header.html" ?>


    <section class="bg-secondary">
        <div class="container">
            <div class="row">
                <h1>Tickets</h1>
            </div>
        </div>
    </section>

    <section>
        <div class="container ticket-container">
            <div class="row">
                <div class="col-sm-offset-11 col-sm-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#titleBasket">
                        <i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Basket
                        <span class="badge" id="ticketBadge"></span>
                    </button>
                </div>
            </div>


            <div class="row" id="ticketContainer">

            </div>
        </div>

        <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tickeUsertName">Name</label>
                            <input type="text" class="form-control" id="ticketUserName" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="ticketEmail">Email address</label>
                            <input type="email" class="form-control" id="ticketEmail" placeholder="Email">
                        </div>

                        <input type="hidden" id="ticketKey">
                        <input type="hidden" id="ticketName">
                        <input type="hidden" id="ticketAmount">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addTicketToBasket">
                            Add ticket to basket!
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="titleBasket" tabindex="-1" role="dialog" aria-labelledby="basketLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="basketLabel">Lustrum #trending - basket</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert" id="checkTimeOut" hidden></div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th style="width: 100px;">Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th style="text-align: right;">Total</th>
                                <th colspan="2">&euro; <span id="tableTotal"></span></th>
                            </tr>
                            </tfoot>
                            <tbody id="basketBody" class="basket-table"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="toCheckout">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="blueprint" style="display: none;">
        <div class="col-sm-6 col-md-4 ticket">
            <div class="hidden-xs col-sm-3 ticket-images" style="background-image: url('%background%');"></div>
            <div class="col-sm-9 ticket-description">
                <span class="date">%date%</span>
                <h1>%name%</h1>
                <div class="content">
                    <p>%description%</p>

                    <div>
                        <span class="sold">%diff_sold% tickets left</span>
                        <span class="price">%amount%</span>
                    </div>
                </div>
            </div>
            <a href="#" data-toggle="modal" data-target="#ticketModal" class="btn btn-default ticket-button"
               data-key="%key%" data-ticket="%name%" data-amount="%amount%">
                Add ticket to basket!
            </a>
        </div>
    </div>

<?php include_once "components/footer.html" ?>