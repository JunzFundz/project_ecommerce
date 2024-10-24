<style>
    /* Add the css after this */
    .tools-dashborad a {
        text-decoration: none;
        display: block;
    }

    .tools-dashborad .custom-tiles {
        min-height: 160px;
        padding: 10px 10px;
        position: relative;
        color: #fff;
        border-radius: 4px;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        transition: all 0.35s ease;
    }

    .tools-dashborad .custom-tiles span {
        display: inline-block;
        font-size: 22px;
        margin: 10px 0px 0px;
        line-height: 1.1;
        font-weight: bold;
    }

    .tools-dashborad .custom-tiles h3 {
        font-size: 16px;
        margin: 5px 0 0 0;
        letter-spacing: 1px;
    }

    .tools-dashborad .custom-tiles .icon-wrap {
        height: 32px;
        width: 32px;
        position: absolute;
        right: 30px;
        top: 30px;
        font-size: 28px;
        transition: all 0.35s ease;
        opacity: 0.7;
    }

    .tools-dashborad .total-records {
        background-color: #07B55C;
    }

    .tools-dashborad .in-progress {
        background-color: #E9A127;
    }

    .tools-dashborad .my-pending {
        background-color: #C5292E;
    }

    .tools-dashborad .group-pending {
        background-color: #17A2B8;
    }

    .tools-dashborad .custom-tiles .small-box-footer {
        position: absolute;
        text-align: center;
        padding: 5px 0;
        color: rgba(255, 255, 255, .8);
        display: block;
        background: rgba(0, 0, 0, .1);
        text-decoration: none;
        bottom: 0;
        width: 100%;
        left: 0;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .tools-dashborad .custom-tiles .small-box-footer:hover {
        color: #fff;
        background: rgba(0, 0, 0, .15);
    }

    .chart-wrap {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }

    .middle-wrap .m-block {
        width: 50%;
        float: left;
        background: rgba(255, 255, 255, 0.1);
        padding: 10px 10px;
    }

    .middle-wrap {
        margin: 15px -10px 0px;
    }

    .tools-dashborad .custom-tiles .middle-wrap h3 {
        font-size: 12px;
        display: inline-block;
    }

    .tools-dashborad .custom-tiles .middle-wrap span {
        font-size: 14px;
        display: inline-block;
    }


    .chart-head {
        font-size: 20px;
        padding: 10px;
        color: #053f79;
        font-weight: 700;
    }

    .chartdiv {
        width: 100%;
        height: auto;
        background-color: white;
    }
</style>


<div class="tools-dashborad">
    <div class="row"> 
            <div class="col-sm-3">
                <div class="custom-tiles total-records">
                    <h3 class="animated slideInUp">Total Registered</h3>
                    <span class="animated slideInUp"></span>

                    <div class="icon-wrap"><i class="fa fa-book" aria-hidden="true"></i></div>
                </div>
            </div> 


            <div class="col-sm-3">
                <div class="custom-tiles in-progress">
                    <h3 class="animated slideInUp">Requests</h3>
                    <span class="animated slideInUp"></span>

                    <div class="icon-wrap"></div>
                    <div class="middle-wrap clearfix">
                        <div class="m-block">
                            <h3 class="animated slideInUp">Pending:</h3>
                            <span class="animated slideInUp"></span>
                        </div>
                        <div class="m-block">
                            <h3 class="animated slideInUp">Approved:</h3>
                            <span class="animated slideInUp"></span>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-sm-3">
            <div class="custom-tiles my-pending">
                <h3 class="animated slideInUp">Items</h3>
                <span class="animated slideInUp"></span>

                <div class="icon-wrap"></div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="custom-tiles group-pending">
                <h3 class="animated slideInUp">Transactions</h3>
                <span class="animated slideInUp"></span>

                <div class="icon-wrap"></div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<ul class="nav nav-fill nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="chart--rating" data-bs-toggle="tab" href="#chart--link" role="tab" aria-controls="chart--link" aria-selected="true"> Tab 1 </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ratings--view" data-bs-toggle="tab" href="#ratings--link" role="tab" aria-controls="ratings--link" aria-selected="false"> Tab 2 </a>
    </li>
</ul>
<div class="tab-content pt-5" id="tab-content">
    <div class="tab-pane active" id="chart--link" role="tabpanel" aria-labelledby="chart--rating">
        
    </div>
    <div class="tab-pane" id="ratings--link" role="tabpanel" aria-labelledby="ratings--view">
        <div class="table--ratings">
 
                <table class="table table-striped text-left" id="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Item</th>
                            <th scope="col">Ratings</th>
                            <th scope="col">Quality</th>
                            <th scope="col">Service</th>
                            <th scope="col">Comments</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
 
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> 
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger remove-rating--"><i class="bi bi-eraser"></i></button>
                                </td>
                            </tr>
 
                    </tbody>
                </table>

        </div>
    </div>
</div>

<br>