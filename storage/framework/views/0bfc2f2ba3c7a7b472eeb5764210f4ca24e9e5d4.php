<?php $__env->startPush('stylesheets'); ?>

<link href="<?php echo e(asset("css/multi-select.css")); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('main_content'); ?>

    
    <?php
    $counter = 1;
    $boot_style = 'info';
    ?>

    <?php foreach($sites as $site): ?>
        <?php if($counter % 3 == 0): ?>
            <div class="row">
                <?php endif; ?>
                <div class="col-sm-4">


                        <div class="card card-user">
                            <div class="image">
                            
                                <img src="<?php echo e(asset('img/bg/'.$site->id.'.jpg')); ?>" alt="...">
                            </div>
                            <div class="content">
                                <div class="author">
                                <?php if($site->isCafet): ?>
                                <img class="avatar border-white" src="<?php echo e(asset('img/faces/cafeteria.png')); ?>" alt="...">
                                <?php else: ?>
                                <img class="avatar border-white" src="<?php echo e(asset('img/faces/mensa.png')); ?>" alt="...">
                                <?php endif; ?>
                                  <h4 class="title"><?php echo e($site->translate()->name); ?><br>
                                     <a href="#"><small><?php echo $site->address; ?></small></a>
                                  </h4>
                                </div> 
                          
                                <p class="description text-center"> 
                                <?php if(!$site->isCafet): ?>
                                    <?php if($site->today): ?>
                                Aujourd'hui:
                                    <table class="table table-striped">
                                    <?php foreach($site->today as $menu): ?>
                                        <tr>
                                            <td><?php echo e($menu->translate()->title); ?><small> <?php echo e($menu->translate()->subtitle); ?></small></td>
                                            <td> <small>(<?php echo e($menu->label); ?>)</small></td>
                                        </tr> 
                                    <?php endforeach; ?>
                                    </table>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </p>
                            </div>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <a class="btn btn-link btn-md btn-block btn-primary modalButton"  data-toggle="modal" data-item-type="sites" data-id="<?php echo e($site->id); ?>" data-action-type="edit" role="button">
                                            <i class="ti-settings"></i>     
                                        </a>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-md-4">

                                        <?php if(!$site->isCafet): ?>
                                        <a class="btn btn-link btn-md btn-primary btn-block" href="<?php echo e(URL::to('generate-pdf/' . $site->id . '/'.date('d.m.Y'))); ?>" role="button">
                                            <i class="ti-import"></i> PDF
                                        </a>

                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <?php if(!$site->isCafet): ?>
                                            <a class="btn btn-default btn-md btn-primary btn-block"  href="<?php echo e(URL::to('sites/' . $site->id . '/'.date('d.m.Y'))); ?>" role="button">
                                                <i class="ti-calendar"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                </div>                                   
                


                <?php if($counter % 3 == 0): ?>
            </div>
        <?php endif; ?>
        <?php $counter++; ?>
    <?php endforeach; ?>


        <div class="col-sm-4">
            

            <div class="card card-user">
                <div class="content">
                    
                <h4 class="description text-center">
                    <a class="modalButton" data-toggle="modal" data-item-type="sites" data-id="0" data-action-type="create">Ajouter un site</a>
                </h4>
                <div class="text-center">
                </div>
            </div>
                  
          </div>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>->
<script src="<?php echo e(asset("js/jquery.multi-select.js")); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setModalListener();
    });

    function setModalListener(){
        $('.modalButton').on('click', function(){
            var this_id = $(this).attr('data-id');
            var this_action = $(this).attr('data-action-type');
            var this_type = $(this).attr('data-item-type');
            
                var url = "<?php echo e(url('/')); ?>/"+this_type+"/form/"+this_action+"/"+this_id;
                $.get(url, function( data ) {
                    $('#myModal').modal();
                    $('#myModal').on('shown.bs.modal', function(){
                        $('#myModal .load_modal').html(data);

                        $('#exportSelect').multiSelect({
                            selectableHeader: "<div class='custom-header'>Masqu??s</div>",
                            selectionHeader: "<div class='custom-header'>Affich?? sur le document</div>",
                            keepOrder: true,
                            afterInit: function(ms){
                                // console.log($('#export').val());
                                var selection =  JSON.parse($('#export').val());
                                for(var i=0;i<selection.length;i++){
                                    // var sel = [];
                                    val = selection[i];
                                    // sel.push(val);
                                    $('#exportSelect').multiSelect('select', val);
                                }
                            },
                            afterSelect: function(values){
				    var val = JSON.parse($("#export").val());

                                if(val.indexOf(values[0]) !== -1){
                                    console.log("Value exists!")
                                } else{
                                    val.push(values[0]);
                                      console.log("Value does not exists! : " +values[0])
                                }

                                $("#export").val(JSON.stringify(val));
                            },
                            afterDeselect: function(values){
			      var val = JSON.parse($("#export").val());

                              var index = val.indexOf(values[0]);
                              if(index !== -1){
                                  val.splice(index, 1);
                                  console.log("Removed! : "+values[0]);
                              } else{
                                  val.push(values[0]);
                                    console.log("Doesnt exist!" );
                              }

                              $("#export").val(JSON.stringify(val));

                            }
                        });
                        $('.deleteButton').on('click', function(){
                            var url = "<?php echo e(url('/')); ?>/"+this_type+"/form/remove/"+this_id;
                            $.get(url, function( data ) {
                                $('#myModal .load_modal').html(data);
                            });
                        });
                    });
                    $('#myModal').on('hidden.bs.modal', function(){
                        $('#myModal .modal-body').data('');
                    });
                });
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>