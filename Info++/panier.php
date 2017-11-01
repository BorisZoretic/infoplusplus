<?php
session_start();
if (isset($_SESSION['id']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
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
			}
		
		});
    });
    </script>
    
    <div class="bouton" id="paypal-button"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>

	
    paypal.Button.render({
		
        env: 'sandbox', // Or 'sandbox'

        style: {
            label: 'checkout',
            size:  'medium',    // small | medium | large | responsive
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
        	var totalpayment = total2.split(' ')[1];

        	var totalrab= $('#tot').text();
        	var totalrabais2 = totalrab.split('$')[0]; 
        	var totalrabais = totalrabais2.split(' ')[1];
        	
			var servicesPks = $("div *").filter(function() {return(this.id == "pkS");});
			var services = [];
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

               var data = {transId : payment.transactions[0].related_resources[0].sale.id, services : services, tarif : totalpayment, rabais : }; 
			$.ajax({method : "POST",
    			url : "MVC/Controller/payment_controller.php",
    			
    			data : data,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
    				$('#paypal').text(response);
    			}
    		
			});payment;
            });
        }

    }, '#paypal-button');
</script>
    
</html>