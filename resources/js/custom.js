$(document).ready(function(){
    alert("hello");
    loadcart();

    function loadcart(){
        $.ajax({
            type:"GET",
            url:"/load-cart-data",
            success: function (response){
                alert(response.count)
    
            }
        });
        
        
    }
});