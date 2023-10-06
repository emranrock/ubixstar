window.addEventListener('online',updateStatus);
window.addEventListener('offline',updateStatus);

function updateStatus(e){
    if(navigator.onLine){
        $("#status").html('<i class="fa fa-circle text-success"></i> Online');
        $("#statusBar").html('<div class="bar">Back To Online</div>');
        $('.bar').delay(1500).fadeOut(800); 
    }else{
        $("#status").html('<i class="fa fa-circle text-danger"></i> Offline');
        $("#statusBar").html('<div class="bar">You are Offline</div>');
        $('.bar').delay(1500).fadeOut(800); 
    }
}