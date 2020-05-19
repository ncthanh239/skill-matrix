  $.ajaxSetup({
  	headers: {
  		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  	}
  });
  $(function () {  
  	$("#datepicker1").datepicker({         
  		autoclose: true,         
  		'format': 'yyyy-mm-dd'
  	}).datepicker('update', new Date());
  });
  $(document).on('change', '.skill-option', function(e){
  	e.preventDefault();
  	$('#modal-id').modal({
  		show: 'true'
  	});
  	var userId = $(this).attr('data-user');
  	var skillId = $(this).attr('data-skill');
  	var levelSkill = $(this).children("option").filter(":selected").val();
  	$('.hidden-userId').val(userId);
  	$('.hidden-skillId').val(skillId);
  	$('.hidden-levelSkill').val(levelSkill);
  });
  $(document).on('click', '.update-skill-up', function(e){
  	var userId = $('.hidden-userId').val();
  	var skillId = $('.hidden-skillId').val();
  	var levelSkill = $('.hidden-levelSkill').val();
  	var date = $('#datepicker1').val();
  	var check = "-";
  	if(levelSkill==check){
  		toastr.warning(chooseNull);
  	}
  	else{
  		$.ajax({
  			url:'/userskill/addLevel',
  			type:'POST',
  			data:{
  				userId: userId,
  				skillId: skillId,
  				levelSkill: levelSkill,
  				date: date,
  				_token: $('#token').val()
  			},
  			success:function(response){
  				toastr.success(levelUpSuccess);
  				setTimeout(function(){
  					window.location.href = "/userskillup";
  				},100);
  			},
  			error:function(){
  				toastr.error(levelUpError);
  			}
  		});
  	}
  });
  $(document).on('click', '.btn-accept-skill', function(e){
  	e.preventDefault();
  	var userId = $(this).attr('data-user');
  	var skill = $(this).attr('data-skill');
  	var level = $(this).attr('data-level');
  	alert
  	swal({
  		title: titleUpdate,
  		text: textUpdate,
  		icon: warning,
  		buttons: true,
  		dangerMode: true,
  	})
  	.then((willDelete) => {
  		if (willDelete) {
  			$.ajax({
  				url:'/userskill/updateSkill',
  				type:'POST',
  				data:{
  					user_id: userId,
  					skill:skill,
  					level:level,
  					_token: $('#token').val()
  				},
  				success:function(response){
  					setTimeout(function(){
  						window.location.href = "/userskillup";
  					},100);
  				},
  				error:function(){
  					swal(errorUpdate, "", warning);
  				}
  			});
  			swal(successUpdate, {
  				icon: success,
  			});
  		} else {
  			swal(cancelUpdate);
  		}
  	});
  });

  $(document).on('change', '.section-option', function(e){
    var sectionId = $(this).children("option").filter(":selected").val();
    var allSectionId = 0;
    var url = '/userskill/section/'+sectionId;
    if(sectionId==allSectionId){
      setTimeout(function(){
        window.location.href = "/userskill";
      },100);
    }
    else{
      $.ajax({
        url:url,
        type:'GET',
        success:function(response){
         setTimeout(function(){
          window.location.href = "/userskill/section/"+sectionId;
        },100);
       },
       error:function(){

      }
    });
    }
  });