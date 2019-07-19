@extends('layouts.headerAdmin')

@section('title')
    Foods
@endsection

@section('body')

<?php 
$con=mysqli_connect('localhost','root','','restaurant');
?>
<body>

<div id="modal-add" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/food.php" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row"> <!--First row option starts here-->
                             <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Add Cost</h3>
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="col-sm-4 control-label">  Food Name </label>
                                    <div class="col-sm-8"><input type="text" placeholder=" Food Name " name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">  Food Details </label>
                                    <div class="col-sm-8"><textarea placeholder=" Food Details " name="details" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label"> Food Type </label>
                                    <div class="col-sm-8"><label class="radio-inline">
                                            <input type="radio" name="type" value="Lunch" checked>Lunch
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="Dinner">Dinner
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"><label class="col-sm-4 control-label"> Price per Unite </label>
                                    <div class="col-sm-8"><input type="Number" placeholder="  Total Cost  " name="price" class="form-control"  >
                                    </div>
                                </div>
                                <div class="form-group" id="data_1">
                                    <label class="col-sm-4 control-label">Food Image </label>
                                    <div class="col-sm-8">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file" ><span class="fileinput-new" >Select file</span>
                                            <span class="fileinput-exists">Change</span><input type="file" id="image_location" name="image_location" ></span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
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



    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>  Cost Information  </h5>
                   <a class="btn-primary pull-right btn-sm" href="#modal-add" data-toggle="modal">Add Cost</a>
                        </div>
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="examples">
                                <thead>
                                <tr>
                                    <th>Food ID.</th>
                                    <th> Name </th>
                                    <th> Image </th>
                                    <th>Type</th>
                                    <th> Price Per Unite </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result=mysqli_query($con,"SELECT * FROM foods")) {

                                        while ($row=mysqli_fetch_assoc($result)) {
                                            if (!empty($row['image_location'])) {
                                              $img='<a href="../'.$row['image_location'].'" target="_blank"><img src="../'.$row['image_location'].'" width="50px" height="50px" /></a>';
                                            }else{
                                              $img='No Image';
                                            }

                                            echo '<tr class="gradeA">
                                                <td>'.$row['fid'].' </td>
                                                <td>'.$row['name'].' </td>
                                                <td style="text-align:center;">'.$img.'</td>

                                                <td>'.$row['type'].'</td>
                                                <td class="center">'.$row['price'].'</td>
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