if (window.print) {
	$("#printthisimage").click(function() {
		var printthisimagewindow = window.open($("#printthisimage").attr("data-href"));

		//timeout-testa när browsern har skapat fönstret. Vi kan inte använda onload eftersom IE m.fl. inte bygger window-objektet förrän fönstret öppnats
		var testdoctitel;
		function newWinLoaded(){
		    testdoctitel = printthisimagewindow.document.getElementsByTagName("body");
		    if(testdoctitel[0]==null){
			setTimeout(newWinLoaded, 10);
		    }else{
			//extra timeout, krävs för Opera m.fl.
			window.setTimeout(function () {
				printthisimagewindow.print();

				//Chrome stänger fönstret för tidigt
				if (navigator.userAgent.toLowerCase().indexOf('chrome') <= -1)
					printthisimagewindow.close();

			    }, 500);
		    }
		}
		newWinLoaded();


		return false;
	});
	$("#printthisimage").css("display","");
}
