<?php
session_start();
if (isset($_SESSION['id']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>

<title>Info++ - Catalogue</title>
</head>
<body>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
    
     <script> 

            $(document).ready(function() {
            	
            

            	var activePage = window.location.href;
            	console.log(activePage);
                //var activePage = url.substring(url.lastIndexOf('/') + 1);
                
                $('.topliens .navigation2').each(function () {
                    var linkPage = this.href;
					console.log(linkPage);
                    if (activePage == linkPage) {
                                            
                    	//$(this).closest("a").removeClass("navigation1");
                        $(this).closest(".navigation2").addClass("navigation1");
                        $(this).closest(".navigation2").removeClass("navigation2");
                    }
                });
            	
            	
            });

            $(document).on("click", ".panier", function(e){
            	e.stopPropagation();
            	var div = $(this).closest("body").find(".serviceForPanier");
            	var lol = $(this).closest("body").find(".allpage");
            	var pk = $(this).closest(".divTable").find("#pk_service");
            	
        		data = "pk_service=" + pk.text();
        		
            	$.ajax({method : "POST",
        			url : "MVC/view/get_serviceForPanier.php",
        			data : data,
        			beforeSend : function() {
        				// TO INSERT - loading animation
        			},
        			success : function(response) {
        				div.css("display", "block");
        				lol.css("display", "block");
        				div.append(response);
        			}
        		
    			});
            	
        	});

            $(document).mouseup(function(e) {
    		    var container = $(".serviceForPanier");
    		    var container2 = $(".allpage");

    		    // if the target of the click isn't the container nor a descendant of the container
    		    if (!container.is(e.target) && container.has(e.target).length === 0) 
    		    {
    		    	container.html('');
    		        container.hide();
    		        container2.hide();
    		    }
    		});
            
            $(document).on("click", ".buttonAjoutPanier", function(e){
                var pk = $(this).closest(".serviceForPanier").find("#pk_service");
                
                var div = $(this).closest("body").find(".serviceForPanier");
            	var lol = $(this).closest("body").find(".allpage");
                
				data = "pk_service=" + pk.text();
        		
            	$.ajax({method : "POST",
        			url : "MVC/view/pushToArraySession.php",
        			data : data,
        			beforeSend : function() {
        				// TO INSERT - loading animation
        			},
        			success : function(response) {
        				div.html('');
        				div.css("display", "none");
        				lol.css("display", "none");
        				$("a#panierAJAX").html("Mon panier ( " + response + ")");
        				//update Mon panier(x)
        			}
        		
    			});
            });

            

		</script>
    
</html>