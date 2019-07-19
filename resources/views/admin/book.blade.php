@extends('layouts.headerAdmin')

@section('title')
    Foods
@endsection

@section('body')

<?php 
$con=mysqli_connect('localhost','root','','restaurant');
?>
<body>
<?php
if ($result=mysqli_query($con,"SELECT * FROM book")) {
    while ($row=mysqli_fetch_assoc($result)) {

?>
<div id="modal-{{$row['bid']}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="confirm" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row"> <!--First row option starts here-->
                             <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Confirm Booking</h3>
                            <div class="row">
                                <div class="form-group"><label class="col-sm-4 control-label">  Table Number </label>
                                    <div class="col-sm-8"><input type="Number" placeholder=" Table Number " name="table_no" class="form-control">
                                    </div>
                                    {{ csrf_field() }}
                                <input type="hidden" name="bid" value="{{ $row['bid'] }}">
                                </div>
                        </div>
                    </div>
                         <div class="button">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="button text-center">
                                        <div class="form-group">
                                            <p><b>Note:</b> <font color="red">All Fields must be filled</font></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="button text-center">
                                        <div class="form-group">

                                                <button class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="examples">
                                <thead>
                                <tr>
                                    <th>Book ID.</th>
                                    <th> Name </th>
                                    <th> Date </th>
                                    <th>Time</th>
                                    <th>Person </th>
                                    <th>Table No. </th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result=mysqli_query($con,"SELECT * FROM book")) {
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            if ($row['status']=='Under Review') {
                                              $action='<a href="#modal-'.$row['bid'].'" data-toggle="modal">Confirm</a>';
                                            }else{
                                              $action='';
                                            }

                                            echo '<tr class="gradeA">
                                                <td>'.$row['bid'].' </td>
                                                <td>'.$row['name'].' </td>
                                                <td>'.$row['date'].'</td>
                                                <td>'.$row['time'].'</td>
                                                <td>'.$row['count'].'</td>
                                                <td>'.$row['table_no'].'</td>
                                                <td>'.$row['status'].'</td>
                                                <td class="center">'.$action.'</td>
                                            </tr>';
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
<script src="../js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="../js/plugins/dataTables/datatables.min.js"></script>
<!-- Date picker -->
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
                        var j = 5;
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


    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
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