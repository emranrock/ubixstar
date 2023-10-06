

$(document).ready(function(){
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

// tacher registration

$(document).ready(function(){
	
	var addUserForm = $("#addteacher");
	
	var validator = addUserForm.validate({
		
		rules:{
			register_date :{ required : true },
			address :{ required : true },
			name :{ required : true },
			aadhar : { required : true, digits : true },
			mobile : { required : true, digits : true },
			dob:{ required : true, date:true},
			qualification:{required : true},
			role : { required : true, selected : true}
		},
		messages:{
			register_date :{ required : "This field is required" },
			address :{ required : "This field is required" },
			qualification :{ required : "This field is required" },
			name :{ required : "This field is required" },
			aadhar : { required : "This field is required", digits : "Please enter numbers only" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			dob :{ required : "This field is required" },
			//role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

$(document).ready(function(){
	
	var addUserForm = $("#addStudent");
	
	var validator = addUserForm.validate({
		
		rules:{
			name :{ required : true },
			//email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			fname : { required : true },
			//date_addmin : {required : true, date: true},
			email : {required : true,selected : true},
			addmision_fee : {required : true},
			total_fee : {required : true, digits : true},
			address : {required : true},
			mobile : { required : true, digits : true },
			//role : { required : true, selected : true}
		},
		messages:{
			name :{ required : "Fill Student Name" },
			fname :{ required : "Father Name  field is required" },
			mname :{ required : "Mother Name  field is required" },
			mt :{ required : "MotherToungh  field is required" },
			addar :{ required : "Aadhar  field is required" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			//role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});

$(document).ready(function(){
	
	var addUserForm = $("#addsalary");
	
	var validator = addUserForm.validate({
		
		rules:{
			months :{ required : true, digits : true },
			teacher_name : {required : true},
			salary : {required : true, digits : true },
			working_day : {required : true, digits : true },
			new_salary : {required : true, digits : true },
			paid_amount : {required : true, digits : true },
		},
		messages:{
			months :{ required : "Fill Select Month" },
			teacher_name : {required : "Fill Student Name"},
			salary : {required : "This field is required", digits : "Please enter numbers only" },
			working_day : {required : "This field is required", digits : "Please enter numbers only" },
			new_salary : {required : "This field is required", digits : "Please enter numbers only" },
			paid_amount : {required : "This field is required", digits : "Please enter numbers only" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
		}
	});
});


$(document).ready(function(){
	
	var addUserForm = $("#addFees");
	
	var validator = addUserForm.validate({
		
		rules:{
			date :{ required : true, date : true },
		},
		messages:{
			date :{ required : "Fill  Date First" },
		}
	});
});


$(document).ready(function(){
	
	var addUserForm = $("#addVehichel");
	
	var validator = addUserForm.validate({
		
		rules:{
			plate_number :{ required : true, text : true },
			vehichel_color :{ required : true, text : true },
			vehichel_model :{ required : true, text : true },
			driver_name :{ required : true, text : true },
			driver_license :{ required : true, text : true },
			driver_contact :{ required : true, text : true },
		},
		messages:{
			plate_number :{ required : "Fill  Plate Number First" },
			vehichel_color :{ required : "Fill  Vehichel Color First" },
			vehichel_model :{ required : "Fill  Vehiche Model First" },
			driver_name :{ required : "Fill  Driver Name First" },
			driver_license :{ required : "Fill  Driver License First" },
			driver_contact :{ required : "Fill  Driver Contact First" },
		}
	});
});


$(document).ready(function(){
	
	var addUserForm = $("#addTransport");
	
	var validator = addUserForm.validate({
		
		rules:{
			transport_name :{ required : true, text : true },
			transport_route :{ required : true, text : true },
			transport_vehichel :{ required : true, selected : true },
			transport_fare :{ required : true, digits : true },
			
		},
		messages:{
			transport_name :{ required : "Fill  Transport Title First" },
			transport_route :{ required : "Fill  Route First" },
			transport_vehichel :{ required : "Fill  Vehiche  First" },
			transport_fare :{ required : "Fill  Fare First" },
			
		}
	});
});