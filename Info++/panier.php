<?php
session_start();
if (isset($_SESSION['id']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
if (count($_SESSION['panier']) == 0){
    
    header("Location: http://localhost/infoplusplus/Info++/catalogue.php?vide=1");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>

<title>Info++ - Panier</title>
</head>
<body>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_panier.php';
            $aPanier = new InfoPanier();
            $aPanier->getDynamicList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
    
    <script>
    $(document).on("click", "#clickRetirer", function(e){
        var pk = $(this).attr("idObj");
        var div = $("#content");
        
		data = "pk_service=" + pk;
		
    	$.ajax({method : "POST",
			url : "MVC/view/removeFromArraySession.php",
			data : data,
			beforeSend : function() {
				// TO INSERT - loading animation
			},
			success : function(response) {
				div.html(response);
				var count = div.find("#count");
				$("a#panierAJAX").html("Mon panier ( " + count.text() + " )");
				checkIfEmpty();
			}
		
		});
    });

    $(document).on("click", "#validerAdd", function(e){
        var code = $(this).closest("form").find(".codePromoInput");
        var soustotal = $(this).closest(".divTotal").find(".sousTotal");
        var total = $(this).closest(".divTotal").find(".total");
        var rabais = $(this).closest(".divTotal").find(".rabaisAdditionnel");
        

		if(code.val() != ""){
			dataToSend = "code=" + code.val() + "&soustotal=" + soustotal.html();
	    	$.ajax({method : "POST",
				url : "MVC/view/checkIfExist.php",
				data : dataToSend,
				beforeSend : function() {
					// TO INSERT - loading animation
				},
				success : function(data) {
					//alert(data);
					var result = data.toString();
					if(result.indexOf("fail")>-1){
						alert('Ce code promotionnel est inexistant ou expiré');
						code.val('');
						code.focus();
					} else{
						rabais.html(data);
						var leSousTotal = soustotal.html();
	
						var ancienSousTotal = leSousTotal.replace('sous-total: ','');
						ancienSousTotal = ancienSousTotal.replace('$','');
						
						var leRabais = data.replace('rabais aditionnel: ','');
						leRabais = leRabais.replace('$','');
						
						var taxes = 1.14975;
	
						var nouveauTotal = 0;
						nouveauTotal = (ancienSousTotal - leRabais) * taxes;
						
						total.html("Total: " + nouveauTotal.toFixed(2) + "$");
					}
				}
			
			});
		} else {
	        var div = $("#content");
	        data = '';
	    	$.ajax({method : "POST",
				url : "MVC/view/getPanier.php",
				data : data,
				beforeSend : function() {
					// TO INSERT - loading animation
				},
				success : function(response) {
					div.html(response);
				}
			
			});
		}
    });
function checkIfEmpty(){
	var servicesPanier = document.getElementsByClassName('divTable');
	if (servicesPanier.length <= 0) {
		$('#paypal-button').addClass('none');
	}
}
    $(document).ready(function() { 
    	checkIfEmpty();

        });
    </script>
    
    <div class="bouton" id="paypal-button"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
var totalpayment ="";
var totalrabais ="";	
var services = [];
    paypal.Button.render({
		
        env: 'sandbox', // Or 'sandbox'

        style: {
            label: 'checkout',
            size:  'small',    // small | medium | large | responsive
            shape: 'rect',     // pill | rect
            color: 'blue'      // gold | blue | silver | black
        },
		
        client: {
            sandbox:    'Aa9S-q7EMtLecAILmrMVM5QHD_ZNVsIrf_-y61n2sP0Is4T-5u4ueolTGtPHJGqFTr6Gf_O028e5A7yq'
        },

        commit: true, // Show a 'Pay Now' button
        
        payment: function(data, actions) {
        	var total = $('#tot').text();
        	var total2 = total.split('$')[0]; 
        	totalpayment = total2.split(' ')[1];

        	var totalrab= $('#rabTot').text();
        	var totalrabais2 = totalrab.split('$')[0]; 
        	totalrabais = totalrabais2.split(' ')[2];
        	
			var servicesPks = $("div *").filter(function() {return(this.id == "pkS");});
			
			$(servicesPks).each(function( index ) {
				  services.push( $( this ).text() );
				});

        	
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: totalpayment, currency: 'CAD' }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
            	
               var data = {transId : payment.transactions[0].related_resources[0].sale.id, services : services, tarif : totalpayment, rabais : totalrabais}; 
			$.ajax({method : "POST",
        			url : "MVC/Controller/payment_controller.php",
        			
        			data : data,
        			beforeSend : function() {
        				// TO INSERT - loading animation
        			},
        			success : function(response) {
        				//console.log(response);
        				alert("Paiement réussi");
        				$(location).attr('href',"http://localhost/infoplusplus/Info++/catalogue.php?success=1");
        			}
        		
    			});payment;
			
            });
        }

    }, '#paypal-button');
</script>
    
</html>