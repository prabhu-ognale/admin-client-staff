 <div class="span9">
  <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
</div>
<h1 class="page-title">Dashboard</h1>     
 <div class="row-fluid">
    <div class="block">
            <div class="block-heading">Send New Message</div>
            <div class="block-body">
                <form id='send-message' action="javascript:void(0);" method="post">
                    
                    <label>Select Name</label>
                    <input type="text" class="span6" id="reciver_name" name="reciver_name" data-provide="getname">
                    
                    <label>Content</label>
                    <textarea class="span6" id="description" name="description" style="height:150px;"> </textarea>
                    
                    <br/>
                    <input type="submit" class="btn btn-primary pull-right" id="btn_message" value="Send"  style="float:left"/>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
</div>
</div>
  <div class="clearfix"></div>
</div>


 <script type="text/javascript">
		$("#reciver_name").autocomplete({
			minLength:2,
			//source
			source: function(req, add) {
				$.getJSON(postUrl+"?page=messageaction=get_name", req, function(data) {
					var suggestions = [];
					$.each(data, function(i, val) {
						suggestions.push(val.name);
					});
					add(suggestions);
				});
			},
			//select
			select: function(e, ui) {
				alert(ui.item.value);
			}
			alert(suggestions);
		})
		</script>