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
            <div class="row" id="ticketContainer">

            </div>
        </div>
    </section>

    <div id="blueprint">
        <div class="col-sm-6 col-md-4 ticket">
            <div class="hidden-xs col-sm-3 ticket-images"></div>
            <div class="col-sm-9 ticket-description">
                <span class="date">%date%</span>
                <h1>%name%</h1>
                <div class="content">
                    <p>%description%</p>
                    <span class="price">%amount%</span>
                </div>
            </div>
            <a href="#" class="btn btn-default ticket-button" data-key="%key%">
                <i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Add ticket to basket!
            </a>
        </div>
    </div>

<?php include_once "components/footer.html" ?>