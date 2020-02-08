<!-- jQuery -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- jQuery UI -->
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

<script type="text/javascript">

	$(document).ready(function(){
    	
    	$('[data-toggle="tooltip"]').tooltip(); 
	
	});
	
	$(document).ready(function(){
		
		$(".btn-delete").on("click", function(){
			var selected = $(this).attr("id");
			var doc_id = selected.split("del_").join("");
			
			var confirmed = confirm("Are you sure you want to delete this document?");
			
			if(confirmed==true){
				$.get("index.php?page=1&id="+doc_id);
			}
		});

		$(".btn-like").on("click", function(){
			var selected = $(this).attr("id");
			var doc_id = selected.split("like_").join("");
			
			$.get("index.php?page=2&id="+doc_id);
		});

	});
	
	function validate(){
		var id_st = $("#11").hasClass("has-success");
		var pwd_st = $("#12").hasClass("has-success");
		var email_st = $("#13").hasClass("has-success");
		
		if(id_st && pwd_st && email_st){
			return true;
		}
		return false;
	}

    function ValidateID(id) {
	    var expr = /^[a-zA-Z0-9.@$&_]{5,10}$/;
	    return expr.test(id);
    };
	
    function ValidateEmail(email) {
	    var expr = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
	    return expr.test(email);
    };

	function Success(x, y){
		$(x).removeClass("has-success");
		$(x).removeClass("has-error");
		$(x).addClass("has-success");					
		
		$(y).removeClass("glyphicon-ok");
		$(y).removeClass("glyphicon-remove");
		$(y).addClass("glyphicon-ok");
	}
	
	function Error(x, y){
		$(x).removeClass("has-success");
		$(x).removeClass("has-error");
		$(x).addClass("has-error");
		
		$(y).removeClass("glyphicon-ok");
		$(y).removeClass("glyphicon-remove");
		$(y).addClass("glyphicon-remove");
	}
	
	function checkID() {
		var input = $("#id").val();
		jQuery.ajax({
		url: "check_availability.php",
		data:'id='+input,
		type: "POST",
		success:function(data){
			if(data==1 && ValidateID(input)){
				Success("#11", "#21");
			}
			else{
				Error("#11", "#21")
			}			
		},
		error:function (){}
		});
	}

	function checkPassword() {
		if($("#pwd").val()!=""){
			if($("#pwd").val()==$("#re-pwd").val()){
				Success("#12", "#22");				
				return;
			}			
		}
		
		Error("#12", "#22");
	}

	function checkEmail() {
		var input = $("#email").val();
		jQuery.ajax({
		url: "check_availability.php",
		data:'email='+input,
		type: "POST",
		success:function(data){
			if(data==1 && ValidateEmail(input)){
				Success("#13", "#23");
			}
			else{
				Error("#13", "#23");
			}						
		},
		error:function (){}
		});
	}

	function removeClass(x, y){
		$(x).removeClass("has-success");
		$(x).removeClass("has-error");
		
		$(y).removeClass("glyphicon-ok");
		$(y).removeClass("glyphicon-remove");			
	}

</script>
