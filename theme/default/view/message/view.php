<?php $data = $this->message->view_msg($this->id);?>
<div class="span9">
   <h1 class="page-title">Messages </h1>
       <div class="row-fluid">
            <div class="block">
            	<dl> 
                	<dt> Sender Nmae </dt>
                    <dd> <?=$data['sender_name'];?></dd>
                </dl>
                <dl> 
                	<dt> Sender Type </dt>
                    <dd> <?=$data['sender_type_id'];?> </dd>
                </dl>
                <dl> 
                	<dt> Content </dt>
                    <dd> <?=$data['content'];?> </dd>
                </dl>
                <dl> 
                	<dt> Date &  Time </dt>
                    <dd> <?=$data['receive_time'];?> </dd>
                </dl>
                <dl> 
                	<dt> Send Message </dt>
                </dl>
            
            </div>
            
             <div class="block-body">
                <form id='send-message' action="javascript:void(0);" method="post">
                   
                    <input type="hidden" class="span6" id="reciver_name" name="reciver_name" value="<?=$data['sender_type_id'];?>" >
                    
                    <label>Content</label>
                    <textarea class="span6" id="description" name="description" style="height:150px;"> </textarea>
                    
                    <br/>
                    <input type="submit" class="btn btn-primary pull-right" id="btn_message" value="Send"  style="float:left"/>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
            
        </div>             
</div>



 <div class="clearfix"></div>  
 </div>


 <div class="clearfix"></div>    
</div>