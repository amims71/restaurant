@extends('layouts.headerAdmin')

@section('title')
    Orders
@endsection

@section('body')

<?php
$con=mysqli_connect('localhost','root','','restaurant') or die();
?>

<body>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <!-- <a class=" btn btn-w-m btn-primary pull-right btn-lg" href="#modal-add" data-toggle="modal">Add User</a> -->
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                        <ul class="nav nav-tabs">
                          <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-line-chart"></i>Ordered</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-file-excel-o"></i>Under Process</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-file-excel-o"></i>Completed</a></li>
                        </ul>
                    <div class="tab-content">
                         <div id="tab-1" class="tab-pane">
                            <div class="ibox-title">
                                <h5>Ordered Item</h5>
                            </div>
                      <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th> Items </th>
                                    <th> Ordered By </th>
                                    <th>Table No.</th>
                                    <th>Total Price </th>
                                    <th>Change State</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    if ($result=mysqli_query($con,"SELECT * FROM orders WHERE state='Ordered'")) {
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            $sql2="SELECT * FROM users WHERE uid=".$row['uid'];
                                             $resul2=mysqli_query($con,$sql2);
                                             $name=mysqli_fetch_assoc($resul2)['name'];

                                            echo '<tr class="gradeA">
                                                <td>'.$i.' </td>
                                                <td>'.$row['items'].' </td>
                                                <td>'.$name.'</td>
                                                <td> '.$row['table_no'].' </td>
                                                <td class="center">'.$row['price'].'</td>
                                                <td><a href="process/'.$row['oid'].'">click</a></td>
                                            </tr>';
                                            $i++;
                                         }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>


               <div id="tab-2" class="tab-pane  ">
                            <div class="ibox-title">
                                <h5> Processing Items</h5>
                            </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th> Items </th>
                                    <th> Ordered By </th>
                                    <th>Table No.</th>
                                    <th>Total Price </th>
                                    <th>Change State</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    if ($result=mysqli_query($con,"SELECT * FROM orders WHERE state='Under Process'")) {
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            $sql2="SELECT * FROM users WHERE uid=".$row['uid'];
                                             $resul2=mysqli_query($con,$sql2);
                                             $name=mysqli_fetch_assoc($resul2)['name'];

                                            echo '<tr class="gradeA">
                                                <td>'.$i.' </td>
                                                <td>'.$row['items'].' </td>
                                                <td>'.$name.'</td>
                                                <td> '.$row['table_no'].' </td>
                                                <td class="center">'.$row['price'].'</td>
                                                <td><a href="complete/'.$row['oid'].'">click</a></td>
                                            </tr>';
                                            $i++;
                                         }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>



            <div id="tab-3" class="tab-pane ">
                            <div class="ibox-title">
                                <h5>  Completed Items </h5>
                            </div>
                     <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th> Items </th>
                                    <th> Ordered By </th>
                                    <th>Table No.</th>
                                    <th>Total Price </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    if ($result=mysqli_query($con,"SELECT * FROM orders WHERE state='Completed'")) {
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            $sql2="SELECT * FROM users WHERE uid=".$row['uid'];
                                             $resul2=mysqli_query($con,$sql2);
                                             $name=mysqli_fetch_assoc($resul2)['name'];

                                            echo '<tr class="gradeA">
                                                <td>'.$row['oid'].' </td>
                                                <td>'.$row['items'].' </td>
                                                <td>'.$name.'</td>
                                                <td> '.$row['table_no'].' </td>
                                                <td class="center">'.$row['price'].'</td>
                                            </tr>';
                                            $i++;
                                         }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="../js/plugins/dataTables/datatables.min.js"></script>
<script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Custom and plugin javascript -->

<script src="../js/plugins/pace/pace.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
          //live total count
          "paging": false,
          			"autoWidth": true,
          			"footerCallback": function ( row, data, start, end, display ) {
          				var api = this.api();
          				nb_cols = api.columns().nodes().length;
          				var j = 4;
          				while(j < nb_cols){
          					var pageTotal = api
                          .column( j, { page: 'current'} )
                          .data()
                          .reduce( function (a, b) {
                              return Number(a) + Number(b);
                          }, 0 );
                    // Update footer
                    $( api.column( j ).footer() ).html(pageTotal);
          					j++;
          				}
          			},
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy',footer:true},
                {extend: 'csv',footer:true},
                {extend: 'excel', title: 'ExampleFile',footer:true},
                {extend: 'pdf', title: 'ExampleFile',footer:true},

                {extend: 'print',footer:true,
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });


        $('#search_data .input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });

</script>
@endsection