<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Yohanes Arif Pradono">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>InaHRS | Indonesia Heart Rhythm Sociaty</title>

    <link href="/assets/event/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
        fieldset {
            padding-bottom: 25px;
        }
    </style>
    <script>
    function myFunction() {
        window.print();
    }
    </script>
</head>

<body>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <h1>
                <img width="300" src="/assets/images/inahrslogo.png">
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>
            <h1><small>Transaction Number: <b><?php echo @$_GET['tx_num'] ?></b></small></h1>
            Payment Status:
            <b>
                <?php if($registrant['paid']) { ?>
                    <span style="color: #0BD20B;">PAID</span>
                <?php } else { ?>
                    <span style="color: red;">UNPAID</span>
                <?php } ?>
            </b>
            <br><button onclick="myFunction()">Print this page</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>From: InaHRS</h4>
                </div>
                <div class="panel-body">
                    <p>
                        National Cardiovascular Center Harapan Kita<br>
                        Cardiac Catheterization Lab, 2nd floor<br />
                        Jl. Letjend. S. Parman Kav. 87, Slipi<br />
                        Jakarta Barat, 11420<br />
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>To: <?php echo @$registrant['fullname'] ?></h4>
                </div>
                <div class="panel-body">
                    <p>
                        <?php echo @$registrant['company_name'] ?> <br>
                        <?php echo @$registrant['company_address'] ?> <br>
                        <?php echo @$registrant['company_city'] ?> <br>
                        <?php echo @$registrant['company_state'] ?> <br>
                        <?php echo @$registrant['company_country'] ?> <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- / end client details section -->

    <table>
        <tbody>
        <tr>
            <td><b>Event Name</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td><?php echo @$registrant['event_title'] ?></td>
        </tr>
        <tr>
            <td><b>Dates</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td><?php echo @$registrant['event_date'] ?></td>
        </tr>
        <tr>
            <td><b>Place</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td><?php echo @$registrant['event_place'] ?></td>
        </tr>
        </tbody>
    </table>

    <br>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="participant_name">Participant Name</th><th class="program" style="min-width: 300px;">Program</th><th class="fee" style="width: 202px;">Fee</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($registrant['participants'] as $key => $participant): ?>
            <?php
            $rowspan = 0;
            if(isset($participant['symposium'])) $rowspan += 1;
            $rowspan += @count(@$participant['workshops']);
            ?>
            <?php if(isset($participant['symposium'])): ?>
                <tr>
                    <td <?php if($rowspan>0) echo 'rowspan="'.$rowspan.'"'; ?>><?php echo $participant['fullname'] ?></td>
                    <td>Symposium for <?php echo $participant['symposium']['participant_type'] ?></td>
                    <td>Rp. <?php echo @number_format((int) @$participant['symposium']['fee'] * 1000) ?></td>
                </tr>
            <?php endif; ?>

            <?php if(@count(@$participant['workshops']) > 0) { foreach($participant['workshops'] as $p=>$workshop) :?>

                <tr>

                    <?php if(!isset($participant['symposium'])  and $p == 0): ?><td <?php if($rowspan>0 and $p == 0) echo 'rowspan="'.$rowspan.'"'; ?> ><?php echo $participant['fullname'] ?></td><?php endif; ?>

                    <td><?php echo $workshop['name'] ?></td>
                    <td>Rp. <?php echo number_format($workshop['fee'] * 1000) ?></td>
                </tr>
            <?php endforeach; } ?>

        <?php endforeach; ?>


        </tbody>
    </table>

	<?php if( count ( $registrant['hotels'] ) > 0 ): ?>
<table class="table table-bordered">
        <thead>
        <tr>
            <th class="participant_name">Hotel Name</th>
			<th class="program" style="min-width: 300px;">Room Type</th>
			<th>Room</th>
            <th>Night</th>
            <th>Book Dates</th>
			<th class="fee" style="width: 202px;">Fee</th>
        </tr>
        </thead>
        <tbody>

		<?php foreach ($registrant['hotels'] as $hotel) : ?>
                 <tr>
                    <td><?php echo $hotel['hotel_name'] ?></td>
                    <td><?php echo $hotel['hotel_room'] ?></td>
                    <td><?php echo $hotel['room_count'] ?></td>
					<td><?php echo $hotel['night'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($hotel['book_from'])) . ' - ' . date('d/m/Y', strtotime($hotel['book_to'])) ?></td>
                    <td>Rp. <?php echo number_format($hotel['total'] * 1000) ?></td>
                </tr>
          <?php endforeach; ?>
        

        </tbody>
    </table>
	<?php endif; ?>

    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                Rp. <?php echo number_format($registrant['total'] * 1000) ?><br>
            </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Bank details</h4>
                </div>
                <div class="panel-body">
                    <?php echo $payment_info ?>
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="span7">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Contact Details</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Phone : (021) 568 4093, ext 5004, 1223<br>
                            Fax : (021) 568 4130/4230<br>
                            Email : inahrs2014@gmail.com <br>
                            Web : <a href="http://www.inahrs.or.id">http://www.inahrs.or.id</a>
                        </p>
                        <h4>Payment should be made by Bank Transfer</h4>
                    </div>
                </div>
            </div>
        </div>
        <b style="color:red;">Payment must be made within a month or registration process will be canceled.</b>
    </div>
</div>
<br>
<footer>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div style="float: left;">
                    Copyright &copy; 2016 | Indonesian Hearth Rhythm Society
                </div>
            </div>
        </div>
    </div>
</footer>

<br />
</body>
</html>

