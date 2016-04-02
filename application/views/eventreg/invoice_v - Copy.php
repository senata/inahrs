<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Yohanes Arif Pradono">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
        fieldset {
            padding-bottom: 25px;
        }
    </style>
</head>

<body>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <h1>
                <img src="logo.png">
                InaHRS
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>
            <h1><small>Transaction Number: <b><?php echo @$_GET['tx_num'] ?></b></small></h1>
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
                <td><?php echo @number_format((int) @$participant['symposium']['fee'] * 1000) ?></td>
            </tr>
            <?php endif; ?>

        <?php if(@count(@$participant['workshops']) > 0) { foreach($participant['workshops'] as $p=>$workshop) :?>

            <tr>

                <?php if(!isset($participant['symposium'])  and $p == 0): ?><td <?php if($rowspan>0 and $p == 0) echo 'rowspan="'.$rowspan.'"'; ?> ><?php echo $participant['fullname'] ?></td><?php endif; ?>

                <td><?php echo $workshop['name'] ?></td>
                <td><?php echo number_format($workshop['fee'] * 1000) ?></td>
            </tr>
        <?php endforeach; } ?>

        <?php endforeach; ?>


        </tbody>
    </table>

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
                    <p>Your Name: Pokja Electrophysiology &amp; Pacing</p>
                    <p>Bank Name: Bank Mandiri</p>
                    <p>Account Number : 117.000.631.3845</p>
					<p>Branch : Jakarta Harapan Kita</p>	
                    <p>SWIFT : BMRIIDJA</p>
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
    </div>
</div>

<footer>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div style="float: left;">
                    Copyright &copy; 2015 | Indonesian Hearth Rhythm Society
                </div>
                <div style="float: right;">
                    IT Powered by <a href="http://www.mdn.web.id" target="_blank">MDN</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<br />
</body>
</html>

