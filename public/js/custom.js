$.ajaxSetup({
	headers:{
	  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	}
 });
 
 $(function(){

   /* UPDATE ADMIN PERSONAL INFO */

   $('#AdminInfoForm').on('submit', function(e){
	   e.preventDefault();

	   $.ajax({
		  url:$(this).attr('action'),
		  method:$(this).attr('method'),
		  data:new FormData(this),
		  processData:false,
		  dataType:'json',
		  contentType:false,
		  beforeSend:function(){
			  $(document).find('span.error-text').text('');
		  },
		  success:function(data){
			   if(data.status == 0){
				 $.each(data.error, function(prefix, val){
				   $('span.'+prefix+'_error').text(val[0]);
				 });
			   }else{
				 $('.admin_name').each(function(){
					$(this).html( $('#AdminInfoForm').find( $('input[name="name"]') ).val() );
				 });
				 alert(data.msg);
			   }
		  }
	   });
   });


   $(document).on('click','#change_picture_btn', function(){
	 $('#admin_image').click();
   });


   $('#admin_image').ijaboCropTool({
		 preview : '.admin_picture',
		 setRatio:1,
		 allowedExtensions: ['jpg', 'jpeg','png'],
		 buttonsText:['CROP','QUIT'],
		 buttonsColor:['#30bf7d','#ee5155', -15],
		 processUrl:'{{ route("adminPictureUpdate") }}',
		 // withCSRF:['_token','{{ csrf_token() }}'],
		 onSuccess:function(message, element, status){
			alert(message);
		 },
		 onError:function(message, element, status){
		   alert(message);
		 }
	  });


   $('#changePasswordAdminForm').on('submit', function(e){
		e.preventDefault();

		$.ajax({
		   url:$(this).attr('action'),
		   method:$(this).attr('method'),
		   data:new FormData(this),
		   processData:false,
		   dataType:'json',
		   contentType:false,
		   beforeSend:function(){
			 $(document).find('span.error-text').text('');
		   },
		   success:function(data){
			 if(data.status == 0){
			   $.each(data.error, function(prefix, val){
				 $('span.'+prefix+'_error').text(val[0]);
			   });
			 }else{
			   $('#changePasswordAdminForm')[0].reset();
			   alert(data.msg);
			 }
		   }
		});
   });

   
 });